<template>
    <div>
        <!--Images-->
        <div class="row">
            <div :class="{deselected: selectedTier !== tier, selected: selectedTier === tier}" @click="selectTier(tier)" class="column tier-holder"
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
                <button :class="{'btn-danger': selectedTier === null, 'btn-success': selectedTier !== null}" :disabled="selectedTier === null || completed"
                        @click="submitTier"
                        style="width: 50%;"
                        class="btn">{{ buttonText }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {

            // Determines if the user may create a submission
            completed: {
                default: false
            },

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
                disableButton: false
            }
        },

        created() {
            this.$http.get('/tierselection/api/tiers')
                .then(response => {
                    this.tiers = response.data;
                    if(!this.canBeSubmitted) {
                        this.selectedTier = this.tiers.filter(tiers => this.submissions[0].tier_id === tiers.id)[0];
                    }

                })
                .catch(error => this.$notify.alert('Sorry, something went wrong.'))
        },

        methods: {
            selectTier(tier) {
                if(this.canBeSubmitted) {
                    this.selectedTier = (this.selectedTier === tier ? null : tier);
                }
            },

            submitTier() {
                if(this.canBeSubmitted) {
                    this.disableButton = true;
                    this.$http.post('/tierselection', {
                        tier_id: this.selectedTier.id
                    })
                        .catch(error => {
                            this.$notify.alert('Sorry, something went wrong.');
                            window.location.reload();
                        })
                }
            }
        },

        computed: {
            buttonText() {
                return (this.selectedTier === null ? 'Select' : (this.canBeSubmitted ? 'Confirm tier ' : 'Entered in Tier ' ) + this.selectedTier.name);
            },

            canBeSubmitted() {
                return this.submissions.length === 0 && !this.disableButton;
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