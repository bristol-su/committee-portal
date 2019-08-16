<template>
    <div>
        <b-form-group
            description="The URL at which this activity will be accessible"
            id="slug-group"
            label="Slug:"
            label-for="slug"
        >
            <b-form-input
                id="slug"
                required
                type="text"
                :value="value"
                @input="$emit('input', $event)"
            ></b-form-input>
        </b-form-group>
    </div>
</template>

<script>
    export default {
        name: "Slug",

        props: {
            value: {
                required: false,
                type: String,
                default: ''
            }
        },

        computed: {
            url() {
                return process.env.MIX_APP_URL + '/' + this.slug;
            }
        }
    }
</script>

<style scoped>

</style>
