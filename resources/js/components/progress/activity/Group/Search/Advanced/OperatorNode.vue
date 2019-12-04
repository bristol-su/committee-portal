<template>
    <p @click="toggleOperator">
        {{value}}
    </p>
</template>

<script>
    export default {
        name: "OperatorNode",

        props: {
            value: {

            }
        },

        data() {
            return {}
        },

        methods: {
            toggleOperator() {
                if(this.value === 'OR') {
                    this.$emit('input', 'AND');
                } else if(this.value === 'AND') {
                    this.$emit('input', 'OR');
                }
            }
        },

        computed: {}
    }
</script>

<style scoped>

</style>
