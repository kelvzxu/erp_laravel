<template>
  <div>
    <div class="o_control_panel">
      <div>
        <ol class="breadcrumb" role="navigation">
          <li class="breadcrumb-item" accesskey="b">
            <router-link class="text-primary" :to="{ name:'uom_index' }">Units of Measure</router-link>
          </li>
        </ol>
        <div class="o_cp_searchview" role="search">
          <div class="o_searchview" role="search" aria-autocomplete="list">
            <button
              class="o_searchview_more fa fa-search-minus"
              title="Advanced Search..."
              role="img"
              aria-label="Advanced Search..."
              type="submit"
            ></button>

            <div class="o_searchview_input_container">
              <input
                type="text"
                class="o_searchview_input"
                v-model="search"
                placeholder="Search..."
                name="value"
              />
              <div class="dropdown-menu o_searchview_autocomplete" role="menu"></div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="o_cp_left">
          <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
            <div>
              <router-link
                type="button"
                class="btn btn-primary text-white o-kanban-button-new"
                :to="{ name:'uom_create' }"
              >Create</router-link>
              <button type="button" class="btn btn-secondary o_button_import">Import</button>
            </div>
          </div>
        </div>
        <div class="o_cp_right">
          <nav class="o_cp_pager" role="search" aria-label="Pager">
            <div class="o_pager o_hidden">
              <span class="o_pager_counter">
                <span class="o_pager_value"></span>
                {{pagination.from}}-{{pagination.to}}
                <span class="o_pager_limit"></span>
                {{pagination.total}}
              </span>

              <span class="btn-group" aria-atomic="true">
                <a
                  v-if="pagination.prevPage"
                  @click="--pagination.currentPage"
                  type="button"
                  class="fa fa-chevron-left btn o_pager_previous"
                ></a>
                <a v-else type="button" class="fa fa-chevron-left btn o_pager_previous"></a>
                <a
                  v-if="pagination.nextPage"
                  @click="++pagination.currentPage"
                  type="button"
                  class="fa fa-chevron-right btn o_pager_next"
                ></a>
                <a v-else type="button" disabled class="fa fa-chevron-right btn o_pager_next"></a>
              </span>
              <span class="btn-group d-none" aria-atomic="true">
                <button
                  type="button"
                  class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                  accesskey="p"
                  aria-label="Previous"
                  title="Previous"
                  tabindex="-1"
                ></button>
                <button
                  type="button"
                  class="fa fa-chevron-right btn btn-secondary o_pager_next"
                  accesskey="n"
                  aria-label="Next"
                  title="Next"
                  tabindex="-1"
                ></button>
              </span>
            </div>
          </nav>
          <nav
            class="btn-group o_cp_switch_buttonsnav nav"
            role="toolbar"
            aria-label="View switcher"
          >
            <a
              data-toggle="tab"
              disable_anchor="true"
              href="#notebook_page_511"
              class="nav-link btn btn-secondary fa fa-lg fa-list-ul o_cp_switch_list active"
              role="tab"
              aria-selected="true"
            ></a>
          </nav>
        </div>
      </div>
    </div>
    <div class="tab-content">
      <div class="tab-pane active" id="notebook_page_511">
        <div class="panel-body ml-2">
          <div class="table-responsive-lg mb-4">
            <table class="table table-striped">
              <thead class="table table-sm">
                <tr>
                  <th
                    v-for="column in columns"
                    :key="column.name"
                    @click="sortBy(column.name)"
                    :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'o-sort-down o_column_sortable' : 'o-sort-up o_column_sortable') : 'sorting'"
                    style="cursor:pointer;"
                  >{{column.label}}</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="row in paginatedata" :key="row.id" class="table-row" @click="show(row)">
                  <td>{{row.name}}</td>
                  <td>{{row.category.name}}</td>
                  <td>{{row.type.name}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  created() {
    this.fetchUom();
  },
  data() {
    let sortOrders = {};
    let columns = [
      { label: "Unit Of Measure", name: "name" },
      { label: "Category", name: "category_id" },
      { label: "Type", name: "uom_type" },
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {
      data: [],
      columns: columns,
      sortKey: "",
      sortOrders: sortOrders,
      length: 10,
      search: "",
      tableShow: {
        showdata: true,
      },
      pagination: {
        currentPage: 1,
        total: "",
        nextPage: "",
        prevPage: "",
        from: "",
        to: "",
      },
    };
  },
  methods: {
    fetchUom() {
      axios
        .get("/api/uom/list")
        .then((response) => {
          this.data = response.data.data;
          this.pagination.total = this.data.length;
        })
        .catch((error) => console.error(error));
    },
    paginate(array, length, pageNumber) {
      this.pagination.from = array.length ? (pageNumber - 1) * length + 1 : " ";
      this.pagination.to =
        pageNumber * length > array.length ? array.length : pageNumber * length;
      this.pagination.prevPage = pageNumber > 1 ? pageNumber : "";
      this.pagination.nextPage =
        array.length > this.pagination.to ? pageNumber + 1 : "";
      return array.slice((pageNumber - 1) * length, pageNumber * length);
    },
    resetPagination() {
      this.pagination.currentPage = 1;
      this.pagination.prevPage = "";
      this.pagination.nextPage = "";
    },
    sortBy(key) {
      this.resetPagination();
      this.sortKey = key;
      this.sortOrders[key] = this.sortOrders[key] * -1;
    },
    getIndex(array, key, value) {
      return array.findIndex((i) => i[key] == value);
    },
    show(row){
      this.$router.push({name: 'uom_edit', params:{id : btoa(row.id)}});
    }
  },
  computed: {
    filterdata() {
      let uom = this.data;
      if (this.search) {
        uom = uom.filter((row) => {
          return Object.keys(row).some((key) => {
            return (
              String(row[key])
                .toLowerCase()
                .indexOf(this.search.toLowerCase()) > -1
            );
          });
        });
      }
      let sortKey = this.sortKey;
      let order = this.sortOrders[sortKey] || 1;
      if (sortKey) {
        uom = uom.slice().sort((a, b) => {
          let index = this.getIndex(this.columns, "name", sortKey);
          a = String(a[sortKey]).toLowerCase();
          b = String(b[sortKey]).toLowerCase();
          if (this.columns[index].type && this.columns[index].type === "date") {
            return (
              (a === b
                ? 0
                : new Date(a).getTime() > new Date(b).getTime()
                ? 1
                : -1) * order
            );
          } else if (
            this.columns[index].type &&
            this.columns[index].type === "number"
          ) {
            return (+a === +b ? 0 : +a > +b ? 1 : -1) * order;
          } else {
            return (a === b ? 0 : a > b ? 1 : -1) * order;
          }
        });
      }
      return uom;
    },
    paginatedata() {
      return this.paginate(
        this.filterdata,
        this.length,
        this.pagination.currentPage
      );
    },
  },
};
</script>