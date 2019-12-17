<template>
    <b-card>
        <data-item title="Name">
            {{connection.name}}
        </data-item>
        <data-item title="Description">
            {{connection.description}}
        </data-item>
        <data-item title="Usage" v-if="loadingServices">
            Loading...
        </data-item>
        <data-item title="Usage" v-else="loadingServices">
            This connection is being used in {{serviceUsage}} modules.
        </data-item>

    </b-card>
</template>

<script>
    import DataItem from '../../../utilities/DataItem';
    export default {
        name: "ConnectionDetails",
        components: {DataItem},
        props: {
            connection: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                miServices: [],
                loadingServices: true
            }
        },

        created() {
            this.loadServices();
        },

        methods: {
            loadServices() {
                this.loadingServices = true;
                this.$api.moduleInstanceServices().all()
                    .then(response => this.miServices = response.data)
                    .catch(error => this.$notify.alert('Could not load service usage'))
                    .then(() => this.loadingServices = false);
            }
        },

        computed: {
            serviceUsage() {
                return this.miServices.filter(service => service.connection_id === this.connection.id).length
            }
        }

    }
</script>

<style scoped>
</style>
