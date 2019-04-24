<template>
    <div>
        <div class="form-group">
            <input
                   :value="value"
                   :checked="value"
                   @input="$emit('input', $event.target.checked)" class="form-check-inline"
                   id="confirm-conditions"
                   type="checkbox">
            <label for="confirm-conditions">I confirm the above.</label>
        </div>

    </div>
</template>

<script>
    export default {
        name: "ConditionsMet",

        props: {
            value: {
                required: false,
                default: false
            }
        }
    }
</script>

<style scoped>

</style>