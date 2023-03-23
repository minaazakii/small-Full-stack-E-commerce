<template>
 

    <div class="grid">
        <div class="col-12">
            <Banner></Banner>
        </div>
    </div>

    <!-- Website Content -->
    <div class="grid">
        <div class="col-12 bg-purple-100 border-rounded">
            <div>
                <ProductList></ProductList>
            </div>
        </div>
    </div>

    <div class="grid mt-2">

        <div class="flex justify-content-center col-12">
            <ProductDataViewVue></ProductDataViewVue>
        </div>

    </div>

    <div class="grid">
        <div class="col-12">
            <Footer></Footer>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Banner from '../../components/User/Banner.vue'
import Footer from '../../components/User/Footer.vue'
import ProductList from '../../components/User/Products/ProductList.vue'
import ProductDataViewVue from '../../components/User/Products/ProductDataView.vue';

export default {
    components:{
        Banner,
        ProductList,
        Footer,
        ProductDataViewVue
    },

    computed: {
        ...mapGetters({
            products:'products',
        })
    },

}
</script>

<style></style>