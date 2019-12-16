<template>
    <div>
        <h4>Required Services</h4>
        <service-select
            v-for="service in required"
            :key="service" :service="service" :connections="connections[service]">
        </service-select>
        <h4>Optional Services</h4>
    </div>
</template>

<script>
    import ServiceSelect from './ServiceSelect';
    export default {
        name: "Services",
        components: {ServiceSelect},
        props: {
            required: {
                type: Array,
                default: function () {
                    []
                }
            },
            optional: {
                type: Array,
                default: function () {
                    []
                }
            }
        },

        data() {
            return {
                connections: {}
            }
        },

        created() {
            this.loadServices();
        },

        methods: {
            loadServices() {
                this.services.forEach(service => {
                    this.$api.connection().allForService(service)
                        .then(response => this.$set(this.connections, service, response.data))
                        .catch(error => this.$notify.alert('Could not load connections: ' + error.message));
                })
            },
            assignService(id, service) {

            }
        },

        computed: {
            services() {
                return this.required.concat(this.optional);
            }
        }
    }
</script>

<style scoped>

</style>
