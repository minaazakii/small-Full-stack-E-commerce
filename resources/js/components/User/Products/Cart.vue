<template>
    <DataView :value="cart" :rows="5" paginator>
        <template #list="slotProps">
            <div class="col-12">
                <div class="flex flex-column xl:flex-row xl:align-items-start p-4 gap-4">
                    <img class="w-9 sm:w-16rem xl:w-10rem shadow-2 block xl:block mx-auto border-round"
                        :src="slotProps.data.product.image" :alt="slotProps.data.product.name" />
                    <div
                        class="flex flex-column sm:flex-row justify-content-between align-items-center xl:align-items-start flex-1 gap-4">
                        <div class="flex flex-column align-items-center sm:align-items-start gap-3">
                            <div class="text-2xl font-bold text-900">{{ slotProps.data?.product?.name }}</div>
                            <div class="flex align-items-center gap-3">
                                <span class="flex align-items-center gap-2">
                                    <i class="pi pi-tag"></i>
                                    <span class="font-semibold">{{ slotProps.data?.product.category?.name }}</span>
                                </span>
                            </div>
                        </div>
                        <div class="flex sm:flex-column align-items-center sm:align-items-end gap-3 sm:gap-2">
                            <span class="text-2xl font-semibold">${{ slotProps.data?.product?.price *
                                slotProps.data.quantity }} </span>
                            <Button @click="RemoveFromCart(slotProps.data.product)" class="p-button-rounded bg-danger" icon="pi pi-times " aria-label="Cancel" />
                            <InputNumber @click="addQuantity(slotProps.data.product, slotProps.data.quantity)"
                                v-model="slotProps.data.quantity" mode="decimal" showButtons :min="0" :max="100"
                                @keyup.enter="addQuantity(slotProps.data.product, slotProps.data.quantity)" />
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </DataView>
</template>

<script>
import DataView from 'primevue/dataview';
import InputNumber from 'primevue/inputnumber';
import { mapGetters } from 'vuex';
export default {
    components: { DataView, InputNumber },
    mounted() {
        this.$store.dispatch('getCart');
    },
    computed: {
        ...mapGetters({
            cart: 'cart'
        })
    },
    data() {
        return {

        }
    },
    methods: {
        async addQuantity(product, quantity) {
            this.$store.dispatch('Loading')
            try {
                await this.$store.dispatch('updateCart', { id: product.id, quantity: quantity })
                // this.$store.dispatch('getCart');
                this.$store.dispatch('stopLoading')
            } catch (e) {
                console.log(e)
                this.$store.dispatch('stopLoading')
            }
        },
        async RemoveFromCart(product)
        {
            console.log(product)
            this.$store.dispatch('Loading')
            try {
                await this.$store.dispatch('removeFromCart', product)
                this.$store.dispatch('getCart');
                this.$store.dispatch('stopLoading')
            } catch (e) {
                console.log(e)
                this.$store.dispatch('stopLoading')
            }
        }
    }
}
</script>

<style></style>
