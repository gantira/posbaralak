<template>
    <admin>
        <template>
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
        </template>

    </admin>
</template>

<script>
import Admin from "@/Layouts/Admin";

export default {
    props: {
        table: Object,
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
            this.form.post(this.route("admin.tables.store"));
        },
    },
};
</script>

<style>
</style>
