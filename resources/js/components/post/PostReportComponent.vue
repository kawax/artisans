<template>
    <b-dropdown aria-role="list">
        <button class="button is-primary is-outlined" slot="trigger">
            <span>違反報告</span>
            <b-icon pack="fas" icon="caret-down"></b-icon>
        </button>

        <b-dropdown-item aria-role="menu-item" custom>
            <div class="model">
                <div class="modal-content">
                    <ul>
                        <li>修正・削除すべき募集があれば報告してください。</li>
                        <li>報告に対する返答等はありません。</li>
                    </ul>

                    <b-field label="理由">
                        <b-input
                            v-model="reason"
                            type="textarea"
                            maxlength="500"
                            required>
                        </b-input>
                    </b-field>

                    <b-field>
                        <button class="button is-primary" :disabled="reason.length === 0" @click="post">送信</button>
                    </b-field>

                    <span v-if="result.length > 0">{{ result }}</span>
                </div>
            </div>
        </b-dropdown-item>
    </b-dropdown>
</template>

<script>
    export default {
        data () {
            return {
                reason: '',
                result: '',
            }
        },
        props: ['postId'],
        mounted () {

        },
        methods: {
            async post () {
                const res = await axios.post('/post/report/' + this.postId, {
                    reason: this.reason,
                })

                this.reason = ''
                this.result = '送信しました。'
            },
        },
    }
</script>
