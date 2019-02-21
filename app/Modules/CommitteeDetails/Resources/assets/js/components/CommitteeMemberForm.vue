<template>
    <modal v-if="visible">

        Hi
    </modal>
</template>

<script>

    import Modal from './../../../../../../../resources/js/components/Modal';

    export default {
        data() {
            return {
                visible: false
            }
        },

        created() {
            CommitteeDetailsEvent.$on('committeedetails-add-new-committee-member', (data) => {
                console.log('New Committee Member');
                console.log(data);
                this.visible = true;
            });

            CommitteeDetailsEvent.$on('committeedetails-edit-committee-member', (data) => {
                console.log('Edit Committee Member');
                console.log(data);
                this.visible = true;
            });
        },

        components: {
            'modal': Modal
        }




    }
</script>

<style>

</style>