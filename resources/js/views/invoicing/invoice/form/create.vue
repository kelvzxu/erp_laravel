<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item" accesskey="b">
                <a href="#">Invoices</a>
              </li>
              <li class="breadcrumb-item active">New</li>
            </ol>
            <div class="o_cp_searchview" role="search"></div>
          </div>
          <div>
            <div class="o_cp_left">
              <div class="o_cp_buttons">
                <div>
                  <div class="o_form_buttons_edit">
                    <button
                      type="button"
                      class="btn btn-primary o_form_button_save"
                      accesskey="s"
                    >
                      Save
                    </button>
                    <button
                      type="button"
                      class="btn btn-secondary o_form_button_cancel"
                      accesskey="j"
                    >
                      Discard
                    </button>
                  </div>
                </div>
              </div>
              <aside class="o_cp_sidebar"></aside>
            </div>
            <div class="o_cp_right">
              <div
                class="btn-group o_search_options position-static"
                role="search"
              ></div>
              <nav class="o_cp_pager" role="search" aria-label="Pager"></nav>
              <nav class="btn-group o_cp_switch_buttons"></nav>
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
                  name="action_post"
                  class="btn btn-primary"
                >
                  <span>Post</span></button
                ><button
                  type="button"
                  name="action_invoice_sent"
                  class="btn btn-secondary o_invisible_modifier"
                  data-original-title=""
                  title=""
                >
                  <span>Send &amp; Print</span></button
                ><button
                  type="button"
                  name="action_invoice_register_payment"
                  id="account_invoice_payment_btn"
                  class="btn btn-primary"
                  data-original-title=""
                  title=""
                >
                  <span>Register Payment</span></button
                ><button
                  type="button"
                  name="preview_invoice"
                  class="btn btn-secondary"
                  data-original-title=""
                  title=""
                >
                  <span>Preview</span></button
                ><button
                  type="button"
                  name="button_cancel"
                  class="btn btn-secondary o_invisible_modifier"
                  data-original-title=""
                  title=""
                >
                  <span>Cancel Entry</span></button
                ><button
                  type="button"
                  name="button_draft"
                  class="btn btn-secondary o_invisible_modifier"
                  data-original-title=""
                  title=""
                >
                  <span>Reset to Draft</span>
                </button>
              </div>
              <div
                class="o_statusbar_status o_field_widget o_readonly_modifier"
              >
                <button
                  type="button"
                  data-value="posted"
                  class="btn o_arrow_button btn-secondary disabled"
                >
                  Posted
                </button>

                <button
                  type="button"
                  data-value="draft"
                  class="btn o_arrow_button btn-primary disabled"
                >
                  Draft
                </button>
              </div>
            </div>
            <div
              class="alert alert-info o_invisible_modifier"
              role="alert"
              style="margin-bottom: 0px"
              attrs="{'invisible': ['|', '|', ('type', 'not in', ('out_invoice', 'out_refund')), ('invoice_has_outstanding', '=', False), ('invoice_payment_state', '!=', 'not_paid')]}"
            >
              You have
              <span
                ><a class="alert-link" href="#outstanding" role="button"
                  >outstanding payments</a
                ></span
              >
              for this customer. You can allocate them to mark this invoice as
              paid.
            </div>
            <div
              class="alert alert-info o_invisible_modifier"
              role="alert"
              style="margin-bottom: 0px"
              attrs="{'invisible': ['|', '|', ('type', 'not in', ('in_invoice', 'in_refund')), ('invoice_has_outstanding', '=', False), ('invoice_payment_state', '!=', 'not_paid')]}"
            >
              You have
              <span
                ><a class="alert-link" href="#outstanding" role="button"
                  >outstanding debits</a
                ></span
              >
              for this supplier. You can allocate them to mark this bill as
              paid.
            </div>
            <div
              class="alert alert-info o_invisible_modifier"
              role="alert"
              style="margin-bottom: 0px"
              attrs="{'invisible': ['|', ('type', 'not in', ('out_invoice', 'out_refund', 'in_invoice', 'in_refund', 'out_receipt', 'in_receipt')), ('invoice_has_matching_suspense_amount','=',False)]}"
            >
              You have suspense account moves that match this invoice.
              <span
                ><button
                  type="button"
                  class="btn alert-link"
                  name="action_open_matching_suspense_moves"
                  role="button"
                  style="padding: 0; vertical-align: baseline"
                  data-original-title=""
                  title=""
                >
                  <span>Check them</span>
                </button></span
              >
              to mark this invoice as paid.
            </div>
            <div class="clearfix position-relative o_form_sheet">
              <div
                class="ribbon ribbon-top-right o_invisible_modifier o_widget"
              >
                <span class="bg-success">Paid</span>
              </div>
              <div
                class="ribbon ribbon-top-right o_invisible_modifier o_widget"
              >
                <span class="bg-success">In Payment</span>
              </div>
              <div>
                <h1>
                  <span>Draft Invoice</span>
                </h1>
              </div>
              <div class="o_group">
                <div class="row">
                  <div class="col-12 col-md-6">
                    <table class="o_group o_inner_group">
                      <tbody>
                        <tr>
                          <td class="o_td_label">
                            <div class="">
                              <label
                                class="o_form_label"
                                style="font-weight: bold"
                                >Customer</label
                              >
                            </div>
                          </td>
                          <td style="width: 100%">
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
                              >
                                {{ row.display_name }}
                              </option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label class="o_form_label">Reference</label>
                          </td>
                          <td style="width: 100%">
                            <input
                              class="o_field_char o_field_widget o_input"
                              type="text"
                            />
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-12 col-md-6">
                    <table class="o_group o_inner_group">
                      <tbody>
                        <tr>
                          <td class="o_td_label">
                            <div class="">
                              <label
                                class="o_form_label"
                                for="o_field_input_802"
                                style="font-weight: bold"
                                data-original-title=""
                                title=""
                                >Invoice Date</label
                              >
                            </div>
                          </td>
                          <td style="width: 100%">
                            <div
                              class="o_datepicker o_field_date o_field_widget"
                              aria-atomic="true"
                              id="datepicker1146"
                              data-target-input="nearest"
                              name="invoice_date"
                            >
                              <input
                                type="date"
                                class="o_datepicker_input o_input datetimepicker-input"
                              />
                              <span class="o_datepicker_button"></span>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label"
                              for="o_field_input_804"
                              data-original-title=""
                              title=""
                              >Payment Terms</label
                            >
                          </td>
                          <td style="width: 100%">
                            <select
                              class="o_input o_field_widget"
                              v-model="state.payment_terms"
                            >
                              <option
                                v-for="row in payment_terms"
                                :select="row.value == state.payment_terms"
                                :key="row.value"
                                :value="row.value"
                              >
                                {{ row.label }}
                              </option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_invisible_modifier o_required_modifier"
                              >Journal</label
                            >
                          </td>
                          <td style="width: 100%">
                            <div
                              class="o_field_widget o_field_many2one o_with_button o_invisible_modifier o_required_modifier"
                              aria-atomic="true"
                              name="journal_id"
                            >
                              <div class="o_input_dropdown">
                                <input type="text" />
                                <a role="button" class="o_dropdown_button"></a>
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
                              class="o_form_label o_invisible_modifier o_readonly_modifier"
                              for="o_field_input_806"
                              data-original-title=""
                              title=""
                              >Company</label
                            >
                          </td>
                          <td style="width: 100%">
                            <a
                              class="o_form_uri o_field_widget o_invisible_modifier o_readonly_modifier"
                              href="#id=1&amp;model=res.company"
                              name="company_id"
                              id="o_field_input_806"
                              ><span>My Company</span></a
                            >
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_invisible_modifier o_required_modifier"
                              for="o_field_input_807"
                              data-original-title=""
                              title=""
                              >Currency</label
                            >
                          </td>
                          <td style="width: 100%">
                            <div
                              class="o_field_widget o_field_many2one o_with_button o_invisible_modifier o_required_modifier"
                              aria-atomic="true"
                              name="currency_id"
                            >
                              <div class="o_input_dropdown">
                                <input
                                  type="text"
                                  class="o_input ui-autocomplete-input"
                                  autocomplete="off"
                                  id="o_field_input_807"
                                />
                                <a
                                  role="button"
                                  class="o_dropdown_button"
                                  draggable="false"
                                ></a>
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
                      href="#notebook_page_1137"
                      class="nav-link active"
                      role="tab"
                      >Invoice Lines</a
                    >
                  </li>
                  <li class="nav-item">
                    <a
                      data-toggle="tab"
                      disable_anchor="true"
                      href="#notebook_page_1138"
                      class="nav-link"
                      role="tab"
                      >Journal Items</a
                    >
                  </li>
                  <li class="nav-item">
                    <a
                      data-toggle="tab"
                      disable_anchor="true"
                      href="#notebook_page_1139"
                      class="nav-link"
                      role="tab"
                      >Other Info</a
                    >
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="notebook_page_1137">
                    <div
                      class="o_field_one2many o_field_widget o_field_x2many o_field_x2many_list"
                      name="invoice_line_ids"
                      id="o_field_input_870"
                      data-original-title=""
                      title=""
                    >
                      <div class="o_list_view o_list_optional_columns">
                        <div class="table-responsive">
                          <table
                            class="o_list_table table table-sm table-hover table-striped o_list_table_ungrouped o_empty_list o_section_and_note_list_view"
                            style="table-layout: fixed"
                          >
                            <thead>
                              <tr>
                                <th
                                  data-name="sequence"
                                  class="o_handle_cell o_column_sortable o_list_number_th"
                                  style="width: 33px"
                                ></th>
                                <th
                                  data-name="product_id"
                                  class="o_column_sortable"
                                  style="width: 33.3333%"
                                >
                                  Product
                                </th>
                                <th
                                  data-name="name"
                                  class="o_section_and_note_text_cell o_column_sortable"
                                  style="width: 33.3333%"
                                >
                                  Label
                                </th>
                                <th
                                  data-name="quantity"
                                  class="o_column_sortable o_list_number_th"
                                  style="width: 92px"
                                >
                                  Quantity
                                </th>
                                <th
                                  data-name="product_uom_qty"
                                  class="o_column_sortable o_list_number_th"
                                  style="width: 92px"
                                >
                                  UoM
                                </th>
                                <th
                                  data-name="price_unit"
                                  class="o_column_sortable o_list_number_th"
                                  style="width: 92px"
                                >
                                  Price
                                </th>
                                <th
                                  data-name="tax_ids"
                                  class="o_many2many_tags_cell o_column_sortable"
                                  style="width: 33.3333%"
                                >
                                  Taxes
                                </th>
                                <th
                                  data-name="price_subtotal"
                                  class="o_column_sortable o_list_number_th"
                                  style="width: 104px"
                                >
                                  Subtotal
                                </th>
                                <th
                                  class="o_list_record_remove_header"
                                  style="width: 32px"
                                ></th>
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
                                    >
                                      {{ row.name }}
                                    </option>
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
                                    @change="compute_qty(product, $event)"
                                    :value="product.qty"
                                  />
                                </td>
                                <td
                                  class="o_data_cell o_field_cell o_list_many2one o_product_configurator_cell"
                                >
                                  <select
                                    class="o_input o_field_widget"
                                    @change="onChangeUom(product, $event)"
                                    :value="product.product_uom"
                                  >
                                    <option
                                      v-for="row in uom"
                                      :select="row.id == product.product_uom"
                                      :key="row.id"
                                      :value="row.id"
                                    >
                                      {{ row.name }}
                                    </option>
                                  </select>
                                </td>
                                <td
                                  class="o_data_cell o_field_cell o_list_number"
                                  tabindex="-1"
                                >
                                  <input
                                    class="o_field_float o_field_number o_field_widget o_input"
                                    name="price_unit"
                                    @change="compute_price(product)"
                                    v-model="product.price"
                                  />
                                </td>
                                <td
                                  class="o_data_cell o_field_cell o_list_number"
                                  tabindex="-1"
                                >
                                  <input
                                    type="text"
                                    @change="compute_price(product)"
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
                                    >{{
                                      formatPrice(product.price_subtotal)
                                    }}</span
                                  >
                                </td>
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
                                <td
                                  colspan="7"
                                  class="o_field_x2many_list_row_add"
                                >
                                  <span @click="addLine" class="text-primary"
                                    >Add a product</span
                                  >
                                </td>
                              </tr>
                              <tr>
                                <td class="sequence"></td>
                                <td class="product_id"></td>
                                <td class="name"></td>
                                <td class="quantity"></td>
                                <td class="uom"></td>
                                <td class="price_unit"></td>
                                <td class="tax_ids"></td>
                                <td class="price_subtotal"></td>
                                <td></td>
                              </tr>
                            </tfoot>
                            <i
                              class="o_optional_columns_dropdown_toggle fa fa-ellipsis-v"
                            ></i>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="o_group oe_right">
                      <table
                        class="o_group o_inner_group oe_subtotal_footer o_group_col_6"
                      >
                        <tbody>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_readonly_modifier"
                                for="o_field_input_6356"
                                >Untaxed Amount</label
                              >
                            </td>
                            <td style="width: 100%">
                              <span
                                class="o_field_monetary o_field_number o_field_widget o_readonly_modifier"
                                >{{ formatPrice(state.sub_total) }}</span
                              >
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_readonly_modifier"
                                for="o_field_input_6357"
                                >Taxes</label
                              >
                            </td>
                            <td style="width: 100%">
                              <span
                                class="o_field_monetary o_field_number o_field_widget o_readonly_modifier"
                                >{{ formatPrice(state.taxes) }}</span
                              >
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <div
                                class="oe_subtotal_footer_separator oe_inline"
                              >
                                <label
                                  class="o_form_label"
                                  for="o_field_input_6358"
                                  >Amount Due</label
                                >
                              </div>
                            </td>
                            <td style="width: 100%">
                              <span
                                class="o_field_monetary o_field_number o_field_widget o_readonly_modifier oe_subtotal_footer_separator"
                                >{{ formatPrice(state.grand_total) }}</span
                              >
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <textarea
                      class="o_field_text o_field_widget o_input"
                      v-model="state.note"
                      placeholder="Terms and conditions..."
                      type="text"
                      style="overflow-y: hidden; height: 50px; resize: none"
                    ></textarea>
                  </div>
                  <div class="tab-pane" id="notebook_page_1138">
                    <div
                      class="o_field_one2many o_field_widget o_field_x2many o_field_x2many_list"
                      name="line_ids"
                      id="o_field_input_869"
                      data-original-title=""
                      title=""
                    >
                      <div class="o_list_view o_list_optional_columns">
                        <div class="table-responsive">
                          <table
                            class="o_list_table table table-sm table-hover table-striped o_list_table_ungrouped o_empty_list"
                          >
                            <thead>
                              <tr>
                                <th
                                  data-name="account_id"
                                  class="o_column_sortable"
                                >
                                  Account
                                </th>
                                <th
                                  data-name="name"
                                  class="o_section_and_note_text_cell o_column_sortable"
                                >
                                  Label
                                </th>
                                <th
                                  data-name="debit"
                                  class="o_column_sortable o_list_number_th"
                                >
                                  Debit
                                </th>
                                <th
                                  data-name="credit"
                                  class="o_column_sortable o_list_number_th"
                                >
                                  Credit
                                </th>
                                <th
                                  data-name="tag_ids"
                                  class="o_many2many_tags_cell o_column_sortable"
                                >
                                  Tax Grids
                                </th>
                                <th class="o_list_record_remove_header"></th>
                              </tr>
                            </thead>
                            <tbody class="ui-sortable">
                              <tr>
                                <td colspan="6">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="6">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="6">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="6">&nbsp;</td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr class="bg-white">
                                <td
                                  colspan="5"
                                  class="o_field_x2many_list_row_add"
                                >
                                  <span
                                    @click="addJournalLine"
                                    class="text-primary"
                                    >Add a Line</span
                                  >
                                </td>
                              </tr>
                              <tr>
                                <td class="account_id"></td>
                                <td class="name"></td>
                                <td
                                  class="debit o_list_number"
                                  title="Total Debit"
                                >
                                  0.00
                                </td>
                                <td
                                  class="credit o_list_number"
                                  title="Total Credit"
                                >
                                  0.00
                                </td>
                                <td class="tag_ids"></td>
                                <td></td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="notebook_page_1139">
                    <div class="o_group">
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <table class="o_group o_inner_group">
                            <tbody>
                              <tr>
                                <td colspan="2" style="width: 100%">
                                  <div class="o_horizontal_separator">
                                    Invoice
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_814"
                                    data-original-title=""
                                    title=""
                                    >Salesperson</label
                                  >
                                </td>
                                <td style="width: 100%">
                                  <div
                                    class="o_field_widget o_field_many2one o_with_button"
                                    aria-atomic="true"
                                    name="invoice_user_id"
                                  >
                                    <div class="o_input_dropdown">
                                      <input
                                        type="text"
                                        class="o_input ui-autocomplete-input"
                                        autocomplete="off"
                                        id="o_field_input_814"
                                      />
                                      <a
                                        role="button"
                                        class="o_dropdown_button"
                                        draggable="false"
                                      ></a>
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
                                    class="o_form_label"
                                    for="o_field_input_815"
                                    data-original-title=""
                                    title=""
                                    >Sales Team</label
                                  >
                                </td>
                                <td style="width: 100%">
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
                                        id="o_field_input_815"
                                      />
                                      <a
                                        role="button"
                                        class="o_dropdown_button"
                                        draggable="false"
                                      ></a>
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
                                    class="o_form_label o_invisible_modifier o_readonly_modifier"
                                    for="o_field_input_816"
                                    data-original-title=""
                                    title=""
                                    >Source Document</label
                                  >
                                </td>
                                <td style="width: 100%">
                                  <span
                                    class="o_field_char o_field_widget o_invisible_modifier o_readonly_modifier"
                                    name="invoice_origin"
                                  ></span>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="col-12 col-md-6">
                          <table class="o_group o_inner_group">
                            <tbody>
                              <tr>
                                <td colspan="2" style="width: 100%">
                                  <div class="o_horizontal_separator">
                                    Accounting
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_817"
                                    data-original-title=""
                                    title=""
                                    >Incoterm</label
                                  >
                                </td>
                                <td style="width: 100%">
                                  <div
                                    class="o_field_widget o_field_many2one"
                                    aria-atomic="true"
                                    name="invoice_incoterm_id"
                                  >
                                    <div class="o_input_dropdown">
                                      <input
                                        type="text"
                                        class="o_input ui-autocomplete-input"
                                        autocomplete="off"
                                        id="o_field_input_817"
                                      />
                                      <a
                                        role="button"
                                        class="o_dropdown_button"
                                        draggable="false"
                                      ></a>
                                    </div>
                                    <button
                                      type="button"
                                      class="fa fa-external-link btn btn-secondary o_external_button"
                                      tabindex="-1"
                                      draggable="false"
                                      aria-label="External link"
                                      title="External link"
                                      style="display: none"
                                    ></button>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_818"
                                    data-original-title=""
                                    title=""
                                    >Fiscal Position</label
                                  >
                                </td>
                                <td style="width: 100%">
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
                                        id="o_field_input_818"
                                      />
                                      <a
                                        role="button"
                                        class="o_dropdown_button"
                                        draggable="false"
                                      ></a>
                                    </div>
                                    <button
                                      type="button"
                                      class="fa fa-external-link btn btn-secondary o_external_button"
                                      tabindex="-1"
                                      draggable="false"
                                      aria-label="External link"
                                      title="External link"
                                      style="display: none"
                                    ></button>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label o_invisible_modifier"
                                    for="o_field_input_819"
                                    data-original-title=""
                                    title=""
                                    >Cash Rounding Method</label
                                  >
                                </td>
                                <td style="width: 100%">
                                  <div
                                    class="o_field_widget o_field_many2one o_invisible_modifier"
                                    aria-atomic="true"
                                    name="invoice_cash_rounding_id"
                                  >
                                    <div class="o_input_dropdown">
                                      <input
                                        type="text"
                                        class="o_input ui-autocomplete-input"
                                        autocomplete="off"
                                        id="o_field_input_819"
                                      />
                                      <a
                                        role="button"
                                        class="o_dropdown_button"
                                        draggable="false"
                                      ></a>
                                    </div>
                                    <button
                                      type="button"
                                      class="fa fa-external-link btn btn-secondary o_external_button"
                                      tabindex="-1"
                                      draggable="false"
                                      aria-label="External link"
                                      title="External link"
                                      style="display: none"
                                    ></button>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label o_invisible_modifier"
                                    for="o_field_input_820"
                                    data-original-title=""
                                    title=""
                                    >Source Email</label
                                  >
                                </td>
                                <td style="width: 100%">
                                  <input
                                    class="o_field_email o_field_widget o_input o_invisible_modifier"
                                    name="invoice_source_email"
                                    placeholder=""
                                    type="text"
                                    id="o_field_input_820"
                                  />
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="col-12 col-md-6">
                          <table class="o_group o_inner_group">
                            <tbody>
                              <tr>
                                <td colspan="2" style="width: 100%">
                                  <div class="o_horizontal_separator">
                                    Payments
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_821"
                                    data-original-title=""
                                    title=""
                                    >Payment Reference</label
                                  >
                                </td>
                                <td style="width: 100%">
                                  <input
                                    class="o_field_char o_field_widget o_input"
                                    name="invoice_payment_ref"
                                    placeholder=""
                                    type="text"
                                    id="o_field_input_821"
                                  />
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_822"
                                    data-original-title=""
                                    title=""
                                    >Bank Account</label
                                  >
                                </td>
                                <td style="width: 100%">
                                  <div
                                    class="o_field_widget o_field_many2one"
                                    aria-atomic="true"
                                    name="invoice_partner_bank_id"
                                  >
                                    <div class="o_input_dropdown">
                                      <input
                                        type="text"
                                        class="o_input ui-autocomplete-input"
                                        autocomplete="off"
                                        id="o_field_input_822"
                                      />
                                      <a
                                        role="button"
                                        class="o_dropdown_button"
                                        draggable="false"
                                      ></a>
                                    </div>
                                    <button
                                      type="button"
                                      class="fa fa-external-link btn btn-secondary o_external_button"
                                      tabindex="-1"
                                      draggable="false"
                                      aria-label="External link"
                                      title="External link"
                                      style="display: none"
                                    ></button>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="col-12 col-md-6">
                          <table class="o_group o_inner_group">
                            <tbody>
                              <tr>
                                <td colspan="2" style="width: 100%">
                                  <div class="o_horizontal_separator">
                                    Marketing
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_823"
                                    data-original-title=""
                                    title=""
                                    >Campaign</label
                                  >
                                </td>
                                <td style="width: 100%">
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
                                        id="o_field_input_823"
                                      />
                                      <a
                                        role="button"
                                        class="o_dropdown_button"
                                        draggable="false"
                                      ></a>
                                    </div>
                                    <button
                                      type="button"
                                      class="fa fa-external-link btn btn-secondary o_external_button"
                                      tabindex="-1"
                                      draggable="false"
                                      aria-label="External link"
                                      title="External link"
                                      style="display: none"
                                    ></button>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_824"
                                    data-original-title=""
                                    title=""
                                    >Medium</label
                                  >
                                </td>
                                <td style="width: 100%">
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
                                        id="o_field_input_824"
                                      />
                                      <a
                                        role="button"
                                        class="o_dropdown_button"
                                        draggable="false"
                                      ></a>
                                    </div>
                                    <button
                                      type="button"
                                      class="fa fa-external-link btn btn-secondary o_external_button"
                                      tabindex="-1"
                                      draggable="false"
                                      aria-label="External link"
                                      title="External link"
                                      style="display: none"
                                    ></button>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_825"
                                    data-original-title=""
                                    title=""
                                    >Source</label
                                  >
                                </td>
                                <td style="width: 100%">
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
                                        id="o_field_input_825"
                                      />
                                      <a
                                        role="button"
                                        class="o_dropdown_button"
                                        draggable="false"
                                      ></a>
                                    </div>
                                    <button
                                      type="button"
                                      class="fa fa-external-link btn btn-secondary o_external_button"
                                      tabindex="-1"
                                      draggable="false"
                                      aria-label="External link"
                                      title="External link"
                                      style="display: none"
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
            <div
              class="o_attachment_preview"
              attrs="{'invisible': ['|', '|',                                 ('type', 'not in', ('out_invoice', 'out_refund', 'in_invoice', 'in_refund')),                                 ('state', '!=', 'draft')]}"
            ></div>
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
      value: 0,
      customer: [],
      uom: [],
      state: {
        customer: "",
        payment_terms: 1,
        grand_total: 0,
        sub_total: 0,
        discount: 0,
        taxes: "",
        products: [
          {
            index: 0,
            name: "",
            description: "",
            price: 0,
            qty: 1,
            taxes: 0,
            product_uom_qty: 1,
            product_uom: 0,
            product_uom_category: 0,
            price_tax: 0,
            price_subtotal: 0,
            total: 0,
          },
        ],
      },
      payment_terms: [
        { label: "Immediate Payment", value: 1 },
        { label: "15 Days", value: 2 },
        { label: "21 Days", value: 3 },
        { label: "30 Days", value: 4 },
        { label: "45 Days", value: 5 },
        { label: "2 Months", value: 6 },
        { label: "End of Following Month", value: 7 },
        { label: "30% Now, Balance 60 Days", value: 8 },
      ],
    };
  },
  mounted() {
    this.fetchproducts();
    this.fetchPartner();
    this.get_ProductUom();
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
        product_uom_qty: 1,
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
    fetchproducts() {
      axios
        .get("/api/Products/sale")
        .then((response) => {
          this.productlist = response.data.data;
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
            product_uom_qty: 1,
            product_uom: this.result.uom.id,
            product_uom_category: this.result.uom.category_id,
            taxes: this.result.tax_id,
            price_subtotal: this.result.price,
            price_tax: this.result.price * (this.result.tax_id / 100),
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
          this.state.payment_terms = this.result.payment_terms;
        })
        .catch((error) => console.error(error));
    },
    get_ProductUom() {
      axios.get(`/api/uom/list`).then((response) => {
        this.uom = response.data.data;
      });
    },
    onChangeUom(self, $event) {
      this.new_uom = event.target.value;
      this.task = "compute_price_uom";
      this.search_uom(self, this.new_uom, this.task);
    },
    search_uom(self, new_uom, task) {
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
            if (task != "compute_uom_qty") {
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
                self.product_uom_qty =
                  Math.round((this.uom_qty / factor) * 100) / 100;
                console.log(self.product_uom_qty);
              } else {
                this.uom_qty = self.product_uom_qty * this.factor;
                self.product_uom_qty =
                  Math.round((this.uom_qty / factor) * 100) / 100;
                console.log(self.product_uom_qty);
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
              this.reference_price = self.price * this.factor;
              if (this.type == "reference") {
                self.price =
                  Math.round((this.reference_price / factor) * 100) / 100;
                self.product_uom = new_uom;
                this.compute_total(self);
              } else {
                self.price =
                  Math.round((this.reference_price / factor) * 100) / 100;
                self.product_uom = new_uom;
                this.compute_total(self);
              }
            })
            .catch((error) => console.error(error));
        })
        .catch((error) => console.error(error));
    },
    compute_qty(product) {
      this.new_qty = event.target.value;
      this.factor = product.product_uom_qty / product.qty;
      product.qty = this.new_qty;
      product.product_uom_qty = product.qty * this.factor;
      this.compute_total(product);
    },
    compute_price(product) {
      this.compute_total(product);
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
  },
};
</script>
