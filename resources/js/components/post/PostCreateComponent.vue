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


        <button class="button is-fullwidth is-primary"
                :disabled="enablePost"
                @click="post">送信
        </button>

    </section>
</template>

<script>
    export default {
        data () {
            return {
                title: '',
                message: '### 連絡方法',
                terms: false,
                errors: null,
            }
        },
        computed: {
            enablePost () {
                return !this.terms || this.title.length === 0 || this.message.length === 0
            },
        },
        methods: {
            post () {
                axios.post('/post', {
                    title: this.title,
                    message: this.message,
                }).then(res => {
                    document.location = '/post/' + res.data.id
                }).error(error => {
                    this.errors = error.errors
                    //console.log(error)
                })
            },
        },
    }
</script>
