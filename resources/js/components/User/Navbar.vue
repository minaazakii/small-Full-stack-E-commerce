<template>
    <nav class="navbar bg-bluegray-900">
        <div class="navbar-brand">
            <a href="#">E-commerce</a>
        </div>
        <div class="navbar-links">
            <a href="#">Home</a>
            <a href="#">Shop</a>
            <a href="#">Contact</a>
        </div>
        <div v-if="user != null" class="navbar-icons">
            <router-link :to="{ name: 'cart' }" href="#" class="cart-icon">
                <i class="pi pi-shopping-cart"></i>
                <span class="cart-number">{{ cartCount || 0}}</span>
            </router-link>
            <a href="#" class="cart-icon ml-5">
                <i class="pi pi-heart"></i>

            </a>
            <a @click="logout" class="login-button">Logout</a>
        </div>


        <div v-if="user == null" class="navbar-icons">
            <router-link :to="{ name: 'login' }" v-if="user === null" class="login-button">Login</router-link>
            <router-link :to="{ name: 'register' }" v-if="user === null" href="#" class="signup-button">Sign
                Up</router-link>
        </div>

    </nav>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    mounted(){
        this.$store.dispatch('getCart')
    },
    computed: {
        ...mapGetters({
            cart: 'cart',
            user: 'user',
            cartCount: 'cartCount',
        })
    },

    data() {
        return {

        }
    },
    methods: {
        logout() {
            this.$store.dispatch('Loading')
            this.$store.commit('logout')
            this.$router.push({name: 'login'})
            this.$store.dispatch('stopLoading')
        }
    }

}
</script>

<style scoped>
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background-color: #f8f9fa;
}

.navbar-brand a {
    font-size: 1.5rem;
    font-weight: bold;
    text-decoration: none;
    color: white;
}

.navbar-links a {
    margin-right: 1rem;
    font-size: 1.2rem;
    text-decoration: none;
    color: white;
}

.navbar-icons {
    display: flex;
    align-items: center;
}

.cart-icon {
    margin-right: 1rem;
    position: relative;
}

.cart-number {
    position: absolute;
    top: -8px;
    right: -8px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #f00;
    color: #fff;
    font-size: 0.8rem;
    font-weight: bold;
}

.cart-icon i {
    font-size: 1.5rem;
    color: white;
}

.login-button {
    margin-right: 1rem;
    padding: 0.5rem 1rem;
    border: none;
    background-color: transparent;
    font-size: 1.2rem;
    text-decoration: none;
    color: white;
    cursor: pointer;
}

.signup-button {
    padding: 0.5rem 1rem;
    border: none;
    background-color: #007bff;
    font-size: 1.2rem;
    text-decoration: none;
    color: #fff;
    cursor: pointer;
}
</style>
