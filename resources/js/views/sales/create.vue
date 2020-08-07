<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item" accesskey="b">
                <a href="#">Quotations</a>
              </li>
              <li class="breadcrumb-item active">New</li>
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
              <aside class="o_cp_sidebar"></aside>
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
              <div class="o_statusbar_status o_field_widget o_readonly_modifier" name="state">
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
                  >New</span>
                </h1>
              </div>
              <div class="o_group">
                <div class="row">
                  <div class="col-6">
                    <table class="o_group o_inner_group">
                      <tbody>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_required_modifier"
                            >Customer</label>
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
                              >{{ row.name }}</option>
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
                                <input type="text" class="o_input ui-autocomplete-input" v-model="state.customer_reference" />
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
                                >Taxes (%) </th>
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
                              <tr class="o_data_row o_selected_row" v-for="product in products" v-bind:key="product.index">
                                <td
                                  class="o_data_cell o_field_cell o_list_number o_handle_cell"
                                  tabindex="-1"
                                >
                                  <span
                                    class="o_row_handle fa fa-arrows ui-sortable-handle o_field_widget"
                                    name="sequence"
                                  ></span>
                                </td>
                                <td class="o_data_cell o_field_cell o_list_many2one o_product_configurator_cell">
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
                                <td
                                  class="o_data_cell o_field_cell o_list_number"
                                  tabindex="-1"
                                >
                                  <input
                                    class="o_field_float o_field_number o_field_widget o_input"
                                    @change="count_total(product)"
                                    v-model="product.qty"
                                  />
                                </td>
                                <td
                                  class="o_data_cell o_field_cell o_list_number o_readonly_modifier"
                                  tabindex="-1"
                                >
                                  <span
                                    class="o_field_widget o_readonly_modifier"
                                  >{{product.product_uom_desc}}</span>
                                </td>
                                <td
                                  class="o_data_cell o_field_cell o_list_number"
                                  tabindex="-1"
                                >
                                  <input
                                    class="o_field_float o_field_number o_field_widget o_input"
                                    name="price_unit" @change="count_total(product)"
                                    v-model="product.price"
                                  />
                                </td>
                                <td
                                  class="o_data_cell o_field_cell o_list_number"
                                  tabindex="-1"
                                >
                                  <input
                                    type="text" @change="count_total(product)"
                                    class="o_field_float o_field_number o_field_widget o_input"
                                    v-model="product.taxes"
                                  />
                                </td>
                                <td class="o_data_cell o_field_cell o_list_number o_monetary_cell o_readonly_modifier" tabindex="-1"><span class="o_field_monetary o_field_number o_field_widget o_readonly_modifier">{{formatPrice(product.price_subtotal)}}</span></td>
                                <td class="o_list_record_remove">
                                  <span
                                    class="fa fa-trash-o"
                                    @click="remove(product)"
                                  ></span>
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
                                name="note"
                                placeholder="Terms and conditions..."
                                type="text"
                                id="o_field_input_6401"
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
                      <table class="o_group o_inner_group o_group_col_6">
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
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_6367"
                                  />
                                  <a role="button" class="o_dropdown_button" draggable="false"></a>
                                </div>
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
                              <label class="o_form_label" for="o_field_input_6368">Sales Team</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one o_with_button"
                                aria-atomic="true"
                                name="team_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_6368"
                                  />
                                  <a role="button" class="o_dropdown_button" draggable="false"></a>
                                </div>
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
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_6369"
                                  />
                                  <a role="button" class="o_dropdown_button" draggable="false"></a>
                                </div>
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
                                for="o_field_input_6370"
                                data-original-title
                                title
                              >Online Signature</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_boolean o_field_widget custom-control custom-checkbox o_invisible_modifier"
                                name="require_signature"
                              >
                                <input
                                  type="checkbox"
                                  id="o_field_input_6370"
                                  class="custom-control-input"
                                />
                                <label for="o_field_input_6370" class="custom-control-label">&#8203;</label>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier"
                                for="o_field_input_6371"
                                data-original-title
                                title
                              >Online Payment</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_boolean o_field_widget custom-control custom-checkbox o_invisible_modifier"
                                name="require_payment"
                              >
                                <input
                                  type="checkbox"
                                  id="o_field_input_6371"
                                  class="custom-control-input"
                                />
                                <label for="o_field_input_6371" class="custom-control-label">&#8203;</label>
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
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_6373"
                              >Customer Reference</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_char o_field_widget o_input"
                                name="client_order_ref"
                                placeholder
                                type="text"
                                id="o_field_input_6373"
                              />
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Invoicing</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_6374"
                                data-original-title
                                title
                              >Fiscal Position</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one"
                                aria-atomic="true"
                                name="fiscal_position_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_6374"
                                  />
                                  <a role="button" class="o_dropdown_button" draggable="false"></a>
                                </div>
                                <button
                                  type="button"
                                  class="fa fa-external-link btn btn-secondary o_external_button"
                                  tabindex="-1"
                                  draggable="false"
                                  aria-label="External link"
                                  title="External link"
                                  style="display: none;"
                                ></button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier"
                                for="o_field_input_6375"
                                data-original-title
                                title
                              >Analytic Account</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one o_invisible_modifier"
                                aria-atomic="true"
                                name="analytic_account_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_6375"
                                  />
                                  <a role="button" class="o_dropdown_button" draggable="false"></a>
                                </div>
                                <button
                                  type="button"
                                  class="fa fa-external-link btn btn-secondary o_external_button"
                                  tabindex="-1"
                                  draggable="false"
                                  aria-label="External link"
                                  title="External link"
                                  style="display: none;"
                                ></button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier o_readonly_modifier"
                                for="o_field_input_6376"
                              >Invoice Status</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                name="invoice_status"
                                class="o_field_widget o_invisible_modifier o_readonly_modifier"
                              >
                                Nothing
                                to Invoice
                              </span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="o_group">
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Delivery</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier o_required_modifier"
                                for="o_field_input_6377"
                              >Warehouse</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one o_with_button o_invisible_modifier o_required_modifier"
                                aria-atomic="true"
                                name="warehouse_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_6377"
                                  />
                                  <a role="button" class="o_dropdown_button" draggable="false"></a>
                                </div>
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
                                class="o_input o_field_widget o_required_modifier"
                                name="picking_policy"
                                id="o_field_input_6379"
                              >
                                <option value="false" style="display: none"></option>
                                <option value="&quot;direct&quot;" style>
                                  As soon as
                                  possible
                                </option>
                                <option value="&quot;one&quot;" style>
                                  When all products
                                  are ready
                                </option>
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
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier o_readonly_modifier"
                                for="o_field_input_6381"
                                data-original-title
                                title
                              >Effective Date</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_date o_field_widget o_invisible_modifier o_readonly_modifier"
                                name="effective_date"
                              ></span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="o_group o_invisible_modifier o_group_col_6">
                        <div class="o_horizontal_separator">Reporting</div>
                        <table class="o_group o_inner_group mb-0 o_group_col_12">
                          <tbody>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label"
                                  for="o_field_input_6382"
                                  data-original-title
                                  title
                                >Source Document</label>
                              </td>
                              <td style="width: 100%;">
                                <input
                                  class="o_field_char o_field_widget o_input"
                                  name="origin"
                                  placeholder
                                  type="text"
                                  id="o_field_input_6382"
                                />
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <table class="o_group o_inner_group mt-0 o_group_col_12">
                          <tbody>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label"
                                  for="o_field_input_6383"
                                  data-original-title
                                  title
                                >Campaign</label>
                              </td>
                              <td style="width: 100%;">
                                <div
                                  class="o_field_widget o_field_many2one"
                                  aria-atomic="true"
                                  name="campaign_id"
                                >
                                  <div class="o_input_dropdown">
                                    <input
                                      type="text"
                                      class="o_input ui-autocomplete-input"
                                      autocomplete="off"
                                      id="o_field_input_6383"
                                    />
                                    <a role="button" class="o_dropdown_button" draggable="false"></a>
                                  </div>
                                  <button
                                    type="button"
                                    class="fa fa-external-link btn btn-secondary o_external_button"
                                    tabindex="-1"
                                    draggable="false"
                                    aria-label="External link"
                                    title="External link"
                                    style="display: none;"
                                  ></button>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label"
                                  for="o_field_input_6384"
                                  data-original-title
                                  title
                                >Medium</label>
                              </td>
                              <td style="width: 100%;">
                                <div
                                  class="o_field_widget o_field_many2one"
                                  aria-atomic="true"
                                  name="medium_id"
                                >
                                  <div class="o_input_dropdown">
                                    <input
                                      type="text"
                                      class="o_input ui-autocomplete-input"
                                      autocomplete="off"
                                      id="o_field_input_6384"
                                    />
                                    <a role="button" class="o_dropdown_button" draggable="false"></a>
                                  </div>
                                  <button
                                    type="button"
                                    class="fa fa-external-link btn btn-secondary o_external_button"
                                    tabindex="-1"
                                    draggable="false"
                                    aria-label="External link"
                                    title="External link"
                                    style="display: none;"
                                  ></button>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label"
                                  for="o_field_input_6385"
                                  data-original-title
                                  title
                                >Source</label>
                              </td>
                              <td style="width: 100%;">
                                <div
                                  class="o_field_widget o_field_many2one"
                                  aria-atomic="true"
                                  name="source_id"
                                >
                                  <div class="o_input_dropdown">
                                    <input
                                      type="text"
                                      class="o_input ui-autocomplete-input"
                                      autocomplete="off"
                                      id="o_field_input_6385"
                                    />
                                    <a role="button" class="o_dropdown_button" draggable="false"></a>
                                  </div>
                                  <button
                                    type="button"
                                    class="fa fa-external-link btn btn-secondary o_external_button"
                                    tabindex="-1"
                                    draggable="false"
                                    aria-label="External link"
                                    title="External link"
                                    style="display: none;"
                                  ></button>
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
</template>
<script>
export default {
  data() {
    return {
      value:0,
      payment_terms:"Immediate Payment",
      productlist: [],
      customer :[],
      state: {
        customer: "",
        customer_reference: "",
        order_date: "",
        expiration: "",
        sub_total: "",
        discount: 0,
        taxes: "",
        grand_total: 0,
        sales: "",
        product_warehouse_id: "",
        company_id: "",
        sub_total: 0,
      },
      products: [{
        index: 0,
        name: '',
        description:'',
        price: 0,
        qty: 1,
        taxes: 0,
        product_uom: 0,
        product_uom_desc:'Units',
        price_tax: 0,
        price_subtotal: 0,
        total:0,
      }]
    };
  },
  mounted() {
    this.fetchproducts();
    this.fetchPartner();
    this.getCurrentDate();
  },
  methods: {
    fetchproducts(){
      axios.get('/api/Products/sale').then(response => {
        this.productlist = response.data.data;
      }).catch(error => console.error(error));
    },
    fetchPartner(){
      axios.post('/api/customer/list').then(response => {
        this.customer = response.data.result;
      }).catch(error => console.error(error));
    },
    addLine: function() {
      this.value += 1
      this.products.push({
        index: this.value,
        name: '',
        description:'',
        price: 0,
        qty: 1,
        taxes: 0,
        product_uom: 0,
        product_uom_desc:'Units',
        price_tax: 0,
        price_subtotal: 0,
        total:0,
      });
    },
    remove: function(product) {
      this.products.$remove(product);
    },
    onChange(product) {
      const params ={id : product.name};
      axios.get('/api/getProduct/id',{params}).then(response => {
        this.result = response.data.data;
        this.products.splice(product.index,1,{
          index:product.index,
          name: product.name,
          description: `[${this.result.code}] ${this.result.name}`,
          price: this.result.price, 
          qty: 1,
          product_uom :this.result.uom.id,
          product_uom_desc :this.result.uom.name,
          taxes : this.result.tax_id,
          price_subtotal : this.result.price,
          price_tax : this.result.price * (this.result.tax_id / 100)
        });
        this.count_total(product);
      }).catch(error => console.error(error));
    },
    onChangePartner(state) {
       const params =state.customer;
      axios.post(`/api/customer/search/${params}`).then(response => {
        this.result = response.data.data;
        this.payment_code = this.result.payment_terms;
        if (this.payment_code == '2')
          this.payment_terms = '15 Days';
        if (this.payment_code == '3')
          this.payment_terms = '21 Days';
        if (this.payment_code == '4')
          this.payment_terms = '30 Days';
        if (this.payment_code == '5')
          this.payment_terms = '45 Days';
        if (this.payment_code == '6')
          this.payment_terms = '2 Months';
        if (this.payment_code == '7')
          this.payment_terms = 'End of Following Month';
        if (this.payment_code == '8')
          this.payment_terms = '30% Now, Balance 60 Days';
      }).catch(error => console.error(error));
    },
    count_total(product) {
      product.price_subtotal = product.qty * product.price
      product.price_tax = product.total * (product.taxes / 100)
      product.total = product.price_subtotal + product.price_tax
      this.state.sub_total = this.subTotal();
      this.state.taxes = this.subTaxes();
      this.state.grand_total = this.grandTotal();
      console.log(this.state.grand_total)
    },
    getCurrentDate(){
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();

      this.state.order_date = dd + '/' + mm + '/' + yyyy;
    },
    subTotal: function() {
      return this.products.reduce(function(carry, product) {
        return carry + (parseFloat(product.qty) * parseFloat(product.price));
      }, 0);
    },
    subTaxes: function() {
      return this.products.reduce(function(carry, product) {
        return carry + (parseFloat(product.price_tax));
      }, 0);
    },
    grandTotal: function() {
      return this.state.sub_total + this.state.taxes;
    },
    formatPrice(value) {
        let val = (value/1).toFixed(2).replace(',', '.')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    },
  },
};
</script>