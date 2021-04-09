<template>
    <admin-layout>
        <template v-slot:header>Edit Table</template>

        <v-form @submit.prevent="submit">
            <v-text-field
                v-model="form.name"
                label="Name"
                type="text"
                :error-messages="errors.name"
            ></v-text-field>

            <button-submit color="info" :loading="form.processing">Update</button-submit>

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
                name: this.table.name,
            }),
        };
    },

    methods: {
        submit() {
            this.form.put(this.route("admin.tables.update", this.table));
        },
    },
};
</script>

