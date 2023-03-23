<template>
    <div>
        <Menubar class="bg-indigo" :model="items">
            <template #start>
                <Button  @click="toggleSideMenu()" icon="pi pi-align-justify" class="p-4 mr-2 p-button-rounded p-button-outlined" text raised/>
            </template>

            <template #end>
                <InputText placeholder="Search" type="text" />
            </template>
        </Menubar>
        <div v-if="showSideMenu">
            <Sidemenu @hideMenu="toggleShowSideMenu" :buttonVisable="showSideMenu"></Sidemenu>
        </div>


    </div>
</template>

<script>
import Menubar from 'primevue/menubar';
import Sidemenu from './Sidemenu.vue';
export default {
    components:{
        Menubar,Sidemenu
    },
    mounted()
    {

    },
    data() {
        return {
            showSideMenu:false,
            items: [
                {
                    label: 'File',
                    icon: 'pi pi-fw pi-file',
                },
                {
                    label: 'Edit',
                    icon: 'pi pi-fw pi-pencil',
                    items: [
                        {
                            label: 'Left',
                            icon: 'pi pi-fw pi-align-left'
                        },
                    ]
                },
            ]
        }
    },methods:
    {
        toggleSideMenu()
        {
            this.showSideMenu = !this.showSideMenu
            console.log(this.showSideMenu)
        },
        toggleShowSideMenu()
        {
            this.showSideMenu = !this.showSideMenu
        }
    },
}

</script>

<style></style>
