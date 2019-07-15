<template>
    <div style="text-align: left">

        <b-form @submit.prlogic="onSubmit">
            <b-form-group
                    description="A name for the logic"
                    id="name-logic"
                    label="Logic Name:"
                    label-for="name"
            >
                <b-form-input
                        id="name"
                        placeholder="Enter Logic Name"
                        required
                        type="text"
                        v-model="form.name"
                ></b-form-input>
            </b-form-group>


            <b-form-group
                    description="A description for the logic"
                    id="description-group"
                    label="Logic Description:"
                    label-for="description"
            >
                <b-form-input
                        id="description"
                        placeholder="Enter Logic Description"
                        required
                        type="text"
                        v-model="form.description"
                ></b-form-input>
            </b-form-group>

            <b-form-group label="Who is this logic for?">
                <b-form-radio name="for" v-model="form.for" value="group">Groups</b-form-radio>
                <b-form-radio name="for" v-model="form.for" value="student">Students</b-form-radio>
            </b-form-group>

            <logic-constraint
            title="All must be true"
            id="all_true"
            :filters="relevantFilters"
            v-model="form.all_true"></logic-constraint>

            <logic-constraint
            title="Any must be true"
            id="any_true"
            :filters="relevantFilters"
            v-model="form.any_true"></logic-constraint>

            <logic-constraint
            title="All must be false"
            id="all_false"
            :filters="relevantFilters"
            v-model="form.all_false"></logic-constraint>

            <logic-constraint
            title="Any must be false"
            id="any_false"
            :filters="relevantFilters"
            v-model="form.any_false"></logic-constraint>


            <b-button type="submit" variant="primary">Submit</b-button>
        </b-form>
    </div>

</template>

<script>

    import LogicConstraint from './LogicConstraint';

    export default {
        name: "Create.vue",

        components: {
            LogicConstraint
        },

        props: {
            filters: {
                required: true,
                type: Array
            }
        },


        data() {
            return {
                form: {
                    name: '',
                    description: '',
                    for: 'group',
                    all_true: [],
                    any_true: [],
                    all_false: [],
                    any_false: []
                }
            }
        },

        methods: {
            onSubmit() {
                this.$http.post('/admin/settings/logic', this.form)
                    .then(response => {
                        this.$notify.success('Logic created!');
                        location.reload();
                    })
                    .catch(error => this.$notify.alert('There was an error: '+error.message));
            },
        },

        computed: {
            relevantFilters() {
                return this.filters.filter(filter => {
                    if(filter.validFor === 'group' && this.for === 'student') {
                        return false;
                    }
                    return true;
                })
            }
        }

    }
</script>

<style scoped>

</style>