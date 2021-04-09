<template>
    <admin-layout>
        <template v-slot:header>New Table</template>

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
                :loading="form.processing"
                :disabled="form.processing"
            >
                Submit
            </v-btn>

        </v-form>

    </admin-layout>
</template>

<script>

export default {
    props: {
        table: Object,
        errors: Object,
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

