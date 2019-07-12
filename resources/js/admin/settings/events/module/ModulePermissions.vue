<template>
    <div>
        <div class="panel-body">
            <form @submit.prevent="onSubmit">

                    <b-form-group
                            v-for="permission in permissions"
                            :key="permission.permission"
                            :id="permission.permission + '-label'"
                            :description="permission.description"
                            :label="permission.name"
                            :label-for="permission.permission"
                    >
                        <b-form-select :options="logicOptions" v-model="form[permission.permission]"></b-form-select>
                    </b-form-group>

                <b-button type="submit" variant="primary">Save Permissions</b-button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ModulePermissions",

        props: {
            moduleInstance: {
                required: true
            },
            studentLogic: {
                required: true
            },
            permissions: {
                required: true,
                type: Object
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
            this.form = (this.permissions.permissions===undefined?{}:this.permissions.permissions);
        },

        methods: {
            getModulePermissions(alias) {
                this.$http.get('/admin/settings/modules/'+this.moduleInstance.alias+'/permissions')
                    .then(response => {
                        this.permissions = response.data;
                    })
                    .catch(error => this.$notify.alert('Could not load module permissions: '+error.message));
            },

            onSubmit() {
                this.$http.post('/admin/settings/moduleinstance/'+this.moduleInstance.id+'/permissions', {permissions: this.form})
                    .then(response => {
                        this.$notify.success('Permissions Saved');
                        this.$emit('saved', response.data);
                    })
                    .catch(error => this.$notify.alert('Permissions not saved: '+error.message));
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