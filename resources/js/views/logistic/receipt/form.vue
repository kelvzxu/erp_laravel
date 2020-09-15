<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item">
                <router-link class="text-primary" :to="{ name:'logistic_dasboard' }">Logistics Dasboard</router-link>
              </li>
              <li class="breadcrumb-item" accesskey="b">
                <router-link class="text-primary" :to="{ name:'receipt_index', params:{id : warehouse_id} }">{{state.purchases_warehouse.name}}: Receipts</router-link>
              </li>
              <li class="breadcrumb-item active">{{state.name}}</li>
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
                    <button
                      type="button"
                      class="btn btn-primary o_form_button_save"
                      accesskey="s"
                    >Save</button>
                    <button
                      type="button"
                      class="btn btn-secondary o_form_button_cancel"
                      accesskey="j"
                    >Discard</button>
                  </div>
                </div>
              </div>
              <aside class="o_cp_sidebar">
                <div class="btn-group o_hidden"></div>
              </aside>
            </div>
            <div class="o_cp_right">
              <div class="btn-group o_search_options position-static" role="search"></div>
              <nav class="o_cp_pager" role="search" aria-label="Pager"></nav>
              <nav class="btn-group o_cp_switch_buttons" role="toolbar" aria-label="View switcher"></nav>
            </div>
          </div>
        </div>
      </div>

      <div class="o_content">
        <div class="o_form_view o_form_editable">
          <div class="o_form_sheet_bg">
            <div class="o_form_statusbar">
              <div class="o_statusbar_buttons">
                <button
                  type="button"
                  v-if="state.state == 'draft'"
                  @click="MarkAsTodo"
                  class="btn btn-primary"
                >
                  <span>Mark as Todo</span>
                </button>
                <button
                  type="button"
                  v-if="state.state == 'Ready'"
                  @click="validate"
                  class="btn btn-primary"
                >
                  <span>Validate</span>
                </button>
                <button
                  type="button"
                  name="do_print_picking"
                  class="btn btn-secondary"
                  data-original-title
                  title
                >
                  <span>Print</span>
                </button>
                <button
                  type="button"
                  name="500"
                  class="btn btn-secondary o_invisible_modifier"
                  data-original-title
                  title
                >
                  <span>Print</span>
                </button>
                <button
                  type="button"
                  name="520"
                  class="btn btn-secondary o_invisible_modifier"
                  data-original-title
                  title
                >
                  <span>Return</span>
                </button>
                <button
                  type="button"
                  name="do_unreserve"
                  class="btn btn-secondary"
                  data-original-title
                  title
                >
                  <span>Unreserve</span>
                </button>
                <button
                  type="button"
                  name="button_scrap"
                  class="btn btn-secondary"
                  data-original-title
                  title
                >
                  <span>Scrap</span>
                </button>
                <button
                  type="button"
                  name="action_toggle_is_locked"
                  help="If the picking is unlocked you can edit initial demand (for a draft picking) or done quantities (for a done picking)."
                  class="btn btn-secondary"
                  data-original-title
                  title
                >
                  <span>Unlock</span>
                </button>
                <button
                  type="button"
                  name="action_toggle_is_locked"
                  class="btn btn-primary o_invisible_modifier"
                  data-original-title
                  title
                >
                  <span>Lock</span>
                </button>
                <button
                  type="button"
                  name="action_cancel"
                  class="btn btn-secondary"
                  data-original-title
                  title
                >
                  <span>Cancel</span>
                </button>
              </div>
              <div
                class="o_statusbar_status o_field_widget o_readonly_modifier"
                >
                <button
                  type="button"
                  v-if="state.state == 'Done'"
                  class="btn o_arrow_button btn-primary disabled"
                >Done</button>
                <button
                  type="button"
                  v-else
                  class="btn o_arrow_button btn-secondary disabled"
                >Done</button>

                <button
                  type="button"
                  v-if="state.state == 'Ready'"
                  class="btn o_arrow_button btn-primary disabled"
                >Ready</button>
                <button
                  type="button"
                  v-else
                  class="btn o_arrow_button btn-secondary disabled"
                >Ready</button>

                <button
                  type="button"
                  data-value="confirmed"
                  disabled="disabled"
                  title="Not active state"
                  aria-pressed="false"
                  class="btn o_arrow_button btn-secondary disabled"
                >Waiting</button>

                <button
                  type="button"
                  v-if="state.state == 'draft'"
                  class="btn o_arrow_button btn-primary disabled"
                >Draft</button>

                <button
                  type="button"
                  v-else
                  class="btn o_arrow_button btn-secondary disabled"
                >Draft</button>
              </div>
              <div
                class="o_field_boolean o_field_widget custom-control custom-checkbox o_invisible_modifier o_readonly_modifier"
                name="picking_type_entire_packs"
                data-original-title
                title
              >
                <input type="checkbox" id="checkbox-497" class="custom-control-input" disabled />
                <label for="o_field_input_470" class="custom-control-label">&#8203;</label>
              </div>
            </div>
            <div class="clearfix position-relative o_form_sheet">
              <div class="o_not_full oe_button_box">
                <button
                  type="button"
                  name="action_picking_move_tree"
                  class="btn oe_stat_button"
                  help="List view of operations"
                  context="{'picking_type_code': picking_type_code, 'default_picking_id': id, 'form_view_ref':'stock.view_move_form', 'address_in_id': partner_id, 'default_picking_type_id': picking_type_id, 'default_location_id': location_id, 'default_location_dest_id': location_dest_id}"
                  data-original-title
                  title
                >
                  <i class="fa fa-fw o_button_icon fa-arrows-v"></i>
                  <div class="o_form_field o_stat_info">
                    <span class="o_stat_text">Operations</span>
                  </div>
                </button>
                <div
                  class="o_field_boolean o_field_widget custom-control custom-checkbox o_invisible_modifier o_readonly_modifier"
                  name="has_scrap_move"
                  data-original-title
                  title
                >
                  <input type="checkbox" id="checkbox-498" class="custom-control-input" disabled />
                  <label for="o_field_input_471" class="custom-control-label">&#8203;</label>
                </div>
                <div
                  class="o_field_boolean o_field_widget custom-control custom-checkbox o_invisible_modifier o_readonly_modifier"
                  name="has_tracking"
                  data-original-title
                  title
                >
                  <input type="checkbox" id="checkbox-499" class="custom-control-input" disabled />
                  <label for="o_field_input_472" class="custom-control-label">&#8203;</label>
                </div>
                <button
                  type="button"
                  name="action_see_move_scrap"
                  class="btn oe_stat_button o_invisible_modifier"
                >
                  <i class="fa fa-fw o_button_icon fa-arrows-v"></i>
                  <span>Scraps</span>
                </button>
                <button
                  type="button"
                  name="action_see_packages"
                  class="btn oe_stat_button o_invisible_modifier"
                >
                  <i class="fa fa-fw o_button_icon fa-cubes"></i>
                  <span>Packages</span>
                </button>
                <button
                  type="button"
                  name="496"
                  class="btn oe_stat_button o_invisible_modifier"
                  invisible="1"
                >
                  <i class="fa fa-fw o_button_icon fa-arrow-up"></i>
                  <span>Traceability</span>
                </button>
                <button
                  type="button"
                  name="action_view_stock_valuation_layers"
                  class="btn oe_stat_button o_invisible_modifier"
                >
                  <i class="fa fa-fw o_button_icon fa-dollar"></i>
                  <span>Valuation</span>
                </button>
              </div>
              <h1 class="d-none d-md-block">
                <span
                  class="o_field_char o_field_widget o_readonly_modifier"
                  name="name"
                  data-original-title
                  title
                >{{state.name}}</span>
              </h1>
              <div class="o_group">
                <div class="row">
                  <div class="col-6">
                    <table class="o_group o_inner_group">
                      <tbody>
                        <tr>
                          <td class="o_td_label">
                            <div class>
                              <label
                                class="o_form_label"
                                for="o_field_input_425"
                                style="font-weight:bold;"
                                data-original-title
                                title
                              >Delivery Address</label>
                            </div>
                          </td>
                          <td style="width: 100%;">
                            <a
                              class="o_form_uri o_field_widget o_readonly_modifier o_required_modifier"
                              @click="viewCustomer" style="cursor:pointer;"
                            >
                              <span>{{state.purchases_order.partner.display_name}}</span>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_readonly_modifier o_required_modifier"
                              for="o_field_input_426"
                              data-original-title
                              title
                            >Operation Type</label>
                          </td>
                          <td style="width: 100%;">
                            <span
                              class="o_field_widget o_readonly_modifier o_required_modifier mr-1"
                            >{{state.company.company_name}}: {{state.picking_type}}</span>
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
                            <label
                              class="o_form_label o_required_modifier"
                              for="o_field_input_430"
                              data-original-title
                              title
                            >Scheduled Date</label>
                          </td>
                          <td style="width: 100%;">
                            <span
                              class="o_field_widget o_readonly_modifier o_required_modifier mr-1"
                            >{{state.schedule_date}}</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label"
                              for="o_field_input_432"
                              data-original-title
                              title
                            >Source Document</label>
                          </td>
                          <td style="width: 100%;">
                            <a
                              class="o_form_uri o_field_widget o_readonly_modifier o_required_modifier"
                              @click="viewCustomer" style="cursor:pointer;"
                            >
                              <span>{{state.origin}}</span>
                            </a>
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
                      href="#notebook_page_484"
                      class="nav-link active"
                      role="tab"
                    >Operations</a>
                  </li>
                  <li class="nav-item">
                    <a
                      data-toggle="tab"
                      disable_anchor="true"
                      href="#notebook_page_485"
                      class="nav-link"
                      role="tab"
                    >Additional Info</a>
                  </li>
                  <li class="nav-item">
                    <a
                      data-toggle="tab"
                      disable_anchor="true"
                      href="#notebook_page_486"
                      class="nav-link"
                      role="tab"
                    >Note</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="notebook_page_484">
                    <div
                      class="o_field_one2many o_field_widget o_field_x2many o_field_x2many_list"
                      name="move_ids_without_package"
                      id="o_field_input_480"
                      data-original-title
                      title
                    >
                      <div class="o_list_view o_list_optional_columns">
                        <div class="table-responsive">
                          <table
                            class="o_list_table table table-sm table-hover table-striped o_list_table_ungrouped"
                            style="table-layout: fixed;"
                          >
                            <thead>
                              <tr>
                                <th
                                  data-name="product_id"
                                  style="width: 223px;"
                                >
                                  Product
                                  <span class="o_resize"></span>
                                </th>
                                <th
                                  data-name="product_description"
                                  style="min-width: 92px; width: 367px;"
                                >
                                  Description
                                  <span class="o_resize"></span>
                                </th>
                                <th
                                  data-name="product_uom_qty"
                                  style="min-width: 92px; width: 183px;"
                                >
                                  Demand
                                  <span class="o_resize"></span>
                                </th>
                                <th
                                  data-name="quantity_done"
                                  style="min-width: 92px; width: 183px;"
                                >
                                  Done
                                  <span class="o_resize"></span>
                                </th>
                                <th class="o_list_record_remove_header" style="width: 32px;"></th>
                              </tr>
                            </thead>
                            <tbody class="ui-sortable">
                              <tr class="o_data_row o_selected_row" v-for="line in state.picking_line"
                                  v-bind:key="line.id">
                                <td
                                  class="o_data_cell o_field_cell o_list_many2one o_readonly_modifier o_required_modifier">
                                  <span
                                    class="o_field_widget o_readonly_modifier o_required_modifier mr-1"
                                  >{{line.product.name}}</span>
                                </td>
                                <td
                                  class="o_field_widget o_readonly_modifier"
                                >
                                  <span
                                    class="o_field_float o_field_number o_field_widget o_readonly_modifier"
                                  >{{line.description}}</span>
                                </td>
                                <td
                                  class="o_data_cell o_field_cell o_list_number o_readonly_modifier o_required_modifier"
                                >
                                  <span
                                    class="o_field_float o_field_number o_field_widget o_readonly_modifier o_required_modifier"
                                  >{{line.qty}}</span>
                                </td>
                                <td
                                  class="o_data_cell o_field_cell o_list_number"
                                >
                                  <input
                                    class="o_field_float o_field_number o_field_widget o_input"
                                    v-model="line.done_qty"
                                  />
                                </td>
                                <td class="o_list_record_remove"></td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td class="product_id"></td>
                                <td class="product_uom_qty"></td>
                                <td class="reserved_availability"></td>
                                <td class="quantity_done"></td>
                                <td></td>
                              </tr>
                            </tfoot>
                            <i class="o_optional_columns_dropdown_toggle fa fa-ellipsis-v"></i>
                          </table>
                        </div>
                        <div class="o_optional_columns text-center dropdown">
                          <a
                            class="dropdown-toggle text-dark o-no-caret"
                            href="#"
                            role="button"
                            data-toggle="dropdown"
                            aria-expanded="false"
                          ></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="notebook_page_485">
                    <div class="o_group">
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Other Information</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_readonly_modifier"
                              >Type of Operation</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_widget o_readonly_modifier"
                              >{{state.picking_type}}</span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_required_modifier"
                                for="o_field_input_439"
                                data-original-title
                                title
                              >Shipping Policy</label>
                            </td>
                            <td style="width: 100%;">
                              <select
                                class="o_input o_field_widget ui-autocomplete-input"
                                name="type"
                                v-model="state.move_type"
                              >
                                <option
                                  v-for="row in shipping_policy"
                                  :select="row.value == state.move_type"
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
                                for="o_field_input_441"
                                data-original-title
                                title
                              >Responsible</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                  class="o_field_widget o_readonly_modifier o_required_modifier mr-1"
                                >{{state.responsible.employee_name}}</span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_readonly_modifier"
                                for="o_field_input_442"
                                data-original-title
                                title
                              >Procurement Group</label>
                            </td>
                            <td style="width: 100%;">
                              <a
                                class="o_form_uri o_field_widget o_readonly_modifier"
                                href="#id=1&amp;model=procurement.group"
                                name="group_id"
                                id="o_field_input_442"
                              >
                                <span>{{state.origin}}</span>
                              </a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane" id="notebook_page_486">
                    <textarea
                      class="o_field_text o_field_widget o_input"
                      name="note"
                      placeholder="Add an internal note that will be printed on the Picking Operations sheet"
                      type="text"
                      id="o_field_input_474"
                      style="overflow-y: hidden; height: 50px; resize: none;"
                      data-original-title
                      title
                    ></textarea>
                    <textarea
                      disabled
                      style="position: absolute; opacity: 0; height: 10px; border-top-width: 0px; border-bottom-width: 0px; padding: 0px; overflow: hidden; top: -10000px; left: -10000px; width: 0px;"
                    ></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      state:{},
      warehouse_id:null,
      shipping_policy: [
        { label: "As soon as possible", value: "direct" },
        { label: "When all products are ready", value: "one" },
      ],
    }
  },
  created() {
    axios.get(`/api/stock_pickings/search/${atob(this.$route.params.id)}`).then(response => {
      this.state = response.data.result;
      console.log(this.state)
      this.warehouse_id = btoa(this.state.purchases_warehouse.id);
    }).catch(error => console.error(error));
  },
  mounted() {
    console.log('mounted')
  },
  methods: {
    viewCustomer() {
      alert('okkk')
    },
    MarkAsTodo(){
      axios.post("/api/stock_pickings/todo", this.state)
      .then((response) => {
        if (response.data.status == "success") {
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$router.push({ name:'receipt_index', params:{id : this.warehouse_id} });
        } else {
          Swal.fire({
            type: "warning",
            title: "Something went wrong!",
            text: response.data.message,
          });
        }
      });
    },
    validate_picking() {
      axios
        .post("/api/stock_pickings/validate", this.state)
        .then((response) => {
          if (response.data.status == "success") {
            Toast.fire({
              icon: "success",
              title: response.data.message,
            });
            this.$router.push({ name:'receipt_index', params:{id : this.warehouse_id} });
          } else {
            Swal.fire({
              type: "warning",
              title: "Something went wrong!",
              text: response.data.message,
            });
          }
        });
    },
    validate() {
      this.validate_picking();
    },
  }

};
</script>
