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

        <b-form-group label="Who does this logic apply to?">
            <b-form-radio name="for" v-model="form.for" value="user">Users</b-form-radio>
            <b-form-radio name="for" v-model="form.for" value="group">Groups</b-form-radio>
            <b-form-radio name="for" v-model="form.for" value="role">Roles</b-form-radio>
        </b-form-group>

        <logic></logic>
    </div>
</template>

<script>
    import Logic from "./Logic";
    export default {
        name: "Create",
        components: {Logic},
        data() {
            return {
                form: {
                    name: '',
                    description: '',
                    for: null
                }
            }
        }
    }
</script>

<style scoped>

</style>
