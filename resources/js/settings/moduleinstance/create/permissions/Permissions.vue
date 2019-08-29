<template>
    <div>
        <div class="panel-body">

            <b-form-group
                :description="permission.description"
                :id="permission.permission + '-label'"
                :key="permission.permission"
                :label="permission.name"
                :label-for="permission.permission"
                v-for="permission in permissions"
            >
                <logic-select v-model="form[permission.permission]"></logic-select>
            </b-form-group>
        </div>
    </div>
</template>

<script>
    import LogicSelect from "./LogicSelect";
    export default {
        name: "ModulePermissions",
        components: {LogicSelect},
        props: {
            permissions: {
                required: false,
                default: function() {
                    return []
                }
            }
        },

        data() {
            return {
                form: {},
                id: null
            }
        },

        watch: {
            form: {
                deep: true,
                handler: _.debounce(function() {
                    if(this.id === null) {
                        this.createPermissions();
                    } else {
                        this.updatePermissions();
                    }
                }, 1000)
            }
        },

        methods: {

            createPermissions() {
                this.$api.permissions().create({participant_permissions: this.form, admin_permissions: {}})
                    .then(response => this.id = response.data.id)
                    .catch(error => this.$notify.alert('There was a problem creating the permissions: ' + error.message))
                    .then(() => this.$emit('input', this.id));
            },

            updatePermissions() {
                this.$api.permissions().update(this.id, {participant_permissions: this.form, admin_permissions: {}})
                    .catch(error => this.$notify.alert('There was a problem creating the permissions: ' + error.message))
                    .then(() => this.$emit('input', this.id));
            },
        },
    }
</script>

<style scoped>

</style>
