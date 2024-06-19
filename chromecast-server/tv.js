const express = require("express");
const { exec } = require("child_process");
const axios = require("axios");

const app = express();
const port = 3000;

const adbPath = "C:\\wifiphone\\adb";
const deviceIp = "192.168.0.10";

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
      "http://localhost:8000/api/tvs/sala/last-video"
    );
    return response.data;
  } catch (error) {
    console.error("Failed to fetch last video", error.message);
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

const playLastVideo = async () => {
  const video = await getLastVideo();
  if (video) {
    console.log(`Playing video: ${video.title}`);

    try {
      await connectToDevice(deviceIp);
      await openYouTubeVideo(video.id);
      const durationMs = parseDuration(video.duration);
      console.log(`Video duration: ${durationMs / 1000} seconds`);

      // Configura el temporizador para verificar nuevamente después de la duración del video
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
  clearInterval(daemonInterval); // Asegúrate de que no haya múltiples intervalos en ejecución
  daemonInterval = setInterval(async () => {
    const video = await getLastVideo();
    if (video) {
      clearInterval(daemonInterval); // Detiene el demonio si se encuentra un nuevo video
      await playLastVideo();
    }
  }, 2000); // Verifica cada 2 segundos
};

// startDaemon();

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

app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});
