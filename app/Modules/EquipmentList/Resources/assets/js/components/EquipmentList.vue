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


        <table v-if="equipment_list.length > 0" class="table table-hover table-striped">
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
                <td colspan="6" class="category">
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
                    @close="closeNewEquipment"
                    :categories="categories"
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
                alert('deleting equipment ' + equipment.id);
            },

            equipmentByCategory(category) {
                return this.equipment_list.filter(equipment => equipment.category === category);
            }
        },

        computed: {
            categories() {
                let categories = [];
                this.equipment_list.filter(equipment => {
                    if(categories.indexOf(equipment.category) === -1) {
                        categories.push(equipment.category);
                    }
                });
                console.log(categories);
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