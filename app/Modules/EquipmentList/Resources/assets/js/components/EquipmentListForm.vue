<template>
    <div>
        <div class="form-horizontal">
            <div class="card text-black bg-white mb-0">

                <div class="card-header">
                    <h4 class="m-0">Add a new piece of equipment for your group</h4>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <div>
                            <label for="name">
                                <small>Equipment Name</small>
                            </label>
                            <input class="form-control" id="name" type="text" v-model="form.name">
                        </div>
                        <small><span class="has-error-span"
                                     v-show="form.errors.has('name')">{{form.errors.get('name')}}</span></small>
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="description">
                                <small>Equipment Description</small>
                            </label>
                            <textarea class="form-control" id="description" v-model="form.description">
                            </textarea>
                        </div>
                        <small><span class="has-error-span" v-show="form.errors.has('description')">{{form.errors.get('description')}}</span>
                        </small>
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="category">
                                <small>Equipment Category (Type to create a new category)</small>
                            </label>

                            <v-select
                            :options="categories"
                            :taggable="true"
                            v-model="form.category"
                            >
                                <span slot="no-options">Start typing to create a new category.</span>

                            </v-select>


                        </div>
                        <small><span class="has-error-span" v-show="form.errors.has('category')">{{form.errors.get('category')}}</span>
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="price">
                            <small>Price at purchase</small>
                        </label>
                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text">£</span>
                            </div>
                            <input class="form-control" id="price" type="text" v-model="form.price">
                        </div>
                        <div>
                            <small><span class="has-error-span" v-show="form.errors.has('price')">{{form.errors.get('price')}}</span>
                            </small>
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="notes">
                                <small>Notes (i.e. location, condition, other information)</small>
                            </label>
                            <textarea class="form-control" id="notes" v-model="form.notes">
                            </textarea>
                        </div>
                        <small><span class="has-error-span"
                                     v-show="form.errors.has('notes')">{{form.errors.get('notes')}}</span>
                        </small>
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="bought_at">
                                <small>Date bought</small>
                            </label>
                            <input class="form-control" id="bought_at" type="date" v-model="form.bought_at">
                        </div>
                        <small><span class="has-error-span" v-show="form.errors.has('bought_at')">{{form.errors.get('bought_at')}}</span>
                        </small>
                    </div>


                    <br/><br/>
                    <button :disabled="submitting" @click="saveEquipment"
                            class="btn btn-info btn-lg" type="submit">
                        Save Equipment
                    </button>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import vSelect from 'vue-select';

    export default {

        props: {
            categories: {
                required: false,
                default: []
            }
        },

        data() {
            return {
                form: new VueForm({
                    name: '',
                    description: '',
                    category: null,
                    price: '',
                    notes: '',
                    bought_at: null
                }),
                submitting: false,
            }
        },

        methods: {
            saveEquipment() {
                this.submitting = true;
                this.form.post('/equipmentlist/equipment')
                    .then(response => {
                        this.$notify.success('Equipment Saved');
                        this.$emit('newEquipment', response);
                        this.$emit('close')
                    })
                    .catch(error => {
                        this.$notify.alert('Could not save the equipment: ' + error.message);
                        this.form.errors.record(error.response.data.errors);
                    })
                    .then(() => this.submitting = false);
            }
        },

        components: {
            vSelect
        }
    }
</script>

<style>

</style>