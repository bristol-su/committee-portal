<template>
    <div>
        <div v-if="completed">
            You have submitted your equipment list for this year, but we encourage you to keep this list updated
            throughout the year.
        </div>
        <br/>
        <button @click="newEquipment" class="btn btn-info">
            Add Equipment
        </button>
        <button @click="completeEquipmentList" class="btn btn-info">
            Finalise Equipment List
        </button>


        <table class="table table-hover table-striped" v-if="equipment_list.length > 0">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Date Bought</th>
                <th>Notes</th>
                <th></th>
            </tr>
            </thead>

            <tbody v-for="category in categories">
            <tr>
                <td class="category" colspan="6">
                    {{category}}
                </td>
            </tr>
            <tr v-for="equipment in equipmentByCategory(category)">
                <td>{{equipment.name}}</td>
                <td>{{equipment.description}}</td>
                <td>£{{equipment.price}}</td>
                <td>{{equipment.bought_at}}</td>
                <td>{{equipment.notes}}</td>
                <td>
                    <button @click="deleteEquipment(equipment)" class="btn btn-sm btn-danger">
                        Delete
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

        <modal
                height="auto"
                name="equipmentlist-form-modal"
        >
            <equipment-list-form
                    :categories="categories"
                    @close="closeNewEquipment"
                    @newEquipment="saveNewEquipment">

            </equipment-list-form>
        </modal>
    </div>
</template>

<script>
    import EquipmentListForm from "./EquipmentListForm";

    export default {
        components: {EquipmentListForm},
        data() {
            return {
                equipment_list: [],
                completed: false,
            }
        },

        created() {
            this.$http.get('/equipmentlist/complete')
                .then(response => {
                    this.completed = true;
                    this.equipment_list = response.data;
                })
                .catch(error => {
                    this.completed = false;
                    this.equipment_list = error.response.data;
                })
        },

        methods: {
            newEquipment() {
                this.$modal.show('equipmentlist-form-modal')
            },

            saveNewEquipment(equipment) {
                this.equipment_list.push(equipment);
            },

            closeNewEquipment() {
                this.$modal.hide('equipmentlist-form-modal');
            },

            deleteEquipment(equipment) {
                let deleted_reason = prompt('Please give us a reason for deleting this equipment. This could be because it\'s broken, has been lost etc.');
                this.$http.delete('/equipmentlist/equipment/' + equipment.id, {
                    params: {
                        deleted_reason: deleted_reason
                    }
                })
                    .then(response => {
                        this.$notify.success('Equipment "' + equipment.name + "' deleted!");
                        this.equipment_list.splice(this.equipment_list.indexOf(equipment), 1);
                    })
                    .catch(error => this.$notify.alert('Equipment couldn\'t be deleted: ' + error.message));
            },

            equipmentByCategory(category) {
                return this.equipment_list.filter(equipment => equipment.category === category);
            },

            completeEquipmentList() {
                this.$http.post('/equipmentlist/submit')
                    .then(response => {
                        this.$notify.success('Your equipment list has been finalised and submitted to us.');
                        this.completed = true;
                    })
                    .catch(error => this.$notify.alert('Your equipment list could not be finalised or submitted'));
            }
        },

        computed: {
            categories() {
                let categories = [];
                this.equipment_list.filter(equipment => {
                    if (categories.indexOf(equipment.category) === -1) {
                        categories.push(equipment.category);
                    }
                });
                return categories;
            }
        }
    }
</script>

<style scoped>

    td.category {
        font-weight: bolder;
        font-size: 1.3em;
    }
</style>