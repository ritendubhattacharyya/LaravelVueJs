<template>
  <q-page class="flex flex-center">
      show blog
  </q-page>
</template>

<script>
// import { mapGetters } from "../components/LoginComponent.vue";

export default {
  name: 'ShowBlog',
  created() {
      alert('show blog');
    //   if(!authorized) {
    //       this.$route.push({name: 'login'});
    //   } else if(isUser) {
    //       this.$route.push({name: 'home'});
    //   }
  },
  methods: {
    //   ...mapGetters('auth', ['isUser', 'authorized'])
  }
};
</script>