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
            <b-button variant="secondary" @click="login" :disabled="!selectedOption">
                Login
            </b-button>
        </b-col>
    </b-row>

    <form id="log-into-group-form" ref="logIn" :action="loginUrl" method="POST" style="display: none;">
        <input type="hidden" name="_token" :value="$csrf">
        <input type="hidden" name="redirect" :value="redirectUrl">
        <input type="hidden" ref="type" name="type">
        <input type="hidden" ref="typeId" name="type_id">
    </form>

    </div>

</template>

<script>
    export default {

        props: {
            groups: {
                type: Array,
                default: function() {
                    return [];
                }
            },
            roles: {
                type: Array,
                default: function() {
                    return [];
                }
            },
            user: {
                type: Object,
                required: false,
                default: null
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
                type: null,
                typeId: null,
            }
        },

        methods: {
            selectOption(option) {
                const optionSplit = option.split(":");
                this.type = optionSplit[0];
                this.typeId = optionSplit[1];
            },

            login() {
                if(this.selectedOption) {
                    this.$refs.type.value = this.type;
                    this.$refs.typeId.value = this.typeId;
                    this.$refs.logIn.submit();
                }
            }
        },

        computed: {
            options() {
                let options = [];
                options = options.concat(this.groups.map(group => {
                    return {
                        text: 'Membership of ' + group.name,
                        value: 'group:' + group.id
                    }
                }));
                options = options.concat(this.roles.map(role => {
                    return {
                        text: 'Role of ' + role.pivot.position_name + ' for ' + role.group.name,
                        value: 'role:' + role.id
                    }
                }));

                if(this.user !== null) {
                    options = options.push({
                        text: 'Your user account',
                        value: 'user:' + this.user.id
                    })
                }
                return options;
            },
            loginUrl() {
                return '/login/admin/' + this.activity.slug;
            },
            selectedOption() {
                return this.type !== null && this.typeId !== null;
            },
            redirectUrl() {
                if(this.redirectTo === null) {
                    return '/p/'  + this.activity.slug;
                }
                return this.redirectTo;
            }
        }

    }
</script>

<style>

</style>
