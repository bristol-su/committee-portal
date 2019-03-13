<template>
    <div>
        <v-select
                :filterable="false"
                :getOptionLabel="getLabel"
                :options="options"
                @search="onSearch"
                v-model="selectedOption"
                :loading="loading"
        >
        </v-select>
        
        <small><span v-show="errorVisible">No users found.</span></small>
        
    </div>
</template>

<script>

    import vSelect from 'vue-select';

    export default {

        components: {
            'v-select': vSelect
        },

        props: {
            initialUid: {
                default: null
            }
        },

        data() {
            return {
                options: [],
                errorVisible: false,
                selectedOption: null,
                loading: false
            }
        },

        watch: {
            selectedOption: function(val) {
                this.$emit('studentSelected', val);
            }
        },

        mounted() {
            // Load the preselected option
            if (this.initialUid !== null) {
                this.loading = true;
                this.$http.get('unioncloud/api/user', {
                    params: {
                        'uid': this.initialUid
                    }
                })
                    .then(response => {
                        this.selectedOption = response.data;
                        this.options = [response.data];
                        this.errorVisible = false;
                        this.loading = false;
                    })
                    .catch(error => {
                        this.$notify.alert('Sorry, something went wrong.');
                        this.errorVisible = true;
                        this.loading = false;
                    });
            }
        },

        methods: {
            onSearch(search, loading) {
                this.loading = true;
                this.search(loading, search, this);
            },

            search: _.debounce((loading, search, vm) => {
                // TODO Change from axios
                axios.get('/unioncloud/api/user/multisearch',
                    {
                        params: {search: search},
                        accept: 'application/json'
                    }
                ).then(response => {
                    vm.loading = false;
                    vm.errorVisible = false;
                    vm.options = response.data;
                    vm.selectedOption = null;
                }).catch(error => {
                    self.loading = false;
                    vm.errorVisible = true;
                    vm.options = [];
                    vm.loading = false;
                });
            }, 1000),

            getLabel(option) {
                return (option.uid === undefined ? '' : option.forename + ' ' + option.surname + ' - ' + option.email);
            },


        }
    }

</script>