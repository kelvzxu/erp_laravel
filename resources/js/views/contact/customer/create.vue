<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item" accesskey="b">
                <a href="#">Customers</a>
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
                      type="submit"
                      class="btn btn-primary text-white o_form_button_save"
                      accesskey="s"
                    >Save</button>
                    <router-link
                      type="button"
                      class="btn btn-secondary o_form_button_cancel"
                      :to="{ name:'product_index' }"
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
              <div class="ribbon ribbon-top-right o_widget">
                <span class="bg-danger">Archived</span>
              </div>
              <div class="o_field_image o_field_widget oe_avatar" aria-atomic="true">
                <img
                  id="picture"
                  class="img img-fluid"
                  v-bind:src="'/images/icons/avatar.png'"
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
                    <select
                      class="o_input o_field_widget"
                      v-model="state.parent"
                      placeholder="Company"
                    >
                      <option :select="state.parent_id == null" value=null></option>
                      <option
                        v-for="row in parent"
                        :select="row.id == state.parent"
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
                                name="street"
                                placeholder="Street..."
                                type="text"
                              />
                              <input
                                class="o_field_char o_field_widget o_input o_address_street"
                                name="street2"
                                placeholder="Street 2..."
                                type="text"
                              />
                              <input
                                class="o_field_char o_field_widget o_input o_address_city"
                                name="city"
                                placeholder="City"
                                type="text"
                              />
                              <div
                                class="o_field_widget o_field_many2one o_address_state"
                                aria-atomic="true"
                                name="state_id"
                                placeholder="State"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    placeholder="State"
                                    autocomplete="off"
                                  />
                                  <a role="button" class="o_dropdown_button" draggable="false"></a>
                                </div>
                              </div>
                              <input
                                class="o_field_char o_field_widget o_input o_address_zip"
                                name="zip"
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
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    placeholder="Country"
                                    autocomplete="off"
                                    id="o_field_input_88"
                                  />
                                  <a role="button" class="o_dropdown_button" draggable="false"></a>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label"
                              for="o_field_input_21"
                              data-original-title
                              title
                            >VAT</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_partner_autocomplete dropdown open o_field_widget"
                              name="vat"
                              placeholder="e.g. BE0477472701"
                            >
                              <input
                                class="o_input"
                                placeholder="e.g. BE0477472701"
                                type="text"
                                id="o_field_input_21"
                              />
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_invisible_modifier o_readonly_modifier"
                              for="o_field_input_22"
                              data-original-title
                              title
                            >
                              Country
                              Code
                            </label>
                          </td>
                          <td style="width: 100%;">
                            <span
                              class="o_field_char o_field_widget o_invisible_modifier o_readonly_modifier"
                              name="country_code"
                            ></span>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label class="o_form_label" for="o_field_input_23">
                              ID
                              PKP
                            </label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_boolean o_field_widget custom-control custom-checkbox"
                              name="l10n_id_pkp"
                            >
                              <input type="checkbox" id="o_field_input_23" class="custom-control-input" />
                              <label for="o_field_input_23" class="custom-control-label">&#8203;</label>
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
                            <label
                              class="o_form_label o_invisible_modifier"
                              for="o_field_input_24"
                            >Job Position</label>
                          </td>
                          <td style="width: 100%;">
                            <input
                              class="o_field_char o_field_widget o_input o_invisible_modifier"
                              name="function"
                              placeholder="e.g. Sales Director"
                              type="text"
                              id="o_field_input_24"
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
                                name="phone"
                                placeholder
                                type="text"
                                id="o_field_input_25"
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
                                name="mobile"
                                placeholder
                                type="text"
                                id="o_field_input_26"
                              />
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_invisible_modifier o_readonly_modifier"
                              for="o_field_input_27"
                              data-original-title
                              title
                            >
                              Sanitized
                              Number
                            </label>
                          </td>
                          <td style="width: 100%;">
                            <span
                              class="o_field_char o_field_widget o_invisible_modifier o_readonly_modifier"
                              name="phone_sanitized"
                            ></span>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_invisible_modifier"
                              for="o_field_input_28"
                            >Users</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_one2many o_field_widget o_invisible_modifier"
                              name="user_ids"
                              id="o_field_input_28"
                            ></div>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_invisible_modifier o_readonly_modifier"
                              for="o_field_input_29"
                              data-original-title
                              title
                            >Blacklist</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_boolean o_field_widget custom-control custom-checkbox o_invisible_modifier o_readonly_modifier"
                              name="is_blacklisted"
                            >
                              <input
                                type="checkbox"
                                id="checkbox-64"
                                class="custom-control-input"
                                disabled
                              />
                              <label for="o_field_input_29" class="custom-control-label">&#8203;</label>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label class="o_form_label oe_inline" for="o_field_input_30">Email</label>
                          </td>
                          <td style="width: 100%;">
                            <div class="o_row o_row_readonly">
                              <i
                                class="fa fa-ban o_invisible_modifier"
                                style="color: red;"
                                role="img"
                                title="This email is blacklisted for mass mailing"
                                aria-label="Blacklisted"
                                attrs="{'invisible': [('is_blacklisted', '=', False)]}"
                              ></i>
                              <input
                                class="o_field_email o_field_widget o_input"
                                name="email"
                                placeholder
                                type="text"
                                id="o_field_input_30"
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
                              name="website"
                              placeholder="e.g. https://www.odoo.com"
                              type="text"
                              id="o_field_input_31"
                            />
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_invisible_modifier"
                              for="o_field_input_32"
                            >Title</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_widget o_field_many2one o_invisible_modifier"
                              aria-atomic="true"
                              name="title"
                              placeholder="e.g. Mister"
                            >
                              <div class="o_input_dropdown">
                                <input
                                  type="text"
                                  class="o_input ui-autocomplete-input"
                                  placeholder="e&#65279;.&#65279;g&#65279;.&#65279; &#65279;M&#65279;i&#65279;s&#65279;t&#65279;e&#65279;r"
                                  autocomplete="off"
                                  id="o_field_input_32"
                                />
                                <a role="button" class="o_dropdown_button" draggable="false"></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_invisible_modifier o_readonly_modifier"
                              for="o_field_input_33"
                            >Active Lang Count</label>
                          </td>
                          <td style="width: 100%;">
                            <span
                              class="o_field_integer o_field_number o_field_widget o_invisible_modifier o_readonly_modifier"
                              name="active_lang_count"
                            >2</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label"
                              for="o_field_input_34"
                              data-original-title
                              title
                            >Language</label>
                          </td>
                          <td style="width: 100%;">
                            <div class="o_row" attrs="{'invisible': [('active_lang_count', '<=', 1)]}">
                              <select class="o_input o_field_widget" name="lang" id="o_field_input_34">
                                <option value="false"></option>
                                <option value="&quot;en_US&quot;">English (US)</option>
                                <option value="&quot;id_ID&quot;">Indonesian / Bahasa Indonesia</option>
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
                            <label class="o_form_label" for="o_field_input_35">Tags</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_many2manytags o_input o_field_widget"
                              name="category_id"
                              placeholder="Tags..."
                            >
                              <div
                                class="o_field_widget o_field_many2one"
                                aria-atomic="true"
                                name="category_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    placeholder="T&#65279;a&#65279;g&#65279;s&#65279;.&#65279;.&#65279;."
                                    autocomplete="off"
                                    id="o_field_input_35"
                                  />
                                  <a role="button" class="o_dropdown_button" draggable="false"></a>
                                </div>
                              </div>
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
                        href="#notebook_page_36"
                        class="nav-link active"
                        role="tab"
                        aria-selected="true"
                      >Contacts &amp; Addresses</a>
                    </li>
                    <li class="nav-item">
                      <a
                        data-toggle="tab"
                        disable_anchor="true"
                        href="#notebook_page_37"
                        class="nav-link"
                        role="tab"
                        aria-selected="false"
                      >Sales &amp; Purchase</a>
                    </li>
                    <li class="nav-item">
                      <a
                        data-toggle="tab"
                        disable_anchor="true"
                        href="#notebook_page_47"
                        class="nav-link"
                        role="tab"
                        aria-selected="false"
                      >Invoicing</a>
                    </li>
                    <li class="nav-item o_invisible_modifier">
                      <a
                        data-toggle="tab"
                        disable_anchor="true"
                        href="#notebook_page_59"
                        class="nav-link"
                        role="tab"
                      >Invoicing</a>
                    </li>
                    <li class="nav-item">
                      <a
                        data-toggle="tab"
                        disable_anchor="true"
                        href="#notebook_page_60"
                        class="nav-link"
                        role="tab"
                        aria-selected="false"
                      >Internal Notes</a>
                    </li>
                  </ul>
                </div>
                <div class="tab-content">
                  <div class="tab-pane active" id="notebook_page_36">
                    <div
                      class="o_field_one2many o_field_widget o_field_x2many o_field_x2many_kanban"
                      name="child_ids"
                      id="o_field_input_99"
                    >
                      <div class="o_cp_controller">
                        <div class="o_x2m_control_panel">
                          <nav
                            class="o_cp_buttons"
                            aria-label="Control panel toolbar"
                            role="toolbar"
                          >
                            <div>
                              <button
                                type="button"
                                class="btn btn-secondary o-kanban-button-new"
                                accesskey="c"
                              >Add</button>
                            </div>
                          </nav>
                          <nav class="o_cp_pager" aria-label="Pager" role="toolbar">
                            <div class="o_pager o_hidden">
                              <span class="o_pager_counter">
                                <span class="o_pager_value"></span> /
                                <span class="o_pager_limit"></span>
                              </span>
                              <span class="btn-group" aria-atomic="true">
                                <button
                                  type="button"
                                  class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                                  aria-label="Previous"
                                  title="Previous"
                                  tabindex="-1"
                                ></button>
                                <button
                                  type="button"
                                  class="fa fa-chevron-right btn btn-secondary o_pager_next"
                                  aria-label="Next"
                                  title="Next"
                                  tabindex="-1"
                                ></button>
                              </span>
                            </div>
                          </nav>
                        </div>
                      </div>
                      <div class="o_kanban_view o_kanban_ungrouped">
                        <div class="o_kanban_record o_kanban_ghost"></div>
                        <div class="o_kanban_record o_kanban_ghost"></div>
                        <div class="o_kanban_record o_kanban_ghost"></div>
                        <div class="o_kanban_record o_kanban_ghost"></div>
                        <div class="o_kanban_record o_kanban_ghost"></div>
                        <div class="o_kanban_record o_kanban_ghost"></div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="notebook_page_37">
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
                              <label
                                class="o_form_label"
                                for="o_field_input_38"
                                data-original-title
                                title
                              >Salesperson</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one"
                                aria-atomic="true"
                                name="user_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_38"
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
                                for="o_field_input_39"
                                data-original-title
                                title
                              >Payment Terms</label>
                            </td>
                            <td style="width: 100%;">
                              <select
                                class="o_input o_field_widget"
                                name="property_payment_term_id"
                                id="o_field_input_39"
                              >
                                <option value="false"></option>
                                <option value="1">Immediate Payment</option>
                                <option value="2">15 Days</option>
                                <option value="3">21 Days</option>
                                <option value="4">30 Days</option>
                                <option value="5">45 Days</option>
                                <option value="6">2 Months</option>
                                <option value="7">End of Following Month</option>
                                <option value="8">30% Now, Balance 60 Days</option>
                                <option value="9">30% Advance End of Following Month</option>
                              </select>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Purchase</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_40"
                                data-original-title
                                title
                              >Payment Terms</label>
                            </td>
                            <td style="width: 100%;">
                              <select
                                class="o_input o_field_widget"
                                name="property_supplier_payment_term_id"
                                id="o_field_input_40"
                              >
                                <option value="false"></option>
                                <option value="1">Immediate Payment</option>
                                <option value="2">15 Days</option>
                                <option value="3">21 Days</option>
                                <option value="4">30 Days</option>
                                <option value="5">45 Days</option>
                                <option value="6">2 Months</option>
                                <option value="7">End of Following Month</option>
                                <option value="8">30% Now, Balance 60 Days</option>
                                <option value="9">30% Advance End of Following Month</option>
                              </select>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Fiscal Information</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_41"
                                data-original-title
                                title
                              >Fiscal Position</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one"
                                aria-atomic="true"
                                name="property_account_position_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_41"
                                  />
                                  <a role="button" class="o_dropdown_button" draggable="false"></a>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_group_col_6">
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
                                name="ref"
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
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_43"
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
                              <label class="o_form_label" for="o_field_input_44">Industry</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one"
                                aria-atomic="true"
                                name="industry_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_44"
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
                      <div class="o_group o_invisible_modifier o_group_col_6">
                        <table class="o_group o_inner_group o_group_col_12">
                          <tbody>
                            <tr>
                              <td colspan="2" style="width: 100%;">
                                <div class="o_horizontal_separator">Inventory</div>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label"
                                  for="o_field_input_45"
                                  data-original-title
                                  title
                                >Customer Location</label>
                              </td>
                              <td style="width: 100%;">
                                <div
                                  class="o_field_widget o_field_many2one o_with_button"
                                  aria-atomic="true"
                                  name="property_stock_customer"
                                >
                                  <div class="o_input_dropdown">
                                    <input
                                      type="text"
                                      class="o_input ui-autocomplete-input"
                                      autocomplete="off"
                                      id="o_field_input_45"
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
                                  class="o_form_label"
                                  for="o_field_input_46"
                                  data-original-title
                                  title
                                >Vendor Location</label>
                              </td>
                              <td style="width: 100%;">
                                <div
                                  class="o_field_widget o_field_many2one o_with_button"
                                  aria-atomic="true"
                                  name="property_stock_supplier"
                                >
                                  <div class="o_input_dropdown">
                                    <input
                                      type="text"
                                      class="o_input ui-autocomplete-input"
                                      autocomplete="off"
                                      id="o_field_input_46"
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
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="notebook_page_47">
                    <div class="o_group">
                      <table class="o_group o_inner_group o_group_col_6">
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
                                <div class="o_cp_controller">
                                  <div class="o_x2m_control_panel">
                                    <nav
                                      class="o_cp_buttons"
                                      aria-label="Control panel toolbar"
                                      role="toolbar"
                                    ></nav>
                                    <nav class="o_cp_pager" aria-label="Pager" role="toolbar">
                                      <div class="o_pager o_hidden">
                                        <span class="o_pager_counter">
                                          <span class="o_pager_value"></span> /
                                          <span class="o_pager_limit"></span>
                                        </span>
                                        <span class="btn-group" aria-atomic="true">
                                          <button
                                            type="button"
                                            class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                                            aria-label="Previous"
                                            title="Previous"
                                            tabindex="-1"
                                          ></button>
                                          <button
                                            type="button"
                                            class="fa fa-chevron-right btn btn-secondary o_pager_next"
                                            aria-label="Next"
                                            title="Next"
                                            tabindex="-1"
                                          ></button>
                                        </span>
                                      </div>
                                    </nav>
                                  </div>
                                </div>
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
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <button
                                type="button"
                                class="btn btn-link"
                                name="65"
                                context="{'search_default_partner_id': active_id, 'default_partner_id': active_id, 'form_view_ref': 'account.view_company_partner_bank_form'}"
                                colspan="2"
                              >
                                <span>View accounts detail</span>
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Accounting Entries</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier o_readonly_modifier"
                                for="o_field_input_48"
                                data-original-title
                                title
                              >Currency</label>
                            </td>
                            <td style="width: 100%;">
                              <a
                                class="o_form_uri o_field_widget o_invisible_modifier o_readonly_modifier"
                                href="#"
                                name="currency_id"
                                id="o_field_input_48"
                              >
                                <span></span>
                              </a>
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
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_49"
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
                                for="o_field_input_50"
                                data-original-title
                                title
                              >Account Payable</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one o_with_button o_required_modifier"
                                aria-atomic="true"
                                name="property_account_payable_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_50"
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
                        </tbody>
                      </table>
                    </div>
                    <div class="o_group o_invisible_modifier">
                      <div class="o_horizontal_separator">Credit Limit</div>
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td class="o_td_label">
                              <label class="o_form_label" for="o_field_input_51">Active Credit Limit</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_boolean o_field_widget custom-control custom-checkbox"
                                name="active_limit"
                              >
                                <input
                                  type="checkbox"
                                  id="o_field_input_51"
                                  class="custom-control-input"
                                />
                                <label for="o_field_input_51" class="custom-control-label">&#8203;</label>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier o_readonly_modifier"
                                for="o_field_input_52"
                              >Credit Limit Enabled</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_boolean o_field_widget custom-control custom-checkbox o_invisible_modifier o_readonly_modifier"
                                name="enable_credit_limit"
                              >
                                <input
                                  type="checkbox"
                                  id="checkbox-66"
                                  class="custom-control-input"
                                  disabled
                                />
                                <label for="o_field_input_52" class="custom-control-label">&#8203;</label>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier"
                                for="o_field_input_53"
                                data-original-title
                                title
                              >Warning Amount</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_float o_field_number o_field_widget o_input o_invisible_modifier"
                                name="warning_stage"
                                placeholder
                                type="text"
                                id="o_field_input_53"
                              />
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier"
                                for="o_field_input_54"
                                data-original-title
                                title
                              >Blocking Amount</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_float o_field_number o_field_widget o_input o_invisible_modifier"
                                name="blocking_stage"
                                placeholder
                                type="text"
                                id="o_field_input_54"
                              />
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="o_group o_invisible_modifier">
                      <div class="o_horizontal_separator">Indonesian Taxes</div>
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_55"
                                data-original-title
                                title
                              >
                                Kode
                                Transaksi
                              </label>
                            </td>
                            <td style="width: 100%;">
                              <select
                                class="o_input o_field_widget"
                                name="l10n_id_kode_transaksi"
                                id="o_field_input_55"
                              >
                                <option value="false"></option>
                                <option value="&quot;01&quot;">
                                  01 Kepada Pihak yang Bukan
                                  Pemungut PPN (Customer Biasa)
                                </option>
                                <option value="&quot;02&quot;">
                                  02 Kepada Pemungut
                                  Bendaharawan (Dinas Kepemerintahan)
                                </option>
                                <option value="&quot;03&quot;">
                                  03 Kepada Pemungut Selain
                                  Bendaharawan (BUMN)
                                </option>
                                <option value="&quot;04&quot;">04 DPP Nilai Lain (PPN 1%)</option>
                                <option value="&quot;06&quot;">
                                  06 Penyerahan Lainnya (Turis
                                  Asing)
                                </option>
                                <option value="&quot;07&quot;">
                                  07 Penyerahan yang PPN-nya
                                  Tidak Dipungut (Kawasan Ekonomi Khusus/ Batam)
                                </option>
                                <option value="&quot;08&quot;">
                                  08 Penyerahan yang PPN-nya
                                  Dibebaskan (Impor Barang Tertentu)
                                </option>
                                <option value="&quot;09&quot;">
                                  09 Penyerahan Aktiva ( Pasal
                                  16D UU PPN )
                                </option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label class="o_form_label" for="o_field_input_56">NIK</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_char o_field_widget o_input"
                                name="l10n_id_nik"
                                placeholder
                                type="text"
                                id="o_field_input_56"
                              />
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td class="o_td_label">
                              <label class="o_form_label" for="o_field_input_57">Tax Address</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_char o_field_widget o_input"
                                name="l10n_id_tax_address"
                                placeholder
                                type="text"
                                id="o_field_input_57"
                              />
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label class="o_form_label" for="o_field_input_58">Tax Name</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_char o_field_widget o_input"
                                name="l10n_id_tax_name"
                                placeholder
                                type="text"
                                id="o_field_input_58"
                              />
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane" id="notebook_page_59">
                    <div>
                      <p>
                        Accounting-related settings are managed on
                        <button
                          type="button"
                          name="open_commercial_entity"
                          class="btn btn-link"
                        >
                          <span>
                            the parent
                            company
                          </span>
                        </button>
                      </p>
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
</template>
<script>
export default {
    data(){
      return {
        state: {
            title:"company",
            name:'',
            parent_id:null,
            address: "contact",
        },
        address_type:[
          { label: "Company", value: "contact" },
          { label: "Invoice Address", value: "invoice" },
          { label: "Delivery Address", value: "delivery" },
          { label: "Other Address", value: "other" },
          { label: "Private Address", value: "private" },
        ],
        parent: {}
      }
    },
    mounted() {
      this.fetchParent();
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
        axios.post('/api/customer/company/list').then(response => {
          this.parent = response.data.result;
        }).catch(error => console.error(error));
      },
    }
}
</script>