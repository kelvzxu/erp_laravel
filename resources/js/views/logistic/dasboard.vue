<template>
  <div class="o_action_manager">
    <div class="o_action o_cannot_create o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item active">
                <router-link
                  class="text-primary"
                  :to="{ name:'logistic_dasboard' }"
                >Logistics Dasboard</router-link>
              </li>
            </ol>
            <div class="o_cp_searchview" role="search">
              <div class="o_searchview" role="search" aria-autocomplete="list">
                <span
                  class="o_searchview_more fa fa-search-minus"
                  title="Advanced Search..."
                  role="img"
                  aria-label="Advanced Search..."
                ></span>

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
              <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar"></div>
              <aside class="o_cp_sidebar"></aside>
            </div>
            <div class="o_cp_right">
              <div class="btn-group o_search_options position-static" role="search">
                <div></div>
              </div>
              <nav class="o_cp_pager" role="search" aria-label="Pager">
                <div class="o_pager o_hidden">
                  <span class="o_pager_counter">
                    <span class="o_pager_value"></span>
                    {{pagination.from}}-{{pagination.to}}/
                    <span
                      class="o_pager_limit"
                    ></span>
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
              <nav class="btn-group o_cp_switch_buttons" role="toolbar" aria-label="View switcher"></nav>
            </div>
          </div>
        </div>
      </div>

      <div class="o_content">
        <div
          class="o_kanban_view oe_background_grey o_kanban_dashboard o_emphasize_colors o_stock_kanban o_kanban_ungrouped"
        >
          <div v-for="row in paginatedata" v-bind:key="row.id" class="o_kanban_record">
            <div modifiers="{}">
              <div class="o_kanban_card_header" modifiers="{}">
                <div class="o_kanban_card_header_title" modifiers="{}">
                  <div class="o_primary" modifiers="{}">
                    <div
                      class="oe_kanban_action oe_kanban_action_a text-primary"
                    >
                      <span>{{row.name}}</span>
                    </div>
                  </div>

                  <div class="o_secondary" modifiers="{}">
                    <span>{{row.warehouse}}</span>
                  </div>
                </div>
              </div>
              <div class="container o_kanban_card_content" modifiers="{}">
                <div class="row" modifiers="{}">
                  <div class="col-6 o_kanban_primary_left" modifiers="{}">
                    <button
                      class="btn btn-primary oe_kanban_action oe_kanban_action_button"
                      @click="onView(row)"
                      type="button"
                    >
                      <span modifiers="{}">View Process</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-for="row in ghost" :key="row.id" class='o_kanban_record o_kanban_ghost'/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    this.fetchWarehouse();
  },
  data() {
    return {
      data: [],
      warehouse: null,
      sortKey: "",
      length: 30,
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
    prepare_data() {
      const value = [];
      const warehouse = this.warehouse;
      $.each(warehouse, function (i) {
        value.push(
          {
            id: 'Receipts-'+warehouse[i].code,
            name: "Receipts",
            w_id: warehouse[i].id,
            warehouse: warehouse[i].name,
          },
          {
            id: 'Delivery-'+warehouse[i].code,
            name: "Delivey Orders",
            w_id: warehouse[i].id,
            warehouse: warehouse[i].name,
          }
        );
      });
      this.data = value;
      this.pagination.total = this.data.length;
    },
    fetchWarehouse() {
      axios
        .get("/api/warehouse")
        .then((response) => {
          this.warehouse = response.data.result;
          this.prepare_data();
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
      this.ghost = this.length - this.pagination.to;
      return array.slice((pageNumber - 1) * length, pageNumber * length);

    },
    resetPagination() {
      this.pagination.currentPage = 1;
      this.pagination.prevPage = "";
      this.pagination.nextPage = "";
    },
    onView(self){
        if (self.name == 'Receipts')
            this.$router.push({name: 'receipt_index', params:{id : btoa(self.w_id)}});
        else
            this.$router.push({name: 'delivery_index', params:{id : btoa(self.w_id)}});
    }
  },
  computed: {
    filterdata() {
      let data = this.data;
      if (this.search) {
        data = data.filter((row) => {
          return Object.keys(row).some((key) => {
            return (
              String(row[key])
                .toLowerCase()
                .indexOf(this.search.toLowerCase()) > -1
            );
          });
        });
      }
      return data;
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