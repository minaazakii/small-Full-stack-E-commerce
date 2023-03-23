<template>
    <div class="mt-5 p-4 w-5 h-full ">
        <div v-if="isLoading" class="spinner">
            <ProgressSpinner />
        </div>
        <DataTable class="border-round" :value="categories" :paginator="true" :rows="5">
            <template #header>
                <div class="flex justify-content-start">
                    <h5 class="m-0">Categories</h5>
                </div>
                <div class="flex justify-content-end">
                    <Button label="Add Category" icon="pi pi-external-link" @click="openAddCategoryModal()" />
                </div>
            </template>
            <Column field="name" header="Name"></Column>

            <Column header="">
                <template #body="{ data }">
                    <div class="flex justify-content-end">
                        <Button icon="pi pi-file-edit" class="p-button-warning p-button-rounded p-button-outlined"
                            @click="openEditCat(data)" />
                        <Button icon="pi pi-times" class="p-button-danger ml-2 p-button-rounded p-button-outlined"
                            @click="deleteCat(data.id)" />
                    </div>
                </template>

            </Column>
        </DataTable>
    </div>

    <Toast />
    <AddModal :displayModal="displayAddModal" @closeAddModal="toggleAddModal">
    </AddModal>

    <EditModal :displayModal="displayEditModal" :editCat="data" @closeEditModal="toggleEditModal">
    </EditModal>
</template>

<script>
import EditModal from './EditModal.vue'
import AddModal from './AddModal.vue'
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { mapGetters } from 'vuex'
export default {
    components: {
        EditModal,
        AddModal,
        DataTable,
        Column,
    },
    mounted() {
        this.$store.dispatch('getCategories');
    },
    computed: {
        ...mapGetters({
            categories: 'getCategories',
            isLoading: 'isLoading'
        })
    },
    data() {
        return {
            displayAddModal: false,
            displayEditModal: false,
            data: ''
        }
    },
    methods: {
        openAddCategoryModal() {
            this.displayAddModal = true;
        },
        toggleAddModal() {
            this.displayAddModal = false;
        },
        openEditCat(data) {
            this.data = { ...data };
            this.displayEditModal = true
        },
        toggleEditModal() {
            this.displayEditModal = false;
        },
        async deleteCat(id) {
            console.log(id);
            let confirmation = confirm('Are you sure you want to delete');
            if (confirmation) {
                try {
                    this.$store.dispatch('Loading')
                    await this.$store.dispatch('deleteCategory', id)
                    this.$store.dispatch('getCategories');
                    this.$store.dispatch('stopLoading')

                    this.$toast.add({ severity: 'success', summary: 'Category Deleted Successfully', life: 3000 });
                } catch (error) {

                }
            }
        },

    }
}
</script>

<style></style>
