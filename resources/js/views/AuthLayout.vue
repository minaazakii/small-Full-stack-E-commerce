<template>
    <div class="grid">
        <Toast/>
        <div v-if="isLoading" class="spinner">
            <ProgressSpinner />
        </div>
        <div class="col-12">
            <div class="flex-auto flex align-items-center justify-content-center">
                <router-view></router-view>
            </div>

        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    computed:{
        ...mapGetters({
            isLoading:'isLoading'
        })
    }
}
</script>

<style></style>