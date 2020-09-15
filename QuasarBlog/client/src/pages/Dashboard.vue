<template>
  <q-page class="flex flex-center q-pa-md column">
    <q-table
      title="Posts"
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

      <!-- addition column -->
      <template v-slot:body-cell-actions="props">
        <q-td :props="props">
          <q-btn-dropdown color="bg-red-1" label="Actions" class="text-blue-grey-6">
            <q-list>
              <q-item
                clickable
                v-close-popup
                @click="onClickActionItem(action)"
                v-for="action in props.row.actions"
                :key="action.title"
              >
                <q-item-section avatar>
                  <q-avatar
                    :icon="action.icon"
                    :color="action.colour"
                    text-color="white"
                    style="font-size: 28px;"
                  />
                </q-item-section>
                <q-item-section>
                  <q-item-label>{{ action.title }}</q-item-label>
                </q-item-section>
              </q-item>
            </q-list>
          </q-btn-dropdown>
        </q-td>
      </template>
      <!-- !addition column -->
    </q-table>
  </q-page>
</template>

<script>
import { mapGetters, mapActions, mapState } from "vuex";

export default {
  name: "PageIndex",

  created() {
    this.me();
    this.onRequest({
      pagination: this.pagination,
      filter: undefined,
    });
  },
  data() {
    return {
      post_id: 1,
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
          name: "title",
          label: "Title",
          field: "title",
          align: "center",
          sortable: true,
        },
        {
          name: "name",
          label: "Author",
          field: "name",
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
          name: "actions",
          align: "left",
          label: "Actions",
          field: "actions",
          sortable: true,
        },
      ],
    };
  },
  computed: {
    ...mapGetters({
      authorized: "auth/authorized",
      getUserInfo: "auth/getUserInfo",
    })
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
        userId: this.getUserInfo.id,
      };

      this.$axios.post("posts", params).then((res) => {
        this.data = res.data.items;
        this.loading = false;
        this.pagination.rowsNumber = res.data.total;
        this.pagination.page = res.data.page - 1;
        this.pagination.rowsPerPage = res.data.rowsPerPage;
        this.pagination.sortBy = res.data.sortBy;
        this.pagination.descending = res.data.descending;
      });
    },
    onClickActionItem(action) {
      if (action.title === "Edit") {
        this.$router.push({path: action.link});
      } else if (action.title === "Delete") {
        // this.confirm = true;
        this.post_id = action.postId;
        this.$q.dialog({
        title: 'Confirm',
        message: 'Do you want to delete this record?',
        cancel: true,
        persistent: true
        }).onOk(() => {
          // console.log(this.post_id);
          this.$axios.delete('posts/' + this.post_id + '/delete').then(() => {
            this.onRequest({
              pagination: this.pagination,
              filter: undefined,
            });
            this.$q.notify({
              type: 'positive',
              message: `Delete Successful`
            })
          })
        }).onCancel(() => {
          // console.log('>>>> Cancel')
        }).onDismiss(() => {
          // console.log('I am triggered on both OK and Cancel')
        })
      }
    },
    ...mapActions({
      me: 'auth/me'
    }),
    deleteUser() {
      //
    }
  },
};
</script>
