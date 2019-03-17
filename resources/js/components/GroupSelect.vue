<template>
    <li class="nav-item dropdown">
        <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
           id="groupSelect" role="button">
            {{currentGroup.name}} <span class="caret"></span>
        </a>

        <div aria-labelledby="groupSelect" class="dropdown-menu dropdown-menu-right">
            <a @click.prevent="logout" class="dropdown-item" href="#" v-if="groupId !== null">
                <button type="button" class="btn btn-outline-danger group-select-dropdown-button">Logout</button>
            </a>
            <a class="dropdown-item" href="/portal" v-if="groupId !== null">
                <button type="button" class="btn btn-outline-success group-select-dropdown-button">Go to portal</button>
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
                let group = this.groups.filter(Gid => Gid.id === this.groupId);

                if (group.length === 0) {
                    return {
                        id: -1,
                        name: 'Select a group'
                    };
                }

                return group[0];
            }
        },

        created() {
            this.$http.get('/control-database/api/groups')
                .then(response => {
                    this.groups = response.data ;
                })
                .catch(error => {
                    this.$notify.alert('Sorry, we could not find groups to view as.');
                })
        },

        methods: {
            login(event) {
                this.$http.post('/admin/login/group', {group_id: event.target.id})
                    .then(response => window.location.href = '/portal')
                    .catch(error => {
                        this.$notify.alert('There was an error logging you in');
                    })
            },
            logout(event) {
                this.$http.post('/admin/logout/group')
                    .then(response => window.location.href = '/admin')
                    .catch(error => {
                        this.$notify.alert('Could not log you out');
                    })
            }
        }
    }
</script>

<style>

    .group-select-dropdown-button {
        width: 100%
    }

</style>