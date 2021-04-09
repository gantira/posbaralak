<template>
    <admin-layout>
        <template v-slot:header>Edit User</template>

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

            <button-submit color="info" :loading="form.processing">Submit</button-submit>

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
                name: this.user.name,
                email: this.user.email,
            }),
        };
    },

    methods: {
        submit() {
            this.form.put(this.route("admin.users.update", this.user));
        },
    },
};
</script>
