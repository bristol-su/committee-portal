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
                <logic-select :for-logic="forLogic" v-model="form[permission.permission]"></logic-select>
            </b-form-group>

            <b-button type="submit" variant="primary">Save Permissions</b-button>
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
                required: true,
                type: Object
            },
            forLogic: {
                required: true,
                type: String
            }
        },

        data() {
            return {
                permissions: [],
                form: {},
            }
        },

        created() {
            this.getModulePermissions();
            this.form = (this.permissions.permissions === undefined ? {} : this.permissions.permissions);
        },

        methods: {

            onSubmit() {
                this.$http.post('/admin/settings/moduleinstance/' + this.moduleInstance.id + '/permissions', {permissions: this.form})
                    .then(response => {
                        this.$notify.success('Permissions Saved');
                        this.$emit('saved', response.data);
                    })
                    .catch(error => this.$notify.alert('Permissions not saved: ' + error.message));
            }
        },

        computed: {
            logicOptions() {
                return this.studentLogic.map(logic => {
                    return {
                        value: logic.id,
                        text: logic.name
                    };
                })
            }
        }
    }
</script>

<style scoped>

</style>
