<template>
    <div>
        <table class="table table-striped table-responsive" v-if="files.length > 0">
            <thead>
            <tr>
                <th>Title</th>
                <th>Filename</th>
                <th>Size</th>
                <th>Year</th>
                <th>Uploaded By</th>
                <th>Uploaded</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody v-for="(file, index) in sortedFiles">

            <!-- Currently uploading file -->
            <tr v-if="!(isSaved(file))">
                <th>{{ uploadingDocumentTitle }}</th>
                <th>{{file.name}}</th>
                <th>{{file.size | bytesToHuman}}</th>
                <th>{{ currentReaffiliationYear | reaffiliation_year}}</th>
                <th colspan="2">
                    <button @click="$emit('upload', index)" class="btn btn-outline-info" style="width: 100%;">
                        Upload
                    </button>
                </th>
                <th v-if="isUploading(index)"><i class="fa fa-spinner fa-spin"></i> Uploading</th>
                <th v-else>Please confirm upload</th>
            </tr>

            <!-- Previously uploaded files -->
            <tr v-else>
                <th>{{file.title}}</th>
                <th>{{file.filename}}</th>
                <th>{{file.size | bytesToHuman}}</th>
                <th>{{file.year | reaffiliation_year}}</th>
                <th>{{file.user | username }}</th>
                <th @click="toggleDate(index)" class="clickable">
                    <span v-if="fullDate.indexOf(index) === -1">
                        {{file.created_at | timeToHuman}}
                    </span>
                    <span v-else>
                        {{file.created_at | date_format}}
                    </span>
                </th>
                <th v-if="file.status === 'awaiting approval'"><i class="fa fa-hourglass"></i> Awaiting Approval</th>
                <th v-else-if="file.status === 'approved'"><i class="fa fa-check"></i> Approved</th>
                <th v-else-if="file.status === 'rejected'"><i class="fa fa-times"></i> Rejected</th>
                <th v-else><i class="fa fa-exclamation-triangle"></i> Error</th>

                <th>
                    <a :href="downloadUrl(file.id)">Download</a>&nbsp;|&nbsp;
                    <!--// TODO Preview File-->
                    <a @click="showNotes(index)" href="#">Notes ({{getNoteCount(file.id)}})</a>

                    <modal
                            height="auto"
                            :name="'notes-file-upload-form-' + index"
                    >
                        <notes
                                :file="file"
                                :module="module"
                                @close="hideNotes(index)"
                                @newnote="newNoteAdded"
                                :notes="notes"
                        >
                        </notes>
                    </modal>

                </th>
            </tr>


            </tbody>
        </table>
    </div>
</template>

<script>
    // TODO Should this component utilise tooltips instead of clicks for the date?
    import moment from 'moment';
    import Notes from './Notes';

    export default {
        props: {
            files: {
                required: true,
                default: function () {
                    return [];
                },
                type: Array
            },

            uploadingDocumentTitle: {
                required: true,
                default: '',
                type: String
            },

            uploading: {
                required: true,
                default: function () {
                    return [];
                },
                type: Array
            },

            module: {
                required: true,
                default: '',
                type: String
            }

        },

        data() {
            return {
                fullDate: [],
                currentReaffiliationYear: parseInt(process.env.MIX_REAFFILIATION_YEAR),
                notes: []
            }
        },

        methods: {

            toggleDate(fileIndex) {
                let index = this.fullDate.indexOf(fileIndex);
                if (index === -1) {
                    this.fullDate.push(fileIndex);
                } else {
                    this.fullDate.splice(index, 1)
                }
            },

            isSaved(file) {
                return !(file instanceof File);
            },

            isUploading(fileIndex) {
                return this.uploading.indexOf(fileIndex) !== -1;
            },

            downloadUrl(id) {
                return '/' + this.module + '/download-files/' + id;
            },

            showNotes(fileIndex) {
                this.$modal.show('notes-file-upload-form-' + fileIndex);
            },

            hideNotes(fileIndex) {
                this.$modal.hide('notes-file-upload-form-' + fileIndex);
            },

            newNoteAdded(note) {
                this.notes.push(note);
            },

            getNoteCount(id) {
                return this.notes.filter(note => note.file_id === id).length;
            }
        },

        filters: {
            bytesToHuman(bytes) {
                let i = bytes === 0 ? 0 : Math.floor(Math.log(bytes) / Math.log(1024));
                return (bytes / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
            },

            timeToHuman(time) {
                return moment(time).fromNow();
            },

            date_format(time) {
                return moment(time).format('lll');
            },

            reaffiliation_year(year) {
                return year.toString() + '/' + (year + 1).toString().slice(2);
            },

            username(user) {
                return user.forename + ' ' + user.surname;
            },

        },

        computed: {
            sortedFiles() {
                let self = this;
                return this.files.sort(function (a, b) {
                    // Ensure the file is before the non file
                    if (!(self.isSaved(a)) && self.isSaved(b)) {
                        return -1
                    }
                    if (self.isSaved(a) && !(self.isSaved(b))) {
                        return 1
                    }

                    // Order by filename for File or time for uploaded files since they are of the same type
                    let asort = (!(self.isSaved(a)) ? parseInt(a.name.charAt(0), 36) - 9 : moment(a.created_at).unix());
                    let bsort = (!(self.isSaved(b)) ? parseInt(b.name.charAt(0), 36) - 9 : moment(b.created_at).unix());
                    return (bsort - asort);
                });
            },
        },

        components: {
            Notes,
        },

        created() {
            this.$http.get('/' + this.module + '/get-notes')
                .then(response => {
                    this.notes = response.data;
                })
                .catch(error => {
                    this.errors.record(error);
                })
        }

    }

</script>

<style>
    table {
        margin: auto;
    }

    .clickable {
        cursor: pointer;
    }

</style>