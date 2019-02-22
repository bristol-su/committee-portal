<template>
    <div>
        <v-select
                :filterable="false"
                :getOptionLabel="getLabel"
                :options="options"
                @search="onSearch"
                v-model="selectedOption"
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
                selectedOption: null
            }
        },

        mounted() {
            // Load the preselected option
            if (this.initialUid !== null) {
                axios.get('unioncloud/api/user', {
                    params: {
                        'uid': this.initialUid
                    }
                })
                    .then(response => {
                        this.selectedOption = response.data;
                        this.options = [response.data];
                        this.errorVisible = false;
                    })
                    .catch(error => {
                        this.errorVisible = true;
                    });
            }
        },

        methods: {
            onSearch(search, loading) {
                loading(true);
                this.search(loading, search, this);
            },

            search: _.debounce((loading, search, vm) => {
                let self = this;
                axios.get('/unioncloud/api/user/multisearch',
                    {
                        params: {search: search},
                        accept: 'application/json'
                    }
                ).then(response => {
                    console.log(response);
                    loading(false);
                    vm.errorVisible = false;
                    vm.options = response.data;
                    self.selectedOption = null;
                }).catch(error => {
                    loading(false);
                    vm.errorVisible = true;
                    vm.options = [];
                    self.selectedOption = null;
                });
            }, 1000),

            getLabel(option) {
                return (option.uid === undefined ? '' : option.forename + ' ' + option.surname + ' - ' + option.email);
            },


        }
    }

</script>