<template>
    <span>
        {{content}}
    </span>
</template>

<script>
    export default {
        name: "Active",

        props: {
            start: {
                required: false,
                default: null
            },
            end: {
                required: false,
                default: null
            }
        },

        computed: {
            alwaysActive() {
                return this.start === null || this.end === null;
            },

            content() {
                return ( this.alwaysActive ? 'Always Active' : 'From ' + this.start + ' to ' + this.end );
            }
        }
    }
</script>

<style scoped>

</style>
