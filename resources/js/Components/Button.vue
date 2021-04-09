<template>
    <v-btn
        :color="color"
        :class="classes"
        :type="type"
        :loading="loading"
        :disabled="loading"
    >
        <slot />
    </v-btn>
</template>

<script>
export default {
    props: {
        color: {
            type: String,
            default: "success",
        },
        type: {
            type: String,
            default: "submit",
        },
        classes: "",
        loading: false,
    },
};
</script>
