import axios from "axios";

export default axios.create({
    baseURL:
        "apiUrl" in window ? window.apiUrl : "http://localhost:8080/undefined",
    headers: {
        //"Content-Type": "application/json",
        Accept: "application/json",
    },
});
