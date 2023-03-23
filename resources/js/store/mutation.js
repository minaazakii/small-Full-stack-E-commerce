export default {
    startLoading(state) {
        state.isLoading = true;
    },
    closeLoading(state) {
        state.isLoading = false;
    },
    setStatuses(state, context) {
        state.statuses = context;
    },
    setUser(state, context) {
        localStorage.setItem("user", JSON.stringify(context));
        state.user = context;
    },
    logout(state) {
        localStorage.removeItem("user");
        localStorage.removeItem('isAuth')
        state.user = null;
    },
    setCart(state,context){
        state.cart = context.items;
        state.cartCount = context.count
    }
};
