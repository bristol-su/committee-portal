<template>
    <li class="nav-item dropdown">
        <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
           id="groupSelect" role="button">
            {{currentGroup.name}} <span class="caret"></span>
        </a>

        <div aria-labelledby="groupSelect" class="dropdown-menu dropdown-menu-right group-select-dropdown" >
            <div class="input-group sticky-top">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="search-icon">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
                <input aria-describedby="search-icon" class="form-control" style="margin: auto; padding: 2px"
                       type="text" v-model="searchData"/>
            </div>
            <a @click.prevent="logout" class="dropdown-item" href="#" v-if="groupId !== null">
                <button class="btn btn-outline-danger group-select-dropdown-button" type="button">Logout</button>
            </a>
            <a class="dropdown-item" href="/portal" v-if="groupId !== null">
                <button class="btn btn-outline-success group-select-dropdown-button" type="button">Go to portal</button>
            </a>

            <a :id="group.id" @click.prevent="login" class="dropdown-item" href="#" v-for="group in filteredGroups"
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
                groups: [],
                searchData: ''
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
            },

            filteredGroups() {
                return this.groups.filter(group => {
                    // if (!new RegExp(this.searchData, 'i').test(group.name)) {
                    //     return false;
                    // }

                    return true;
                });
            }
        },

        created() {
            this.$http.get('/control-database/api/groups')
                .then(response => {
                    this.groups = response.data;
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

    .group-select-dropdown {
        overflow-y: scroll;
        height: 50vh;
    }

</style>