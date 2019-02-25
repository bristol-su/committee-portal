<template>
        <td>
            <span v-if="hasDisplay">
                {{display}}
            </span>
            <span v-else-if="failed">
                Error
            </span>
            <span v-else>
                Loading...
            </span>
        </td>
</template>

<script>
    export default {
        props: {
            'display': {
                default: ''
            },
            'failed': {
                required: true
            }
        },

        methods: {

            checkIfEmpty(val) {
                // TODO further this
                return val === '' | val === undefined;
            }
        },

        computed: {
            hasDisplay() {
                return !this.checkIfEmpty(this.display);
            },
        }
    }
</script>
