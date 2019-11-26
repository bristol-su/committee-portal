<template>
    <div>
        <b-table :fields="fields" :items="permissions">

            <template v-slot:cell(assign)="data">
                <a :href="'/site-permission/' + data.item.ability + '/'">
                    <b-button variant="secondary" size="sm">Assign</b-button>
                </a>
            </template>


        </b-table>
    </div>
</template>

<script>
    export default {
        name: "Index",
        data() {
            return {
                permissionObject: {},
                fields: [
                    'name', 'description', 'assign'
                ]
            }
        },

        created() {
            this.getPermissions();
        },

        methods: {
            getPermissions() {
                this.$api.sitepermissions().all()
                    .then(response => this.permissionObject = response.data)
                    .catch(error => this.$notify.alert('Could not retrieve permissions'));
            }
        },

        computed: {
            permissions() {
                return Object.keys(this.permissionObject).map(key => this.permissionObject[key]);
            },
        }
    }
</script>

<style scoped>

</style>
