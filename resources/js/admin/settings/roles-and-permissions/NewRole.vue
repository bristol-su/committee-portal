<template>
    <div class="container" style="margin: 2%;">

        <div style="display: flex; justify-content: space-evenly;">
            <div class="display: inline-block; ">
                <h2>{{formTitle}}</h2>
            </div>
            <div class="float: right;">
                <button @click="cancel" class="btn btn-danger btn-sm">Cancel</button>
                <button @click="save" class="btn btn-success btn-sm">{{submitText}}</button>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <div class="col-md-12">
                Role Name:
                <input class="form-control input-md" id="rolename" name="rolename" placeholder="Forename" required=""
                       type="text" v-model="roleName">

            </div>
        </div>


    </div>
</template>

<script>

    export default {
        props: {
            role: {
                default: null,
            }
        },

        data() {
            return {
                roleName: ''
            }
        },

        created() {
            if(this.role !== null) {
                this.roleName = this.role.name
            }
        },

        methods: {
            cancel() {
                if (confirm('Are you sure you wish to cancel? You will lose any unsaved changes.')) {
                    this.$emit('close');
                }
            },

            save() {
                this.$http.post('/admin/settings/roles/update' + (this.role === null?'':'/'+this.role.id), {
                    name: this.roleName
                })
                    .then(response => {
                        this.$notify.success('Role Saved');
                        this.$emit('roleUpdated', response.data);
                        this.$emit('close');
                    })
                    .catch(error => this.$notify.alert('Role not saved: '+error.message))
            }
        },

        computed: {
            formTitle() {
                return (this.role === null ? 'Create new role' : 'Edit role #' + this.role.id);
            },

            submitText() {
                return (this.role === null ? 'Create Role' : 'Update Role')
            }
        }
    }
</script>

<style>

</style>