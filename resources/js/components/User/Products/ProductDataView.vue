<template>
    <DataView :value="products" paginator :rows="6" :layout="layout">
        <template #header>
            <div class="flex justify-content-end">
                <DataViewLayoutOptions v-model="layout" />
            </div>
        </template>

        <template #list="slotProps">
            <div class="col-12">
                <div class="flex flex-column xl:flex-row xl:align-items-start p-4 gap-4">
                    <img class="w-9 sm:w-16rem xl:w-10rem shadow-2 block xl:block mx-auto border-round"
                        :src="slotProps.data.image"
                        :alt="slotProps.data.name" />
                    <div
                        class="flex flex-column sm:flex-row justify-content-between align-items-center xl:align-items-start flex-1 gap-4">
                        <div class="flex flex-column align-items-center sm:align-items-start gap-3">
                            <div class="text-2xl font-bold text-900">{{ slotProps.data.name }}</div>
                            <Rating :modelValue="slotProps.data.rating" readonly :cancel="false"></Rating>
                            <div class="flex align-items-center gap-3">
                                <span class="flex align-items-center gap-2">
                                    <i class="pi pi-tag"></i>
                                    <span class="font-semibold">{{ slotProps.data.category?.name }}</span>
                                </span>
                                <Tag :value="slotProps.data.status.type" :severity="getSeverity(slotProps.data.status.type)"></Tag>
                            </div>
                        </div>
                        <div class="flex sm:flex-column align-items-center sm:align-items-end gap-3 sm:gap-2">
                            <span class="text-2xl font-semibold">${{ slotProps.data.price }}</span>
                            <Button icon="pi pi-shopping-cart" rounded
                                :disabled="slotProps.data.inventoryStatus === 'OUTOFSTOCK'"></Button>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template #grid="slotProps">
            <div class="col-12 sm:col-6 lg:col-12 xl:col-4 p-2">
                <div class="p-4 border-1 surface-border surface-card border-round">
                    <div class="flex flex-wrap align-items-center justify-content-between gap-2">
                        <div class="flex align-items-center gap-2">
                            <i class="pi pi-tag"></i>
                            <span class="font-semibold">{{ slotProps.data.category?.name }}</span>
                        </div>
                        <Tag :value="slotProps.data.status.type" :severity="getSeverity(slotProps.data.status.type)"></Tag>
                    </div>
                    <div class="flex flex-column align-items-center gap-3 py-5">
                        <img class="w-9 shadow-2 border-round"
                            :src="slotProps.data.image"
                            :alt="slotProps.data.name" />
                        <div class="text-2xl font-bold">{{ slotProps.data.name }}</div>
                        <Rating v-model="slotProps.data.reviews" readonly :cancel="false"></Rating>
                    </div>
                    <div class="flex align-items-center justify-content-between">
                        <span class="text-2xl font-semibold">${{ slotProps.data.price }}</span>
                        <Button icon="pi pi-shopping-cart" rounded
                            :disabled="slotProps.data.inventoryStatus === 'OUTOFSTOCK'"></Button>
                    </div>
                </div>
            </div>
        </template>
    </DataView>
</template>

<script>
import Rating from 'primevue/rating'
import Tag from 'primevue/tag';
import DataView from 'primevue/dataview';
import DataViewLayoutOptions from 'primevue/dataviewlayoutoptions'
import { mapGetters } from 'vuex';
export default {
    components: {
        DataView,
        DataViewLayoutOptions,
        Tag,
        Rating
    },
    mounted(){
        this.$store.dispatch('getProducts');
    },
    computed: {
        ...mapGetters({
            products:'products',
        })
    },
    data(){
        return{
            layout: 'grid'
        }
    },
    methods:{
        getSeverity(status)
        {
            if (status == "In Stock") {
                return "success"
            }
            if (status == "Out of Stock") {
                return "danger"
            }
            if (status == "Low in Stock") {
                return "warning"
            }
        }
    }

}
</script>

<style></style>
