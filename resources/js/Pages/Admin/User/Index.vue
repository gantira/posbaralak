<template>
    <admin>
        <template v-slot:header>User</template>

        <v-alert
            text
            dense
            outlined
            dismissible
            v-if="$page.props.flash.message"
            :type="$page.props.flash.type"
        >
            {{ $page.props.flash.message }}
        </v-alert>

        <v-card>

            <v-card-title>
                <inertia-link :href="route('admin.users.create')">
                    <v-btn
                        small
                        color="primary"
                    >New</v-btn>
                </inertia-link>
                <v-spacer></v-spacer>
                <v-text-field
                    dense
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
            </v-card-title>

            <v-data-table
                :headers="headers"
                :items="users"
                item-key="id"
                :search="search"
            >
                <template v-slot:[`item.actions`]="{ item }">
                    <v-icon
                        small
                        class="mr-2"
                        @click="edit(item)"
                    >
                        mdi-pencil
                    </v-icon>

                    <v-icon
                        small
                        @click="destroy(item)"
                    >
                        mdi-delete
                    </v-icon>
                </template>

            </v-data-table>
        </v-card>

    </admin>
</template>

<script>
import Admin from "@/Layouts/Admin";

export default {
    props: ["users"],

    components: {
        Admin,
    },

    data: () => ({
        search: "",
        headers: [
            {
                text: "Name",
                align: "start",
                value: "name",
            },
            { text: "Email", value: "email" },
            {
                text: "Actions",
                align: "end",
                value: "actions",
                sortable: false,
            },
        ],
    }),

    methods: {
        edit(item) {
            this.$inertia.get(route("admin.users.edit", item));
        },
        destroy(item) {
            this.$inertia.delete(route("admin.users.delete", item), {
                onBefore: () => confirm("Are you sure?"),
            });
        },
    },
};
</script>

<style>
</style>
