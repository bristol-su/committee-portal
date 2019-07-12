<template>
    <div style="text-align: left">

        <b-form @submit.prevent="onSubmit">
            <b-form-group
                    description="A name for the event"
                    id="name-group"
                    label="Event Name:"
                    label-for="name"
            >
                <b-form-input
                        id="name"
                        placeholder="Enter Event Name"
                        required
                        type="text"
                        v-model="form.name"
                ></b-form-input>
            </b-form-group>


            <b-form-group
                    description="A description for the event"
                    id="description-group"
                    label="Event Description:"
                    label-for="description"
            >
                <b-form-input
                        id="description"
                        placeholder="Enter Event Description"
                        required
                        type="text"
                        v-model="form.description"
                ></b-form-input>
            </b-form-group>

            <b-form-group label="Who is this event for?">
                <b-form-radio name="for" v-model="form.for" value="group" @input="form.for_logic = null">Groups</b-form-radio>
                <b-form-radio name="for" v-model="form.for" value="student" @input="form.for_logic = null">Students</b-form-radio>
                <b-form-select v-model="form.for_logic" :options="(form.for==='group'?groupLogicOptions:studentLogicOptions)"></b-form-select>
            </b-form-group>

            <active-range
                @startDateUpdated="updateStartDate"
                @endDateUpdated="updateEndDate"
            >

            </active-range>

<!--            <module-list-->
<!--            :logic="(form.for==='group'?groupLogicOptions:studentLogicOptions)"-->
<!--            ></module-list>-->

            <b-button type="submit" variant="primary">Submit</b-button>
        </b-form>
    </div>

</template>

<script>

    import ActiveRange from "./ActiveRange";
    import ModuleList from "./module/ModuleList";

    export default {
        name: "Create.vue",

        props: {
            grouplogic: {
                required: true,
                type: Array
            },
            studentlogic: {
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
                    for_logic: null,
                    start_date: null,
                    end_date: null
                }
            }
        },

        methods: {
            onSubmit() {
                this.$http.post('/admin/settings/events', this.form)
                    .then(response => {
                        this.$notify.success('Event created!');
                        location.reload();
                    })
                    .catch(error => this.$notify.alert('There was an error: '+error.message));
            },

            updateStartDate(date) {
                this.form.start_date = date;
            },

            updateEndDate(date) {
                this.form.end_date = date;
            },
        },

        computed: {
            groupLogicOptions() {
                return this.grouplogic.map(logic => {
                    return { value: logic.id, text: logic.name }
                })
            },

            studentLogicOptions() {
                return this.studentlogic.map(logic => {
                    return { value: logic.id, text: logic.name }
                })
            }
        },

        components: {
            ActiveRange
        }
    }
</script>

<style scoped>

</style>