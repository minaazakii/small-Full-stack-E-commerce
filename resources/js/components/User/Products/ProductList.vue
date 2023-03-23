<template>
    <Carousel :value="products" :numVisible="3" :numScroll="1" :autoplayInterval="3000" :responsiveOptions="responsiveOptions">
    <template #item="slotProps">
        <div class="border-1 surface-border border-round  m-2 text-center py-5 px-3">
            <div class="mb-3">
                <img :src="slotProps.data.image" :alt="slotProps.data.name" class="w-3 h-3 shadow-2" />
            </div>
            <div>
                <h4 class="mb-1">{{ slotProps.data.name }}</h4>
                <h6 class="mt-0 mb-3">${{ slotProps.data.price }}</h6>
                <Tag :value="slotProps.data.status.type" :severity="getSeverity(slotProps.data.status.type)" />
                <div class="mt-5">
                    <Button @click="$router.push({name:'productDetail',params:{id:slotProps.data.id}})" icon="pi pi-search" class="mr-2 p-button-rounded bg-primary" />
                    <Button icon="pi pi-star-fill"  class="p-button-rounded bg-success"/>
                </div>
            </div>
        </div>
    </template>
</Carousel>
</template>

<script>
import Carousel from 'primevue/carousel';
import Tag from 'primevue/tag';
import { mapGetters } from 'vuex';
export default {
    components:{Carousel,Tag},
    mounted(){
        this.$store.dispatch('getProducts');
    },
    computed:{
        ...mapGetters({
            products:'products'
        })
    },
    data(){
        return{
            responsiveOptions: [
                {
                    breakpoint: '1199px',
                    numVisible: 3,
                    numScroll: 3
                },
                {
                    breakpoint: '991px',
                    numVisible: 2,
                    numScroll: 2
                },
                {
                    breakpoint: '767px',
                    numVisible: 1,
                    numScroll: 1
                }
            ]
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

<style>

</style>
