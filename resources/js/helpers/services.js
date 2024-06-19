import axios from "axios";

const url = "http://localhost:8000";

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
    searchVideos
};
