<template>
    <div>
        <div class="form-check-inline">
            <input type="checkbox" v-model="checked" id="checked-missing-functionality" @input="$emit('input', null)">
            <label for="checked-missing-functionality">We require functionality that the main Bristol SU account can’t provide</label>
        </div>
        <input class="form-control" placeholder="Please explain what functionality we aren't able to provide"
               type="text" v-if="checked" @input="$emit('input', $event.target.value)" :value="value">
    </div>
</template>

<script>
    export default {
        name: "MissingFunctionality",

        props: {
            value: {
                required: false,
                default: false
            }
        },

        data() {
            return {
                checked: false
            }
        }
    }
</script>

<style scoped>

</style>