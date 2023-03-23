<template>

    <!-- <div>
        <Button icon="pi pi-align-justify " @click="showSideMenu()" class="mr-2" />
    </div> -->
    <div>
        <Sidebar @hide="hideSideMenu()"  v-model:visible="visible" :baseZIndex="10000" >

            <div class="mb-3 ">
                <h3>Sidemenu</h3>
            </div>
            <div class="mb-3">
                <Button  @click="$router.push({ name: 'categories' })" label="Categories"
                class="text-black p-button-raised p-button-text w-full" />
            </div>

            <div class="mb-3">
                <Button @click="$router.push({name:'products'})"  label="Products"
                class="text-black p-button-raised p-button-text w-full" />
            </div>

            <div class="mb-3">
                <Button  label="Users"
                class="text-black p-button-raised p-button-text w-full" />
            </div>

        </Sidebar>
    </div>
</template>

<script>
import Sidebar from 'primevue/sidebar';
export default {
    props:['buttonVisable'],
    components:{
        Sidebar
    },
    mounted()
    {
      this.visible = this.buttonVisable
      console.log(Sidebar)
    },
    data(){
        return{
            visible:false
        }
    },
    methods:{
        hideSideMenu()
        {
            this.$emit('hideMenu',true);
        }
    }
}
</script>

<style>

</style>
