<template>
    <div>
        <button @click="$modal.show('statement')" class="btn btn-info btn-lg">
            Read Statement
        </button>

        <modal
                height="auto"
                name="statement">
            <div style="padding: 20px;">
                <p>I agree not to involve my student group in any defamatory or libellous activity or to break copyright law.</p>

                <p>Defamation is any intentional false communication, either written or spoken, that harms a person’s
                reputation, decreases the respect, regard, or confidence in which a person is held, or induces disparaging,
                hostile, or disagreeable opinions or feelings against a person. Defamation in written or image form is known
                    as libel.</p>

                <p>For any photographs and pictures used in your publications, make sure that all licences and consents are
                    obtained from copyright holders prior to publication and creators of the work are credited.</p>

                <div style="text-align: center">
                    <button class="btn btn-outline-info" style="margin: auto;" @click="$modal.hide('statement')">Close</button>
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