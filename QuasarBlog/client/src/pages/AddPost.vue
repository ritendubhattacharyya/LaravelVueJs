<template>
  <q-page class="flex flex-center q-pa-md column">
    <div style="width: 80%" class="q-pa-xl">
      <q-form class="q-gutter-md q-pa-xl">
        <q-card class="my-card">
          <q-card-section>
            <h4>Add Post</h4>
          </q-card-section>
          <q-separator />
          <q-card-section>
            <q-form>
              <q-input
                clearable
                clear-icon="close"
                filled
                color="red-12 q-mb-lg"
                v-model="post.title"
                :rules="[val => !!val || 'Field is required']"
                label="Title"
                ref="title"
              />

              <q-input 
                v-model="post.body" 
                filled type="textarea" 
                color="red-12 q-mb-lg" 
                label="Body"
                :rules="[val => !!val || 'Field is required']"
                ref="body"
               />
              <q-btn label="Add" outline color="blue" style="width: 100%" class="q-py-sm" @click.prevent="add" />
            </q-form>
          </q-card-section>
        </q-card>
      </q-form>
    </div>
  </q-page>
</template>

<script>
export default {
  name: "HeaderComponent",
  data() {
      return {
          post: {
              title: '',
              body: ''
          }
      }
  },
  methods: {
    add() {
      // console.log('add method');
      this.$axios.post('posts/add', this.post)
      .then(res => {
        this.post.title = '';
        this.post.body = '';

        this.$q.notify({
          type: 'positive',
          message: `Request sent...Your blog will add shortly`
        });
      })
      .catch(err => {
        console.log(err.response.data.errors);
        let errors = err.response.data.errors
        for(let fieldname in errors) {
          // console.log(fieldname);
          let msg = errors[fieldname][0];
          // console.log(fieldname, msg);
          this.$refs[fieldname].innerError = true;
          this.$refs[fieldname].innerErrorMessage = msg;
        }
      })
    }
  }
};
</script>