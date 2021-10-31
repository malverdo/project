import axios from "axios";

const instance = axios.create({
    baseURL:'http://symfonytest.local',
    withCredentials: true,
    headers: {
        accept:'application/json'
    }
})
export default instance