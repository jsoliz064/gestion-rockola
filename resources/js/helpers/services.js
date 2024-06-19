import axios from "axios";

const url = "http://localhost:8000";

async function getAllVideos(token) {
    try {
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

export default {
    getAllVideos,
};
