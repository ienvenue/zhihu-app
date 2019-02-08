<template>
    <button
            class="btn btn-primary"
            v-bind:class="{'btn-success': followed}"
            v-text="text"
            v-on:click="follow"
            style="float: left;margin-right: 4px;"
    ></button>
</template>

<script>
    export default {
        props: ['user'],
        mounted() {
            axios.get('/api/user/followers/' + this.user).then(response => {
                this.followed = response.data.followed
            })
        },
        data() {
            return {
                followed: false
            }
        },
        computed: {
            text() {
                return this.followed ? 'Followed' : 'Follow'
            }
        },
        methods: {
            follow() {
                axios.post('/api/user/follow', {'user': this.user}).then(response => {
                    this.followed = response.data.followed
                })
            }
        }
    }
</script>