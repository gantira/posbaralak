<template>
    <admin>
        <template v-slot:header>New Category</template>

        <v-form @submit.prevent="submit">
            <v-text-field
                v-model="form.name"
                label="Name"
                type="text"
                :error-messages="errors.name"
            ></v-text-field>

            <v-btn
                color="success"
                class="mr-4"
                type="submit"
                :disabled="form.processing"
            >
                Submit
            </v-btn>

        </v-form>

    </admin>
</template>

<script>
import Admin from "@/Layouts/Admin";

export default {
    props: {
        category: Object,
        errors: Object,
    },
    components: {
        Admin,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: "",
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(this.route("admin.categories.store"));
        },
    },
};
</script>

<style>
</style>
