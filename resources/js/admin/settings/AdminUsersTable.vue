<template>
    <div>

        <table class="table table-hover table-responsive table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>ID</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="user in users">
                    <th>{{user | fullname}}</th>
                    <th>{{user.email}}</th>
                    <th>{{user.student_id}}</th>
                    <th>
                        <button type="button" class="btn btn-outline-info" @click="editUser(user)">Edit</button>
                        <button type="button" class="btn btn-outline-info" @click="manageUserPermissions(user)">Manage Permissions</button>
                        <button type="button" class="btn btn-outline-danger" @click="deleteUser(user)">Delete</button>
                    </th>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: []
            }
        },

        created() {

            this.$http.get('/admin/settings/admin-users/get-users')
                .then(response => this.users = response.data)
                .catch(error => this.$notify.alert(error.message));
        },

        filters: {
            fullname (user) {
                return user.forename + ' ' + user.surname;
            }
        },

        methods: {
            editUser(user) {
                // TODO
            },
            deleteUser(user) {
                // TODO
            },
            manageUserPermissions(user) {
                // TODO
            }
        }
    }
</script>

<style>

</style>