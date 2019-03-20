<template>
    <section>
        <b-field label="タイトル">
            <b-input v-model="title" minlength="1" maxlength="100"></b-input>
        </b-field>
        <p class="help mb-1">OGPの画像等でも使われます。</p>


        <b-field label="メッセージ（Markdown）">
            <b-input minlength="1" maxlength="1000" type="textarea" v-model="message"></b-input>
        </b-field>
        <p class="help mb-1"></p>


        <div class="field">
            <b-switch v-model="terms">利用規約に同意する</b-switch>
        </div>


        <button class="button is-fullwidth is-primary" :disabled="!terms || title.length === 0 || message.length === 0"
                @click="post">送信
        </button>

    </section>
</template>

<script>
    export default {
        data () {
            return {
                title: '',
                message: '',
                terms: true,
            }
        },
        props: ['postId'],
        mounted () {
            axios.get('/post/edit/' + this.postId).then(res => {
                this.title = res.data.title
                this.message = res.data.message
            })
        },
        methods: {
            async post () {
                const res = await axios.put('/post/' + this.postId, {
                    title: this.title,
                    message: this.message,
                })

                document.location = '/post/' + this.postId
            },
        },
    }
</script>
