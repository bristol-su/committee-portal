<template>
    <div>
        <!--Images-->
        <div class="row">
            <div :class="{deselected: selectedTier !== tier, selected: selectedTier === tier}" @click="selectTier(tier)"
                 class="column tier-holder"
                 v-for="tier in tiers">
                <img :alt="tier.name" :src="tier.filename | static" style="width:100%">
                <!--<div style="text-align: center; font-weight: bold; font-size: 30px;">{{tier.name}}</div>-->
            </div>
        </div>

        <!-- Shows when tiers are loading -->
        <div style="text-align: center;" v-if="tiers.length === 0">
            <h4>Loading tiers...</h4>
        </div>

        <!--Submit button-->
        <div class="row">
            <div class="column" style="display: flex; align-items: center; justify-content: center;">
                <button :class="{'btn-danger': selectedTier === null, 'btn-success': selectedTier !== null}"
                        @click="submitTier"
                        class="btn"
                        style="width: 50%;">{{ buttonText }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {


            // Holds the current submissions
            submissions: {
                default: [],
                type: Array
            }
        },

        data() {
            return {
                tiers: [],
                selectedTier: null,
            }
        },

        created() {
            this.$http.get('/tierselection/api/tiers')
                .then(response => {
                    this.tiers = response.data;
                    if (this.hasBeenSubmitted) {
                        this.selectedTier = this.tiers.filter(tiers => this.submissions[0].tier_id === tiers.id)[0];
                    }
                })
                .catch(error => this.$notify.alert('Sorry, something went wrong.'))
        },

        methods: {
            selectTier(tier) {
                this.selectedTier = (this.selectedTier === tier ? null : tier);
            },

            submitTier() {
                this.$http.post('/tierselection', {
                    tier_id: this.selectedTier.id
                })
                    .then(response => {
                        this.$notify.success('You have been entered into the "' + this.selectedTier.name + '" tier.');
                        this.submissions.push(this.selectedTier);
                    })
                    .catch(error => {
                        this.$notify.alert('Sorry, something went wrong.');
                    })
            },

            loadSubmissions() {

            }
        },

        computed: {
            buttonText() {
                return (this.selectedTier === null
                    ? 'Select'
                    : (this.hasBeenSubmitted && this.submissions.filter(submission => submission.id === this.selectedTier.id).length === 1
                    ? 'Entered in Tier '
                    : 'Enter in Tier ') + this.selectedTier.name);
            },

            hasBeenSubmitted() {
                return this.submissions.length !== 0;
            }
        },

        filters: {
            static(filename) {
                return window.serveStaticContent(filename);
            }
        }
    }
</script>

<style>
    /* Row and column were found online to give three tiers side by side */
    .row {
        display: flex;
    }

    .column {
        flex: 33.33%;
        padding: 5px;
    }

    /* deselected is applied to deselected tiers, applied to applied tiers */
    .deselected {
        border: 3px solid #f8fafc;
    }

    .selected {
        border: 5px solid red;
    }

    .tier-holder:hover.deselected {
        border: 3px solid red;
    }

</style>