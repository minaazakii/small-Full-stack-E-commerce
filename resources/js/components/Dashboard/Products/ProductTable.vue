<template>
    <div class="mt-5 p-4 w-7 h-5 ">
        <div v-if="isLoading" class="spinner">
            <ProgressSpinner />
        </div>
        <DataTable class="border-round" showGridlines :rowsPerPageOptions="[5, 10, 20, 50]" :value="products"
            :paginator="true" :rows="5"
            paginatorTemplate="RowsPerPageDropdown FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink"
            currentPageReportTemplate="{first} to {last} of {totalRecords}">
            <template #header>
                <div class="flex justify-content-start">
                    <h5 class="m-0">Products</h5>
                </div>
                <div class="flex justify-content-end">
                    <Button label="Add Product" icon="pi pi-external-link" @click="openAddProductModal()" />
                </div>
            </template>
            <Column field="name" header="Name"></Column>
            <Column field="price" sortable header="Price"></Column>
            <Column field="category.name" sortable header="Category"></Column>
            <Column field="status.type" header="Status">
                <template #body="slotProps">
                    <Tag :value="slotProps.data.status.type" :severity="getSeverity(slotProps.data.status.type)" />
                </template>
            </Column>

            <Column field="reviews" sortable header="Review">
                <template #body="slotProps">
                    <Rating :modelValue="parseInt(slotProps.data.reviews)" readonly :cancel="false" />
                </template>
            </Column>
            <Column header="Image">
                <template #body="slotProps">
                    <img :src="`${slotProps.data.image}`" :alt="slotProps.data.image"
                        class="w-6rem shadow-2 border-round" />
                </template>
            </Column>

            <Column header="">
                <template #body="{ data }">
                    <div class="flex justify-content-end">
                        <Button icon="pi pi-file-edit" class="p-button-warning p-button-rounded p-button-outlined"
                            @click="openEditProd(data)" />
                        <Button icon="pi pi-times" class="p-button-danger ml-2 p-button-rounded p-button-outlined"
                            @click="deleteProduct(data.id)" />
                    </div>
                </template>

            </Column>
        </DataTable>
    </div>

    <Toast />
    <!-- Add Modal -->
    <AddModal :displayModal="displayAddModal" @toggleModal="closeAddModal"></AddModal>

    <!-- Edit Modal -->
    <EditModal :productEdit="productEdit" :displayModal="displayEditModal" @toggleModal="closeEditModal"></EditModal>
</template>

<script>
import EditModal from './EditModal.vue'
import Tag from 'primevue/tag';
import AddModal from './AddModal.vue'
import Rating from 'primevue/rating';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { mapGetters } from 'vuex';
export default {
    components: {
        EditModal,
        AddModal,
        DataTable,
        Column,
        Rating,
        AddModal,
        Tag
    },
    mounted() {
        this.$store.dispatch('getProducts')
    },
    computed: {
        ...mapGetters({
            isLoading: 'isLoading',
            products: 'products'
        })
    },
    data() {
        return {
            displayAddModal: false,
            displayEditModal: false,
            productEdit:{}
        }
    },
    methods: {
        openAddProductModal() {
            this.displayAddModal = true
        },
        closeAddModal() {
            this.displayAddModal = false
        },
        openEditProd(data) {
            this.productEdit = {...data}
            this.displayEditModal = true
        },
        closeEditModal() {
            this.displayEditModal = false
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
        async deleteProduct(id) {
            let confirmation = confirm('Are you sure you want to delete this product?')
            if (confirmation) {
                this.$store.dispatch('Loading')
                try {
                    const response = await this.$store.dispatch('deleteProduct', id)
                    this.$toast.add({ severity: 'success', summary: 'Product Deleted Successfully', life: 3000 });
                    this.$store.dispatch('stopLoading')
                    this.$store.dispatch('getProducts')
                } catch (e) {
                    this.$store.dispatch('stopLoading')
                    this.$toast.add({ severity: 'error', summary: 'Something Went Wrong', life: 3000 });
                }

            }

        }
    }
}
</script>

<style></style>