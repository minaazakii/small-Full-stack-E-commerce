<template>
    <Dialog header="Add Category" v-model:visible="displayAddModal" :breakpoints="{ '960px': '75vw', '640px': '90vw' }"
        :style="{ width: '50vw' }" :modal="true">
        <div class="p-inputgroup mt-2">
            <span class="p-inputgroup-addon">
                <i class="pi pi-shopping-bag"></i>
            </span>
            <InputText v-model="category" placeholder="Category Name"
                :class="{ 'p-invalid': v$.category.$invalid && clicked }" />
        </div>
        <div v-if="v$.category.$invalid && clicked">
            <label for="name" :class="{ 'p-error': v$.category.required.$invalid && clicked }">
                {{ v$.category.required.$message.replace('Value', 'Category') }}
            </label>
        </div>
        <template #footer>
            <Button label="Add Category" icon="pi pi-check" @click="addCat()" autofocus />
        </template>
    </Dialog>
</template>

<script>
import Dialog from 'primevue/dialog';
import { required } from "@vuelidate/validators";
import { useVuelidate } from "@vuelidate/core";
export default {
    setup: () => ({ v$: useVuelidate() }),
    props: ['displayModal'],
    components: { Dialog },
    watch: {
        displayModal(newv) {
            this.displayAddModal = newv
        },
        displayAddModal(newv) {
            if (newv == false) {
                this.$emit('closeAddModal', false)
            }
        },
    },
    data() {
        return {
            displayAddModal: false,
            category: '',
            clicked:false
        }
    },
    methods: {
        async addCat() {
            if (this.v$.$invalid) {
                this.clicked = true
                return
            }
            try {
                this.$store.dispatch('Loading')
                const response = await this.$store.dispatch('addCategory', this.category)
                this.$store.dispatch('getCategories');
                this.$store.dispatch('stopLoading')
                this.$toast.add({ severity: 'success', summary: 'Category Added Successfully', life: 3000 });
                this.displayAddModal = false;
                this.category = ''
            } catch (error) {
                this.$store.dispatch('stopLoading')
                this.$toast.add({ severity: 'error', summary: 'Something Went Wrong', life: 3000 });
                
            }
        },
    },
    validations() {
        return {
            category: {
                required
            }
        }
    }
}
</script>

<style></style>