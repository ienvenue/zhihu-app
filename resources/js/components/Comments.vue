<template>
    <div>

        <button
                class="button is-naked delete-button"
                style="margin-top: 39px;margin-right: 5px;"
                @click="showCommentsForm"
                v-text="text"
        ></button>
        <div class="modal fade" :id=dialog tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h4 class="modal-title" style="margin-left: 300px;">
                            CommentList
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div v-if="comments.length > 0">
                            <div class="media" v-for="comment in comments">
                                <div class="media-left">
                                    <a href="#">
                                        <img width="24" class="media-object" :src="comment.user.avatar">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{comment.user.name}}</h4>
                                    {{comment.body}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="text" class="form-control" v-model="body">
                        <button type="button" class="btn btn-primary" @click="store">
                            Commnet
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['type','model','count'],
        data() {
            return {
                body:'',
                comments: [],

                comment_count:this.count
            }
        },
        computed:{
            dialog() {
                return 'comments-dialog-' + this.type + '-' + this.model
            },
            dialogId() {
                return '#' + this.dialog
            },
            text() {
                return this.comment_count + ' comment'
            },
            total() {
                return this.count
            }
        },
        methods:{
            store() {
                axios.post('/api/comment',{'type':this.type,'model':this.model,'body':this.body}).then(response => {
                    let comment = {
                        user:{
                            name:Zhihu.name,
                            avatar:Zhihu.avatar
                        },
                        body: response.data.body
                    }
                    this.comments.push(comment)
                    this.body = ''
                    this.total ++
                })
            },
            showCommentsForm() {
                this.getComments()
                $(this.dialogId).modal('show')
            },
            getComments() {
                axios.get('/api/' + this.type +'/' + this.model + '/comments').then(response => {
                    this.comments = response.data
                })
            }
        }
    }
</script>