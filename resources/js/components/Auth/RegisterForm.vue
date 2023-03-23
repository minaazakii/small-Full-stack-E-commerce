<template>
    <div class="surface-card p-4 shadow-2 border-round w-full lg:w-6">
    
        <div class="text-center mb-5">
            <img src="../../../images/download.png" alt="Image" height="50" class="mb-3">
            <div class="text-900 text-3xl font-medium mb-3">Sign Up</div>
            <span class="text-600 font-medium line-height-3">Remembered Your Account?</span>
            <router-link :to="{ name: 'login' }" class="font-medium no-underline ml-2 text-blue-500 cursor-pointer">Login
                Now</router-link>
        </div>

        <div>
            <label for="password1" class="block text-900 font-medium mb-2">Name</label>
            <InputText v-model="user.name" type="text" class="w-full mb-3" />
            <label  for="email1" class="block text-900 font-medium mb-2">Email</label>
            <InputText v-model="user.email" type="email" class="w-full mb-3" />

            <div>
                <label for="password1" class="block text-900 font-medium mb-2">Password</label>
                <Password v-model="user.password"  class="w-full mb-3" toggleMask>
                    <template #header>
                        <h6>Pick a password</h6>
                    </template>
                    <template #footer>
                        <Divider />
                        <p class="mt-2">Suggestions</p>
                        <ul class="pl-2 ml-2 mt-0" style="line-height: 1.5">
                            <li>At least one lowercase</li>
                            <li>At least one uppercase</li>
                            <li>At least one numeric</li>
                            <li>Minimum 8 characters</li>
                        </ul>
                    </template>
                </Password>
            </div>


            <label for="password1" class="block text-900 font-medium mb-2">Phone Number</label>
            <InputNumber v-model="user.phone" inputId="withoutgrouping" class="w-full mb-3" :useGrouping="false" />

            <label for="password1" class="block text-900 font-medium mb-2">Address</label>
            <InputText v-model="user.address" type="text" class="w-full mb-3" />


            <Button label="Sign Up" icon="pi pi-user" class="w-full" @click="signUp()"></Button>
        </div>
    </div>
</template>

<script>
import Checkbox from 'primevue/checkbox';
import Password from 'primevue/password';
import Divider from 'primevue/divider';

export default {
    components: { Checkbox, Password,Divider },
    data() {
        return {
            user:{}
        }
    },
    methods:{
        async signUp()
        {
            this.$store.dispatch('Loading')
            try
            {
                const response = await this.$store.dispatch('register',this.user)
                this.$store.dispatch('stopLoading');
                this.$toast.add({ severity: 'success', summary: 'Registered Successfully', life: 3000 });
            }
            catch(e)
            {
                this.$store.dispatch('stopLoading');
                this.$toast.add({ severity: 'error', summary: 'Something went Wrong', life: 3000 });
            }
            
        }
    }
}
</script>



<style>
input[type="password"],input[type="text"]{
    width: 100%;
}
</style>