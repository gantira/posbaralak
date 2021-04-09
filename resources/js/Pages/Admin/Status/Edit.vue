<template>
    <admin-layout>
        <template v-slot:header>Edit Status</template>

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

            <button-submit color="info" :loading="form.processing">Update</button-submit>

        </v-form>

    </admin-layout>
</template>
<script>

export default {
    props: {
        status: Object,
        errors: Object,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: this.status.name,
                description: this.status.description,
            }),
        };
    },

    methods: {
        submit() {
            this.form.put(this.route("admin.statuses.update", this.status));
        },
    },
};
</script>

