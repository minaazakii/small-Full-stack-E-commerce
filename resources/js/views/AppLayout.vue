<template>
    <Toast />
    <div v-if="isLoading" class="spinner">
        <ProgressSpinner />
    </div>
    <div class="grid">
        <div class="col-12">
            <Navbar></Navbar>
        </div>
    </div>


        <router-view></router-view>
 
</template>

<script>
import Navbar from '../components/User/Navbar.vue'
import { mapGetters } from 'vuex'
export default {
    components:{Navbar},
    computed: {
        ...mapGetters({
            isLoading: 'isLoading'
        })
    }
}
</script>

<style></style>
