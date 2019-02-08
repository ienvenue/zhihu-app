<template>
    <div>

        <button
                class="btn btn-success"
                @click="showSendMessageForm"
        >Message
        </button>
        <div class="modal fade" id="modal-send-message" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h4 class="modal-title" style="margin-left: 300px;">
                            SendMessage
                        </h4>
                    </div>
                    <div class="modal-body">
                        <textarea name="body" class="form-control" v-model="body" v-if="!status"></textarea>
                        <div class="alert alert-success" v-if="status">
                            <strong>Success!</strong>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="store">
                            Send
                        </button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                body: '',
                status: false
            }
        },
        methods: {
            store() {
                axios.post('/api/message/store', {'user': this.user, 'body': this.body}).then(response => {
                    this.status = response.data.status
                    this.body = ''
                    setTimeout(function () {
                        $('#modal-send-message').modal('hide')
                    }, 2000)
                })
            },
            showSendMessageForm() {
                $('#modal-send-message').modal('show')
            }
        }
    }
</script>