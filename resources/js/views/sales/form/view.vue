<template>
  <form @submit.prevent="submit" method="post">
    <div class="o_action_manager">
      <div class="o_action o_view_controller">
        <div class="o_cp_controller">
          <div class="o_control_panel">
            <div>
              <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b">
                  <router-link class="text-primary" :to="{ name:'sales_index' }">Quotations</router-link>
                </li>
                <li class="breadcrumb-item active">{{state.order_no}}</li>
              </ol>
              <div class="o_cp_searchview" role="search"></div>
            </div>
            <div>
              <div class="o_cp_left">
                <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                  <div>
                    <div
                      class="o_form_buttons_edit"
                      role="toolbar"
                      aria-label="Main actions"
                      data-original-title
                      title
                    >
                      <router-link
                        type="button"
                        class="btn btn-primary o_form_button_cancel"
                        :to="{ name:'sales_edit' }"
                      >Edit</router-link>
                      <router-link
                        type="button"
                        class="btn btn-secondary o_form_button_cancel"
                        :to="{ name:'sales_create' }"
                      >Create</router-link>
                    </div>
                  </div>
                </div>
                <aside class="o_cp_sidebar"></aside>
              </div>
              <div class="o_cp_right">
                <div class="btn-group o_search_options position-static" role="search"></div>
                <nav class="o_cp_pager" role="search" aria-label="Pager"></nav>
                <nav
                  class="btn-group o_cp_switch_buttons"
                  role="toolbar"
                  aria-label="View switcher"
                ></nav>
              </div>
            </div>
          </div>
        </div>

        <div class="o_content">
          <div class="o_form_view o_sale_order o_form_editable">
            <div class="o_form_sheet_bg">
              <div class="o_form_statusbar">
                <div class="o_statusbar_buttons">
                  <button type="button" class="btn btn-secondary o_invisible_modifier">
                    <span>Create Invoice</span>
                  </button>
                  <button v-if="state.state == 'Quotation'" type="button" class="btn btn-primary" @click="confirm_order">
                    <span>Confirm</span>
                  </button>
                  <button v-if="state.state == 'sale' && state.picking == false" type="button" class="btn btn-primary" @click="delivere_process">
                    <span>Delivery</span>
                  </button>
                  <button type="button" class="btn btn-secondary">
                    <span>Cancel</span>
                  </button>
                </div>
                <div
                  class="o_field_many2many o_field_widget o_invisible_modifier o_readonly_modifier"
                  name="authorized_transaction_ids"
                  id="o_field_input_6402"
                ></div>
                <div class="o_statusbar_status o_field_widget o_readonly_modifier" name="state">
                  <button
                    v-if="state.state == 'sale'"
                    type="button"
                    class="btn o_arrow_button btn-primary disabled"
                  >Sales Order</button>
                  <button
                    v-else
                    type="button"
                    class="btn o_arrow_button btn-secondary disabled"
                  >Sales Order</button>
                  <button
                    v-if="state.state == 'Quotation'"
                    type="button"
                    class="btn o_arrow_button btn-primary disabled"
                  >Quotation</button>
                  <button
                    v-else
                    type="button"
                    class="btn o_arrow_button btn-secondary disabled"
                  >Quotation</button>
                </div>
              </div>
              <div class="clearfix position-relative o_form_sheet">
                <div class="o_not_full oe_button_box">
                  <button type="button" name="preview_sale_order" class="btn oe_stat_button">
                    <i class="fa fa-fw o_button_icon fa-globe icon"></i>
                    <div class="o_field_widget o_stat_info">
                      <span class="o_stat_text">Customer</span>
                      <span class="o_stat_text">Preview</span>
                    </div>
                  </button>
                  <button v-if="state.receipt == true" type="button" name="action_view_delivery" class="btn oe_stat_button"><i class="fa fa-fw o_button_icon fa-truck"></i><div name="delivery_count" class="o_field_widget o_stat_info o_readonly_modifier" data-original-title="" title="">
                      <span class="o_stat_value">1</span>
                      <span class="o_stat_text">Delivery</span>
                  </div></button>
                </div>
                <div class="oe_title">
                  <h1>
                    <span
                      class="o_field_char o_field_widget o_readonly_modifier o_required_modifier"
                      name="name"
                    >{{state.order_no}}</span>
                  </h1>
                </div>
                <div class="o_group">
                  <div class="row">
                    <div class="col-6">
                      <table class="o_group o_inner_group">
                        <tbody>
                          <tr>
                            <td class="o_td_label">
                              <label class="o_form_label o_required_modifier">Customer</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_widget o_readonly_modifier o_required_modifier mr-1"
                              >{{ state.partner.display_name }}</span>
                            </td>
                          </tr>
                          <tr class="o_invisible_modifier">
                            <td class="o_td_label">
                              <label class="o_form_label" for="o_field_input_6354">Payment Terms</label>
                            </td>
                            <td style="width: 100%;">
                              <div class="o_row no-gutters d-flex">
                                <div class="col">
                                  <span
                                    class="o_field_widget o_readonly_modifier o_required_modifier mr-1"
                                  >{{payment_terms}}</span>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label class="o_form_label">Reference</label>
                            </td>
                            <td style="width: 100%;">
                              <div class="o_field_widget o_field_many2one">
                                <div class="o_input_dropdown">
                                  <span
                                    class="o_field_widget o_readonly_modifier o_required_modifier mr-1"
                                  >{{state.customer_reference}}</span>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-6">
                      <table class="o_group o_inner_group">
                        <tbody>
                          <tr>
                            <td class="o_td_label">
                              <label class="o_form_label" for="o_field_input_6350">Expiration</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_widget o_readonly_modifier o_required_modifier mr-1"
                              >{{state.expiration}}</span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <div invisible="1">
                                <label
                                  class="o_form_label"
                                  for="o_field_input_6351"
                                  data-original-title
                                  title
                                >
                                  Order
                                  Date
                                </label>
                              </div>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_widget o_readonly_modifier o_required_modifier mr-1"
                              >{{state.order_date}}</span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="o_notebook">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a
                        data-toggle="tab"
                        disable_anchor="true"
                        href="#notebook_page_6355"
                        class="nav-link active"
                        role="tab"
                        aria-selected="true"
                      >Order Lines</a>
                    </li>
                    <li class="nav-item">
                      <a
                        data-toggle="tab"
                        disable_anchor="true"
                        href="#notebook_page_6366"
                        class="nav-link"
                        role="tab"
                        aria-selected="false"
                      >Other Info</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="notebook_page_6355">
                      <div
                        class="o_field_one2many o_field_widget o_field_x2many o_field_x2many_list"
                        name="order_line"
                        id="o_field_input_6412"
                      >
                        <div class="o_list_view o_list_optional_columns">
                          <div class="table-responsive">
                            <table
                              class="o_list_table table table-sm table-hover table-striped o_list_table_ungrouped o_empty_list o_section_and_note_list_view"
                              style="table-layout: fixed;"
                            >
                              <thead>
                                <tr>
                                  <th
                                    data-name="sequence"
                                    class="o_handle_cell o_column_sortable o_list_number_th"
                                    tabindex="-1"
                                    title
                                    style="width: 33px;"
                                  ></th>
                                  <th
                                    data-name="product_id"
                                    class="o_product_configurator_cell o_column_sortable"
                                    tabindex="-1"
                                    title="Product"
                                    style="width: 32.2581%;"
                                  >Product</th>
                                  <th
                                    data-name="product_id"
                                    class="o_product_configurator_cell o_column_sortable"
                                    tabindex="-1"
                                    title="Product"
                                    style="width: 32.2581%;"
                                  >Description</th>
                                  <th
                                    data-name="product_uom_qty"
                                    tabindex="-1"
                                    class="o_column_sortable o_list_number_th"
                                    title="Quantity"
                                    style="width: 92px;"
                                  >Quantity</th>
                                  <th
                                    data-name="product_uom_qty"
                                    tabindex="-1"
                                    class="o_column_sortable o_list_number_th"
                                    title="Quantity"
                                    style="width: 92px;"
                                  >UoM</th>
                                  <th
                                    data-name="price_unit"
                                    tabindex="-1"
                                    class="o_column_sortable o_list_number_th"
                                    title="Unit Price"
                                    style="width: 92px;"
                                  >Unit Price</th>
                                  <th
                                    data-name="tax_id"
                                    class="o_many2many_tags_cell o_column_sortable"
                                    tabindex="-1"
                                    title="Taxes"
                                    style="width: 32.2581%;"
                                  >Taxes (%)</th>
                                  <th
                                    data-name="price_subtotal"
                                    class="o_monetary_cell o_column_sortable o_list_number_th"
                                    tabindex="-1"
                                    title="Subtotal"
                                    style="width: 104px;"
                                  >Subtotal</th>
                                  <th class="o_list_record_remove_header" style="width: 32px;"></th>
                                </tr>
                              </thead>
                              <tbody class="ui-sortable">
                                <tr
                                  class="o_data_row o_selected_row"
                                  v-for="line in state.products"
                                  v-bind:key="line.index"
                                >
                                  <td
                                    class="o_data_cell o_field_cell o_list_number o_handle_cell"
                                    tabindex="-1"
                                  >
                                    <span
                                      class="o_row_handle fa fa-arrows ui-sortable-handle o_field_widget"
                                      name="sequence"
                                    ></span>
                                  </td>
                                  <td
                                    class="o_data_cell o_field_cell o_list_many2one o_product_configurator_cell"
                                  >
                                    <span
                                      class="o_input o_field_widget"
                                    >{{line.product.name}}
                                    </span>
                                  </td>
                                  <td
                                    class="o_data_cell o_field_cell o_list_text o_section_and_note_text_cell"
                                    tabindex="-1"
                                    title="Product Description"
                                  >
                                    <span
                                      class="o_field_text o_field_widget o_input"
                                    >{{line.description}}</span>
                                  </td>
                                  <td class="o_data_cell o_field_cell o_list_number" tabindex="-1">
                                    <span
                                      class="o_field_float o_field_number o_field_widget o_input"
                                    >{{line.qty}}</span>
                                  </td>
                                  <td
                                    class="o_data_cell o_field_cell o_list_many2one o_product_configurator_cell"
                                  >
                                    <span
                                      class="o_field_float o_field_number o_field_widget o_input"
                                    >{{line.uom.name}}</span>
                                  </td>
                                  <td class="o_data_cell o_field_cell o_list_number" tabindex="-1">
                                    <span
                                      class="o_field_float o_field_number o_field_widget o_input"
                                    >{{line.price}}</span>
                                  </td>
                                  <td class="o_data_cell o_field_cell o_list_number" tabindex="-1">
                                    <span
                                      class="o_field_float o_field_number o_field_widget o_input"
                                    >{{line.taxes}}</span>
                                  </td>
                                  <td
                                    class="o_data_cell o_field_cell o_list_number o_monetary_cell o_readonly_modifier"
                                    tabindex="-1"
                                  >
                                    <span
                                      class="o_field_monetary o_field_number o_field_widget o_readonly_modifier"
                                    >{{formatPrice(line.price_subtotal)}}</span>
                                  </td>
                                  <td class="o_list_record_remove">
                                    <span></span>
                                  </td>
                                </tr>
                              </tbody>
                              <tfoot>
                                <tr>
                                  <td colspan="8"></td>
                                </tr>
                              </tfoot>
                              <i class="o_optional_columns_dropdown_toggle fa fa-ellipsis-v"></i>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="o_group">
                        <table class="o_group o_inner_group o_group_col_8">
                          <tbody>
                            <tr>
                              <td style="width: 50%;">
                                <span
                                  class="o_field_widget o_readonly_modifier o_required_modifier mr-1"
                                  placeholder="Terms and conditions..."
                                  type="text"
                                  style="overflow-y: hidden; height: 50px; resize: none;"
                                >{{state.note}}</span>
                                <textarea
                                  disabled
                                  style="position: absolute; opacity: 0; height: 10px; border-top-width: 0px; border-bottom-width: 0px; padding: 0px; overflow: hidden; top: -10000px; left: -10000px; width: 698px;"
                                ></textarea>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <table
                          class="o_group o_inner_group oe_subtotal_footer oe_right o_group_col_4"
                        >
                          <tbody>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label o_readonly_modifier"
                                  for="o_field_input_6356"
                                >Untaxed Amount</label>
                              </td>
                              <td style="width: 100%;">
                                <span
                                  class="o_field_monetary o_field_number o_field_widget o_readonly_modifier"
                                >{{formatPrice(state.sub_total)}}</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label o_readonly_modifier"
                                  for="o_field_input_6357"
                                >Taxes</label>
                              </td>
                              <td style="width: 100%;">
                                <span
                                  class="o_field_monetary o_field_number o_field_widget o_readonly_modifier"
                                >{{formatPrice(state.taxes)}}</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <div class="oe_subtotal_footer_separator oe_inline">
                                  <label class="o_form_label" for="o_field_input_6358">Total</label>
                                </div>
                              </td>
                              <td style="width: 100%;">
                                <span
                                  class="o_field_monetary o_field_number o_field_widget o_readonly_modifier oe_subtotal_footer_separator"
                                >{{formatPrice(state.grand_total)}}</span>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="oe_clear o_group_col_2"></div>
                      </div>
                    </div>
                    <div class="tab-pane" id="notebook_page_6366">
                      <div class="o_group">
                        <div class="row">
                          <div class="col-6">
                            <table class="o_group o_inner_group">
                              <tbody>
                                <tr>
                                  <td colspan="2" style="width: 100%;">
                                    <div class="o_horizontal_separator">Sales</div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="o_td_label">
                                    <label class="o_form_label" for="o_field_input_6367">Salesperson</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <span
                                      class="o_field_widget o_readonly_modifier o_required_modifier mr-1"
                                    >{{ state.sales_person.employee_name }}</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="o_td_label">
                                    <label
                                      class="o_form_label o_required_modifier"
                                      for="o_field_input_6369"
                                    >Company</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <span
                                      class="o_field_widget o_readonly_modifier o_required_modifier mr-1"
                                    >{{ state.company.company_name }}</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="o_td_label">
                                    <label
                                      class="o_form_label o_invisible_modifier o_readonly_modifier"
                                      for="o_field_input_6372"
                                      data-original-title
                                      title
                                    >Payment Ref.</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <span
                                      class="o_field_char o_field_widget o_invisible_modifier o_readonly_modifier"
                                      name="reference"
                                    ></span>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="col-6">
                            <table class="o_group o_inner_group">
                              <tbody>
                                <tr>
                                  <td colspan="2" style="width: 100%;">
                                    <div class="o_horizontal_separator">Delivery</div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="o_td_label">
                                    <label
                                      class="o_form_label o_required_modifier"
                                      for="o_field_input_6377"
                                    >Warehouse</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <div
                                      class="o_field_widget o_field_many2one o_with_button o_required_modifier"
                                      aria-atomic="true" 
                                      name="warehouse_id"
                                    >
                                      <select
                                        class="o_input o_field_widget ui-autocomplete-input"
                                        name="type" disabled
                                        v-model="state.product_warehouse_id"
                                      >
                                        <option
                                          v-for="row in warehouse"
                                          :select="row.id == state.product_warehouse_id"
                                          :key="row.id"
                                          :value="row.id"
                                        >{{ row.name }}</option>
                                      </select>
                                      <button
                                        type="button"
                                        class="fa fa-external-link btn btn-secondary o_external_button"
                                        tabindex="-1"
                                        draggable="false"
                                        aria-label="External link"
                                        title="External link"
                                      ></button>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="o_td_label">
                                    <label
                                      class="o_form_label o_required_modifier"
                                      for="o_field_input_6379"
                                      data-original-title
                                      title
                                    >Shipping Policy</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <select
                                      class="o_input o_field_widget ui-autocomplete-input"
                                      name="type" disabled
                                      v-model="state.shipping_policy"
                                    >
                                      <option
                                        v-for="row in shipping_policy"
                                        :select="row.value == state.shipping_policy"
                                        :key="row.value"
                                        :value="row.value"
                                      >{{ row.label }}</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="o_td_label">
                                    <label
                                      class="o_form_label"
                                      for="o_field_input_6380"
                                      data-original-title
                                      title
                                    >Delivery Date</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <div class="o_row">
                                      <div
                                        class="o_datepicker o_field_date o_field_widget"
                                        aria-atomic="true"
                                        id="datepicker6395"
                                        data-target-input="nearest"
                                        name="commitment_date"
                                      >
                                        <input
                                          type="text"
                                          class="o_datepicker_input o_input datetimepicker-input"
                                          name="commitment_date"
                                          data-target="#datepicker6395"
                                          placeholder readonly
                                          id="o_field_input_6380"
                                        />
                                        <span class="o_datepicker_button"></span>
                                      </div>
                                      <span class="text-muted">
                                        Expected:
                                        <span
                                          class="o_field_date o_field_widget o_readonly_modifier"
                                          name="expected_date"
                                          data-original-title
                                          title
                                        ></span>
                                      </span>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>
<script>
export default {
  data() {
    return {
      value: 0,
      payment_terms: "Immediate Payment",
      productlist: [],
      customer: [],
      state: {},
      delivery_no:null,
      shipping_policy: [
        { label: "As soon as possible", value: "direct" },
        { label: "When all products are ready", value: "one" },
      ],
      uom: [],
      warehouse: [],
      company: [],
      sales: [],
    };
  },
  created() {
    axios.get(`/api/sale/search/${atob(this.$route.params.id)}`).then(response => {
      this.state = response.data.result;
    }).catch(error => console.error(error));
  },
  mounted() {
    this.fetchproducts();
    this.fetchWarehouse();
    this.fetchCompany();
    this.fetchEmployees();
    this.fetchUser();
  },
  methods: {
    addLine: function () {
      this.value += 1;
      this.state.products.push({
        index: this.value,
        name: "",
        description: "",
        price: 0,
        qty: 1,
        taxes: 0,
        product_uom: 0,
        product_uom_category: 0,
        price_tax: 0,
        price_subtotal: 0,
        total: 0,
      });
    },
    remove: function (product) {
      this.value -= 1;
      this.state.products.$remove(product);
    },
    fetchCompany() {
      axios
        .get("/api/company")
        .then((response) => {
          this.company = response.data.data;
        })
        .catch((error) => console.error(error));
    },
    fetchproducts() {
      axios
        .get("/api/Products/sale")
        .then((response) => {
          this.productlist = response.data.data;
        })
        .catch((error) => console.error(error));
    },
    fetchWarehouse() {
      axios
        .get("/api/warehouse")
        .then((response) => {
          this.warehouse = response.data.result;
        })
        .catch((error) => console.error(error));
    },
    fetchPartner() {
      axios
        .post("/api/customer/list")
        .then((response) => {
          this.customer = response.data.result;
        })
        .catch((error) => console.error(error));
    },
    fetchEmployees() {
      axios
        .get("/api/employee/list")
        .then((response) => {
          this.sales = response.data.result;
        })
        .catch((error) => console.error(error));
    },
    fetchUser() {
      this.user = document.getElementById("current_email").value;
      const url = "/api/employee/search?email=" + this.user;
      axios
        .post(url)
        .then((response) => {
          this.result = response.data.data;
          this.state.sales = this.result.id;
        })
        .catch((error) => console.error(error));
    },
    compute_PriceUom(self, uom_type, factor, new_uom) {
      const params = { id: self.name };
      axios
        .get("/api/getProduct/id", { params })
        .then((response) => {
          this.value = response.data.data;
          this.price = this.value.price;
          axios
            .get(`/api/uom/get_uom/${self.product_uom}`)
            .then((response) => {
              this.result = response.data.result;
              this.type = this.result.uom_type;
              this.factor = this.result.factor;
              if (this.type == "reference") {
                self.price = (self.price / factor).toFixed(0);
                self.product_uom = new_uom;
                this.compute_total(self);
              } else {
                this.reference_price = (self.price * this.factor).toFixed(0);
                self.price = (this.reference_price / factor).toFixed(0);
                self.product_uom = new_uom;
                this.compute_total(self);
              }
            })
            .catch((error) => console.error(error));
        })
        .catch((error) => console.error(error));
    },
    compute_total(product) {
      product.price_subtotal = product.qty * product.price;
      product.price_tax = product.price_subtotal * (product.taxes / 100);
      product.total = product.price_subtotal + product.price_tax;
      this.state.sub_total = this.compute_subTotal();
      this.state.taxes = this.compute_subTaxes();
      this.state.grand_total = this.compute_grandTotal();
    },
    compute_subTotal() {
      return this.state.products.reduce(function (carry, product) {
        return carry + parseFloat(product.qty) * parseFloat(product.price);
      }, 0);
    },
    compute_subTaxes() {
      return this.state.products.reduce(function (carry, product) {
        return carry + parseFloat(product.price_tax);
      }, 0);
    },
    compute_grandTotal() {
      return this.state.sub_total + this.state.taxes;
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(2).replace(",", ".");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
    confirm_order(){
      axios.post("/api/sale/confirm", this.state)
      .then((response) => {
        if (response.data.status == "success") {
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$router.push({ name: "sales_index" });
        } else {
          Swal.fire({
            type: "warning",
            title: "Something went wrong!",
            text: response.data.message,
          });
        }
      })
      .catch((error) => {
        if (error) {
          if (error.response.status == 422) {
            var error = error.response.data.errors;
            console.log(error)
            error = error[Object.keys(error)[0]];
            Swal.fire({
              type: "warning",
              title: "Something went wrong!",
              text: error[0],
            });
          }
        }
      });
    },
    delivere_orders(){
       axios.post("/api/sale/delivere", this.state)
      .then((response) => {
        if (response.data.status == "success") {
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$router.push({ name: "delivery_form", params:{id : btoa(this.delivery_no)}});
        } else {
          Swal.fire({
            type: "warning",
            title: "Something went wrong!",
            text: response.data.message,
          });
        }
      })
    },
    delivere_process(){
      axios.post("/api/stock_pickings/store", this.state)
      .then((response) => {
        if (response.data.status == "success") {
          this.delivery_no = response.data.message
          this.delivere_orders();
        } else {
          Swal.fire({
            type: "warning",
            title: "Something went wrong!",
            text: response.data.message,
          });
        }
      })
    },
    submit($e) {
      axios
        .post("/api/sale/update", this.state)
        .then((response) => {
          if (response.data.status == "success") {
            Toast.fire({
              icon: "success",
              title: response.data.message,
            });
            this.$router.push({ name: "sales_index" });
          } else {
            Swal.fire({
              type: "warning",
              title: "Something went wrong!",
              text: response.data.message,
            });
          }
        })
        .catch((error) => {
          if (error) {
            if (error.response.status == 422) {
              var error = error.response.data.errors;
              console.log(error)
              error = error[Object.keys(error)[0]];
              Swal.fire({
                type: "warning",
                title: "Something went wrong!",
                text: error[0],
              });
            }
          }
        });
    },
  },
};
</script>