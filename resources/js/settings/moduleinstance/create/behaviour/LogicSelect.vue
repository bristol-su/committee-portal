<template>
    <div>
        <b-form-select @input="$emit('input', $event)" :value="value" :options="options" class="mb-3">
            <!-- This slot appears above the options from 'options' prop -->
            <template slot="first">
                <option :value="null" disabled>-- Please select an option --</option>
            </template>
        </b-form-select>
    </div>
</template>

<script>
    export default {
        name: "LogicSelect",

        props: {
            value: {
                required: false,
                default: null
            },
            forLogic: {
                required: true,
                type: String
            }
        },

        data() {
            return {
                logic: [],
                loading: true
            }
        },

        created() {
            this.loadLogic();
        },

        methods: {
            loadLogic() {
                this.loading = true;
                this.$api.logic().all()
                    .then(response => this.logic = response.data)
                    .catch(error => this.$notify.alert('There was a problem getting the logic: ' + error.message))
                    .then(() => this.loading = false);
            }
        },

        computed: {
            options() {
                return this.logic.filter(logic => {
                    return ((this.forLogic === 'group' && logic.for !== 'role')
                        || (this.forLogic === 'user' && logic.for === 'user'));
                }).map(logic => {
                        return {
                            text: logic.name,
                            value: logic.id
                        }
                });
            }
        }
    }
</script>

<style scoped>

</style>
