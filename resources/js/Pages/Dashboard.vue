<template>
    <admin>
        <template v-slot:header>Dashboard</template>

        <v-row no-gutters>
            <v-col cols="4">
                <v-card
                    class="pa-2"
                    outlined
                    tile
                >
                    .col-12 .col-sm-6 .col-md-8
                </v-card>
            </v-col>
            <v-col cols="8">
                <v-card
                    class="pa-2"
                    outlined
                    tile
                >
                    .col-6 .col-md-4
                </v-card>
            </v-col>
        </v-row>
    </admin>
</template>

<script>
import Admin from "@/Layouts/Admin";
export default {
    components: {
        Admin,
    },
};
</script>
