const express = require('express');
const { exec } = require('child_process');

const app = express();
const port = 3000;

const adbPath = './adb/adb';

app.use(express.json());

const connectToDevice = (ip) => {
  return new Promise((resolve, reject) => {
    exec(`"${adbPath}" connect ${ip}:5555`, (error, stdout, stderr) => {
      if (error) {
        return reject(`Error connecting to device: ${stderr}`);
      }
      resolve(stdout);
    });
  });
};

const openYouTubeVideo = (videoId) => {
  return new Promise((resolve, reject) => {
    exec(`"${adbPath}" shell am start -a android.intent.action.VIEW -d "https://www.youtube.com/watch?v=${videoId}"`, (error, stdout, stderr) => {
      if (error) {
        return reject(`Error opening YouTube video: ${stderr}`);
      }
      resolve(stdout);
    });
  });
};

app.post('/play-video', (req, res) => {
  const videoId = req.body.videoId;
  const deviceIp = req.body.deviceIp;

  if (!videoId || !deviceIp) {
    return res.status(400).send({ error: "Video ID and device IP are required" });
  }

  connectToDevice(deviceIp)
    .then((output) => {
      console.log('Connected to device:', output);
      return openYouTubeVideo(videoId);
    })
    .then((output) => {
      console.log('YouTube video opened:', output);
      res.send({ success: true, message: 'YouTube video opened', output: output });
    })
    .catch((error) => {
      console.error(error);
      res.status(500).send({ error: error });
    });
});

app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});
