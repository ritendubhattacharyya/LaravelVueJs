<template>
    <q-page class="flex flex-center q-pa-md column">
        <q-card class="my-card">
            <q-banner inline-actions class="text-white bg-red-7" style="width: 100%">Edit</q-banner>
            <q-card-section class="q-pa-xl">
                <q-form>
                <q-input
                    outlined
                    v-model="post.title"
                    label="Title"
                    type="text"
                    id="uid"
                    class="q-mb-lg"
                    style="width: 50vh"
                />
                <q-input
                    outlined
                    v-model="post.body"
                    label="Body"
                    type="text"
                    class="q-mb-lg"
                    style="width: 50vh"
                />
                <q-btn
                    outline
                    color="primary"
                    label="Save"
                    class="q-py-sm"
                    style="width: 50vh"
                    @click.prevent="save"
                    />
                </q-form>
            </q-card-section>
        </q-card>   
    </q-page>
</template>

<script>
import { mapGetters, mapState } from 'vuex'

export default {
    name: 'HeaderComponent',
    created() {
        this.postId = this.$route.params.id;
        this.userId = this.$route.params.userId;
        if(this.user.role !== 'admin') {
            if(this.user.id !== parseInt(this.userId)) {
                this.$router.push({name: 'dashboard'});
            }
        }
        this.$axios.get('posts/' + this.postId + '/edit')
        .then(res => {
            this.post.title = res.data.title;
            this.post.body = res.data.body;
        })
        .catch(err => console.log('failed'));
    },
    data() {
        return {
            postId: 1,
            userId: 1,
            post: {
                title: '',
                body: ''
            }
        }
    },
    computed: {
        ...mapState('auth', ['user']),
        ...mapGetters({
            getUserInfo: "auth/getUserInfo",
            getUserInfo: "auth/isAdmin",
        })
    },
    methods: {
        save() {
            this.$axios.put('posts/' + this.postId + '/edit', this.post)
            .then(res => {
                this.$q.dialog({
                    title: 'Alert',
                    message: 'Edit Successful'
                }).onOk(() => {
                    this.$router.push({name: 'dashboard'});
                }).onCancel(() => {
                    this.$router.push({name: 'dashboard'});
                }).onDismiss(() => {
                    this.$router.push({name: 'dashboard'});
                })
            })
        }
    }

}
</script>