<template>
    <div>
            <b-form-group
                description="Name"
                id="name-group"
                label="Name:"
                label-for="name"
            >
                <b-form-input
                    id="name"
                    required
                    type="text"
                    v-model="name"
                ></b-form-input>
            </b-form-group>


            <b-form-group
                description="A description"
                id="description-group"
                label="Description:"
                label-for="description"
            >
                <b-form-input
                    id="description"
                    required
                    type="text"
                    v-model="description"
                ></b-form-input>
            </b-form-group>

            <b-button @click="createNewActivityInstance">Create new run through</b-button>
    </div>
</template>

<script>
    import Url from 'domurl';

    export default {
        name: "NewActivityInstance",

        props: {
            activityId: {
                required: true,
                type: Number
            },
            resourceType: {
                required: true,
                type: String
            },
            resourceId: {
                required: true,
                type: Number
            }
        },

        data() {
            return {
                name: '',
                description: ''
            }
        },

        methods: {
            createNewActivityInstance() {
                this.$api.activityInstance().create({
                    name: this.name,
                    description: this.description,
                    activity_id: this.activityId,
                    resource_type: this.resourceType,
                    resource_id: this.resourceId
                })
                    .then(response => {
                        let u = new Url;
                        u.query.aiid = response.data.id;
                        window.location = u.toString();
                    })
                    .catch(error => this.$notify.alert('Sorry, something went wrong: ' + error.message));
            }
        },

        computed: {}
    }
</script>

<style scoped>

</style>
