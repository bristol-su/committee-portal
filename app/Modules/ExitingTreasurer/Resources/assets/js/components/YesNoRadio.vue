<template>
    <div class="custom-controls-stacked">
        <div class="custom-control custom-radio" style="text-align: left;">
            <input
                    :value="true"
                    class="custom-control-input"
                    type="radio"
                    @input="$emit('input', true)"
                    :checked="this.value===true"
            >
            <label
                    class="custom-control-label"
                    @click="$emit('input', true)">
                {{yes}}
            </label>
        </div>

        <div class="custom-control custom-radio" style="text-align: left;">
            <input
                    class="custom-control-input"
                    type="radio"
                    @input="$emit('input', false)"
                    :checked="this.value===false"
            >
            <label
                    class="custom-control-label"
                    @click="$emit('input', false)">
                {{no}}
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            yes: {
                required: true,
                type: String
            },
            no: {
                required: true,
                type: String
            },
            value: {
                required: true,
                default: null
            }

        },
    }
</script>

<style scoped>

</style>