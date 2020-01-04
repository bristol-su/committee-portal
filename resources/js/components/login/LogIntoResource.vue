<template>
    <div>
        <b-row>
            <b-col>
                TITLE:
                To access the activity '{{activity.name}}', you need to log in.

            </b-col>
        </b-row>

        <b-row>
            <b-col lg="4" md="6" sm="12" v-if="canBeUser">
                <login-choice :current-id="loginId" :current-type="loginType" :resource="user" @input="setLogin"
                              type="user"></login-choice>
            </b-col>
            <b-col :key="group.id" lg="4" md="6" sm="12" v-for="group in groups">
                <login-choice :current-id="loginId" :current-type="loginType" :resource="group" @input="setLogin"
                              type="group"></login-choice>
            </b-col>
            <b-col :key="role.id" lg="4" md="6" sm="12" v-for="role in roles">
                <login-choice :current-id="loginId" :current-type="loginType" :resource="role" @input="setLogin"
                              type="role"></login-choice>
            </b-col>
        </b-row>

        <b-row>
            <b-col md="3" sm="12">
                <b-button :disabled="!hasSelectedOption" @click="login" variant="secondary">
                    Login
                </b-button>
            </b-col>
        </b-row>

        <form :action="loginUrl" id="log-into-admin-form" method="POST" ref="loginForm" style="display: none;">
            <input :value="$csrf" name="_token" type="hidden">
            <input :value="redirectUrl" name="redirect" type="hidden">
            <input name="login_id" ref="loginId" type="hidden">
            <input name="login_type" ref="loginType" type="hidden">
        </form>

    </div>

</template>

<script>
    import LoginChoice from './LoginChoice';

    export default {
        components: {LoginChoice},
        props: {
            groups: {
                type: Array,
                default: function () {
                    return [];
                }
            },
            roles: {
                type: Array,
                default: function () {
                    return [];
                }
            },
            user: {
                type: Object,
                required: false
            },
            canBeUser: {
                type: Boolean,
                default: false
            },
            activity: {
                type: Object,
                required: true
            },
            redirectTo: {
                type: String,
                default: ''
            },
            admin: {
                type: Boolean,
                default: false
            }
        },

        data() {
            return {
                loginId: null,
                loginType: null

            }
        },

        methods: {
            login() {
                if (this.hasSelectedOption) {
                    this.$refs.loginId.value = this.loginId;
                    this.$refs.loginType.value = this.loginType;
                    this.$refs.loginForm.submit();
                }
            },
            setLogin(type, id) {
                this.loginType = type;
                this.loginId = id;
            },
        },

        computed: {
            loginUrl() {
                return '/login/admin/' + this.activity.slug;
            },
            hasSelectedOption() {
                return this.loginId !== null && this.loginType !== null;
            },
            redirectUrl() {
                if (this.redirectTo === null) {
                    return '/a/' + this.activity.slug;
                }
                return this.redirectTo;
            }
        }
    }
</script>

<style>

</style>
