<template>
    <div style="text-align: left;">

        <b-form-group
            description="A name for the logic"
            id="name-group"
            label="Name:"
            label-for="name"
        >
            <b-form-input
                id="name"
                required
                type="text"
                v-model="form.name"
            ></b-form-input>
        </b-form-group>


        <b-form-group
            description="A description for the activity"
            id="description-group"
            label="Description:"
            label-for="description"
        >
            <b-form-input
                id="description"
                required
                type="text"
                v-model="form.description"
            ></b-form-input>
        </b-form-group>

        <b-form-group label="Filters">
            <filter-group title="All True" v-model="form.all_true" >

            </filter-group>

            <filter-group title="All False" v-model="form.all_false">

            </filter-group>

            <filter-group title="Any Must Be True" v-model="form.any_true">

            </filter-group>

            <filter-group title="Any Must Be False" v-model="form.any_false">

            </filter-group>
        </b-form-group>

        <b-button variant="secondary" @click="create">Create Logic</b-button>
    </div>
</template>

<script>
    import FilterGroup from "./filter/FilterGroup";

    export default {
        name: "Create",
        components: {FilterGroup},
        data() {
            return {
                form: {
                    name: '',
                    description: '',
                    all_true: [],
                    all_false: [],
                    any_true: [],
                    any_false: []
                }
            }
        },

        methods: {
            create() {
                this.$api.logic().create(this.form)
                    .then(response => {
                        this.$notify.success('Logic ' + this.form.name + ' created!');
                        window.setTimeout(() => {window.location.href = '/logic/' + response.data.id}, 3000);
                    })
                    .catch(error => this.$notify.alert('Logic could not be created: ' + error.message))
            }
        }
    }
</script>

<style scoped>

</style>
