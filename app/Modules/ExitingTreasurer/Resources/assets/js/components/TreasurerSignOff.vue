<template>
    <div class="container">


        <div class="row">
            <div class="col-md-12">
                <tabs
                        :content="tabsLayout"
                        default="reports">

                    <template v-slot:reports>
                        <div v-if="hasReports">
                            <reports
                                    :reports="yearReports()">
                            </reports>
                        </div>
                        <div v-else>
                            The financial reports could not be found. This could be because your new treasurer has not
                            completed the training, or we could be in the process of generating and uploading them.
                        </div>
                    </template>
                    <template v-slot:allreports>
                        <div v-if="hasOldReports">
                            <reports
                                    :reports="reports">
                            </reports>
                        </div>
                        <div v-else>
                            No reports from previous years were found
                        </div>
                    </template>
                    <template v-slot:oldsubmissions>
                        <div v-if="hasOldSubmissions">
                            <submissions
                                    :submissions="completeSubmissions">
                            </submissions>
                        </div>
                        <div v-else>
                            No previous sign-off's found
                        </div>
                    </template>

                </tabs>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12" v-if="!hasSubmitted">
                <button @click="showSubmissionForm" class="btn btn-info" v-if="hasReports">
                    {{(hasCurrentSubmission?'Continue Sign-Off':'Start Sign-Off')}}
                </button>
            </div>
            <span style="padding-top: 50px;" v-else>
                <h3 style=" border: 2px solid #FF6E11; border-radius: 1em; padding: 5px;">You have completed a sign-off this year. Head to "Previous Sign-Off's" to see what you said.</h3>
            </span>
        </div>
        <div class="row">
            <div class="col-md-12">
                <modal
                        @before-close=""
                        height="70%"
                        name="sign-off-form-modal"
                        width="70%"
                >
                    <sign-off-form
                            :current-submission="currentSubmission"
                            @close="hideSubmissionForm"
                            @newSubmission="newSubmission"
                    >

                    </sign-off-form>
                </modal>
            </div>
        </div>

    </div>
</template>

<script>

    import Submissions from './ViewSubmissions/Submissions';
    import SignOffForm from './SignOff/SignOffForm';
    import Tabs from './../../../../../../../resources/js/components/Tabs';
    import Reports from "./SignOff/Reports";

    export default {
        components: {
            Reports,
            SignOffForm,
            Submissions,
            Tabs,
        },

        data() {
            return {
                submissions: [],
                reports: [],
                showForm: false,
                tabsLayout: [
                    {
                        id: 'reports',
                        name: 'Reports',
                        disabled: false
                    },
                    {
                        id: 'allreports',
                        name: 'All Reports',
                        disabled: false
                    },
                    {
                        id: 'oldsubmissions',
                        name: 'Previous Sign Off\'s',
                        disabled: false
                    }
                ]
            }
        },

        created() {
            this.$http.get('/exitingtreasurer/submissions')
                .then(response => {
                    this.submissions = response.data;
                })
                .catch(error => this.$notify.alert('Could not load previous submissions'));
            this.$http.get('/exitingtreasurer/documents')
                .then(response => this.reports = response.data)
                .catch(error => this.$notify.alert('Could not load your reports'));
        },

        methods: {
            newSubmission(data) {
                let index = null;
                this.submissions.filter((submission, submissionIndex) => {
                    if (submission.id === data.id) {
                        index = submissionIndex;
                    }
                });
                if (index === null) {
                    this.submissions.push(data);
                } else {
                    this.submissions.splice(index, 1, data);
                }
            },

            yearReports() {
                return this.reports.filter(report => {
                    return report.year === parseInt(process.env.MIX_REAFFILIATION_YEAR);
                })
            },

            yearSubmissions() {
                return this.submissions.filter(submission => {
                    return submission.year === parseInt(process.env.MIX_REAFFILIATION_YEAR);
                })
            },

            showSubmissionForm() {
                this.$modal.show('sign-off-form-modal');
            },

            hideSubmissionForm() {
                this.$modal.hide('sign-off-form-modal')
            },
        },

        computed: {
            // Has a half finished submission
            hasCurrentSubmission() {
                return this.yearSubmissions().filter(submission => {
                    return submission.complete === false;
                }).length > 0;
            },

            completeSubmissions() {
                return this.submissions.filter(submission => {
                    return submission.complete === true;
                });
            },

            // Has submitted a submission already
            hasSubmitted() {
                return this.yearSubmissions().filter(submission => {
                    return submission.complete === true;
                }).length > 0;
            },

            // At least one submission
            hasOldSubmissions() {
                return this.submissions.filter(submission => {
                    return submission.complete === true;
                }).length > 0;
            },

            // Has the reports needed to sign off
            hasReports() {
                return this.yearReports().length > 1;
            },

            // Any reports were found
            hasOldReports() {
                return this.reports.length > 0;
            },

            currentSubmission() {
                if (this.hasCurrentSubmission) {
                    return this.yearSubmissions().filter(submission => {
                        return submission.complete === false;
                    })[0];
                }
                return null;
            }
        },

    }
</script>

<style>

</style>