<template>
    <form action="#" class="form-horizontal">

        <div class="card text-black bg-white mb-0">

            <div class="card-header">
                <h4 class="m-0">Add a new committee member for your society. Anyone you add must have an account on our
                    <a href="https://www.bristolsu.org.uk">website!</a></h4>
            </div>

            <div class="card-body">

                <div class="form-group">

                    <div>
                        <small>Select the position of the student</small>
                    </div>

                    <!--<position-select-->
                        <!--v-model="positionId"-->

                    <!--&gt;</position-select>-->
                    <!--:positionSelected-->
                </div>



                <div class="form-group">

                    <div>
                        <small>Search by Email or Student ID</small>
                    </div>

                    <user-select
                        :initialUid="initialUid"
                    ></user-select>
                    <!--@studentSelected="updateUid"-->
                </div>


                <button @submit.prevent="alert('saving')" class="btn btn-info" type="button">Add
                    Committee Member
                </button>

            </div>
        </div>

    </form>
</template>

<script>

    import UserSearch from './../../../../../../../resources/js/components/unioncloud/UserSearch';
    import PositionSearch from './../../../../../../../resources/js/components/control/PositionSearch';

    export default {
        props: {
            initialUid: {
                'default': null
            },
            initialPositionId: {
                'default': null
            },
            initialPositionName: {
                'default': null
            }
        },

        created() {
            this.uid = this.initialUid;
            this.positionName = this.initialPositionName;
            this.positionId = this.initialPositionId;
        },

        methods: {
            updateUid(uid) {
                this.uid = uid;
            },

            updatePosition(position) {
                this.position_id = position.id;
                this.position_name = position.name;
            }
        },

        components: {
            'user-select': UserSearch,
            'position-select': PositionSearch
        },

        data() {
            return {
                uid: null,
                positionId: null,
                positionName: null
            }
        }
    }
</script>

<style>

</style>