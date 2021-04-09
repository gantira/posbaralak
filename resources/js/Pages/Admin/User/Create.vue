<template>
    <admin-layout>
        <template v-slot:header>New User</template>

        <v-form @submit.prevent="submit">
            <v-text-field
                v-model="form.name"
                label="Name"
                type="text"
                :error-messages="errors.name"
            ></v-text-field>

            <v-text-field
                v-model="form.email"
                label="E-mail"
                type="text"
                :error-messages="errors.email"
            ></v-text-field>

            <v-text-field
                v-model="form.password"
                label="Password"
                type="password"
                :error-messages="errors.password"
            ></v-text-field>

            <v-text-field
                v-model="form.password_confirmation"
                label="Password Confirmation"
                type="password"
            ></v-text-field>

            <button-submit :loading="form.processing">Submit</button-submit>

        </v-form>

    </admin-layout>
</template>

<script>
export default {
    props: {
        user: Object,
        errors: Object,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
                remember: false,
            }),
        };
    },

    methods: {
        submit() {
            this.form.post(this.route("admin.users.store"));
        },
    },
};
</script>
