<template>
  <form @submit.prevent="submit" method="post">
    <div class="o_action_manager">
      <div class="o_action o_view_controller">
        <div class="o_cp_controller">
          <div class="o_control_panel">
            <div>
              <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b">
                   <router-link class="text-primary" :to="{ name:'vendor_index' }">Vendors</router-link>
                </li>
                <li class="breadcrumb-item active">{{state.display_name}}</li>
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
                        :to="{ name:'customer_index' }"
                      >Discard</router-link>
                    </div>
                  </div>
                </div>
                <aside class="o_cp_sidebar">
                  <div class="btn-group o_hidden"></div>
                </aside>
              </div>
              <div class="o_cp_right">
                <div class="btn-group o_search_options position-static"></div>
                <nav class="o_cp_pager"></nav>
                <nav class="btn-group o_cp_switch_buttons"></nav>
              </div>
            </div>
          </div>
        </div>

        <div class="o_content">
          <div class="o_form_view o_form_editable">
            <div class="o_form_sheet_bg">
              <div class="clearfix position-relative o_form_sheet">
                <div class="o_not_full oe_button_box">
                  <button type="button" class="btn oe_stat_button" name="302">
                    <i class="fa fa-fw o_button_icon fa-usd"></i>
                    <div
                      name="sale_order_count"
                      class="o_field_widget o_stat_info o_readonly_modifier"
                    >
                      <span class="o_stat_value">0</span>
                      <span class="o_stat_text">Sales</span>
                    </div>
                  </button>
                  <button
                    type="button"
                    class="btn oe_stat_button"
                    name="action_view_partner_invoices"
                    context="{'default_partner_id': active_id}"
                  >
                    <i class="fa fa-fw o_button_icon fa-pencil-square-o"></i>
                    <div class="o_form_field o_stat_info">
                      <span class="o_stat_value">
                        <span
                          class="o_field_monetary o_field_number o_field_widget o_readonly_modifier"
                          name="total_invoiced"
                        >0.00</span>
                      </span>
                      <span class="o_stat_text">Invoiced</span>
                    </div>
                  </button>
                </div>
                <div class="ribbon ribbon-top-right o_widget o_invisible_modifier">
                  <span class="bg-danger">Archived</span>
                </div>
                <div class="o_field_image o_field_widget oe_avatar mr-3" aria-atomic="true">
                  <img
                    v-if="state.logo == null"
                    id="picture"
                    class="img img-fluid"
                    v-bind:src="'/images/icons/avatar.png'"
                    border="1"
                  />
                  <img
                    v-if="state.logo != null"
                    id="picture"
                    class="img img-fluid"
                    v-bind:src="'/uploads/Vendors/'+state.logo"
                    border="1"
                  />

                  <div class="o_form_image_controls">
                    <span class="input-group-btn">
                      <span class="btn btn-default btn-file bg-primary text-white">
                        Browse…
                        <input
                          type="file"
                          id="imgInp"
                          ref="file"
                          name="photo"
                          v-on:change="handleFileUpload()"
                        />
                      </span>
                    </span>
                  </div>
                </div>
                <div class="oe_title">
                  <div
                    class="o_field_radio o_horizontal o_field_widget oe_edit_only"
                    name="company_type"
                  >
                    <div class="custom-control custom-radio o_radio_item" aria-atomic="true">
                      <b-form-radio v-model="state.title" name="some-radios" value="individual" :checked="state.title == 'individual'" @click="onChangeIndividual">
                          <label class="custom-control-label o_form_label" @click="onChangeIndividual">Individual</label>
                      </b-form-radio>
                    </div>

                    <div class="custom-control custom-radio o_radio_item" aria-atomic="true">
                      <b-form-radio v-model="state.title" name="some-radios" value="company" :checked="state.title == 'company'" @click="onChangeCompany">
                          <label class="custom-control-label o_form_label" @click="onChangeCompany">Company</label>
                      </b-form-radio>
                    </div>
                  </div>
                  <h1>
                    <div
                      class="o_field_partner_autocomplete dropdown open o_field_widget o_required_modifier"
                    >
                      <input class="o_field_char o_field_widget o_input o_field_translate o_required_modifier" placeholder="Name" type="text" v-model="state.name"/>
                    </div>
                  </h1>
                  <div class="o_row">
                    <div
                      class="o_field_widget o_field_many2one"
                      v-if="state.title == 'individual'"
                    >
                    <select v-model="state.parent_id" class="o_input ui-autocomplete-input">
                        <option :select="state.parent_id" :value='null'>Company</option>
                        <option
                          v-for="row in parent"
                          :select="row.id == state.parent_id"
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
                        style="display: none;"
                      ></button>
                    </div>
                  </div>
                </div>
                <div class="o_group">
                  <div class="row">
                    <div class="col-6">
                      <table class="o_group o_inner_group">
                        <tbody>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_20"
                                data-original-title
                                title
                              >
                                Address
                                Type
                              </label>
                            </td>
                            <td style="width: 100%;">
                              <select
                                class="o_input o_field_widget"
                                v-model="state.address"
                              >
                              <option
                                  v-for="row in address_type"
                                  :select="row.value == state.address"
                                  :key="row.value"
                                  :value="row.value"
                                >{{ row.label }}</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label for name="address_name">
                                <b v-if="state.address == 'contact'">Company Address</b>
                                <b v-if="state.address == 'invoice'">Invoice Address</b>
                                <b v-if="state.address == 'delivery'">Delivery Address</b>
                                <b v-if="state.address == 'other'">Other Address</b>
                                <b v-if="state.address == 'private'">Private Address</b>
                              </label>
                            </td>
                            <td style="width: 100%;">
                              <div class="o_address_format">
                                <input
                                  class="o_field_char o_field_widget o_input o_address_street"
                                  v-model="state.street"
                                  placeholder="Street..."
                                  type="text"
                                />
                                <input
                                  class="o_field_char o_field_widget o_input o_address_street"
                                  v-model="state.street2"
                                  placeholder="Street 2..."
                                  type="text"
                                />
                                <input
                                  class="o_field_char o_field_widget o_input o_address_city"
                                  v-model="state.city"
                                  placeholder="City"
                                  type="text"
                                />
                                <div
                                  class="o_field_widget o_field_many2one o_address_state"
                                  placeholder="State"
                                >
                                  <div class="o_input_dropdown">
                                    <select v-model="state.state_id" class="o_input ui-autocomplete-input">
                                      <option :select="state.state_id" :value='null'>State</option>
                                      <option
                                        v-for="row in country_state"
                                        :select="row.id == state.state_id"
                                        :key="row.id"
                                        :value="row.id"
                                      >{{ row.state_name }}</option>
                                    </select>
                                  </div>
                                </div>
                                <input
                                  class="o_field_char o_field_widget o_input o_address_zip"
                                  v-model="state.zip"
                                  placeholder="ZIP"
                                  type="text"
                                />
                                <div
                                  class="o_field_widget o_field_many2one o_address_country"
                                  aria-atomic="true"
                                  name="country_id"
                                  placeholder="Country"
                                >
                                <div class="o_input_dropdown">
                                  <select @change="onChangeCountry" v-model="state.country_id" class="o_input ui-autocomplete-input">
                                    <option :select="state.country_id" :value='null'>country</option>
                                    <option
                                      v-for="row in country"
                                      :select="row.id == state.country_id"
                                      :key="row.id"
                                      :value="row.id"
                                    >{{ row.country_name }}</option>
                                  </select>
                                </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                              >VAT</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_partner_autocomplete dropdown open o_field_widget"
                                placeholder="e.g. BE0477472701"
                              >
                                <input
                                  class="o_input"
                                  placeholder="e.g. BE0477472701"
                                  type="text"
                                  v-model="state.vat"
                                />
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-6">
                      <table class="o_group o_inner_group">
                        <tbody>
                          <tr v-if="state.title == 'individual'">
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                              >Job Position</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_char o_field_widget o_input"
                                v-model="state.job_title"
                                placeholder="e.g. Sales Director"
                                type="text"
                              />
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label class="o_form_label" for="o_field_input_25">Phone</label>
                            </td>
                            <td style="width: 100%;">
                              <div class="o_row">
                                <input
                                  class="o_field_phone o_field_widget o_input"
                                  v-model="state.phone"
                                  placeholder
                                  type="text"
                                />
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label class="o_form_label" for="o_field_input_26">Mobile</label>
                            </td>
                            <td style="width: 100%;">
                              <div class="o_row">
                                <input
                                  class="o_field_phone o_field_widget o_input"
                                  v-model="state.mobile"
                                  placeholder
                                  type="text"
                                />
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label class="o_form_label oe_inline" for="o_field_input_30">Email</label>
                            </td>
                            <td style="width: 100%;">
                              <div class="o_row o_row_readonly">
                                <input
                                  class="o_field_email o_field_widget o_input"
                                  v-model="state.email"
                                  placeholder
                                  type="text"
                                />
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label class="o_form_label" for="o_field_input_31">Website Link</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_url o_field_widget o_input"
                                v-model="state.website"
                                placeholder="e.g. https://www.google.com"
                                type="text"
                              />
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                data-original-title
                                title
                              >Language</label>
                            </td>
                            <td style="width: 100%;">
                              <div class="o_row">
                                <select v-model="state.lag" class="o_input o_field_widget">
                                  <option :select="state.lag" :value='null'>language</option>
                                  <option
                                    v-for="row in language"
                                    :select="row.id == state.lag"
                                    :key="row.id"
                                    :value="row.id"
                                  >{{ row.lang_name }}</option>
                                </select>
                                <button
                                  type="button"
                                  name="55"
                                  class="btn btn-sm btn-link mb4 fa fa-globe"
                                  aria-label="More languages"
                                  title="More languages"
                                ></button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label class="o_form_label" for="o_field_input_35">Currency</label>
                            </td>
                            <td style="width: 100%;">
                              <div class="o_input_dropdown">
                                <select v-model="state.currency_id" class="o_input ui-autocomplete-input">
                                  <option :select="state.currency_id" :value='null'>currency</option>
                                  <option
                                    v-for="row in currency"
                                    :select="row.id == state.currency_id"
                                    :key="row.id"
                                    :value="row.id"
                                  >{{ row.currency_name }} ({{ row.symbol }})</option>
                                </select>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="o_notebook">
                  <div class="o_notebook_headers">
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a
                          data-toggle="tab"
                          disable_anchor="true"
                          href="#notebook_page_37"
                          class="nav-link active"
                        >Sales &amp; Purchase</a>
                      </li>
                      <li class="nav-item">
                        <a
                          data-toggle="tab"
                          disable_anchor="true"
                          href="#notebook_page_47"
                          class="nav-link"
                        >Invoicing</a>
                      </li>
                      <li class="nav-item">
                        <a
                          data-toggle="tab"
                          disable_anchor="true"
                          href="#notebook_page_60"
                          class="nav-link"
                        >Internal Notes</a>
                      </li>
                    </ul>
                  </div>
                  <div class="tab-content">
                    <div class="tab-pane active" id="notebook_page_37">
                      <div class="o_group">
                        <div class="row">
                          <div class="col-6">
                            <table class="o_group o_inner_group">
                              <tbody>
                                <tr>
                                  <td colspan="2" style="width: 100%;">
                                    <div class="o_horizontal_separator">Purchases</div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="o_td_label">
                                    <label
                                      class="o_form_label"
                                      for="o_field_input_38"
                                      data-original-title
                                      title
                                    >Merchandise</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <div
                                      class="o_field_widget o_field_many2one"
                                      aria-atomic="true"
                                      name="user_id"
                                    >
                                      <div class="o_input_dropdown">
                                        <select
                                          v-model="state.merchandise"
                                          class="o_input ui-autocomplete-input"
                                        >
                                          <option :select="state.merchandise" :value="null">Merchandise</option>
                                          <option
                                            v-for="row in merchandise"
                                            :select="row.id == state.merchandise"
                                            :key="row.id"
                                            :value="row.id"
                                          >{{ row.employee_name }}</option>
                                        </select>
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
                                      for="o_field_input_39"
                                      data-original-title
                                      title
                                    >Payment Terms</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <select
                                      class="o_input o_field_widget"
                                      v-model="state.payment_terms"
                                    >
                                      <option
                                        v-for="row in payment_terms"
                                        :select="row.value == state.payment_terms"
                                        :key="row.value"
                                        :value="row.value"
                                      >{{ row.label }}</option>
                                    </select>
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
                                    <div class="o_horizontal_separator">Misc</div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="o_td_label">
                                    <label class="o_form_label" for="o_field_input_42">Reference</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <input
                                      class="o_field_char o_field_widget o_input"
                                      v-model="state.ref"
                                      placeholder
                                      type="text"
                                      id="o_field_input_42"
                                    />
                                  </td>
                                </tr>
                                <tr>
                                  <td class="o_td_label">
                                    <label class="o_form_label" for="o_field_input_43">Company</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <div
                                      class="o_field_widget o_field_many2one"
                                      aria-atomic="true"
                                      name="company_id"
                                    >
                                      <div class="o_input_dropdown">
                                        <select v-model="state.company_id" class="o_input ui-autocomplete-input">
                                          <option :select="state.company_id" :value='null'></option>
                                          <option
                                            v-for="row in company"
                                            :select="row.id == state.company_id"
                                            :key="row.id"
                                            :value="row.id"
                                          >{{ row.company_name }}</option>
                                        </select>
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
                                    <label class="o_form_label" for="o_field_input_44">Industry</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <div
                                      class="o_field_widget o_field_many2one"
                                      aria-atomic="true"
                                      name="industry_id"
                                    >
                                      <div class="o_input_dropdown">
                                        <select v-model="state.industry_id" class="o_input ui-autocomplete-input">
                                          <option :select="state.industry_id" :value='null'></option>
                                          <option
                                            v-for="row in industry"
                                            :select="row.id == state.industry_id"
                                            :key="row.id"
                                            :value="row.id"
                                          >{{ row.industry_name }}</option>
                                        </select>
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
                    <div class="tab-pane" id="notebook_page_47">
                      <div class="o_group">
                        <div class="row">
                          <div class="col-6">
                            <table class="o_group o_inner_group">
                              <tbody>
                                <tr>
                                  <td colspan="2" style="width: 100%;">
                                    <div class="o_horizontal_separator">Bank Accounts</div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width: 50%;">
                                    <div
                                      class="o_field_one2many o_field_widget o_field_x2many o_field_x2many_list"
                                      name="bank_ids"
                                      id="o_field_input_98"
                                    >
                                      <div class="o_list_view">
                                        <div class="table-responsive">
                                          <table
                                            class="o_list_table table table-sm table-hover table-striped o_list_table_ungrouped o_empty_list"
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
                                                  data-name="bank_id"
                                                  tabindex="-1"
                                                  class="o_column_sortable"
                                                  title="Bank"
                                                  style="width: 235px;"
                                                >Bank</th>
                                                <th
                                                  data-name="acc_number"
                                                  class="o_iban_cell o_column_sortable"
                                                  tabindex="-1"
                                                  title="Account Number"
                                                  style="width: 235px;"
                                                >Account Number</th>
                                                <th
                                                  class="o_list_record_remove_header"
                                                  style="width: 32px;"
                                                ></th>
                                              </tr>
                                            </thead>
                                            <tbody class="ui-sortable">
                                              <tr>
                                                <td></td>
                                                <td colspan="3" class="o_field_x2many_list_row_add">
                                                  <a href="#" role="button">
                                                    Add a
                                                    line
                                                  </a>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td colspan="4">&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td colspan="4">&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td colspan="4">&nbsp;</td>
                                              </tr>
                                            </tbody>
                                            <tfoot>
                                              <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                              </tr>
                                            </tfoot>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="col-6">
                            <table v-if="accounting == 'installed'" class="o_group o_inner_group">
                              <tbody>
                                <tr>
                                  <td colspan="2" style="width: 100%;">
                                    <div class="o_horizontal_separator">Accounting Entries</div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="o_td_label">
                                    <label
                                      class="o_form_label o_required_modifier"
                                      for="o_field_input_49"
                                      data-original-title
                                      title
                                    >Account Receivable</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <div
                                      class="o_field_widget o_field_many2one o_with_button o_required_modifier"
                                      aria-atomic="true"
                                      name="property_account_receivable_id"
                                    >
                                      <div class="o_input_dropdown">
                                        <select v-model="state.receivable_account" class="o_input ui-autocomplete-input">
                                          <option
                                            v-for="row in accounts"
                                            :select="row.id == state.receivable_account"
                                            :key="row.id"
                                            :value="row.id"
                                          >{{ row.name }} | {{row.code}}</option>
                                        </select>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="o_td_label">
                                    <label
                                      class="o_form_label o_required_modifier"
                                      for="o_field_input_50"
                                      data-original-title
                                      title
                                    >Account Journal</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <div
                                      class="o_field_widget o_field_many2one o_with_button o_required_modifier"
                                      aria-atomic="true"
                                      name="property_account_payable_id"
                                    >
                                      <div class="o_input_dropdown">
                                        <select v-model="state.journal" class="o_input ui-autocomplete-input">
                                          <option
                                            v-for="row in journal"
                                            :select="row.id == state.journal"
                                            :key="row.id"
                                            :value="row.id"
                                          >{{ row.name }} | {{row.code}}</option>
                                        </select>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="o_group ">
                        <div class="o_horizontal_separator">Credit Limit</div>
                        <table class="o_group o_inner_group o_group_col_6">
                          <tbody>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label"
                                  for="o_field_input_53"
                                  data-original-title
                                  title
                                >Warning Amount</label>
                              </td>
                              <td style="width: 100%;">
                                <input
                                  class="o_field_float o_field_number o_field_widget o_input"
                                  v-model="state.warning_stage"
                                  placeholder
                                  type="text"
                                />
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label"
                                  for="o_field_input_54"
                                  data-original-title
                                  title
                                >Blocking Amount</label>
                              </td>
                              <td style="width: 100%;">
                                <input
                                  class="o_field_float o_field_number o_field_widget o_input"
                                  v-model="state.blocking_stage"
                                  placeholder
                                  type="text"
                                />
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane" id="notebook_page_60">
                      <textarea
                        class="o_field_text o_field_widget o_input"
                        name="comment"
                        placeholder="Internal note..."
                        type="text"
                        id="o_field_input_89"
                        style="overflow-y: hidden; height: 50px; resize: none;"
                      ></textarea>
                      <textarea
                        disabled
                        style="position: absolute; opacity: 0; height: 10px; border-top-width: 0px; border-bottom-width: 0px; padding: 0px; overflow: hidden; top: -10000px; left: -10000px; width: 0px;"
                      ></textarea>
                      <table class="o_group o_inner_group o_invisible_modifier">
                        <tbody>
                          <tr></tr>
                          <tr>
                            <td colspan="4" style="width: 200%;">
                              <div class="o_horizontal_separator">Warning on the Sales Order</div>
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 50%;">
                              <select
                                class="o_input o_field_widget"
                                name="sale_warn"
                                id="o_field_input_90"
                                data-original-title
                                title
                              >
                                <option value="false"></option>
                                <option value="&quot;no-message&quot;">No Message</option>
                                <option value="&quot;warning&quot;">Warning</option>
                                <option value="&quot;block&quot;">Blocking Message</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3" style="width: 150%;">
                              <span
                                class="o_field_text o_field_widget o_readonly_modifier"
                                name="sale_warn_msg"
                              ></span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_invisible_modifier">
                        <tbody>
                          <tr></tr>
                          <tr>
                            <td colspan="4" style="width: 200%;">
                              <div class="o_horizontal_separator">Warning on the Purchase Order</div>
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 50%;">
                              <select
                                class="o_input o_field_widget"
                                name="purchase_warn"
                                id="o_field_input_92"
                                data-original-title
                                title
                              >
                                <option value="false"></option>
                                <option value="&quot;no-message&quot;">No Message</option>
                                <option value="&quot;warning&quot;">Warning</option>
                                <option value="&quot;block&quot;">Blocking Message</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3" style="width: 150%;">
                              <span
                                class="o_field_text o_field_widget o_readonly_modifier"
                                name="purchase_warn_msg"
                              ></span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_invisible_modifier">
                        <tbody>
                          <tr></tr>
                          <tr>
                            <td colspan="4" style="width: 200%;">
                              <div class="o_horizontal_separator">Warning on the Invoice</div>
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 50%;">
                              <select
                                class="o_input o_field_widget"
                                name="invoice_warn"
                                id="o_field_input_94"
                                data-original-title
                                title
                              >
                                <option value="false"></option>
                                <option value="&quot;no-message&quot;">No Message</option>
                                <option value="&quot;warning&quot;">Warning</option>
                                <option value="&quot;block&quot;">Blocking Message</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3" style="width: 150%;">
                              <span
                                class="o_field_text o_field_widget o_readonly_modifier"
                                name="invoice_warn_msg"
                              ></span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_invisible_modifier">
                        <tbody>
                          <tr></tr>
                          <tr>
                            <td colspan="4" style="width: 200%;">
                              <div class="o_horizontal_separator">Warning on the Picking</div>
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 50%;">
                              <select
                                class="o_input o_field_widget"
                                name="picking_warn"
                                id="o_field_input_96"
                                data-original-title
                                title
                              >
                                <option value="false"></option>
                                <option value="&quot;no-message&quot;">No Message</option>
                                <option value="&quot;warning&quot;">Warning</option>
                                <option value="&quot;block&quot;">Blocking Message</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3" style="width: 150%;">
                              <span
                                class="o_field_text o_field_widget o_readonly_modifier"
                                name="picking_warn_msg"
                              ></span>
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
  </form>
</template>
<script>
export default {
    data(){
      return {
        state: {},
        address_type:[
          { label: "Company", value: "contact" },
          { label: "Invoice Address", value: "invoice" },
          { label: "Delivery Address", value: "delivery" },
          { label: "Other Address", value: "other" },
          { label: "Private Address", value: "private" },
        ],
        payment_terms: [
          { label: "Immediate Payment", value: 1},
          { label: "15 Days", value: 2},
          { label: "21 Days", value: 3},
          { label: "30 Days", value: 4},
          { label: "45 Days", value: 5},
          { label: "2 Months", value: 6},
          { label: "End of Following Month", value: 7},
          { label: "30% Now, Balance 60 Days", value: 8},
        ],
        parent: {},
        country: {},
        country_state:{},
        currency: {},
        language: {},
        merchandise: {},
        company: {},
        warehouse: {},
        industry: {},
        accounts: {},
        journal:{},
        accounting: false,
      }
    },
    created() {
      axios.post(`/api/vendor/search/${atob(this.$route.params.id)}`).then(response => {
        this.state = response.data.data;
      }).catch(error => console.error(error));
    },
    mounted() {
      this.fetchParent();
      this.fetchCountry();
      this.fetchCurrency();
      this.fetchLanguage();
      this.fetchEmployees();
      this.fetchCompany();
      this.fetchIndustry();
      this.fetchAccounts();
      this.fetchJournals();
      this.CheckAccounting();
      this.prepare_country_state();
    },
    methods: {
      onChangeIndividual(){
          this.state.title="individual"
          this.state.parent_id = null
      },
      onChangeCompany(){
          this.state.title="company"
          this.state.parent_id = null
      },
      fetchParent(){
        axios.post('/api/vendor/company/list').then(response => {
          this.parent = response.data.result;
        }).catch(error => console.error(error));
      },
      fetchCountry(){
        axios.get('/api/country').then(response => {
          this.country = response.data
        }).catch(error => console.error(error));
      },
      fetchState(){
        axios.get('/api/state').then(response => {
          this.country_state = response.data
        }).catch(error => console.error(error));
      },
      fetchCurrency(){
        axios.get('/api/currency').then(response => {
          this.currency = response.data
        }).catch(error => console.error(error));
      },
      fetchLanguage(){
        axios.get('/api/lang').then(response => {
          this.language = response.data
        }).catch(error => console.error(error));
      },
      fetchEmployees(){
        axios.get('/api/employee/list').then(response => {
          this.merchandise = response.data.result;
        }).catch(error => console.error(error));
      },
      fetchAccounts(){
        axios.get('/api/fetchaccount/accounts').then(response => {
          this.accounts = response.data.result;
        }).catch(error => console.error(error));
      },
      fetchJournals(){
        axios.get('/api/fetchaccount/journal').then(response => {
          this.journal = response.data.result;
        }).catch(error => console.error(error));
      },
      fetchCompany() {
        axios
          .get("/api/company")
          .then((response) => {
          this.company = response.data.data;
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
      fetchIndustry(){
        axios.get('/api/industry').then(response => {
          this.industry = response.data
        }).catch(error => console.error(error));
      },
      // validate Addons
      CheckAccounting() {
        axios
          .get("/api/Addons/Check/Accounting")
          .then((response) => {
            this.result = response.data.result;
            if (this.result == true)
              this.accounting = 'installed';
          })
          .catch((error) => console.error(error));
      },
      getState(value){
        const url = "/api/state/search?data=" + value;
        axios.get(url).then(response => {
          this.country_state = response.data.data
        })
      },
      prepare_country_state(){
        this.country_state={}
        if (this.state.country_id == null)
          this.fetchState()
        else
          this.getState(this.state.country_id)
      },
      onChangeCountry(){
        this.prepare_country_state();
      },
      prepare_parent_address()
      {
        axios.post(`/api/vendor/search/${state.parent_id}`).then(response => {
          this.result = response.data.data;
          this.state.address = this.result.address;
          this.state.street = this.result.street;
          this.state.street2 = this.result.street2;
          this.state.city = this.result.city;
          this.state.state = this.result.state;
          this.state.country = this.result.country;
          this.state.zip = this.result.zip;
        }).catch(error => console.error(error));
      },
      // handle Upload File
      handleFileUpload() {
        this.createImage(this.$refs.file.files[0]);
      },
      createImage(file) {
        let reader = new FileReader();
        let vm = this;
        reader.onload = (e) => {
          vm.state.photo = e.target.result;
          this.set_image(vm.state.photo);
        };
        reader.readAsDataURL(file);
      },
      set_image(file) {
        document.getElementById("picture").src = file;
      },
      submit($e) {
      axios
        .post("/api/vendor/update", this.state)
        .then((response) => {
          if (response.data.status == "success") {
            Toast.fire({
              icon: "success",
              title: response.data.message,
            });
            this.$router.push({ name: "vendor_index" });
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
              error = error[Object.keys(error)[0]];
              Swal.fire({
                type: "warning",
                title: "Something went wrong!",
                text: error[0],
              });
            }
          }
        });
      }
    }
}
</script>