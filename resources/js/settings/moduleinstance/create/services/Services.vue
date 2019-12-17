<template>
    <div>
        <h4>Required Services</h4>
        <service-select
            :assigned-services="assignedServices"
            :key="service" :module-instance-id="moduleInstance.id" :service="service"
            v-for="service in services.required" @updated="updateAssignedService" @created="createAssignedService">
        </service-select>

        <h4>Optional Services</h4>
        <service-select
            :assigned-services="assignedServices"
            :key="service" :module-instance-id="moduleInstance.id" :service="service"
            v-for="service in services.optional" @updated="updateAssignedService" @created="createAssignedService">
        </service-select>
    </div>
</template>

<script>
    import ServiceSelect from './ServiceSelect';

    export default {
        name: "Services",
        components: {ServiceSelect},
        props: {
            moduleInstance: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                services: {
                    required: [],
                    optional: []
                },
                assignedServices: []
            }
        },

        created() {
            this.loadServices();
            this.loadAssignedServices();
        },

        methods: {
            loadServices() {
                this.$api.modules().getByAlias(this.moduleInstance.alias)
                    .then(response => this.services = {
                        required: response.data.services.required, optional: response.data.services.optional
                    })
                    .catch(error => this.$notify.alert('Could not load connections: ' + error.message));
            },

            loadAssignedServices() {
                this.$api.moduleInstanceServices().forModuleInstance(this.moduleInstance.id)
                    .then(response => this.assignedServices = response.data)
                    .catch(error => this.$notify.alert('Could not load assigned services: ' + error.message));
            },
            updateAssignedService(service) {
                let index = this.assignedServices.indexOf(this.assignedServices.filter(a => a.id === service.id)[0]);
                this.assignedServices.splice(index, 1, service);
            },
            createAssignedService(service) {
                this.assignedServices.push(service);
            }
        },
    }
</script>

<style scoped>

</style>
