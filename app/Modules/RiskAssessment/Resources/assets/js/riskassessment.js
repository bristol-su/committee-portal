new Vue({
    el: '#riskassessment-root',


    components: {
        'upload-file': CustomFileUpload,
        'admin-file-table': CustomFileUploadAdminFileTable,
        'admin-note-template': CustomFileUploadAdminNoteTemplate
    },
});