<template>
    <section class="mb-1">
        <article class="message is-primary">
            <div class="message-header">
                <p>募集検索</p>
            </div>
            <div class="message-body">
                <b-field label="">
                    <b-autocomplete
                        :data="data"
                        placeholder="検索"
                        field="id"
                        clear-on-select
                        :loading="isFetching"
                        @typing="getAsyncData"
                        @select="select">

                        <template slot-scope="props">
                            <div class="media">
                                <div class="media-left">
                                    <figure class="image is-32x32">
                                        <img class="is-rounded"
                                             width="32"
                                             :src="`${props.option.user.avatar}`"
                                             :title="`${props.option.user.name}`"
                                        >
                                    </figure>
                                </div>
                                <div class="media-content">
                                    <p class="has-text-primary has-text-weight-semibold">
                                        {{ props.option.title }}
                                    </p>
                                    <p>
                                        {{ props.option.message.substr(0, 100) }}
                                    </p>

                                    <b-field>
                                        <div class="control">
                                            <b-taglist attached>
                                                <b-tag type="is-primary">更新日</b-tag>
                                                <b-tag>{{ props.option.updated_at }}</b-tag>
                                            </b-taglist>
                                        </div>
                                    </b-field>
                                </div>
                            </div>
                        </template>
                    </b-autocomplete>
                </b-field>
            </div>
        </article>
    </section>
</template>

<script>
    import debounce from 'lodash/debounce'

    export default {
        data () {
            return {
                data: [],
                selected: null,
                isFetching: false,
            }
        },
        methods: {
            // You have to install and import debounce to use it,
            // it's not mandatory though.
            getAsyncData: debounce(function (name) {
                if (!name.length) {
                    this.data = []
                    return
                }
                this.isFetching = true
                axios.get(`/api/post?q=${name}`).then(({data}) => {
                    this.data = []
                    data.data.forEach((item) => this.data.push(item))
                }).catch((error) => {
                    this.data = []
                    throw error
                }).finally(() => {
                    this.isFetching = false
                })
            }, 500),

            select (option) {
                document.location = '/post/' + option.id
            },
        },
    }
</script>
