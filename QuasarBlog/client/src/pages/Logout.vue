<template>
  <q-page class="flex flex-center">
  </q-page>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: 'Logout',

  created() {
    this.signout();
  },

  methods: {
      ...mapActions({
          signout: 'auth/signout'
      })
  }
};
</script>