<template>
    <!-- App.vue -->
    <v-app>
        <v-navigation-drawer app>
            <v-list>
                <v-list-item>
                    <v-list-item-avatar>
                        <v-img src="https://cdn.vuetifyjs.com/images/john.png"></v-img>
                    </v-list-item-avatar>
                </v-list-item>

                <v-list-item link>
                    <v-list-item-content>
                        <v-list-item-title class="title">
                            {{ $page.props.auth.user.name }}
                        </v-list-item-title>
                        <v-list-item-subtitle>{{ $page.props.auth.user.email }}</v-list-item-subtitle>
                    </v-list-item-content>

                    <v-list-item-action>
                        <v-icon>mdi-menu-down</v-icon>
                    </v-list-item-action>
                </v-list-item>
            </v-list>
            <v-divider></v-divider>
            <v-list
                nav
                dense
            >
                <v-list-item-group

                    color="primary"
                >
                    <v-list-item
                        v-for="(item, i) in items"
                        :key="i"
                        @click="goTo(item.path)"
                    >
                        <v-list-item-icon>
                            <v-icon v-text="item.icon"></v-icon>
                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title v-text="item.text"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar
            app
            flat
        >

            <v-toolbar-title>
                <slot name="header">Header</slot>
            </v-toolbar-title>

            <v-spacer></v-spacer>

            <inertia-link
                href="/logout"
                method="post"
                as="button"
                type="button"
            >
                <v-btn icon>
                    <v-icon>mdi-logout</v-icon>
                </v-btn>
            </inertia-link>

        </v-app-bar>

        <!-- Sizes your content based upon application components -->
        <v-main>

            <!-- Provides the application the proper gutter -->
            <v-container fluid>

                <slot />
            </v-container>
        </v-main>

        <v-footer app>
            Copyright @ 2021
            <v-spacer></v-spacer>
            Login as: Admin
        </v-footer>
    </v-app>
</template>

<script>
import AppBar from "@/Components/AppBar";
export default {
    components: {
        AppBar,
    },

    props: ["user"],

    data() {
        return {
            selectedItem: 0,
            items: [
                {
                    text: "Dashboard",
                    icon: "mdi-home",
                    path: route("dashboard"),
                },
                {
                    text: "User Management",
                    icon: "mdi-account-multiple",
                    path: route("admin.users.index"),
                },
                {
                    text: "Category",
                    icon: "mdi-tag",
                    path: route("admin.categories.index"),
                },
                {
                    text: "Table",
                    icon: "mdi-table",
                    path: route("admin.tables.index"),
                },
                {
                    text: "Status",
                    icon: "mdi-information",
                    path: route("admin.statuses.index"),
                },
                {
                    text: "Product",
                    icon: "mdi-food",
                    path: route("admin.products.index"),
                },
            ],
            right: null,
        };
    },

    methods: {
        goTo(path) {
            this.$inertia.get(path);
        },
    },
};
</script>
