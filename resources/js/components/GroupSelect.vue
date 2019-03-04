<template>
    <li class="nav-item dropdown">
        <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
           id="groupSelect" role="button">
            {{currentGroup.name}} <span class="caret"></span>
        </a>

        <div aria-labelledby="groupSelect" class="dropdown-menu dropdown-menu-right">
            <a @click.prevent="logout" class="dropdown-item" href="#" v-if="groupId !== null">
                <button type="button" class="btn btn-outline-danger">Logout</button>
            </a>
            <a :id="group.id" @click.prevent="login" class="dropdown-item" href="#" v-for="group in groups"
               v-if="group.id !== currentGroup.id">
                {{group.name}}
            </a>
        </div>
    </li>
</template>

<script>
    export default {

        props: {
            groupId: {
                default: null,
            }
        },

        data() {
            return {
                groups: []
            }
        },

        computed: {
            currentGroup() {
                if (this.groupId === null) {
                    return {
                        id: -1,
                        name: 'Select a group'
                    };
                }

                return this.groups.filter(Gid => Gid.id === this.groupId)[0];
            }
        },

        created() {
            this.$http.get('/control-database/api/groups')
                .then(response => {
                    this.groups = response.data ;
                })
                .catch(error => {
                    console.log('Sorry, we could not get the groups');
                })
        },

        methods: {
            login(event) {
                this.$http.post('/login/group', {group_id: event.target.id})
                    .then(response => window.location.href = '/portal')
                    .catch(error => {
                        this.$notify({
                            group: 'notification',
                            title: 'Error',
                            text: 'There was an error logging you in.'
                        });
                    })
            },
            logout(event) {
                this.$http.post('/logout/group')
                    .then(response => window.location.href = '/admin')
                    .catch(error => {
                        this.$notify({
                            group: 'notification',
                            title: 'Error',
                            text: 'Could not log you out.'
                        });
                    })
            }
        }
    }
</script>

<style>

</style>