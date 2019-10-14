<template>
    <div>
        <b-button variant="secondary" @click="gotoActivity">{{activity.name}}</b-button>

        <form id="redirect-to-activity" ref="redirectToActivity" :action="loginUrl" method="POST" style="display: none;">
            <input type="hidden" name="_token" :value="$csrf">
            <input type="hidden" name="redirect" :value="redirectUrl">
            <input type="hidden" ref="roleId" name="role_id" :value="roleId">
        </form>
    </div>
</template>

<script>
    export default {
        name: "RoleActivity",

        props: {
            activity: {
                required: true,
                type: Object
            },
            roleId: {
                required: true
            },
            admin: {
                default: false,
                type: Boolean
            }
        },

        data() {
            return {}
        },

        methods: {
            gotoActivity() {
                this.$refs.redirectToActivity.submit();
            }
        },

        computed: {
            redirectUrl() {
                return (this.admin?'/a/':'/p/')
                    + this.activity.slug;
            },
            loginUrl() {
                return '/login/role/' + this.activity.slug;
            }
        }
    }
</script>

<style scoped>

</style>
