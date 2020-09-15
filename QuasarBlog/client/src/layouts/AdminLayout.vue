<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar class="bg-red-10">
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"
        />

        <q-toolbar-title>
          Dashboard
        </q-toolbar-title>

        <div>
            <q-btn 
                round color="amber" 
                glossy text-color="black" 
                icon="power_settings_new" 
                style="font-size: 0.8rem"
                @click="logout" />
        </div>

      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      content-class="bg-grey-1"
    >
      <q-list>
        <!-- Profile link -->
        <q-card class="my-card">
          <q-img
            src="https://cdn.quasar.dev/img/parallax2.jpg"
            basic
            style="height: 9rem"
          >
            <div class="absolute-bottom text-subtitle2 text-right">
              {{ getUserInfo.name }}
            </div>
          </q-img>
        </q-card>
        <!-- !Profile link -->

        <!-- menu item -->

        <q-list bordered padding class="rounded-borders text-primary">
            <router-link to="/admin">
                <q-item
                clickable
                v-ripple
                :active="link === 'dashboard'"
                @click="link = 'dashboard'"
                active-class="my-menu-link"
                >
                    <q-item-section avatar>
                    <q-icon name="home" />
                    </q-item-section>

                    <q-item-section>Home</q-item-section>
                </q-item>
            </router-link>
            <router-link to="/admin/add">
                <q-item
                clickable
                v-ripple
                :active="link === 'add'"
                @click="link = 'add'"
                active-class="my-menu-link"
                >
                    <q-item-section avatar>
                    <q-icon name="add" />
                    </q-item-section>

                    <q-item-section>Add</q-item-section>
                </q-item>
            </router-link>
            <router-link :to="'/admin/user/'+getUserInfo.id">
                <q-item
                clickable
                v-ripple
                :active="link === 'profile'"
                @click="link = 'profile'"
                active-class="my-menu-link"
                >
                    <q-item-section avatar>
                    <q-icon name="perm_identity" />
                    </q-item-section>

                    <q-item-section>Profile</q-item-section>
                </q-item>
            </router-link>
            <template v-if="isAdmin">
              <router-link to="/admin/users">
                  <q-item
                  clickable
                  v-ripple
                  :active="link === 'users'"
                  @click="link = 'users'"
                  active-class="my-menu-link"
                  >
                      <q-item-section avatar>
                      <q-icon name="account_circle" />
                      </q-item-section>

                      <q-item-section>Users</q-item-section>
                  </q-item>
              </router-link>
            </template>
               
        </q-list>

        <!-- !menu item -->
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'AdminLayout',
  created() {
      if(!this.authorized) {
          this.$router.push({name: 'login'});
      } 
  },
  data () {
    return {
      leftDrawerOpen: false,
      link: 'dashboard'
    }
  },
  computed: {
      ...mapGetters({
        authorized: 'auth/authorized',
        getUserInfo: 'auth/getUserInfo',
        isAdmin: 'auth/isAdmin',
        isAuthor: 'auth/isAuthor',
        isUser: 'auth/isUser',
      })
  },
  methods: {
      ...mapActions({
          signout: 'auth/signout'
      }),
      logout() {
          this.signout();
      }
  }
}
</script>

<style scoped>
.my-menu-link {
    color: white;
    background: #F2C037
}

a {
    text-decoration: none;
    color: black;
}
</style>
