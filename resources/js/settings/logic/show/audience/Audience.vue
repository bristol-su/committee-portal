<template>
    <div>
        <div v-if="loading">Loading...</div>
        <div v-else>
            <b-table striped hover :fields="fields" :items="items">
                <template v-slot:cell(can_access)="data">
                    <ul>
                        <li v-for="text in audienceCanAccessThrough(data.item)" >
                            {{text}}
                        </li>
                    </ul>
                </template>
            </b-table>
        </div>
    </div>
</template>

<script>
    import DataItem from "../../../../utilities/DataItem";

    export default {
        name: "Audience",
        components: {DataItem},
        props: {
            logicId: {
                required: true,
                type: Number
            }
        },

        data() {
            return {
                audience: [],
                loading: false,
                fields: [
                    {key: 'user', label: 'User'},
                    {key: 'can_access', label: 'Ways involved in the logic'}
                ]
            }
        },

        created() {
            this.getAudience();
        },

        methods: {
            getAudience() {
                this.loading = true;
                this.$api.logic().audience(this.logicId)
                    .then(response => this.audience = response.data)
                    .catch(error => console.log(error))
                    .then(() => this.loading = false);
            },

            audienceCanAccessThrough(audienceItem) {
                let methods = [];
                if(audienceItem.canBeUser) {
                    methods.push('Access through their user account')
                }
                methods = methods.concat(audienceItem.groups.map(group => {
                    return 'Access through their membership to ' + group.name;
                }));
                methods = methods.concat(audienceItem.roles.map(role => {
                    return 'Access through their role as ' + role.position.name + ' to ' + role.group.name;
                }));
                console.log(methods);
                return methods;
            }
        },

        computed: {
            items() {
                return this.audience.map(audience => {
                    return {
                        user: audience.user.uc_uid,
                        groups: audience.groups,
                        roles: audience.roles,
                        canBeUser: audience.can_be_user
                    }
                })
            },

        }

    }
</script>

<style scoped>

</style>
