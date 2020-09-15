<template>
  <div>
    <q-banner inline-actions class="text-white bg-red-7">
        Login
    </q-banner>
    <q-card class="my-card">
      <q-card-section class="q-pa-xl">
        <q-form>
          <q-input 
            outlined 
            v-model="form.email" 
            label="Email" 
            type="text"
            class="q-mb-lg"
            :rules="[val => !!val || 'Field is required']"
            ref="email"
            style="width: 380px" />
          <q-input 
            outlined 
            v-model="form.password" 
            label="Password" 
            type="password"
            class="q-mb-lg"
            :rules="[val => !!val || 'Field is required']"
            ref="password"
            style="width: 380px" />

          <q-btn outline color="primary" label="Login" class="q-px-lg q-py-sm" style="width: 100%" @click.prevent="login" />
        </q-form>
      </q-card-section>
    </q-card>
  </div>
</template>

<script>
import {
  Quasar,
  QCard,
  QCardSection
  // QCardActions
} from 'quasar';

import { mapActions, mapGetters } from 'vuex'


export default {
  name: 'LoginComponents',
  created() {
    if(this.authorized) {
      this.$router.push('/dashboard');
    }
  },
  components: {
    QCard,
    QCardSection,
    // QCardActions
  },
  data() {
    return {
      form: {
        email : '',
        password : ''
      }
    }
  },
  computed: {
    ...mapGetters('auth', ['authorized', 'isUser']),
  },
  methods: {
    ...mapActions({
      signin: 'auth/signin'
    }),

    login() {
      this.$q.loading.show();
      this.$axios.get('/users/check?email=' + this.form.email).then(res => {
        if(res.data === 'user') {
          this.$q.loading.hide();
          this.$q.notify({
            type: 'negative',
            message: `You dont have permission.`
          })
        } else {
          this.signin(this.form).then(()=> {
            this.$q.loading.hide();
          })
          .catch(err => {
            this.$q.loading.hide();
            this.$q.notify({
              type: 'negative',
              message: `Provide the right credentials`
            })
          });
        }
      }).catch(err => {
        this.$q.loading.hide();
        this.$q.notify({
          type: 'negative',
          message: `Provide the right credentials`
        })
    })
    }
  }
  
}
</script>
