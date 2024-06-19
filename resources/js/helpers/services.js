import axios from "axios";

// let url = "http://localhost:8000";

const getDomain = () => {
    const domain = window.location.hostname;
    if (domain == "127.0.0.1") {
        return "";
    }
    const originalString = window.location.href;

    let count = 0;
    let fourthSlashIndex = -1;
    for (let i = 0; i < originalString.length; i++) {
        if (originalString[i] === "/") {
            count++;
            if (count === 3) {
                fourthSlashIndex = i;
                break;
            }
        }
    }

    let resultString = "";
    if (fourthSlashIndex !== -1) {
        resultString = originalString.substring(0, fourthSlashIndex);
    } else {
        resultString = originalString;
    }
    return resultString;
};

let url = getDomain();

async function getAllVideos() {
    try {
        const token = localStorage.getItem("token");
        if (!token) {
            throw new Error("No token found in localStorage");
        }
        const response = await axios.get(`${url}/api/rockola/videos`, {
            headers: {
                Authorization: token,
            },
        });
        console.log("reponse:", response);
        return response.data;
    } catch (error) {
        console.log("error: ", error);
        throw error;
    }
}

async function getSalaPlaylist() {
    try {
        const token = localStorage.getItem("token");
        if (!token) {
            throw new Error("No token found in localStorage");
        }
        const response = await axios.get(`${url}/api/rockola/playlist`, {
            headers: {
                Authorization: token,
            },
        });
        console.log("reponse:", response);
        return response.data;
    } catch (error) {
        console.log("error: ", error);
        throw error;
    }
}

async function addVideo(videoId) {
    try {
        const token = localStorage.getItem("token");
        if (!token) {
            throw new Error("No token found in localStorage");
        }
        const response = await axios.post(
            `${url}/api/rockola/add-video`,
            {
                videoId: videoId,
            },
            {
                headers: {
                    Authorization: token,
                },
            }
        );
        console.log("reponse:", response);
        return response.data;
    } catch (error) {
        console.log("error: ", error);
        throw error;
    }
}

async function searchVideos(query) {
    try {
        const token = localStorage.getItem("token");
        if (!token) {
            throw new Error("No token found in localStorage");
        }
        const response = await axios.get(
            `${url}/api/rockola/search?query=${query}`,
            {
                headers: {
                    Authorization: token,
                },
            }
        );
        console.log("reponse:", response);
        return response.data;
    } catch (error) {
        console.log("error: ", error);
        throw error;
    }
}

export default {
    getAllVideos,
    getSalaPlaylist,
    addVideo,
    searchVideos,
};
