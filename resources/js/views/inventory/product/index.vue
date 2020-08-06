<template>
   <div>
      <div class="o_control_panel">
          <div>
              <ol class="breadcrumb" role="navigation">
                  <router-link class="text-primary" :to="{ name:'product_index' }">Products</router-link>
              </ol>
              <div class="o_cp_searchview" role="search">
                  <div class="o_searchview" role="search" aria-autocomplete="list">
                      <button class="o_searchview_more fa fa-search-minus" title="Advanced Search..." role="img"
                          aria-label="Advanced Search..." type="submit"></button>

                      <div class="o_searchview_input_container">
                          <input type="text" class="o_searchview_input" placeholder="Search..." v-model="search">
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
                            :to="{ name:'product_create' }"
                          >Create</router-link>

                          <button type="button" class="btn btn-secondary">
                              Import
                          </button>
                      </div>
                  </div>
              </div>
              <div class="o_cp_right">
                  <div class="btn-group o_search_options position-static" role="search">
                      <div>
                          <div class="btn-group o_dropdown">
                              <select
                                  class=" o_filters_menu_button o_dropdown_toggler_btn btn btn-secondary dropdown-toggle "
                                  data-toggle="dropdown" aria-expanded="false" tabindex="-1" data-flip="false"
                                  data-boundary="viewport" name="key" id="key">
                                  <option value="" data-icon="fa fa-filter">Filters</option>
                                  <option value="name">Name</option>
                                  <!-- <span class="fa fa-filter"></span> Filters -->
                              </select>
                          </div>
                      </div>
                  </div>
                  <nav class="o_cp_pager" role="search" aria-label="Pager">
                      <div class="o_pager o_hidden">
                          <span class="o_pager_counter">
                              <span class="o_pager_value"></span>
                              {{pagination.from}}-{{pagination.to}}
                              <span class="o_pager_limit"></span>
                              /&nbsp;{{pagination.total}}
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
                      </div>
                  </nav>
                  <nav class="btn-group o_cp_switch_buttons nav" role="toolbar" aria-label="View switcher">
                      <a data-toggle="tab" disable_anchor="true" href="#notebook_page_511"
                                  class="nav-link btn btn-secondary fa fa-lg fa-th-large o_cp_switch_kanban active" role="tab"></a>
                      <a data-toggle="tab" disable_anchor="true" href="#notebook_page_521"
                                  class="nav-link btn btn-secondary fa fa-lg fa-list-ul o_cp_switch_list" role="tab" aria-selected="true"></a>
                  </nav>
              </div>
          </div>
      </div>
      <div class="tab-content">
          <div class="tab-pane active" id="notebook_page_511">
              <div v-if="pagination.total != 0" class="o_kanban_view o_kanban_ungrouped">
                  <div v-for="row in paginatedata" class="oe_kanban_global_click o_kanban_record" v-bind:key="row.id" @click="show(row)">
                      <div class="o_kanban_image">
                          <img v-if="row.photo == null" v-bind:src="'/images/icons/camera.png'" alt="Product" class="o_image_64_contain">
                          <img v-else v-bind:src="'/uploads/Products/'+row.photo" alt="Product" class="o_image_64_contain ">
                      </div>
                      <div class="oe_kanban_details">
                          <strong class="o_kanban_record_title">
                              <span>{{row.name}}</span>
                              <small>[<span>{{row.code}}</span>]</small>
                          </strong> 
                          <div name="tags"></div>
                          <ul>
                              <li>Price: <span class="o_field_monetary o_field_number o_field_widget" name="lst_price">Rp&nbsp;{{formatPrice(row.price)}}</span></li>        
                              <li>On hand: <span>{{row.quantity}}</span> <span>{{row.uom.name}}</span></li>
                          </ul>
                          <div name="tags"></div>
                      </div>
                  </div>
                  <div v-for="row in ghost" :key="row.id" class='o_kanban_record o_kanban_ghost'/>
              </div>
              <div v-else class="o_kanban_view o_kanban_ungrouped">
                  <div class="o_nocontent_help">
                      <p class="o_view_nocontent_smiling_face">
                          <img  v-bind:src="'/images/icons/smiling_face.svg'" alt=""><br>
                          Create a new Products and Start your trading
                      </p>
                      <p>
                          You must define a product for everything you sell or purchase,
                          whether it's a storable product, a consumable or a service.
                      </p>
                  </div>
              </div>
          </div>
          <div class="tab-pane" id="notebook_page_521">
              <div class="panel-body">
                  <div v-if="pagination.total != 0" class="o_content">
                    <div class="o_list_view o_sale_order o_list_optional_columns">
                      <div class="table-responsive mb-3">
                          <table class="o_list_table table table-sm table-hover table-striped o_list_table_ungrouped"
                            style="table-layout: fixed;">
                              <thead>
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
                                  <td>{{row.code}}</td>
                                  <td>{{row.name}}</td>
                                  <td>{{formatPrice(row.price)}}</td>
                                  <td>{{formatPrice(row.cost)}}</td>
                                  <td>{{row.quantity}}</td>
                                  <td>{{row.uom.name}}</td>
                                </tr>
                              </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                  <div v-else class="o_nocontent_help">
                      <p class="o_view_nocontent_smiling_face">
                          <img  v-bind:src="'/images/icons/smiling_face.svg'" alt=""><br>
                          Create a new Products and Start your trading
                      </p>
                      <p>
                          You must define a product for everything you sell or purchase,
                          whether it's a storable product, a consumable or a service.
                      </p>
                  </div>
              </div>
          </div>
      </div>
    </div>
</template>
<script>
export default {
  created() {
    this.fetchproducts();
  },
  data() {
    let sortOrders = {};
    let columns = [
      { label: "Internal Reference", name: "code" },
      { label: "Name", name: "name" },
      { label: "Sales Price", name: "price" },
      { label: "Cost", name: "cost" },
      { label: "Quantity On Hand", name: "quantity" },
      { label: "Unit Of Measure", name: "uom_id" },
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {
      data: [],
      columns: columns,
      sortKey: "",
      sortOrders: sortOrders,
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
      ghost :"",
    };
  },
  methods: {
    fetchproducts() {
      axios
        .get("/api/Products")
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
      this.ghost = this.length - this.pagination.to;
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
    formatPrice(value) {
        let val = (value/1).toFixed(2).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    },
    show(row){
      this.$router.push({name: 'product_edit', params:{id : btoa(row.id)}});
    }
  },
  computed: {
    filterdata() {
      let product = this.data;
      if (this.search) {
        product = product.filter((row) => {
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
        product = product.slice().sort((a, b) => {
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
      return product;
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
