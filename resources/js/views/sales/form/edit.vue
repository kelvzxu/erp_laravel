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
                      <button
                        type="submit"
                        class="btn btn-primary text-white o_form_button_save"
                        accesskey="s"
                      >Save</button>
                      <router-link
                        type="button"
                        class="btn btn-secondary o_form_button_cancel"
                        :to="{ name:'sales_index' }"
                      >Discard</router-link>
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
                  <button type="button" class="btn btn-primary o_invisible_modifier">
                    <span>Confirm</span>
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
                <div v-if="state.state == 'Quotation'" class="o_statusbar_status o_field_widget o_readonly_modifier" name="state">
                  <button
                    type="button"
                    data-value="sale"
                    disabled="disabled"
                    title="Not active state"
                    aria-pressed="false"
                    class="btn o_arrow_button btn-secondary disabled"
                  >Sales Order</button>
                  <button
                    type="button"
                    data-value="draft"
                    disabled="disabled"
                    title="Current state"
                    aria-pressed="true"
                    class="btn o_arrow_button btn-primary disabled"
                    aria-current="step"
                  >Quotation</button>
                </div>
                <div v-if="state.state == 'sale'" class="o_statusbar_status o_field_widget o_readonly_modifier" name="state">
                  <button
                    type="button"
                    data-value="draft"
                    disabled="disabled"
                    title="Current state"
                    aria-pressed="true"
                    class="btn o_arrow_button btn-primary disabled"
                    aria-current="step"
                  >Sales Order</button>
                  <button
                    type="button"
                    data-value="sale"
                    disabled="disabled"
                    title="Not active state"
                    aria-pressed="false"
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
                              <select
                                class="o_input o_field_widget o_required_modifier"
                                @change="onChangePartner(state)"
                                v-model="state.customer"
                              >
                                <option
                                  v-for="row in customer"
                                  :select="row.id == state.customer"
                                  :key="row.id"
                                  :value="row.id"
                                >{{ row.display_name }}</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
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
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    v-model="state.customer_reference"
                                  />
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
                              <div
                                class="o_datepicker o_field_date o_field_widget"
                                aria-atomic="true"
                                id="datepicker6390"
                                data-target-input="nearest"
                                name="validity_date"
                              >
                                <input
                                  type="date"
                                  class="o_field_text o_input datetimepicker-input"
                                  v-model="state.expiration"
                                />
                                <span class="o_datepicker_button"></span>
                              </div>
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
                              <div
                                class="o_datepicker o_field_date o_field_widget o_required_modifier"
                                aria-atomic="true"
                                id="datepicker6391"
                                data-target-input="nearest"
                                name="date_order"
                              >
                                <span
                                  type="text"
                                  class="o_datepicker_input o_input datetimepicker-input"
                                >{{state.order_date}}</span>
                                <span class="o_datepicker_button"></span>
                              </div>
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
                                  v-for="product in state.products"
                                  v-bind:key="product.index"
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
                                    <select
                                      class="o_input o_field_widget"
                                      @change="onChange(product)"
                                      v-model="product.name"
                                    >
                                      <option
                                        v-for="row in productlist"
                                        :select="row.id == product.name"
                                        :key="row.id"
                                        :value="row.id"
                                      >{{ row.name }}</option>
                                    </select>
                                  </td>
                                  <td
                                    class="o_data_cell o_field_cell o_list_text o_section_and_note_text_cell"
                                    tabindex="-1"
                                    title="Product Description"
                                  >
                                    <input
                                      class="o_field_text o_field_widget o_input"
                                      v-model="product.description"
                                    />
                                  </td>
                                  <td class="o_data_cell o_field_cell o_list_number" tabindex="-1">
                                    <input
                                      class="o_field_float o_field_number o_field_widget o_input"
                                      @change="compute_qty(product, $event)"
                                      :value="product.qty"
                                    />
                                  </td>
                                  <td
                                    class="o_data_cell o_field_cell o_list_many2one o_product_configurator_cell"
                                  >
                                    <select
                                      class="o_input o_field_widget"
                                      @change="onChangeUom(product,$event)"
                                      :value="product.product_uom"
                                    >
                                      <option
                                        v-for="row in uom"
                                        :select="row.id == product.product_uom"
                                        :key="row.id"
                                        :value="row.id"
                                      >{{row.name}}</option>
                                    </select>
                                  </td>
                                  <td class="o_data_cell o_field_cell o_list_number" tabindex="-1">
                                    <input
                                      class="o_field_float o_field_number o_field_widget o_input"
                                      name="price_unit"
                                      @change="compute_price(product)"
                                      v-model="product.price"
                                    />
                                  </td>
                                  <td class="o_data_cell o_field_cell o_list_number" tabindex="-1">
                                    <input
                                      type="text"
                                      @change="compute_total(product)"
                                      class="o_field_float o_field_number o_field_widget o_input"
                                      v-model="product.taxes"
                                    />
                                  </td>
                                  <td
                                    class="o_data_cell o_field_cell o_list_number o_monetary_cell o_readonly_modifier"
                                    tabindex="-1"
                                  >
                                    <span
                                      class="o_field_monetary o_field_number o_field_widget o_readonly_modifier"
                                    >{{formatPrice(product.price_subtotal)}}</span>
                                  </td>
                                  <td class="o_list_record_remove">
                                    <span class="fa fa-trash-o" @click="remove(product)"></span>
                                  </td>
                                </tr>
                              </tbody>
                              <tfoot>
                                <tr class="bg-white">
                                  <td></td>
                                  <td colspan="7" class="o_field_x2many_list_row_add">
                                    <span @click="addLine" class="text-primary">Add a product</span>
                                  </td>
                                </tr>
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
                                <textarea
                                  class="o_field_text o_field_widget o_input"
                                  v-model="state.note"
                                  placeholder="Terms and conditions..."
                                  type="text"
                                  style="overflow-y: hidden; height: 50px; resize: none;"
                                ></textarea>
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
                                    <div
                                      class="o_field_widget o_field_many2one o_with_button"
                                      aria-atomic="true"
                                      name="user_id"
                                    >
                                      <select
                                        class="o_input o_field_widget ui-autocomplete-input"
                                        name="type"
                                        v-model="state.sales"
                                      >
                                        <option
                                          v-for="row in sales"
                                          :select="row.user_id == state.sales"
                                          :key="row.id"
                                          :value="row.id"
                                        >{{ row.employee_name }}</option>
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
                                      for="o_field_input_6369"
                                    >Company</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <div
                                      class="o_field_widget o_field_many2one o_with_button o_required_modifier"
                                      aria-atomic="true"
                                      name="company_id"
                                    >
                                      <select
                                        class="o_input o_field_widget ui-autocomplete-input"
                                        name="type"
                                        v-model="state.company_id"
                                      >
                                        <option
                                          v-for="row in company"
                                          :select="row.id == state.company_id"
                                          :key="row.id"
                                          :value="row.id"
                                        >{{ row.company_name }}</option>
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
                                        name="type"
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
                                      class="o_form_label o_invisible_modifier"
                                      for="o_field_input_6378"
                                      data-original-title
                                      title
                                    >Incoterm</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <select
                                      class="o_input o_field_widget o_invisible_modifier"
                                      name="incoterm"
                                      id="o_field_input_6378"
                                    >
                                      <option value="false" style></option>
                                      <option value="1" style>EX WORKS</option>
                                      <option value="2" style>FREE CARRIER</option>
                                      <option value="3" style>FREE ALONGSIDE SHIP</option>
                                      <option value="4" style>FREE ON BOARD</option>
                                      <option value="5" style>COST AND FREIGHT</option>
                                      <option value="6" style>COST, INSURANCE AND FREIGHT</option>
                                      <option value="7" style>CARRIAGE PAID TO</option>
                                      <option value="8" style>CARRIAGE AND INSURANCE PAID TO</option>
                                      <option value="9" style>DELIVERED AT FRONTIER</option>
                                      <option value="10" style>DELIVERED EX SHIP</option>
                                      <option value="11" style>DELIVERED EX QUAY</option>
                                      <option value="12" style>DELIVERED DUTY UNPAID</option>
                                      <option value="13" style>DELIVERED AT TERMINAL</option>
                                      <option value="14" style>DELIVERED AT PLACE</option>
                                      <option value="15" style>DELIVERED DUTY PAID</option>
                                    </select>
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
                                      name="type"
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
                                          placeholder
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
    this.fetchPartner();
    this.getCurrentDate();
    this.get_ProductUom();
    this.fetchWarehouse();
    this.fetchCompany();
    this.fetchEmployees();
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
    onChange(product) {
      const params = { id: product.name };
      axios
        .get("/api/getProduct/id", { params })
        .then((response) => {
          this.result = response.data.data;
          this.state.products.splice(product.index, 1, {
            index: product.index,
            name: product.name,
            description: `[${this.result.code}] ${this.result.name}`,
            price: this.result.price,
            qty: 1,
            product_uom: this.result.uom.id,
            product_uom_category: this.result.uom.category_id,
            taxes: this.result.tax_id,
            price_subtotal: this.result.price,
            price_tax: this.result.price * (thisrow.id.result.tax_id / 100),
          });
          this.compute_total(product);
        })
        .catch((error) => console.error(error));
    },
    onChangePartner(state) {
      const params = state.customer;
      axios
        .post(`/api/customer/search/${params}`)
        .then((response) => {
          this.result = response.data.data;
          this.payment_terms = this.setPaymentTerms(this.result.payment_terms);
        })
        .catch((error) => console.error(error));
    },
    setPaymentTerms(self) {
      if (self == "2") return "15 Days";
      if (self == "3") return "21 Days";
      if (self == "4") return "30 Days";
      if (self == "5") return "45 Days";
      if (self == "6") return "2 Months";
      if (self == "7") return "End of Following Month";
      if (self == "8") return "30% Now, Balance 60 Days";
      else return "Immediate Payment";
    },
    getCurrentDate() {
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, "0");
      var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
      var yyyy = today.getFullYear();

      this.state.order_date = yyyy + "-" + mm + "-" + dd;
    },
    get_ProductUom() {
      axios.get(`/api/uom/list`).then((response) => {
        this.uom = response.data.data;
      });
    },
    onChangeUom(self, $event) {
      this.new_uom = event.target.value;
      this.task = 'compute_price_uom';
      this.search_uom(self, this.new_uom, this.task)
    },
    search_uom(self, new_uom, task){
      axios
        .get(`/api/uom/get_uom/${new_uom}`)
        .then((response) => {
          this.result = response.data.result;
          this.type = this.result.uom_type;
          this.factor = this.result.factor;
          if (this.result.category_id != self.product_uom_category) {
            console.log("wrong");
            this.onChange(self);
            Swal.fire({
              type: "warning",
              title: "Something went wrong!",
              text:
                "The default Unit of Measure and the sale Unit of Measure must be in the same category.",
            });
          } else {
            if (task != 'compute_uom_qty'){
              this.compute_PriceUom(self, this.type, this.factor, new_uom);
            }
            this.compute_Uom_Qty(self, this.type, this.factor, new_uom);
          }
        })
        .catch((error) => console.error(error));
    },
    compute_Uom_Qty(self, uom_type, factor, new_uom) {
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
                self.product_uom_qty =  Math.round((this.uom_qty  / factor) * 100)/100;
                console.log(self.product_uom_qty)
              } else {
                this.uom_qty = self.product_uom_qty * this.factor
                self.product_uom_qty = Math.round((this.uom_qty  / factor) * 100)/100;
                console.log(self.product_uom_qty)
              }
            })
            .catch((error) => console.error(error));
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
              this.reference_price = self.price * this.factor
              if (this.type == "reference") {
                self.price = Math.round((this.reference_price / factor) * 100)/100;
                self.product_uom = new_uom;
                this.compute_total(self);
              } else {
                self.price = Math.round((this.reference_price / factor) * 100)/100;
                self.product_uom = new_uom;
                this.compute_total(self);
              }
            })
            .catch((error) => console.error(error));
        })
        .catch((error) => console.error(error));
    },
    compute_qty(product){
      this.new_qty = event.target.value;
      this.factor = product.product_uom_qty / product.qty
      product.qty = this.new_qty
      product.product_uom_qty = product.qty * this.factor
      this.compute_total(product)
    },
    compute_price(product){
      this.compute_total(product)
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