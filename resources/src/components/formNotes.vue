<template>
    <div class="formNotes">
        <form>
            <div class="menu">
                <button @click="submitRemove" type="button" class="bg-danger btn btn-delete">Delete</button>
                <button @click="submitSave" type="button" class="bg-success btn" v-if="mode == 'save'">Save</button>
                <button @click="submitUpdate" type="button" class="bg-success btn"
                    v-if="mode == 'update'">Update</button>
            </div>

            <div class="content">
                <input type="text" class="text" placeholder="Id" v-model="id">
                <input type="text" class="text" placeholder="Title" v-model="title">
                <textarea class="text textarea" placeholder="Describe your plan..." v-model="description"></textarea>
            </div>
        </form>
    </div>
</template>

<script type="text/javascript">

    import axios from 'axios';

    export default {
        name: 'formNotes',
        data: function () {
            return {
                id: 0,
                title: '',
                description: '',
                mode: 'save'
            }
        },
        methods: {
            submitSave() {
                let params = new URLSearchParams;
                params.append('title', this.title);
                params.append('description', this.description);

                axios.post("http://note.mrifki.my.id/note/create", params)
                    .then(res => {
                        let data = {
                            id: res.data.id,
                            title: this.title,
                            description: this.description,
                        }
                        this.$root.$emit('emitSaveNote', data);
                        if (res.data.status === true) {
                            alert(res.data.pesan);
                        }
                    })

            },
            submitUpdate() {
                let params = new URLSearchParams;
                params.append('id', this.id);
                params.append('title', this.title);
                params.append('description', this.description);

                axios.post("http://note.mrifki.my.id/note/update", params)
                    .then(res => {
                        let data = {
                            id: res.data.id,
                            title: this.title,
                            description: this.description,
                        }
                        this.$root.$emit('emitUpdateNote', data);
                        if (res.data.status === true) {
                            alert(res.data.pesan);
                        }
                    })
            },
            submitRemove() {
                let params = new URLSearchParams;
                params.append('id', this.id);

                axios.post("http://note.mrifki.my.id/note/delete", params)
                    .then(res => {
                        let data = {
                            id: res.data.id,
                        }
                        this.$root.$emit('emitRemoveNote', data);
                        if (res.data.status === true) {
                            alert(res.data.pesan);
                        }
                        this.resetInput();
                    })
            },
            resetInput() {
                this.id = 0;
                this.title = '';
                this.description = '';
                this.mode = 'save';
            }
        },
        mounted() {
            this.$root.$on('emitForm', data => {
                this.id = data.id;
                this.title = data.title;
                this.description = data.description;
                this.mode = data.mode;
            })
        },

    }
</script>

<style>
    .menu {
        background: #f7f7f7;
        padding: 10px 25px;
        margin-bottom: 25px;
        text-align: right;
        border-bottom: 1px solid #e8e6e6;
    }

    .btn-delete {
        margin-right: 10px;
    }

    .content {
        padding: 0px 25px;
    }

    .text {
        display: block;
        width: 100%;
        padding: 0px;
        font-weight: bold;
        font-size: 20px;
        color: #2c3e50;
        border: none;
        margin-bottom: 10px;
        box-sizing: border-box;
        outline: none;
    }

    .textarea {
        min-height: 350px;
        font-size: 15px;
        font-weight: lighter;
        line-height: 30px;
        font-weight: normal;
    }

    .loader {
        vertical-align: middle;
    }
</style>