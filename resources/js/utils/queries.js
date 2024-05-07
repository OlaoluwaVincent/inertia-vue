import axios from "axios";

export async function getPopularCategories() {
    try {
        const res = await axios.get("/api/categories");
        return res.data;
    } catch (error) {
        return error.stack;
    }
}
