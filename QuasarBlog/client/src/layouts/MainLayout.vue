<template>
  <q-layout view="lHh Lpr lFf">
    <header-component></header-component>

    <q-page-container>
      <!-- {{ authorized }} -->
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import HeaderComponent from "../components/HeaderComponent.vue";
import { mapActions } from 'vuex'

export default {
  name: "MainLayout",
  created() {
    this.me();
  },
  components: {
    "header-component": HeaderComponent,
  },
  methods: {
    ...mapActions('auth', ['me'])
  }
};
</script>

<style lang="stylus">
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, Helvetica, sans-serif;
}
body {
  background-color: #f2fcff;
}
</style>
