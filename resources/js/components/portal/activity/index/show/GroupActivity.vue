<template>
    <div>
        <b-button variant="secondary" @click="gotoActivity">{{activity.name}}</b-button>

        <form id="redirect-to-activity" ref="redirectToActivity" :action="loginUrl" method="POST" style="display: none;">
            <input type="hidden" name="_token" :value="$csrf">
            <input type="hidden" name="redirect" :value="redirectUrl">
            <input type="hidden" name="login_type" value="group">
            <input type="hidden" ref="groupId" name="login_id" :value="groupId">
        </form>
    </div>
</template>

<script>
    export default {
        name: "GroupActivity",

        props: {
            activity: {
                required: true,
                type: Object
            },
            groupId: {
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
                return '/login/group/' + this.activity.slug;
            }
        }
    }
</script>

<style scoped>

</style>
