<template>
    <Dialog header="Add Product" v-model:visible="displayAddModal" :breakpoints="{ '960px': '75vw', '640px': '90vw' }"
        :style="{ width: '50vw' }" :modal="true">
        <div class="grid mt-2">
            <div class="p-inputgroup col-6">
                <span class="p-inputgroup-addon">
                    <i class="pi pi-shopping-bag"></i>
                </span>
                <InputText :class="{'p-invalid':this.v$.product.name.required.$message && clicked}" v-model="product.name" placeholder="Product Name" />
            </div>
            <div class="col-6">
                <Dropdown v-model="product.category" :options="categories" filter optionLabel="name"
                    placeholder="Select a Category" class="w-full md:w-14rem">
                </Dropdown>
            </div>
            <div class="p-inputgroup col-6">
                <span class="p-inputgroup-addon">
                    <i class="pi pi-money-bill"></i>
                </span>
                <InputText v-model="product.price" placeholder="Price" />
            </div>
            <div class="col-6">
                <Dropdown v-model="product.review" :options="reviews" filter optionLabel="label" placeholder="Review"
                    class="w-full md:w-14rem">
                </Dropdown>
            </div>
            <div class="col-6">
                <Dropdown v-model="product.status" :options="statuses" filter optionLabel="type"
                    placeholder="Select a Status" class="w-full md:w-14rem">
                </Dropdown>
            </div>
        </div>

        <template #footer>
            <Button label="Add Product" icon="pi pi-check" @click="addProduct()" autofocus />
        </template>
    </Dialog>
</template>

<script>
import Dialog from 'primevue/dialog';
import Dropdown from 'primevue/dropdown';
import { useVuelidate } from '@vuelidate/core'
import { mapGetters } from 'vuex';
import { required } from '@vuelidate/validators';
export default {
    props: ['displayModal'],
    components: {
        Dialog, Dropdown
    },
    setup() {
        return { v$: useVuelidate() }
    },
    mounted() {
        this.$store.dispatch('getCategories')
        this.$store.dispatch('getStatuses')
    },
    computed: {
        ...mapGetters({
            categories: 'getCategories',
            statuses: 'statuses',
        })
    },
    watch: {
        displayModal(newv) {
            this.displayAddModal = newv
        },
        displayAddModal(newv) {
            if (newv == false) {
                this.$emit('toggleModal', false)
            }
        }
    },
    data() {
        return {
            displayAddModal: false,
            clicked: false,
            product: {
                name: '',
                category: '',
                price: '',
                review: '',
                status: '',
            },
            reviews: [
                { value: 0, label: '0' },
                { value: 1, label: '1' },
                { value: 2, label: '2' },
                { value: 3, label: '3' },
                { value: 4, label: '4' },
                { value: 5, label: '5' },
            ],
        }
    },
    methods: {
        async addProduct() {

            this.$store.dispatch('Loading');
            try {
                const response = await this.$store.dispatch('addProduct', this.product)
                this.$store.dispatch('stopLoading');
                this.$toast.add({ severity: 'success', summary: 'Product Added Successfully', life: 3000 });
                this.$store.dispatch('getProducts')
                this.displayAddModal = false
            } catch (e) {
                this.$store.dispatch('stopLoading');
                this.$toast.add({ severity: 'error', summary: 'Something Went Wrong', life: 3000 });

            }

        }
    }, validations() {
        return {
            product: {
                name: { required },
                category: { required },
                price: { required },
                review: { required },
                status: { required },
            }
        }
    }
}
</script>

<style></style>
