<template>
    <div>

    <b-row>
        <b-col>
            To access the activity '{{activity.name}}', you need to log into a group.

        </b-col>
    </b-row>

    <b-row>
        <b-col md="9" sm="12">
            <b-form-select v-model="groupId" :options="groupOptions">

            </b-form-select>
        </b-col>

        <b-col md="3" sm="12">
            <b-button variant="secondary" @click="login" :disabled="!selectedGroup">
                Login
            </b-button>
        </b-col>
    </b-row>

    <form id="log-into-group-form" ref="logIntoGroup" :action="loginUrl" method="POST" style="display: none;">
        <input type="hidden" name="_token" :value="$csrf">
        <input type="hidden" name="redirect" :value="redirectUrl">
        <input type="hidden" ref="groupId" name="group_id">
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
                groupId: null,
            }
        },

        methods: {
            login() {
                if(this.selectedGroup) {
                    this.$refs.groupId.value = this.groupId;
                    this.$refs.logIntoGroup.submit();
                }
            }
        },

        computed: {
            groupOptions() {
                return this.groups.map(group => {
                    return {
                        text: 'Membership of ' + group.name,
                        value: group.id
                    }
                })
            },
            loginUrl() {
                return '/login/group/' + this.activity.slug;
            },
            selectedGroup() {
                return this.groupId !== null;
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
