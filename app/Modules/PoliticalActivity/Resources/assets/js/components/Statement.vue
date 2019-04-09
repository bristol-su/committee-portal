<template>
    <div>
        <button @click="$modal.show('statement')" class="btn btn-info btn-lg">
            Read Statement
        </button>

        <modal
                height="auto"
                name="statement">
            <ol>
                <li>Bristol SU encourages students to develop their political awareness, acquire knowledge of and debate
                    political issues through the facilitation of student groups. This is done in a balanced manner and
                    without preference to one or more particular political parties over others.
                </li>

                <li>Neither the Students’ Union nor any of its affiliated student groups can make donations to external
                    organisations, this includes political parties.
                </li>

                <li>Funds within your Bristol SU bank account cannot be used directly to support the political party
                    your
                    group represents. E.g. printing literature to canvas general public, fund canvassing trips, etc
                </li>

                <li>Bristol SU will remain neutral and not support or oppose a particular political party, candidate or
                    politician.
                </li>
            </ol>

            <div style="text-align: center">
                <button @click="$modal.hide('statement')" class="btn btn-outline-info" style="margin: auto;">Close
                </button>
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