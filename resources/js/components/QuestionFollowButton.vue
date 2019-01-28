<template>
    <button class="btn btn-primary"
            v-text="text"
            v-bind:class="{'btn-success':followed}"
            v-on:click="follow"
    >

    </button>
</template>

<script>
    export default {
        props:['question','user'],
        mounted() {
            axios.post('/api/question/follower', {'question':this.question,'user':this.user}).then(response => {
                this.followed =response.data.followed
            })
        },
        data() {
            return {
                followed: false
            }
        },
        computed: {
            text() {
                return this.followed ? 'Followed' : '  Follow'
            }
        },
        methods:{
            follow(){
                axios.post('/api/question/follow', {'question':this.question,'user':this.user}).then(response => {
                    this.followed =response.data.followed
                })
            }
        }
    }
</script>
        