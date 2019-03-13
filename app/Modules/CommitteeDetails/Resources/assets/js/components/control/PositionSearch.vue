<template>
    <div>
        <v-select
                :loading="loading"
                :options="options"
                label="name"
                v-model="selectedOption"
        >
        </v-select>

        <small><span v-show="errorVisible">No positions found.</span></small>

    </div>
</template>

<script>

    import vSelect from 'vue-select';

    export default {

        components: {
            'v-select': vSelect
        },

        props: {
            initialPositionId: {
                default: null
            }
        },

        data() {
            return {
                options: [],
                selectedOption: null,
                errorVisible: false,
                loading: false,
            }
        },

        watch: {
            selectedOption: function (val) {
                this.$emit('positionSelected', val);
            }
        },

        mounted() {
            this.loading = true;
            // Load available positions
            this.$http.get('committeedetails/positions')
                .then(response => {
                    this.options = response.data;
                    this.loading = false;
                })
                .catch(error => {
                    this.$notify.alert('Sorry, something went wrong.');
                    this.errorVisible = true;
                    this.loading = false;
                });

            // If the user is being edited, add their position too
            if (this.initialPositionId !== null) {
                this.$http.get('control-database/api/positions')
                    .then(response => {
                        let option = response.data.filter(position => position.id === this.initialPositionId)[0];
                        this.options.push(option);
                        this.selectedOption = option;
                    })
                    .catch(error => {
                        this.$notify.alert('Sorry, something went wrong.');
                        this.errorVisible = true;
                    });
            }

        },

    }

</script>