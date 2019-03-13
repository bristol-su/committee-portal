<template>
    <li class="nav-item dropdown">
        <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
           id="committeeSelect" role="button">
            {{currentRole.group.name}} - {{currentRole.position.name}} <span class="caret"></span>
        </a>

        <div aria-labelledby="committeeSelect" class="dropdown-menu dropdown-menu-right">
            <a :id="role.id" @click.prevent="login" class="dropdown-item" href="#" v-for="role in roles"
               v-if="role.id !== currentRole.id">
                {{role.group.name}} - {{role.position.name}}
            </a>
        </div>
    </li>
</template>

<script>
    export default {

        props: {
            roleId: {
                default: null,
            }
        },

        data() {
            return {
                roles: []
            }
        },

        computed: {
            currentRole() {
                if (this.roles.length === 0) {
                    return {
                        group: {
                            name: 'Loading...'
                        },
                        position: {
                            name: 'Loading...'
                        }
                    };
                }

                return (this.roleId === null ? this.roles[0] : this.roles.filter(Rid => Rid.id === this.roleId)[0]);
            }
        },

        created() {
            this.$http.get('/control-database/api/available_committee_roles')
                .then(response => {
                    this.roles = response.data;
                })
                .catch(error => {
                    this.$notify.alert('Sorry, something went wrong.');
                    console.log('Sorry, we could not get positions');
                })
        },

        methods: {
            login(event) {
                this.$http.post('/login/position', {committee_role_id: event.target.id})
                    .then(response => {
                        window.location.reload();
                    })
                    .catch(error => {
                        this.$notify.alert('There was an error logging you in');
                    })
            }
        }
    }
</script>

<style>

</style>