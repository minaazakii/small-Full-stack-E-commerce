import axios from "axios";
const baseUrl ='http://localhost:8000/api/'
export default {

    Loading({commit})
    {
        commit('startLoading');
    },
    stopLoading({commit})
    {
        commit('closeLoading');
    },
    async getStatuses({commit})
    {
        const response = await axios.get('http://localhost:8000/api/statuses')
        commit('setStatuses', response.data)

    },
    async login({commit},context)
    {
        const response = await axios.post('http://localhost:8000/api/login',context);
        return response
    },
    async register(payload,context)
    {
        let body =
        {
            name:context.name,
            email:context.email,
            password:context.password,
            phone:context.phone,
            address:context.address
        }
        const response = await axios.post('http://localhost:8000/api/register',body);
        return response
    },
    async addToCart(payload,context)
    {
        let body=
        {
            "user_id": payload.state.user.id,
            "product_id": context.id,
        }
        const response = await axios.post('http://localhost:8000/api/cart/add',body)
        return response
    },
    async getCart({commit,state})
    {
       const response = await axios.get('http://localhost:8000/api/cart/'+state.user.id)
       commit('setCart',response.data)
    },
    async updateCart({commit,state},context)
    {
        console.log(context)
        let body ={product_id:context.id,quantity:context.quantity}
        const response = await axios.put('http://localhost:8000/api/cart/update/'+state.user.id,body)
        console.log(response)
    },
    async removeFromCart({state},context)
    {
        console.log(context.id,state.user.id)
        const response = await axios.delete(baseUrl+'cart/delete/'+state.user.id+'?product_id='+context.id)
        console.log(response)
        return response
    }

}
