<template>

    <div class="surface-card p-4 shadow-2 border-round w-full lg:w-6">
        <div class="text-center mb-5">
            <img src="../../../images/download.png" alt="Image" height="50" class="mb-3">
            <div class="text-900 text-3xl font-medium mb-3">Welcome Back</div>
            <span class="text-600 font-medium line-height-3">Don't have an account?</span>
            <router-link :to="{ name: 'register' }" class="font-medium no-underline ml-2 text-blue-500 cursor-pointer">Create
                Today </router-link>
        </div>

        <div>
            <label for="email1" class="block text-900 font-medium mb-2">Email</label>
            <InputText v-model="email" type="text" class="w-full mb-3" />

            <label for="password1" class="block text-900 font-medium mb-2">Password</label>
            <Password class="w-full" v-model="password" toggleMask :feedback="false" />

            <div class="flex align-items-center justify-content-between mb-6">
                <div class="flex align-items-center">
                    <Checkbox id="rememberme1" :binary="true" class="mr-2"></Checkbox>
                    <label for="rememberme1">Remember me</label>
                </div>
                <a class="font-medium no-underline ml-2 text-blue-500 text-right cursor-pointer">Forgot password?</a>
            </div>

            <Button label="Sign In" icon="pi pi-user" class="w-full" @click="login()"></Button>
        </div>
    </div>
</template>

<script>
import Checkbox from 'primevue/checkbox';
import Password from 'primevue/password';
export default {
    components: { Checkbox, Password },
    data() {
        return {
            email: '',
            password: '',
        }
    },
    methods: {
        async login() {
            this.$store.dispatch('Loading');
            try {
                let creds = { email: this.email, password: this.password }
                const response = await this.$store.dispatch('login', creds)
                this.$store.dispatch('stopLoading');
                this.$toast.add({ severity: 'success', summary: 'Login Successfully', life: 3000 });
                this.$router.push({name:'landingPage'})
                this.$store.commit('setUser',response.data.user)
                localStorage.setItem('isAuth','true')
            }
            catch (e) {
                console.log(this.router)
                this.$store.dispatch('stopLoading');
                this.$toast.add({ severity: 'error', summary: 'Something went Wrong', detail: 'Wrong Email or Password', life: 3000 });
            }

        }
    }
}
</script>

<style>
input[type="text"] {
    width: 100%;
}
</style>
