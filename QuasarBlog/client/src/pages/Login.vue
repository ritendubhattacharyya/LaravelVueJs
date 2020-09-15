<template>
  <q-page class="flex flex-center">
      <login-component></login-component>
  </q-page>
</template>

<script>
import LoginComponent from "../components/LoginComponent.vue";

export default {
  components: {
    "login-component": LoginComponent,
  },
};
</script>