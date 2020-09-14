<template>
    <div class="listNotes">
        <ul>
            <li v-for="(row, index) in notes" :key="index">
                <button class="btn-note" @click="editNote(row.id)">
                    <label>{{ row.title }}</label>
                    <span>{{ row.description }}</span>
                </button>
            </li>
        </ul>
    </div>
</template>

<script type="text/javascript">
    export default {
        name: 'listNotes',
        props: {
            propEditNote: {
                type: Function
            }
        },
        data: function () {
            return {
                notes: [
                    { id: 1, title: 'Test', description: 'Ini cuma percobaan hahaha' },
                    { id: 2, title: 'Bambang', description: 'Ini cuma percobaan bambang' }
                ]
            }
        },
        methods: {
            editNote(id) {
                let dataForm = this.notes.find(note => note.id === id);

                this.$root.$emit('emitForm', dataForm);
            },
        },
        mounted() {
            this.$root.$on("emitRemoveNote", data => {
                let noteIndex = this.notes.findIndex(note => note.id === data.id);
                this.notes.splice(noteIndex, 1);

            })
        },
    }
</script>

<style>
    ul {
        list-style-type: none;
        padding: 0;
        margin: 0px;
    }

    .btn-note {
        text-align: left;
        border: none;
        border-bottom: 1px solid gainsboro;
        padding: 0px 15px;
        cursor: pointer;
        outline: none;
        background: #f7f7f7;
        height: 150px;
        width: 100%;
    }

    .btn-note:hover {
        background: #eaeaea;
    }

    .btn-note label {
        display: block;
        color: #444444;
        font-size: 1.5em;
        margin-bottom: 15px;
    }

    .btn-note span {
        color: #545454;
    }
</style>