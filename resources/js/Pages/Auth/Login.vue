<template>
    <guest>
        <v-layout
            align-center
            justify-center
        >
            <v-flex
                xs12
                sm8
                md4
            >
                <v-card class="elevation-12">
                    <v-toolbar
                        dark
                        color="primary"
                    >
                        <v-toolbar-title>Login form</v-toolbar-title>
                    </v-toolbar>
                    <v-form @submit.prevent="submit">
                        <v-card-text>
                            <v-text-field
                                v-model="form.email"
                                name="email"
                                prepend-icon="mdi-account"
                                label="Username"
                                type="text"
                                :error-messages="errors.email"
                            ></v-text-field>
                            <v-text-field
                                id="password"
                                prepend-icon="mdi-lock"
                                v-model="form.password"
                                label="Password"
                                type="password"
                                :error-messages="errors.password"
                            ></v-text-field>

                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="primary"
                                type="submit"
                            >Login</v-btn>
                        </v-card-actions>
                    </v-form>
                </v-card>
            </v-flex>
        </v-layout>
    </guest>
</template>

<script>
import Guest from "@/Layouts/Guest";

export default {
    components: {
        Guest,
    },

    props: {
        auth: Object,
        canResetPassword: Boolean,
        errors: Object,
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: "",
                password: "",
                remember: false,
            }),
        };
    },

    methods: {
        submit() {
            this.form
                .transform((data) => ({
                    ...data,
                    remember: this.form.remember ? "on" : "",
                }))
                .post(this.route("login"), {
                    onFinish: () => this.form.reset("password"),
                });
        },
    },
};
</script>
