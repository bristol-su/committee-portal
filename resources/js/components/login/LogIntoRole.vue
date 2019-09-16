<template>
    <li class="nav-item dropdown">
        <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="committeeSelect" role="button">
            <span v-if="hasCurrentRole">{{currentRole.group.name}} {{currentRole.position_name}} ({{currentRole.committee_year}})</span>
            <span v-if="!hasCurrentRole">Select a role</span>
            <span class="caret"></span>
        </a>

        <div aria-labelledby="committeeSelect" class="dropdown-menu dropdown-menu-right">
            <a :id="role.id" @click.prevent="login(role.id)" class="dropdown-item" href="#" v-for="role in roles">
                {{role.group.name}} {{role.position_name}} ({{role.committee_year}})
            </a>
        </div>

        <form id="log-into-role-form" ref="logIntoRole" action="/login/role" method="POST" style="display: none;">
            <input type="hidden" name="_token" :value="$csrf">
            <input type="hidden" ref="roleId" name="role_id">
        </form>
    </li>
</template>

<script>
    export default {

        props: {
            currentRole: {
                type: Object,
                default: null,
                required: false
            }
        },

        data() {
            return {
                roles: [],
                loading: false,
                chosenRoleId: null
            }
        },

        created() {
            this.loading = true;
            this.$api.me().roles()
                .then(response => this.roles = response.data)
                .catch(error => this.$notify.alert('Could not load roles'))
                .then(() => this.loading = false);
        },

        methods: {
            login(roleId) {
                this.$refs.roleId.value = roleId;
                this.$refs.logIntoRole.submit();
            }
        },

        computed: {
            hasCurrentRole() {
                return this.currentRole !== null
            }
        }

    }
</script>

<style>

</style>
