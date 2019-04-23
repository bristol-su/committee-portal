<template>
    <div>
        <input type="date" @input="$emit('input', $event.target.value)" :value="value"></div>
    </div>
</template>

<script>
    export default {
        name: "YearEnd",

        props: {
            value: {
                required: false,
                default: null
            }
        }
    }
</script>

<style scoped>

</style>