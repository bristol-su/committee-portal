<template>
    <div style="padding: 10px;">
        <h2 style="text-align: center;">Document Upload</h2>

        <form @submit.prevent="upload">
            <div class="form-group row">
                <label class="col-4 col-form-label">Group</label>
                <div class="col-8">
                    {{document.group.name}}
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-4 col-form-label">Document Title</label>
                <div class="col-8">
                    <input id="title" name="title" type="text" class="form-control" v-model="title">
                </div>
            </div>
            <div class="form-group row">
                <label for="file" class="col-4 col-form-label">File</label>
                <div class="col-8">
                    <input type="file" id="file" name="file" class="form-control" ref="document" @change="selectFile">
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: {
            document: {
                required: true,
                type: Object
            },
        },

        data() {
            return {
                title: '',
                file: null
            }
        },

        methods: {
            selectFile() {
                this.file = this.$refs.document.files[0];
            },

            upload() {
                let formData = new FormData();
                formData.append('document', this.file);
                formData.append('title', this.title);

                this.$http.post('/admin/exitingtreasurer/upload/'+this.document.id,formData)
                    .then(response => {
                        this.$notify.success('Document uploaded!');
                        this.$emit('documentUploaded', response.data);
                        this.$emit('close');
                    })
                    .catch(error => this.$notify.alert('Document not uploaded: '+error.message));
            }
        },

        created() {
            this.title = this.document.title;
        }
    }
</script>

<style>

</style>