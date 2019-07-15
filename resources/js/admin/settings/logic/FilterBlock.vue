<template>
    <div class="filter-container">
        <b-input-group>
            <b-input-group-text slot="prepend">{{filter.name}}</b-input-group-text>
            <b-form-select
                    :options="filter.options"
                    v-model="selectedOption">

            </b-form-select>
        </b-input-group>
    </div>

</template>

<script>

    export default {
        name: "FilterBlock",

        props: {
            filter: {
                required: true,
                type: Object
            },
            index: {
                required: true,
                type: Number
            }
        },

        data() {
            return {
                selectedOption: null
            }
        },

        created() {
            this.selectedOption = Object.keys(this.filter.options)[0]
        },

        watch: {
            selectedOption(newValue, oldValue) {
                this.$emit('filterUpdated',
                    {'class': this.filter.id, 'setting': newValue}, this.index
                );
            }
        },


    }
</script>

<style scoped>

    .filter-container {
        /*border: 1px solid black;*/

    }
</style>