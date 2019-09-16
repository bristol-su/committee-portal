<template>
    <div>
        <div v-if="loading">Loading...</div>
        <div v-else>
            <hr/>
            <data-item title="Person" v-for="reach in audience" :key="reach.id">
                {{reach}}
                <hr/>
            </data-item>
        </div>
    </div>
</template>

<script>
    import DataItem from "../../../../utilities/DataItem";

    export default {
        name: "Audience",
        components: {DataItem},
        props: {
            logicId: {
                required: true,
                type: Number
            }
        },

        data() {
            return {
                audience: [],
                loading: false
            }
        },

        created() {
            this.getAudience();
        },

        methods: {
            getAudience() {
                this.loading = true;
                this.$api.logic().audience(this.logicId)
                    .then(response => this.audience = response.data)
                    .catch(error => console.log(error))
                    .then(() => this.loading = false);
            }
        }
    }
</script>

<style scoped>

</style>
