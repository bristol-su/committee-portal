new Vue({
    el: '#constitution-root',


    components: {
        'upload-file': CustomFileUpload,
        'admin-file-table': CustomFileUploadAdminFileTable,
        'admin-note-template': CustomFileUploadAdminNoteTemplate
    },
});