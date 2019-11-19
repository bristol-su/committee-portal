<template>
    <div>

        <b-row>
            <b-col>
                To access the activity '{{activity.name}}' as an administrator, you need to log in.

            </b-col>
        </b-row>

        <b-row>
            <b-col md="9" sm="12">
                <b-form-select @input="selectOption" :options="options">

                </b-form-select>
            </b-col>

            <b-col md="3" sm="12">
                <b-button variant="secondary" @click="login" :disabled="!hasSelectedOption">
                    Login
                </b-button>
            </b-col>
        </b-row>

        <form id="log-into-admin-form" ref="loginForm" :action="loginUrl" method="POST" style="display: none;">
            <input type="hidden" name="_token" :value="$csrf">
            <input type="hidden" name="redirect" :value="redirectUrl">
            <input type="hidden" ref="loginId" name="login_id">
            <input type="hidden" ref="loginType" name="login_type">
        </form>

    </div>

</template>

<script>
    export default {
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
            activity: {
                type: Object,
                required: true
            },
            redirectTo: {
                type: String,
                default: ''
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
            selectOption(value) {
                let info = value.split(':');
                this.loginType = info[0];
                this.loginId = info[1];
            }
        },

        computed: {
            groupOptions() {
                return this.groups.map(group => {
                    return {
                        text: 'Membership to ' + group.name,
                        value: 'group:' + group.id
                    }
                })
            },
            roleOptions() {
                return this.roles.map(role => {
                    return {
                        text: 'Position of ' + role.position.name + ' of ' + role.group.name,
                        value: 'role:' + role.id
                    }
                })
            },
            userOptions() {
                if (this.user !== null) {
                    return {
                        text: 'Your user account',
                        value: 'user:' + this.user.id
                    }
                } else {
                    return null;
                }
            },
            options() {
                return [this.userOptions].concat(this.groupOptions).concat(this.roleOptions);
            },
            loginUrl() {
                return '/login/admin/' + this.activity.slug;
            },
            hasSelectedOption() {
                return this.loginId !== null && this.loginType !== null;
            },
            redirectUrl() {
                if (this.redirectTo === null) {
                    return '/p/' + this.activity.slug;
                }
                return this.redirectTo;
            }
        }
    }
</script>

<style>

</style>
