<template>
  <div>
    <q-card class="my-card">
      <q-card-section class="q-pa-xl">
        <q-form>
          <q-input
            outlined
            v-model="user_info.name"
            label="Name"
            type="text"
            :rules="[val => !!val || 'Field is required']"
            ref="name"
            class="q-mb-lg"
            style="width: 380px"
             />
          <q-input
            outlined
            v-model="user_info.email"
            label="Email"
            type="text"
            :rules="[val => !!val || 'Field is required']"
            ref="email"
            class="q-mb-lg"
            style="width: 380px" />
          <q-input
            outlined
            v-model="user_info.password"
            :rules="[val => !!val || 'Field is required']"
            ref="password"
            label="Password"
            type="password"
            class="q-mb-lg"
            style="width: 380px" />
          <q-input
            outlined
            v-model="user_info.confirmPassword"
            :rules="[val => !!val || 'Field is required']"
            ref="confirmPassword"
            label="Confirm-Password"
            type="password"
            class="q-mb-lg"
            style="width: 380px" />

          <q-btn outline color="primary" label="Sign up" class="q-px-lg q-py-sm" style="width: 100%" @click.prevent="register" />
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


export default {
  name: 'LoginComponents',
  components: {
    QCard,
    QCardSection,
    // QCardActions
  },
  data() {
    return {
      user_info: {
        name: '',
        email: '',
        password: '',
        confirmPassword: ''
      },
      errors: {}
    }
  },
  methods: {
    register() {
      this.$axios.post('users', this.user_info).then(res => {
        console.log(res);
        this.$router.push({ name: 'login' });
      }).catch(err => {
        if(err.response.data.error) {
            this.$q.notify({
              type: 'negative',
              message: `Password did not match`
            })
        } else {
            this.errors = err.response.data.errors;
        }
        let errors = err.response.data.errors
        for(let fieldname in errors) {
          // console.log(fieldname);
          let msg = errors[fieldname][0];
          // console.log(fieldname, msg);
          this.$refs[fieldname].innerError = true;
          this.$refs[fieldname].innerErrorMessage = msg;
        }
        console.log(this.errors);
      });
    }
  }

}
</script>
