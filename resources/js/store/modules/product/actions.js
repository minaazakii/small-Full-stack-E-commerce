import axios from 'axios'
export default {
    async getProducts({commit})
    {
        const response = await axios.get('http://localhost:8000/api/products')
        commit('setProducts', response.data)
    },
    async addProduct(payload,data)
    {
        let body = 
        {
            name:data.name,
            price:data.price,
            reviews:data.review.value,
            category_id:data.category.id,
            status_id:data.status.id,
        }
        console.log(body)
        const response = await axios.post('http://localhost:8000/api/products',body)
        return response
    },
    async updateProduct(payload,data)
    {
        let body = 
        {
            name:data.name,
            price:data.price,
            reviews:data.reviews.value,
            category_id:data.category.id,
            status_id:data.status.id,
        }
        console.log(body)
        const response = await axios.put('http://localhost:8000/api/products/'+data.id,body)
        return response
    },
    async deleteProduct(payload,id)
    {
        console.log(id)
        const response = await axios.delete('http://localhost:8000/api/products/'+id)
        return response
    },
    async getProduct(payload,id)
    {
        const response = await axios.get('http://localhost:8000/api/products/'+id)
        return response
    }

}