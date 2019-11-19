<template>
    <div>
        <b-button variant="secondary" @click="gotoActivity">{{activity.name}}</b-button>

        <form id="redirect-to-activity" ref="redirectToActivity" :action="loginUrl" method="POST" style="display: none;">
            <input type="hidden" name="_token" :value="$csrf">
            <input type="hidden" name="redirect" :value="redirectUrl">
            <input type="hidden" name="login_type" value="user">
            <input type="hidden" ref="userId" name="login_id" :value="userId">
        </form>
    </div>
</template>

<script>
    export default {
        name: "UserActivity",

        props: {
            activity: {
                required: true,
                type: Object
            },
            admin: {
                default: false,
                type: Boolean
            },
            userId: {
                default: false,
            }
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
                return '/login/user/' + this.activity.slug;
            }
        }
    }
</script>

<style scoped>

</style>
