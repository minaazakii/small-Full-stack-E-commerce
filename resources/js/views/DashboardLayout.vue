<template>
    <div>
        <div>
            <Navbar></Navbar>
        </div>
        <div class="grid">

            <div class="col-12">
                <div class="flex-auto flex align-items-center justify-content-center">
                    <router-view></router-view>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import Navbar from '../components/Dashboard/Navbar.vue';

export default {
    components: {
        Navbar
    }
}
</script>

<style>
.spinner {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background-color: rgba(255, 255, 255, 0.5); /* semi-transparent white */
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
