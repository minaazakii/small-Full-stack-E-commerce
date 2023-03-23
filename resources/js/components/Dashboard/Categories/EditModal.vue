<template>
    <Dialog header="Edit Category" v-model:visible="displayEditModal" :breakpoints="{ '960px': '75vw', '640px': '90vw' }"
        :style="{ width: '50vw' }" :modal="true">
        <div class="p-inputgroup mt-2">
            <span class="p-inputgroup-addon">
                <i class="pi pi-shopping-bag"></i>
            </span>
            <InputText v-model="categoryEdit.name" placeholder="Category Name" />
        </div>
        <template #footer>
            <Button label="Edit Category" icon="pi pi-check" @click="updateCat()" autofocus />
        </template>
    </Dialog>
</template>

<script>
import Dialog from 'primevue/dialog';
export default {
    components: { Dialog },
    props: ['displayModal', 'editCat'],
    watch: {
        displayModal(newv) {
            this.displayEditModal = newv
        },
        displayEditModal(newv) {
            if (newv == false) {
                this.$emit('closeEditModal', false);
            }
        },
        editCat(newv) {
            this.categoryEdit = newv
        }

    },
    data() {
        return {
            categoryEdit: '',
            displayEditModal: false
        }
    },
    methods: {
        async updateCat() {
            try {
                this.$store.dispatch('Loading')
                await this.$store.dispatch('updateCategory', this.categoryEdit)
                this.$store.dispatch('getCategories');
                this.$store.dispatch('stopLoading')
                this.$toast.add({ severity: 'success', summary: 'Category Edited Successfully', life: 3000 });

            } catch (error) {
                this.$store.dispatch('stopLoading')
                this.$toast.add({ severity: 'error', summary: 'Something Went Wrong', life: 3000 });
            }
        },
    }
}
</script>

<style></style>