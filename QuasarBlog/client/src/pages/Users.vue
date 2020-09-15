<template>
  <q-page class="flex flex-center q-pa-md column">
    <div>
      <q-select
        outlined
        v-model="user_info.role"
        :options="roles"
        label="Role"
        class="q-mb-lg"
        @input="onChangeCategory"
      />
      <q-select
        outlined
        v-model="user_info.status"
        :options="status"
        label="Status"
        class="q-mb-lg"
        @input="onChangeCategory"
      />
      <q-table
        title="Users"
        :data="data"
        :columns="columns"
        row-key="id"
        :pagination.sync="pagination"
        :loading="loading"
        :filter="filter"
        @request="onRequest"
        binary-state-sort
        class="q-pa-md"
      >
        <template v-slot:top-right>
          <q-input borderless dense debounce="300" v-model="filter" placeholder="Search">
            <template v-slot:append>
              <q-icon name="search" />
            </template>
          </q-input>
        </template>
      </q-table>
    </div>
  </q-page>
</template>

<script>
import { mapGetters, mapActions, mapState } from "vuex";

export default {
  name: "PageIndex",

  created() {
      // if(!this.isAdmin) {
      //     this.$router.push({name: 'dashboard'})
      // }
      this.onRequest({
        pagination: this.pagination,
        filter: undefined,
      });
  },
  data() {
    return {
      roles: ['All', 'author', 'admin', 'user'],
      status: ['All', 'active', 'inactive'],
      user_info: {
        role: '',
        status: ''
      },
      data: [],
      filter: "",
      loading: false,
      pagination: {
        sortBy: "id",
        descending: false,
        page: 1,
        rowsPerPage: 3,
        rowsNumber: 16,
      },
      columns: [
        {
          name: "id",
          label: "#",
          field: "id",
          align: "center",
          sortable: true,
        },
        {
          name: "name",
          label: "Name",
          field: "name",
          align: "center",
          sortable: true,
        },
        {
          name: "email",
          label: "Email",
          field: "email",
          align: "center",
          sortable: true,
        },
        {
          name: "created_at",
          label: "Created_at",
          align: "center",
          field: "created_at",
          sortable: true,
        },
        {
          name: "role",
          label: "Role",
          align: "center",
          field: "role",
          sortable: true,
        },
        {
          name: "status",
          align: "center",
          label: "Status",
          field: "status",
          sortable: true,
        },
      ],
    }
  },
  computed: {
    // ...mapGetters({
    //   authorized: 'auth/authorized',
    //   isAdmin: 'auth/isAdmin',
    // })
    ...mapGetters('auth', ['authorized', 'isAdmin'])
  },
  methods: {
    onRequest(props) {
      const { page, rowsPerPage, sortBy, descending } = props.pagination;
      const filter = props.filter;

      this.loading = true;

      let params = {
        page,
        rowsPerPage,
        sortBy,
        descending,
        filter,
        role: this.user_info.role,
        status: this.user_info.status
      };

      this.$axios.post('users/list', params).then(res => {
        this.data = res.data.items;
        this.loading = false;
        this.pagination.rowsNumber = res.data.total;
        this.pagination.page = res.data.page - 1;
        this.pagination.rowsPerPage = res.data.rowsPerPage;
        this.pagination.sortBy = res.data.sortBy;
        this.pagination.descending = res.data.descending;
      })
    },
    onChangeCategory() {
      this.onRequest({
        pagination: this.pagination,
        filter: this.filter,
      });
    },
  }
};
</script>