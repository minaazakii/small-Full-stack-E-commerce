export default {
    isLoading(state)
    {
        return state.isLoading
    },
    statuses(state)
    {
        return state.statuses
    },
    user(state)
    {
        return state.user
    },
    cart(state)
    {
        console.log(state.cart)
        return state.cart
    },
    cartCount(state)
    {
        return state.cartCount
    }

}