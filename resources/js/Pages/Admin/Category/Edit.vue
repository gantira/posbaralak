<template>
    <admin-layout>
        <template v-slot:header>Edit Category</template>

        <v-form @submit.prevent="submit">
            <v-text-field
                v-model="form.name"
                label="Name"
                type="text"
                :error-messages="errors.name"
            ></v-text-field>

            <v-btn
                color="info"
                class="mr-4"
                type="submit"
                :loading="form.processing"
                :disabled="form.processing"
            >
                Update
            </v-btn>

        </v-form>

    </admin-layout>
</template>

<script>
export default {
    props: {
        category: Object,
        errors: Object,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: this.category.name,
            }),
        };
    },
    methods: {
        submit() {
            this.form.put(this.route("admin.categories.update", this.category));
        },
    },
};
</script>

<style>
</style>
