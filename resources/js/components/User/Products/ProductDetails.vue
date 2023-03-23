<template>
    <div class="col-12">
        <div class="flex justify-content-center">
            <Card style="width: 25em">
                <template #header>
                    <img alt="user header" :src="product.image" />
                </template>
                <template #title> {{ product.name }} </template>
                <template #subtitle> {{ product.category?.name }} </template>
                <template #content>
                    <p>
                        Price:{{ product.price }}$

                    </p>
                    <p>
                        Review:
                        <Rating v-model="product.reviews" :cancel="false" />
                    </p>
                    <p>

                        <Tag :severity="getSeverity(product.status?.type)" :value="product.status?.type"></Tag>
                    </p>
                </template>
                <template #footer>
                    <Button @click="addToCart()" icon="pi pi-shopping-cart" label="Add To Cart" />
                    <Button icon="pi pi-heart" label="Favorites" severity="secondary" style="margin-left: 0.5em" />
                </template>
            </Card>
        </div>
    </div>
</template>

<script>
import Image from 'primevue/image';
import Card from 'primevue/card';
import Tag from 'primevue/tag';
import Rating from 'primevue/rating';
export default {
    components: { Image, Card, Tag, Rating },
    mounted() {
        this.id = this.$route.params.id;
        this.getProduct();
    },
    data() {
        return {
            product: {},
            id: ''
        }
    },
    methods: {
        async getProduct() {
            this.$store.dispatch('Loading')
            const response = await this.$store.dispatch('getProduct', this.id)
            this.$store.dispatch('stopLoading')
            this.product = response.data
        },
        getSeverity(status) {
            if (status == "In Stock") {
                return "success"
            }
            if (status == "Out of Stock") {
                return "danger"
            }
            if (status == "Low in Stock") {
                return "warning"
            }
        },
        async addToCart() {
            this.$store.dispatch('Loading')
            try {
                const response = await this.$store.dispatch('addToCart', this.product);
                this.$store.dispatch('stopLoading')
                console.log(response)
                this.$store.dispatch('getCart');
            }catch(e){
                console.log(e)
                this.$store.dispatch('stopLoading')
            }
            
        }
    },

}
</script>

<style></style>