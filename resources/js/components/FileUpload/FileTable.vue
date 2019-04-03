<template>
    <div>
        <table class="table table-striped table-responsive table-condensed table-hover" v-if="files.length > 0">
            <thead>
            <tr>
                <th>Title</th>
                <th>Filename</th>
                <th>Size</th>
                <th>Year</th>
                <th>Uploaded By</th>
                <th>Uploaded</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody v-for="(file, index) in sortedFiles">

            <!-- Currently uploading file -->
            <tr v-if="!(isSaved(file))">
                <td>{{ uploadingDocumentTitle }}</td>
                <td>{{file.name}}</td>
                <td>{{file.size | bytesToHuman}}</td>
                <td>{{ currentReaffiliationYear | reaffiliation_year}}</td>
                <td colspan="2" style="color: #E9304A;">
                    Awaiting Confirmation
<!--                    <button @click="$emit('upload', index)" class="btn btn-outline-info" style="width: 100%;">-->
<!--                        Upload-->
<!--                    </button>-->
                </td>
                <td v-if="isUploading(index)"><i class="fa fa-spinner fa-spin"></i> Uploading</td>
                <td v-else></td>
            </tr>

            <!-- Previously uploaded files -->
            <tr v-else>
                <td>{{file.title}}</td>
                <td>{{file.filename}}</td>
                <td>{{file.size | bytesToHuman}}</td>
                <td>{{file.year | reaffiliation_year}}</td>
                <td>{{file.user | username }}</td>
                <td @click="toggleDate(index)" class="clickable">
                    <span v-if="fullDate.indexOf(index) === -1">
                        {{file.created_at | timeToHuman}}
                    </span>
                    <span v-else>
                        {{file.created_at | date_format}}
                    </span>
                </td>
                <td v-if="file.status === 'awaiting approval'"><i class="fa fa-hourglass"></i> Awaiting Approval</td>
                <td v-else-if="file.status === 'approved'"><i class="fa fa-check"></i> Approved</td>
                <td v-else-if="file.status === 'rejected'"><i class="fa fa-times"></i> Rejected</td>
                <td v-else><i class="fa fa-exclamation-triangle"></i> Error</td>

                <td>
                    <a :href="downloadUrl(file.id)">Download</a>&nbsp;|&nbsp;
                    <!--// TODO Preview File-->
                    <a @click="showNotes(index)" href="#">Notes ({{file.notes.length}})</a>

                    <modal
                            height="auto"
                            :name="'notes-file-upload-form-' + index"
                    >
                        <notes
                                :file="file"
                                :module="module"
                                @close="hideNotes(index)"
                                @updatedfile="fileUpdated"
                        >
                        </notes>
                    </modal>

                </td>
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

            fileUpdated(file) {
                this.$emit('updatedfile', file);
            },

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