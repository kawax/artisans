<template>
    <section>
        <div class="field">
            <b-switch v-model="hidden">
                職人リストで非公開
            </b-switch>
        </div>
        <p class="help mb-1">個別のページでは公開されます。</p>


        <b-field label="一言タイトル">
            <b-input v-model="title" maxlength="100"></b-input>
        </b-field>
        <p class="help mb-1">OGPの画像等でも使われます。</p>


        <b-field label="メッセージ">
            <b-input maxlength="1000" type="textarea" v-model="message"></b-input>
        </b-field>
        <p class="help mb-1">Markdownが使えます。</p>


        <b-field label="タグ">
            <b-taginput
                v-model="tags"
                maxtags="10"
                ellipsis
                icon-pack="fas"
                icon="tag"
                placeholder="Add a tag">
            </b-taginput>
        </b-field>
        <p class="help mb-1">スキルを書くなり条件を書くなり使い方は自由。</p>


        <button class="button is-fullwidth is-primary" @click="post">保存</button>

    </section>
</template>

<script>
    export default {
        data () {
            return {
                name: '',
                title: '',
                message: '',
                tags: [],
                hidden: false,
            }
        },
        mounted () {
            axios.get('/profile/me').then(res => {
                this.name = res.data.name
                this.title = res.data.title
                this.message = res.data.message
                this.hidden = res.data.hidden
                this.tags = res.data.tags
            })
        },
        methods: {
            async post () {
                const res = await axios.put('/profile', {
                    title: this.title,
                    message: this.message,
                    hidden: this.hidden,
                    tags: this.tags,
                })

                document.location = '/@' + this.name
            },
        },
    }
</script>
