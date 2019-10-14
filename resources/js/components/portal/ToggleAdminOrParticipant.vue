<template>
    <div>
        <b-row>
            <b-col v-if="admin">
                <a href="/p">
                    <b-button variant="secondary">Go to participant</b-button>
                </a>
            </b-col>
            <b-col v-else>
                <a href="/a">
                    <b-button variant="secondary">Go to administrator</b-button>
                </a>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    export default {
        name: "ToggleAdminOrParticipant",

        props: {
            admin: {
                required: false,
                type: Boolean,
                default: false
            }
        },

        data() {
            return {}
        },

        methods: {},

        computed: {}
    }
</script>

<style scoped>

</style>
