<template>
    <div>
        <button @click="$modal.show('statement')" class="btn btn-outline-info btn-lg">
            Charitable Giving Guidance
        </button>

        <modal
                height="auto"
                name="statement">
            <div style="padding: 20px;">


                <ul>

                    <li>Neither the Students’ Union nor any of its affiliated student groups can make donations to
                        external organisations via Bristol SU’s bank accounts.Money raised by student groups for
                        external organisations should be paid via Bristol RAG.
                    </li>


                    <li>Student groups can fundraise:
                        <ul>
                            <li>Via Bristol RAG</li>
                            <li>Directly for an external organisation where the funds raised are given immediately to
                                the
                                organisation. For example, the use of a Just Giving page, bucket collection handed over
                                to a
                                charity partner at end of collection.
                            </li>
                            <li>For themselves, money raised for the purpose of supporting the group and its members can
                                be paid
                                directly into the student groups SU account.
                            </li>
                        </ul>
                    </li>


                    <li>Donations made to external organisation can not be claimed back as a group expense.</li>


                    <li>Membership to student groups cannot be used to fundraise for an external organisation.
                        Membership fees can only be used to support the running of your group and its members.
                    </li>


                    <li>Cash donations should:
                        <ul>
                            <li>Never be left unattended</li>
                            <li>Be counted by at least 2 members of your group</li>
                            <li>Paid in the same day (There are drop boxes at the Bristol SU reception - 3rd floor
                                Richmond
                                Building and the Estate Assistance reception - ground floor Richmond Building)
                            </li>
                        </ul>

                    </li>

                    <li>
                        Further guidance on fundraising can be found via the Fundraising Code of Practice and Charity
                        Act 2016 Fundraising Rules
                    </li>
                    <li>
                        Any complaints regarding a groups fundraising should be recorded and forwarded to Bristol SU
                        Finance Team Bristolsu-accounts@bristol.ac.uk

                    </li>

                </ul>

                <div style="text-align: center">
                    <button @click="$modal.hide('statement')" class="btn btn-outline-info" style="margin: auto;">Close
                    </button>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>
    export default {
        name: "Statement"
    }
</script>

<style scoped>

</style>