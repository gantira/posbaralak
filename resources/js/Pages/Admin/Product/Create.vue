<template>
    <admin-layout>
        <template v-slot:header>New Product</template>

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

            <v-file-input
                v-model="form.image"
                label="Image"
                truncate-length="15"
                :error-messages="errors.image"
            ></v-file-input>

            <button-submit :loading="form.processing">Submit</button-submit>

        </v-form>

    </admin-layout>
</template>

<script>
export default {
    props: {
        categories: Object,
        statuses: Object,
        errors: Object,
    },

    data() {
        return {
            form: this.$inertia.form(
                {
                    category_id: "",
                    status_id: "",
                    name: "",
                    price: "",
                    description: "",
                    image: "",
                },
                { forceFormData: true }
            ),
        };
    },
    methods: {
        submit() {
            this.form.post(this.route("admin.products.store"));
        },
    },
};
</script>

<style>
</style>
