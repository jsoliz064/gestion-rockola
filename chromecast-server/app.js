const express = require("express");
const { exec } = require("child_process");
const axios = require("axios");
require("dotenv").config();

const app = express();
const port = 3000;

const adbPath = "./adb/adb";
const deviceIp = process.env.TV_IP;
const salaToken = process.env.SALA_TOKEN;
const rockolaHost = process.env.ROCKOLA_HOST;

let daemonInterval;

app.use(express.json());

const connectToDevice = (ip) => {
    return new Promise((resolve, reject) => {
        exec(`"${adbPath}" connect ${ip}:5555`, (error, stdout, stderr) => {
            if (error) {
                console.log("error al conectar a tv");
                return reject(`Error connecting to device: ${stderr}`);
            }
            console.log("tv connected");
            resolve(stdout);
        });
    });
};

const openYouTubeVideo = (videoId) => {
    return new Promise((resolve, reject) => {
        exec(
            `"${adbPath}" shell am start -a android.intent.action.VIEW -d "https://www.youtube.com/watch?v=${videoId}"`,
            (error, stdout, stderr) => {
                if (error) {
                    return reject(`Error opening YouTube video: ${stderr}`);
                }
                resolve(stdout);
            }
        );
    });
};

const getLastVideo = async () => {
    try {
        const response = await axios.get(
            `${rockolaHost}/api/tvs/sala/last-video`,
            {
                headers: {
                    Authorization: salaToken,
                },
            }
        );
        console.log(response.data);
        return response.data;
    } catch (error) {
        const message = error.response.data || error.message;
        console.error("Failed to fetch last video", message);
        return null;
    }
};

const parseDuration = (duration) => {
    const match = duration.match(/PT(\d+H)?(\d+M)?(\d+S)?/);
    const hours = parseInt(match[1]) || 0;
    const minutes = parseInt(match[2]) || 0;
    const seconds = parseInt(match[3]) || 0;
    return (hours * 3600 + minutes * 60 + seconds) * 1000;
};

const playLastVideo = async (video) => {
    if (video) {
        console.log(`Playing video: ${video.title}`);
        try {
            await connectToDevice(deviceIp);
            await openYouTubeVideo(video.videoId);
            const durationMs = parseDuration(video.duration);
            console.log(`Video duration: ${durationMs / 1000} seconds`);

            setTimeout(() => {
                startDaemon();
            }, durationMs);
        } catch (error) {
            console.error("Error playing video:", error);
        }
    } else {
        console.log("No new video found");
        // Reinicia el daemon si no se encontró un nuevo video
        startDaemon();
    }
};

const startDaemon = () => {
    clearInterval(daemonInterval);
    daemonInterval = setInterval(async () => {
        const video = await getLastVideo();
        if (video) {
            clearInterval(daemonInterval);
            await playLastVideo(video);
        }
    }, 2000); // Verifica cada 2 segundos
};

app.post("/play-video", async (req, res) => {
    const videoId = req.body.videoId;
    if (!videoId) {
        return res.status(400).send({ error: "Video ID is required" });
    }

    try {
        await connectToDevice(deviceIp);
        await openYouTubeVideo(videoId);
        res.send({ success: true, message: "YouTube video opened" });
    } catch (error) {
        res.status(500).send({ error: error.message });
    }
});

startDaemon();

app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});
