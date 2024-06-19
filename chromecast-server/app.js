const express = require("express");
const { Client, DefaultMediaReceiver } = require("castv2-client");
const Youtube = require("castv2-client").DefaultMediaReceiver;

const app = express();
const port = 3000;

let client;
let player;

app.use(express.json());

const playVideoOnChromecast = () => {
  return new Promise((resolve, reject) => {
    client = new Client();

    client.connect("192.168.0.5", () => {
      resolve(true);
      console.log("Connected to Chromecast");
    });

    client.on("error", (err) => {
      console.error("Client error:", err);
      client.close();
      reject(err);
    });
  });
};

playVideoOnChromecast()
  .then()
  .catch((err) => console.log(err));

app.post("/play-video", (req, res) => {
  const videoId = req.body.videoId;
  const deviceIp = req.body.deviceIp;

  if (!videoId || !deviceIp) {
    return res
      .status(400)
      .send({ error: "Video ID and device IP are required" });
  }

  // client.launch(Youtube, function (err, player) {
  //   if (err) {
  //     console.error("Error launching YouTube:", err);
  //     return res.status(400).send({ error: "Youtube Error" });
  //   }
  //   console.log("YouTube app launched successfully");

  //   player.load(`https://youtu.be/${videoId}`, function (err, status) {
  //     if (err) {
  //       console.error("Error loading video:", err);
  //     }
  //   });
  //   res.send({ success: true });
  // });

  client.launch(Youtube, function (err, player) {
    var media = {
      // Here you can plug an URL to any mp4, webm, mp3 or jpg file with the proper contentType.
      contentId: `https://www.youtube.com/watch?v=gdviNUp0jxg`,
      // contentType: "video/webm",
      streamType: "LIVE", // or LIVE

      metadata: {
        type: 0,
        metadataType: 0,
        title: "YouTube",
        images: [
          {
            url: "http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/images/BigBuckBunny.jpg",
          },
        ],
      },
    };

    player.on("status", function (status) {
      console.log("status broadcast playerState=%s", status);
    });

    console.log(
      'app "%s" launched, loading media %s ...',
      player.session.displayName,
      media.contentId
    );

    player.load(media, { autoplay: true }, function (err, status) {
      console.log("media loaded playerState=%s", status);

      // Seek to 2 minutes after 15 seconds playing.
      setTimeout(function () {
        player.seek(2 * 60, function (err, status) {
          //
        });
      }, 15000);

      res.send({ success: true });
    });
  });
});

app.post("/volume-up", (req, res) => {
  if (!client) {
    return res.status(400).send({ error: "Client not connected" });
  }

  client.getVolume((err, volume) => {
    if (err) {
      return res.status(500).send({ error: err.message });
    }

    const newVolume = Math.min(volume.level + 0.1, 1);
    client.setVolume({ level: newVolume }, (err) => {
      if (err) {
        return res.status(500).send({ error: err.message });
      }
      res.send({ success: true, volume: newVolume });
    });
  });
});

app.post("/volume-down", (req, res) => {
  if (!client) {
    return res.status(400).send({ error: "Client not connected" });
  }

  client.getVolume((err, volume) => {
    if (err) {
      return res.status(500).send({ error: err.message });
    }

    const newVolume = Math.max(volume.level - 0.1, 0);
    client.setVolume({ level: newVolume }, (err) => {
      if (err) {
        return res.status(500).send({ error: err.message });
      }
      res.send({ success: true, volume: newVolume });
    });
  });
});

app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});
