<template>
    <admin-layout>
        <template v-slot:header>Status</template>

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
                <inertia-link :href="route('admin.statuses.create')">
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
                :items="statuses"
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

    </admin-layout>
</template>

<script>
export default {
    props: ["statuses"],

    data: () => ({
        search: "",
        headers: [
            {
                text: "Name",
                align: "start",
                value: "name",
            },
            { text: "Description", value: "description" },
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
            this.$inertia.get(route("admin.statuses.edit", item));
        },
        destroy(item) {
            this.$inertia.delete(route("admin.statuses.delete", item), {
                onBefore: () => confirm("Are you sure?"),
            });
        },
    },
};
</script>
