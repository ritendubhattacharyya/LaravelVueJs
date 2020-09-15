<template>
  <q-page class="flex flex-center q-pa-md column">
    <div style="width: 80%" class="q-pa-xl">
      <q-form class="q-gutter-md q-my-md q-mx-xl">
        <q-card class="my-card">
          <q-card-section>
            <h4>Profile Details</h4>
          </q-card-section>
          <q-separator />
          <q-card-section>
            <q-form>
              <q-input
                clearable
                clear-icon="close"
                filled
                color="red-12 q-mb-lg"
                v-model="user.name"
                label="Name"
                :rules="[val => !!val || 'Field is required']"
              />
              <q-input
                clearable
                clear-icon="close"
                filled
                color="red-12 q-mb-lg"
                v-model="user.email"
                label="Email"
                :rules="[val => !!val || 'Field is required']"
              />

              <q-btn label="Save" outline color="blue" style="width: 100%" class="q-py-sm" @click.prevent="Save" />
            </q-form>
          </q-card-section>
        </q-card>
      </q-form>
    </div>
  </q-page>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: "HeaderComponent",
  created() {
      this.user.id = parseInt(this.$route.params.id)
      if(parseInt(this.$route.params.id) !== parseInt(this.getUserInfo.id)) 
      {
        this.$router.push({name: 'dashboard'});
      }
      this.user.name = this.getUserInfo.name
      this.user.email = this.getUserInfo.email

  },
  data() {
      return {
          user: {
              id: '',
              name: '',
              email: ''
          }
      }
  },
  computed: {
      ...mapGetters('auth', ['getUserInfo'])
  },
  methods: {
    Save() {
      // console.log('add method');
      this.$axios.put('users/'+ this.user.id +'/edit', this.user)
      .then(res => {
        this.$router.push({name: 'dashboard'});
      })
      .catch(err => console.log(err))
    }
  }
};
</script>