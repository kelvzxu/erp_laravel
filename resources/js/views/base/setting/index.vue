<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_content">
        <div
          class="o_form_view oe_form_configuration o_base_settings o_form_nosheet o_form_editable"
        >
          <div class="o_control_panel">
            <div class="o_panel">
              <div class="title mb0 mt4 d-none d-md-block">
                <ol class="breadcrumb" role="navigation">
                  <li class="breadcrumb-item" accesskey="b">
                    <router-link
                      class="text-primary"
                      :to="{ name:'general_setting' }"
                    >General Settings</router-link>
                  </li>
                </ol>
              </div>
              <div class="o_setting_search">
                <input type="text" class="searchInput" placeholder="Search..." />
                <span class="searchIcon">
                  <i class="fa fa-search" role="img" aria-label="Search" title="Search"></i>
                </span>
              </div>
            </div>
            <div class="o_form_statusbar">
              <div class="o_statusbar_buttons">
                <button
                  type="button"
                  name="execute"
                  class="btn btn-primary"
                  data-original-title
                  title
                >
                  <span>Save</span>
                </button>
                <button
                  type="button"
                  name="cancel"
                  special="cancel"
                  class="btn btn-secondary"
                  data-original-title
                  title
                >
                  <span>Discard</span>
                </button>
              </div>
            </div>
          </div>
          <div class="o_setting_container">
            <div class="settings">
              <div
                class="app_settings_block"
                data-string="General Settings"
                string="General Settings"
                data-key="general_settings"
              >
                <div id="manage_users">
                  <h2>Users</h2>
                  <div class="row mt16 o_settings_container">
                    <div class="col-12 col-lg-6 o_setting_box">
                      <div class="o_setting_right_pane">
                        <span class="fa fa-lg fa-users"></span>
                        <span
                          class="o_field_integer o_field_number o_field_widget o_readonly_modifier w-auto pl-3 font-weight-bold"
                        >{{data.internaluser}}</span>
                        <span class="o_form_label">Internal Users</span>
                        <br />
                        <a
                          href="/User/InternalUser"
                          class="btn btn-link o_web_settings_access_rights"
                        >
                          <i class="fa fa-fw o_button_icon fa-arrow-right"></i>
                          <span>Manage Users</span>
                        </a>
                      </div>
                    </div>
                    <div class="col-12 col-lg-6 o_setting_box">
                      <div class="o_setting_right_pane">
                        <span class="fa fa-lg fa-users"></span>
                        <span
                          class="o_field_integer o_field_number o_field_widget o_readonly_modifier w-auto pl-3 font-weight-bold"
                        >{{data.portaluser}}</span>
                        <span class="o_form_label">Portal Users</span>
                        <br />
                        <a href="/User/Portal" class="btn btn-link o_web_settings_access_rights">
                          <i class="fa fa-fw o_button_icon fa-arrow-right"></i>
                          <span>Manage Users</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="companies">
                  <h2>Companies</h2>
                  <div class="row mt16 o_settings_container">
                    <div class="col-12 col-lg-6 o_setting_box">
                      <div class="o_setting_right_pane">
                        <span
                          class="o_field_char o_field_widget o_readonly_modifier font-weight-bold"
                          name="company_name"
                          data-original-title
                          title
                        >My Company</span>
                        <br />
                        <span
                          class="o_field_text o_field_widget o_readonly_modifier text-muted"
                          name="company_informations"
                          style="width: 90%;"
                          data-original-title
                          title
                        >Indonesia</span>
                        <br />
                        <button
                          type="button"
                          name="open_company"
                          class="btn btn-link"
                          data-original-title
                          title
                        >
                          <i class="fa fa-fw o_button_icon fa-arrow-right"></i>
                          <span>Update Info</span>
                        </button>
                      </div>
                    </div>
                    <div class="col-12 col-lg-6 o_setting_box">
                      <div class="o_setting_right_pane">
                        <span class="fa fa-lg fa-building-o"></span>
                        <span
                          class="o_field_integer o_field_number o_field_widget o_readonly_modifier w-auto pl-1 font-weight-bold"
                          name="company_count"
                          data-original-title
                          title
                        >{{data.company}}</span>
                        <span class="o_form_label">Companies</span>
                        <br />
                        <div class="mt8">
                          <router-link
                            type="button"
                            :to="{ name:'company_index' }"
                            class="btn btn-link"
                          >
                            <i class="fa fa-fw o_button_icon fa-arrow-right"></i>
                            <span>Manage Companies</span>
                          </router-link>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="languages">
                  <h2>Languages</h2>
                  <div class="row mt16 o_settings_container">
                    <div class="col-xs-12 col-md-6 o_setting_box">
                      <div class="o_setting_right_pane">
                        <div class="w-50">
                          <span
                            class="o_field_integer o_field_number o_field_widget o_readonly_modifier w-auto pl-1 font-weight-bold"
                            name="language_count"
                            data-original-title
                            title
                          >{{data.lang}}</span>
                          <span class="o_form_label">Languages</span>
                        </div>
                        <div class="mt8">
                          <router-link
                            type="button"
                            :to="{ name:'lang_index' }"
                            class="btn btn-link"
                          >
                            <i class="fa fa-fw o_button_icon fa-arrow-right"></i>
                            <span>Manage Languages</span>
                          </router-link>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="currencies">
                  <h2>Currencies</h2>
                  <div class="row o_settings_container mt16">
                    <div class="col-12 col-lg-6 o_setting_box">
                      <div class="o_setting_left_pane"></div>
                      <div class="o_setting_right_pane">
                        <span class="o_form_label">
                          <span class="highlighter"></span>Main Currency
                        </span>
                        <span
                          class="fa fa-lg fa-building-o"
                          title="Values set here are company-specific."
                          aria-label="Values set here are company-specific."
                          role="img"
                        ></span>
                        <div class="text-muted">Main currency of your company</div>
                        <div class="content-group">
                          <div class="mt16 row">
                            <label
                              class="o_form_label col-3 col-lg-3 o_light_label"
                              for="o_field_input_121"
                              data-original-title
                              title
                            >Currency</label>
                            <div class="o_field_widget o_field_many2one o_required_modifier">
                              <select
                                v-model="state.default_currency"
                                class="o_input ui-autocomplete-input"
                              >
                                <option :select="state.default_currency" :value="null"></option>
                                <option
                                  v-for="row in currency"
                                  :select="row.id == state.default_currency"
                                  :key="row.id"
                                  :value="row.id"
                                >{{ row.currency_name }} ({{ row.symbol }})</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-6 o_setting_box">
                      <div class="o_setting_left_pane">
                        <div
                          class="o_field_boolean o_field_widget custom-control custom-checkbox"
                          name="group_multi_currency"
                        >
                          <input
                            type="checkbox"
                            id="o_field_input_160"
                            class="custom-control-input"
                            @change="mutli_currency"
                          />
                          <label for="o_field_input_160" class="custom-control-label">&#8203;</label>
                        </div>
                      </div>
                      <div class="o_setting_right_pane">
                        <label
                          class="o_form_label"
                          for="o_field_input_160"
                          data-original-title
                          title
                        >
                          <span class="highlighter"></span>Multi-Currencies
                        </label>
                        <div class="text-muted">Record transactions in foreign currencies</div>
                        <div class="content-group" v-if="state.mutli_currency == true">
                          <div class="mt8">
                            <button
                              type="button"
                              name="71"
                              class="btn btn-link"
                              data-original-title
                              title
                            >
                              <i class="fa fa-fw o_button_icon fa-arrow-right"></i>
                              <span>Activate Other Currencies</span>
                            </button>
                          </div>
                          <div class="row mt16 o_invisible_modifier">
                            <label
                              class="o_form_label col-lg-3 o_light_label"
                              for="o_field_input_161"
                              data-original-title
                              title
                            >
                              <span class="highlighter"></span>Exchange Gain or Loss Journal
                            </label>
                            <div
                              class="o_field_widget o_field_many2one o_with_button"
                              aria-atomic="true"
                              name="currency_exchange_journal_id"
                            >
                              <div class="o_input_dropdown">
                                <input
                                  type="text"
                                  class="o_input ui-autocomplete-input"
                                  autocomplete="off"
                                  id="o_field_input_161"
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
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="col-12 col-lg-6 o_setting_box o_invisible_modifier"
                      attrs="{'invisible': [('group_multi_currency', '=', False)]}"
                    >
                      <div class="o_setting_left_pane">
                        <div
                          class="o_field_boolean o_field_widget custom-control custom-checkbox"
                          name="module_currency_rate_live"
                        >
                          <input type="checkbox" id="checkbox-1125" class="custom-control-input" />
                          <label for="checkbox-1125" class="custom-control-label">&#8203;</label>
                        </div>
                      </div>
                      <div class="o_setting_right_pane">
                        <label
                          class="o_form_label"
                          for="o_field_input_162"
                          data-original-title
                          title
                        >
                          Automatic Currency Rates&nbsp;
                          <span
                            class="badge badge-primary oe_inline o_enterprise_label"
                          >Enterprise</span>
                        </label>
                        <div
                          class="text-muted"
                          id="update_currency_live"
                        >Update exchange rates automatically</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="business_documents">
                  <h2>Business Documents</h2>
                  <div class="row mt16 o_settings_container">
                    <div class="col-12 col-lg-6 o_setting_box">
                      <div class="o_setting_right_pane">
                        <span class="o_form_label">Format</span>
                        <span
                          class="fa fa-lg fa-building-o o_invisible_modifier"
                          title="Values set here are company-specific."
                          aria-label="Values set here are company-specific."
                          role="img"
                          invisible="1"
                        ></span>
                        <div class="text-muted">Set the paper format of printed documents</div>
                        <div class="content-group">
                          <div class="mt16 row">
                            <label
                              class="o_form_label col-3 col-lg-3 o_light_label"
                              for="o_field_input_121"
                              data-original-title
                              title
                            >Format</label>
                            <div
                              class="o_field_widget o_field_many2one o_with_button o_required_modifier oe_inline"
                              aria-atomic="true"
                              name="paperformat_id"
                            >
                              <div class="o_input_dropdown">
                                <input
                                  type="text"
                                  class="o_input ui-autocomplete-input"
                                  autocomplete="off"
                                  id="o_field_input_121"
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
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-6 o_setting_box">
                      <div class="o_setting_right_pane">
                        <span class="o_form_label">Document Layout</span>
                        <span
                          class="fa fa-lg fa-building-o o_invisible_modifier"
                          title="Values set here are company-specific."
                          aria-label="Values set here are company-specific."
                          role="img"
                          invisible="1"
                        ></span>
                        <div class="text-muted">Choose the layout of your documents</div>
                        <div class="content-group">
                          <div class="mt16">
                            <label
                              class="o_form_label col-3 col-lg-3 o_light_label"
                              for="o_field_input_122"
                              data-original-title
                              title
                            >Layout</label>
                            <div
                              class="o_field_widget o_field_many2one oe_inline"
                              aria-atomic="true"
                              name="external_report_layout_id"
                            >
                              <div class="o_input_dropdown">
                                <input
                                  type="text"
                                  class="o_input ui-autocomplete-input"
                                  autocomplete="off"
                                  id="o_field_input_122"
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
                          </div>
                          <div class="mt8">
                            <button
                              type="button"
                              name="50"
                              class="btn btn-link"
                              data-original-title
                              title
                            >
                              <i class="fa fa-fw o_button_icon fa-arrow-right"></i>
                              <span>Configure Document Layout</span>
                            </button>
                            <button
                              type="button"
                              name="edit_external_header"
                              class="btn btn-link"
                              data-original-title
                              title
                            >
                              <span>Edit Layout</span>
                            </button>
                            <button
                              type="button"
                              name="82"
                              class="btn btn-link"
                              data-original-title
                              title
                            >
                              <span>Preview Document</span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="contacts_settings">
                  <h2>Contacts</h2>
                  <div class="row mt16 o_settings_container">
                    <div class="col-xs-12 col-md-6 o_setting_box" id="sms">
                      <div class="o_setting_right_pane" id="sms_settings">
                        <div class="o_form_label">Send SMS</div>
                        <div class="text-muted">Send texts to your contacts</div>
                        <div class="o_field_iap_buy_more_credits o_widget">
                          <div class="mt-2 row">
                            <div class="col-sm">
                              <button class="btn btn-link buy_credits">
                                <i class="fa fa-arrow-right"></i> Buy credits
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="col-xs-12 col-md-6 o_setting_box"
                      title="When populating your address book, Odoo provides a list of matching companies. When selecting one item, the company data and logo are auto-filled."
                      id="partner_autocomplete"
                    >
                      <div class="o_setting_left_pane">
                        <div
                          class="o_field_boolean o_field_widget custom-control custom-checkbox"
                          name="module_partner_autocomplete"
                        >
                          <input
                            type="checkbox"
                            id="o_field_input_123"
                            class="custom-control-input"
                          />
                          <label for="o_field_input_123" class="custom-control-label">&#8203;</label>
                        </div>
                      </div>
                      <div class="o_setting_right_pane" id="partner_autocomplete_settings">
                        <label
                          class="o_form_label"
                          for="o_field_input_123"
                          data-original-title
                          title
                        >Partner Autocomplete</label>
                        <div
                          class="text-muted"
                        >Automatically enrich your contact base with company data</div>
                        <div class="o_field_iap_buy_more_credits o_widget">
                          <div class="mt-2 row">
                            <div class="col-sm">
                              <button class="btn btn-link buy_credits">
                                <i class="fa fa-arrow-right"></i> Buy credits
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <h2>Discuss</h2>
                <div class="row mt16 o_settings_container" id="emails">
                  <div class="col-12 col-lg-6 o_setting_box">
                    <div class="o_setting_left_pane"></div>
                    <div class="o_setting_right_pane">
                      <span class="o_form_label">Activities</span>
                      <div class="text-muted">Configure your activity types</div>
                      <div class="content-group">
                        <div class="mt8">
                          <button
                            type="button"
                            name="106"
                            class="btn btn-link"
                            data-original-title
                            title
                          >
                            <i class="fa fa-fw o_button_icon fa-arrow-right"></i>
                            <span>Activity Types</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    class="col-12 col-lg-6 o_setting_box"
                    title="Using your own email server is required to send/receive emails in Community and Enterprise versions. Online users already benefit from a ready-to-use email server (@mycompany.odoo.com)."
                  >
                    <div class="o_setting_left_pane">
                      <div
                        class="o_field_boolean o_field_widget custom-control custom-checkbox"
                        name="external_email_server_default"
                      >
                        <input type="checkbox" id="o_field_input_124" class="custom-control-input" />
                        <label for="o_field_input_124" class="custom-control-label">&#8203;</label>
                      </div>
                    </div>
                    <div class="o_setting_right_pane">
                      <label
                        class="o_form_label"
                        for="o_field_input_124"
                        data-original-title
                        title
                      >External Email Servers</label>
                      <div
                        class="text-muted"
                        id="external_email_server_default"
                      >Use your own email servers</div>
                      <div
                        class="content-group o_invisible_modifier"
                        attrs="{'invisible': [('external_email_server_default', '=', False)]}"
                      >
                        <div class="row mt16" id="mail_alias_domain">
                          <label
                            class="o_form_label col-lg-3 o_light_label"
                            for="o_field_input_125"
                            data-original-title
                            title
                          >Alias Domain</label>
                          <input
                            class="o_field_char o_field_widget o_input"
                            name="alias_domain"
                            placeholder="mycompany.odoo.com"
                            type="text"
                            id="o_field_input_125"
                          />
                        </div>
                        <div class="mt8">
                          <button
                            type="button"
                            name="125"
                            class="btn btn-link"
                            data-original-title
                            title
                          >
                            <i class="fa fa-fw o_button_icon fa-arrow-right"></i>
                            <span>Incoming Email Servers</span>
                          </button>
                        </div>
                        <div class="mt8">
                          <button
                            type="button"
                            name="14"
                            class="btn btn-link"
                            data-original-title
                            title
                          >
                            <i class="fa fa-fw o_button_icon fa-arrow-right"></i>
                            <span>Outgoing Email Servers</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <h2>Users</h2>
                <div class="row mt16 o_settings_container" id="user_default_rights">
                  <div
                    class="col-12 col-lg-6 o_setting_box"
                    title="By default, new users get highest access rights for all installed apps."
                    id="access_rights"
                  >
                    <div class="o_setting_left_pane">
                      <div
                        class="o_field_boolean o_field_widget custom-control custom-checkbox"
                        name="user_default_rights"
                      >
                        <input type="checkbox" id="o_field_input_126" class="custom-control-input" />
                        <label for="o_field_input_126" class="custom-control-label">&#8203;</label>
                      </div>
                    </div>
                    <div class="o_setting_right_pane">
                      <label
                        class="o_form_label"
                        for="o_field_input_126"
                        data-original-title
                        title
                      >Default Access Rights</label>
                      <div class="text-muted">Set custom access rights for new users</div>
                      <div
                        class="content-group o_invisible_modifier"
                        attrs="{'invisible': [('user_default_rights','=',False)]}"
                      >
                        <div class="mt8">
                          <button
                            type="button"
                            name="open_default_user"
                            class="btn btn-link"
                            data-original-title
                            title
                          >
                            <i class="fa fa-fw o_button_icon fa-arrow-right"></i>
                            <span>Default Access Rights</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    class="col-12 col-lg-6 o_setting_box"
                    title=" To send invitations in B2B mode, open a contact or select several ones in list view and click on 'Portal Access Management' option in the dropdown menu *Action*."
                  >
                    <div class="o_setting_left_pane"></div>
                    <div class="o_setting_right_pane">
                      <label
                        class="o_form_label"
                        for="o_field_input_127"
                        data-original-title
                        title
                      >Customer Account</label>
                      <div class="text-muted">Let your customers log in to see their documents</div>
                      <div class="mt8">
                        <div
                          class="o_field_radio o_vertical o_field_widget o_required_modifier o_light_label"
                          name="auth_signup_uninvited"
                        >
                          <div class="custom-control custom-radio o_radio_item" aria-atomic="true">
                            <input
                              type="radio"
                              class="custom-control-input o_radio_input"
                              data-value="b2b"
                              data-index="0"
                              id="radio231_b2b"
                            />
                            <label
                              class="custom-control-label o_form_label"
                              for="radio231_b2b"
                            >On invitation</label>
                          </div>

                          <div class="custom-control custom-radio o_radio_item" aria-atomic="true">
                            <input
                              type="radio"
                              class="custom-control-input o_radio_input"
                              checked="true"
                              data-value="b2c"
                              data-index="1"
                              id="radio231_b2c"
                            />
                            <label
                              class="custom-control-label o_form_label"
                              for="radio231_b2c"
                            >Free sign up</label>
                          </div>
                        </div>
                      </div>
                      <div
                        class="content-group"
                        attrs="{'invisible': [('auth_signup_uninvited','=','b2b')]}"
                      >
                        <div class="mt8">
                          <button
                            type="button"
                            name="open_template_user"
                            class="btn btn-link"
                            data-original-title
                            title
                          >
                            <i class="fa fa-fw o_button_icon fa-arrow-right"></i>
                            <span>Default Access Rights</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 o_setting_box">
                    <div class="o_setting_left_pane">
                      <div
                        class="o_field_boolean o_field_widget custom-control custom-checkbox"
                        name="auth_signup_reset_password"
                      >
                        <input type="checkbox" id="o_field_input_129" class="custom-control-input" />
                        <label for="o_field_input_129" class="custom-control-label">&#8203;</label>
                      </div>
                    </div>
                    <div class="o_setting_right_pane">
                      <label
                        class="o_form_label"
                        for="o_field_input_129"
                        data-original-title
                        title
                      >Password Reset</label>
                      <div class="text-muted">Enable password reset from Login page</div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 o_setting_box" id="allow_import">
                    <div class="o_setting_left_pane">
                      <div
                        class="o_field_boolean o_field_widget custom-control custom-checkbox"
                        name="module_base_import"
                      >
                        <input type="checkbox" id="o_field_input_130" class="custom-control-input" />
                        <label for="o_field_input_130" class="custom-control-label">&#8203;</label>
                      </div>
                    </div>
                    <div class="o_setting_right_pane">
                      <label
                        class="o_form_label"
                        for="o_field_input_130"
                        data-original-title
                        title
                      >Import &amp; Export</label>
                      <div class="text-muted">Allow users to import data from CSV/XLS/XLSX/ODS files</div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 o_setting_box">
                    <div class="o_setting_left_pane">
                      <div
                        class="o_field_boolean o_field_widget custom-control custom-checkbox"
                        name="show_effect"
                      >
                        <input type="checkbox" id="o_field_input_131" class="custom-control-input" />
                        <label for="o_field_input_131" class="custom-control-label">&#8203;</label>
                      </div>
                    </div>
                    <div class="o_setting_right_pane">
                      <label
                        class="o_form_label"
                        for="o_field_input_131"
                        data-original-title
                        title
                      >Show Effect</label>
                      <div class="text-muted">Add fun feedback and motivate your employees</div>
                    </div>
                  </div>
                </div>
                <div id="iap_portal">
                  <h2>In-App Purchases</h2>
                  <div class="row mt16 o_settings_container iap_portal">
                    <div class="col-12 col-lg-6 o_setting_box">
                      <div class="o_setting_right_pane">
                        <div class="o_form_label">Odoo IAP</div>
                        <div class="text-muted">View your IAP Services and recharge your credits</div>
                        <div class="mt8">
                          <button
                            type="button"
                            name="93"
                            class="btn btn-link"
                            data-original-title
                            title
                          >
                            <i class="fa fa-fw o_button_icon fa-arrow-right"></i>
                            <span>View My Services</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="multi_company" invisible="1" class="o_invisible_modifier">
                  <div
                    class="o_field_widget o_field_many2one o_with_button o_invisible_modifier o_required_modifier"
                    aria-atomic="true"
                    name="company_id"
                    data-original-title
                    title
                  >
                    <div class="o_input_dropdown">
                      <input
                        type="text"
                        class="o_input ui-autocomplete-input"
                        autocomplete="off"
                        id="o_field_input_188"
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
                  <h2>Multi-Company</h2>
                  <div class="row mt16 o_settings_container" name="multi">
                    <div
                      class="col-12 col-lg-6 o_setting_box"
                      title="Configure company rules to automatically create SO/PO when one of your company sells/buys to another of your company."
                      id="inter_company"
                    >
                      <div class="o_setting_left_pane">
                        <div
                          class="o_field_boolean o_field_widget custom-control custom-checkbox"
                          name="module_inter_company_rules"
                        >
                          <input type="checkbox" id="checkbox-261" class="custom-control-input" />
                          <label for="checkbox-261" class="custom-control-label">&#8203;</label>
                        </div>
                      </div>
                      <div class="o_setting_right_pane">
                        <label
                          class="o_form_label"
                          for="o_field_input_132"
                          data-original-title
                          title
                        >
                          Inter-Company Transactions&nbsp;
                          <span
                            class="badge badge-primary oe_inline o_enterprise_label"
                          >Enterprise</span>
                        </label>
                        <span
                          class="fa fa-lg fa-building-o o_invisible_modifier"
                          title="Values set here are company-specific."
                          aria-label="Values set here are company-specific."
                          role="img"
                          invisible="1"
                        ></span>
                        <div
                          class="text-muted"
                        >Automatically generate counterpart documents for orders/invoices between companies</div>
                        <div
                          class="content-group o_invisible_modifier"
                          attrs="{'invisible': [('module_inter_company_rules','=',False)]}"
                          id="inter_companies_rules"
                        >
                          <div class="mt16 text-warning">
                            <strong>Save</strong> this page and come back here to set up the feature.
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <h2>Integrations</h2>
                <div class="row mt16 o_settings_container" name="integration">
                  <div class="col-12 col-lg-6 o_setting_box">
                    <div class="o_setting_left_pane">
                      <div
                        class="o_field_boolean o_field_widget custom-control custom-checkbox"
                        name="module_pad"
                      >
                        <input type="checkbox" id="o_field_input_133" class="custom-control-input" />
                        <label for="o_field_input_133" class="custom-control-label">&#8203;</label>
                      </div>
                    </div>
                    <div class="o_setting_right_pane">
                      <label
                        class="o_form_label"
                        for="o_field_input_133"
                        data-original-title
                        title
                      >Collaborative Pads</label>
                      <div class="text-muted">Use external pads in Odoo Notes</div>
                      <div
                        class="content-group o_invisible_modifier"
                        attrs="{'invisible': [('module_pad','=',False)]}"
                        id="msg_module_pad"
                      >
                        <div class="text-warning mt16">
                          <strong>Save</strong> this page and come back here to set up the feature.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 o_setting_box">
                    <div class="o_setting_left_pane">
                      <div
                        class="o_field_boolean o_field_widget custom-control custom-checkbox"
                        name="module_google_calendar"
                      >
                        <input type="checkbox" id="o_field_input_134" class="custom-control-input" />
                        <label for="o_field_input_134" class="custom-control-label">&#8203;</label>
                      </div>
                    </div>
                    <div class="o_setting_right_pane">
                      <label
                        class="o_form_label"
                        for="o_field_input_134"
                        data-original-title
                        title
                      >Google Calendar</label>
                      <div class="text-muted">Synchronize your calendar with Google Calendar</div>
                      <div
                        class="content-group o_invisible_modifier"
                        attrs="{'invisible': [('module_google_calendar','=',False)]}"
                        id="msg_module_google_calendar"
                      >
                        <div class="text-warning mt16">
                          <strong>Save</strong> this page and come back here to set up the feature.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 o_setting_box">
                    <div class="o_setting_left_pane">
                      <div
                        class="o_field_boolean o_field_widget custom-control custom-checkbox"
                        name="module_google_drive"
                      >
                        <input type="checkbox" id="o_field_input_135" class="custom-control-input" />
                        <label for="o_field_input_135" class="custom-control-label">&#8203;</label>
                      </div>
                    </div>
                    <div class="o_setting_right_pane">
                      <label
                        class="o_form_label"
                        for="o_field_input_135"
                        data-original-title
                        title
                      >Google Drive</label>
                      <div class="text-muted">Create and attach Google Drive documents to any record</div>
                      <div
                        class="content-group mt16 o_invisible_modifier"
                        attrs="{'invisible': [('module_google_drive','=',False)]}"
                        id="msg_module_google_drive"
                      >
                        <div class="mt16 text-warning">
                          <strong>Save</strong> this page and come back here to set up the feature.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 o_setting_box">
                    <div class="o_setting_left_pane">
                      <div
                        class="o_field_boolean o_field_widget custom-control custom-checkbox"
                        name="module_google_spreadsheet"
                      >
                        <input type="checkbox" id="o_field_input_136" class="custom-control-input" />
                        <label for="o_field_input_136" class="custom-control-label">&#8203;</label>
                      </div>
                    </div>
                    <div class="o_setting_right_pane">
                      <label
                        class="o_form_label"
                        for="o_field_input_136"
                        data-original-title
                        title
                      >Google Spreadsheet</label>
                      <div class="text-muted">Extract and analyze Odoo data from Google Spreadsheet</div>
                      <div
                        class="content-group o_invisible_modifier"
                        attrs="{'invisible': [('module_google_spreadsheet','=',False)]}"
                        id="msg_module_google_spreadsheet"
                      >
                        <div class="mt16 text-warning">
                          <strong>Save</strong> this page and come back here to set up the feature.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 o_setting_box" id="module_auth_oauth">
                    <div class="o_setting_left_pane">
                      <div
                        class="o_field_boolean o_field_widget custom-control custom-checkbox"
                        name="module_auth_oauth"
                      >
                        <input type="checkbox" id="o_field_input_137" class="custom-control-input" />
                        <label for="o_field_input_137" class="custom-control-label">&#8203;</label>
                      </div>
                    </div>
                    <div class="o_setting_right_pane">
                      <label
                        class="o_form_label"
                        for="o_field_input_137"
                        data-original-title
                        title
                      >OAuth Authentication</label>
                      <div
                        class="text-muted"
                      >Use external accounts to log in (Google, Facebook, etc.)</div>
                      <div
                        class="content-group mt16 o_invisible_modifier"
                        attrs="{'invisible': [('module_auth_oauth','=',False)]}"
                        id="msg_module_auth_oauth"
                      >
                        <div class="mt16 text-warning">
                          <strong>Save</strong> this page and come back here to set up the feature.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 o_setting_box" id="oauth">
                    <div class="o_setting_left_pane">
                      <div
                        class="o_field_boolean o_field_widget custom-control custom-checkbox"
                        name="module_auth_ldap"
                        data-original-title
                        title
                      >
                        <input type="checkbox" id="o_field_input_189" class="custom-control-input" />
                        <label for="o_field_input_189" class="custom-control-label">&#8203;</label>
                      </div>
                    </div>
                    <div class="o_setting_right_pane" name="auth_ldap_right_pane">
                      <label class="o_form_label" for="o_field_input_138">LDAP Authentication</label>
                      <div class="text-muted">Use LDAP credentials to log in</div>
                      <div
                        class="content-group o_invisible_modifier"
                        attrs="{'invisible': [('module_auth_ldap','=',False)]}"
                        id="auth_ldap_warning"
                      >
                        <div class="mt16 text-warning">
                          <strong>Save</strong> this page and come back here to set up the feature.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 o_setting_box" id="gengo">
                    <div class="o_setting_left_pane">
                      <div
                        class="o_field_boolean o_field_widget custom-control custom-checkbox"
                        name="module_base_gengo"
                      >
                        <input type="checkbox" id="o_field_input_139" class="custom-control-input" />
                        <label for="o_field_input_139" class="custom-control-label">&#8203;</label>
                      </div>
                    </div>
                    <div class="o_setting_right_pane" name="base_gengo_right_pane">
                      <label
                        class="o_form_label"
                        for="o_field_input_139"
                        data-original-title
                        title
                      >Gengo Translations</label>
                      <div class="text-muted">Translate your website with Gengo</div>
                      <div
                        class="content-group o_invisible_modifier"
                        attrs="{'invisible': [('module_base_gengo','=',False)]}"
                        name="base_gengo_warning"
                      >
                        <div class="mt16 text-warning">
                          <strong>Save</strong> this page and come back here to set up the feature.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 o_setting_box" id="unsplash">
                    <div class="o_setting_left_pane">
                      <div
                        class="o_field_boolean o_field_widget custom-control custom-checkbox"
                        name="module_web_unsplash"
                      >
                        <input type="checkbox" id="o_field_input_140" class="custom-control-input" />
                        <label for="o_field_input_140" class="custom-control-label">&#8203;</label>
                      </div>
                    </div>
                    <div class="o_setting_right_pane" id="web_unsplash_settings">
                      <label
                        class="o_form_label"
                        for="o_field_input_140"
                        data-original-title
                        title
                      >Unsplash Image Library</label>
                      <div class="text-muted">Find free high-resolution images from Unsplash</div>
                      <div attrs="{'invisible': [('module_web_unsplash', '=', False)]}">
                        <div class="content-group mt16">
                          <label
                            class="o_form_label o_light_label"
                            for="o_field_input_141"
                            data-original-title
                            title
                          >Access Key</label>
                          <input
                            class="o_field_char o_field_widget o_input"
                            name="unsplash_access_key"
                            placeholder
                            type="text"
                            id="o_field_input_141"
                          />
                        </div>
                        <div>
                          <a
                            href="https://www.odoo.com/documentation/user/general/unsplash/unsplash_access_key.html"
                            class="oe_link"
                            target="_blank"
                          >
                            <i class="fa fa-arrow-right"></i> Generate an Access Key
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 o_setting_box" id="base_geolocalize">
                    <div class="o_setting_left_pane">
                      <div
                        class="o_field_boolean o_field_widget custom-control custom-checkbox"
                        name="module_base_geolocalize"
                      >
                        <input type="checkbox" id="o_field_input_142" class="custom-control-input" />
                        <label for="o_field_input_142" class="custom-control-label">&#8203;</label>
                      </div>
                    </div>
                    <div class="o_setting_right_pane" id="web_geolocalize_settings">
                      <label
                        class="o_form_label"
                        for="o_field_input_142"
                        data-original-title
                        title
                      >Geo Localization</label>
                      <div class="text-muted">GeoLocalize your partners</div>
                      <div
                        class="content-group o_invisible_modifier"
                        attrs="{'invisible': [('module_base_geolocalize','=', False)]}"
                        name="base_geolocalize_warning"
                      >
                        <div class="mt16 text-warning">
                          <strong>Save</strong> this page and come back here to choose your Geo Provider.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="o_widget">
                  <div id="developer_tool">
                    <h2>Developer Tools</h2>
                    <div class="row mt16 o_settings_container">
                      <div class="col-12 col-lg-6 o_setting_box" id="devel_tool">
                        <div class="o_setting_right_pane">
                          <a
                            class="d-block"
                            href="?debug=assets"
                          >Activate the developer mode (with assets)</a>
                          <a
                            class="d-block"
                            href="?debug=assets,tests"
                          >Activate the developer mode (with tests assets)</a>
                          <a class="d-block" href="?debug=">Deactivate the developer mode</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="about">
                  <h2>About</h2>
                  <div class="row mt16 o_settings_container">
                    <div class="col-12 col-lg-6 o_setting_box" id="appstore">
                      <div class="d-flex">
                        <div class="o_setting_right_pane mr-3">
                          <a
                            class="d-block mx-auto"
                            href="https://kltech-intl.technology"
                            target="blank"
                          >
                            <img
                              alt="kltech-intl.technology"
                              class="d-block mx-auto img img-fluid"
                              width="190px"
                              v-bind:src="'/images/icons/kltech-intl.png'"
                            />
                          </a>
                        </div>
                        <div>
                          <a class="d-block mx-auto" href="https://laravel.com/" target="blank">
                            <img
                              class="mark"
                              v-bind:src="'/images/logo/logomark.min.svg'"
                              alt="Laravel"
                            />
                            <img
                              class="type"
                              v-bind:src="'/images/logo/logotype.min.svg'"
                              alt="Laravel"
                            />
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="o_widget">
                      <div class="col-12 o_setting_box" id="edition">
                        <div class="o_setting_right_pane">
                          <div class="user-heading">
                            <h3>
                              Laravel ERP System 3.0
                              (Community Edition)
                            </h3>
                          </div>
                          <div>
                            <div class="tab-content">
                              <div
                                role="tabpanel"
                                id="settings"
                                class="tab-pane active text-muted o_web_settings_compact_subtitle"
                              >
                                <small>
                                  Copyright © 2020
                                  <a
                                    target="_blank"
                                    href="https://kltech-intl.technology"
                                    style="text-decoration: underline;"
                                  >kltech-intl</a>
                                  <a
                                    target="_blank"
                                    href="http://www.gnu.org/licenses/lgpl.html"
                                    style="text-decoration: underline;"
                                  >GNU LGPL Licensed</a>
                                </small>
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
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      data: {
        lang: null,
      },
      state: {
        mutli_currency: false,
        default_currency: null,
      },
      currency: {},
    };
  },
  mounted() {
    this.prepare_data();
    this.fetchCurrency();
  },
  methods: {
    prepare_data() {
      this.count_internal_user();
      this.count_portal_user();
      this.count_company();
      this.count_language();
    },
    count_internal_user() {
      axios
        .get("/api/user/internal/count")
        .then((response) => {
          this.data.internaluser = response.data.result;
        })
        .catch((error) => console.error(error));
    },
    count_portal_user() {
      axios
        .get("/api/user/portal/count")
        .then((response) => {
          this.data.portaluser = response.data.result;
        })
        .catch((error) => console.error(error));
    },
    count_company() {
      axios
        .get("/api/company/count")
        .then((response) => {
          this.data.company = response.data.result;
        })
        .catch((error) => console.error(error));
    },
    count_language() {
      axios
        .get("/api/lang/count")
        .then((response) => {
          this.data.lang = response.data.result;
        })
        .catch((error) => console.error(error));
    },
    fetchCurrency() {
      axios
        .get("/api/currency")
        .then((response) => {
          this.currency = response.data;
        })
        .catch((error) => console.error(error));
    },
    mutli_currency() {
      console.log(this.state.mutli_currency);
      if (this.state.mutli_currency == true) {
        console.log("okk");
        this.state.mutli_currency = false;
      } else if (this.state.mutli_currency == false) {
        console.log("siap");
        this.state.mutli_currency = true;
      }
    },
  },
};
</script>