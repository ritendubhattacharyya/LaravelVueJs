<template>
    <q-header elevated>
      <q-toolbar class="text-white bg-red-10 shadow-2 rounded-borders">
        <!-- <q-tabs shrink stretch>
          <q-route-tab name="home" label="Homepage" :to="{name: 'home'}" />
        </q-tabs> -->
        <q-space />

        <!--
          notice shrink property since we are placing it
          as child of QToolbar
        -->
        <q-tabs shrink stretch>
          <!-- <q-route-tab name="home" label="HOME" :to="{name: 'home'}" /> -->
          <q-route-tab name="login" label="LOGIN" :to="{name: 'login'}" />
          <q-route-tab name="register" label="REGISTER" :to="{name: 'register'}" />
          <!-- <template v-if="authorized">
            <template v-if="isAdmin">
              <q-route-tab name="admin" label="ADMIN" :to="{name: 'admin'}" />
            </template>
            <template v-if="isAuthor">
              <q-route-tab name="addPost" label="ADD POST" :to="{name: 'addPost'}" />
            </template>
            <template v-if="isUser">
              <q-route-tab name="SendReq" label="SEND REQ" :to="{name: 'sendRequest'}" />
            </template>
            <q-route-tab name="logout" label="LOGOUT" :to="{name: 'logout'}" />
          </template>
          <template v-else>
            <q-route-tab name="login" label="LOGIN" :to="{name: 'login'}" />
            <q-route-tab name="register" label="REGISTER" :to="{name: 'register'}" />
          </template> -->
        </q-tabs>

        <q-space />
      </q-toolbar>
    </q-header>
</template>

<script>
import { mapGetters, mapState } from 'vuex';

export default {
    name: 'HeaderComponent',
    computed: {
      ...mapGetters({
        authorized: 'auth/authorized',
        getUserInfo: 'auth/getUserInfo',
        isAdmin: 'auth/isAdmin',
        isAuthor: 'auth/isAuthor',
        isUser: 'auth/isUser',
      })
    },
}
</script>