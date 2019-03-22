<template>
    <div>

        <form @submit.prevent="updatePresident">
            <div class="form-group">
                <user-search
                        @studentSelected="updateStudentSelection">

                </user-search>
            </div>
            <div class="form-group">

                <button class="btn btn-info" style="width: 100%;">{{buttonText}}</button>
            </div>
        </form>

    </div>

</template>

<script>
    import UserSearch from './../../../../../../../resources/js/components/unioncloud/UserSearch';

    export default {
        components: {
            'user-search': UserSearch
        },

        data() {

            return {
                selected: null
            }
        },

        methods: {

            updateStudentSelection(student) {
                this.selected = student
            },

            updatePresident() {
                if (this.selected === null) {
                    this.$notify.warning('Please select the new president before submitting.');
                } else if (confirm('Are you sure you wish to hand over the president position to ' +
                    this.selected.forename + ' ' + this.selected.surname + ' (' + this.selected.email + ')?')) {
                        this.$http.post('/presidenthandover', {
                            uid: this.selected.uid
                        })
                            .then(response => window.location.reload());
                            .catch(error => this.$notify.error('Could not hand over to ' + this.selected.forename + ': ' + error.message));
                }
            }
        },

        computed: {
            buttonText() {
                return (this.selected === null ? 'Search for your new president above' : 'Confirm ' + this.selected.forename + ' ' + this.selected.surname + ' as your new president?');
            }
        }
    }
</script>

<style>


</style>