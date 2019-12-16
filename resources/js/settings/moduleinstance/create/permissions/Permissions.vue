<template>
    <div>
        <div class="panel-body">
            <b-form-group
                :description="permission.description"
                :id="permission.ability + '-label'"
                :key="permission.ability"
                :label="permission.name"
                :label-for="permission.ability"
                v-for="permission in participantPermissions"
            >
                <logic-select v-model="participant[permission.ability]"></logic-select>
            </b-form-group>

            <br/><hr/><br/>
            <b-form-group
                :description="permission.description"
                :id="permission.ability + '-label'"
                :key="permission.ability"
                :label="permission.name"
                :label-for="permission.ability"
                v-for="permission in adminPermissions"
            >
                <logic-select v-model="admin[permission.ability]"></logic-select>
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
            moduleInstance: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                participant: {},
                admin: {},
                id: null
            }
        },

        watch: {
            formattedForm: {
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
                this.$api.moduleInstancePermissions().create(this.formattedForm)
                    .then(response => this.id = response.data.id)
                    .catch(error => this.$notify.alert('There was a problem creating the permissions: ' + error.message))
                    .then(() => this.$emit('input', this.id));
            },

            updatePermissions() {
                this.$api.moduleInstancePermissions().update(this.id, this.formattedForm)
                    .catch(error => this.$notify.alert('There was a problem creating the permissions: ' + error.message))
                    .then(() => this.$emit('input', this.id));
            },
        },

        computed: {
            participantPermissions() {
                return this.permissions.filter(permission => permission.module_type === 'participant');
            },
            adminPermissions() {
                return this.permissions.filter(permission => permission.module_type === 'administrator');
            },

            formattedForm() {
                return {
                    participant_permissions: this.participant,
                    admin_permissions: this.admin
                }
            }

        }
    }
</script>

<style scoped>

</style>
