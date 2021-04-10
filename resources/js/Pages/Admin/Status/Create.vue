<template>
    <admin-layout>
        <template v-slot:header>New Status</template>

        <v-form @submit.prevent="submit">
            <v-text-field
                v-model="form.name"
                label="Name"
                type="text"
                :error-messages="errors.name"
            ></v-text-field>

            <v-textarea
                v-model="form.description"
                label="Description"
                clear-icon="mdi-close-circle"
                clearable
                :error-messages="errors.description"
            ></v-textarea>

            <button-submit :loading="form.processing">Submit</button-submit>

        </v-form>

    </admin-layout>
</template>

<script>

export default {
    props: {
        errors: Object,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: "",
                description: "",
            }),
        };
    },

    methods: {
        submit() {
            this.form.post(this.route("admin.statuses.store"));
        },
    },
};
</script>

