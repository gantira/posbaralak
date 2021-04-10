<template>
    <admin-layout>
        <template v-slot:header>Edit Category</template>

        <v-form @submit.prevent="submit">

            <v-text-field
                v-model="form.name"
                label="Name"
                :error-messages="errors.name"
            ></v-text-field>

            <v-text-field
                v-model="form.price"
                label="Price"
                type="number"
                :error-messages="errors.price"
            ></v-text-field>

            <v-textarea
                clearable
                counter="255"
                v-model="form.description"
                label="Description"
                :error-messages="errors.description"
            ></v-textarea>

            <v-autocomplete
                chips
                v-model="form.category_id"
                label="Category"
                :items="categories"
                item-text="name"
                item-value="id"
                :error-messages="errors.category_id"
            ></v-autocomplete>

            <v-autocomplete
                chips
                v-model="form.status_id"
                label="Status"
                :items="statuses"
                item-text="name"
                item-value="id"
                :error-messages="errors.status_id"
            ></v-autocomplete>

            <v-img
                lazy-src="https://picsum.photos/id/11/10/6"
                max-height="150"
                max-width="250"
                :src="product.image_link"
            ></v-img>

            <v-file-input
                v-model="form.image"
                label="Image"
                truncate-length="15"
                :error-messages="errors.image"
            ></v-file-input>

            <button-submit
                color="info"
                :loading="form.processing"
            >Update</button-submit>

        </v-form>
    </admin-layout>
</template>

<script>
export default {
    props: {
        product: Object,
        categories: Object,
        statuses: Object,
        errors: Object,
    },

    data() {
        return {
            form: this.$inertia.form(
                {
                    category_id: this.product.category_id,
                    status_id: this.product.status_id,
                    name: this.product.name,
                    price: this.product.price,
                    description: this.product.description,
                    image: "",
                    _method: 'put'
                },
                { forceFormData: true }
            ),
        };
    },
    methods: {
        submit() {
            this.form.post(this.route("admin.products.update", this.product));
        },
    },
};
</script>

<style>
</style>
