import  axios  from "axios"
import store from "../../index.js"

export default {
    async getCategories({commit})
    {
        const response = await axios.get("http://localhost:8000/api/categories")
        commit('setCategories', response.data)   
    },
    async addCategory(payload,context)
    {
        const response = await axios.post("http://localhost:8000/api/categories",{name:context})
        return response
    },
    async updateCategory(payload,context)
    {
        const response = await axios.put("http://localhost:8000/api/categories/"+context.id,{name:context.name})
        return response
    },
    async deleteCategory(payload,context)
    {
        const response = await axios.delete("http://localhost:8000/api/categories/"+context)
        return response
    }
}