<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item" accesskey="b">
                <router-link class="text-primary" :to="{ name:'employee_index' }">Employees</router-link>
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
            <div class="o_cp_right"></div>
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
                  class="btn btn btn-primary o_employee_chat_btn o_invisible_modifier"
                  data-original-title
                  title
                >
                  <span>Chat</span>
                </button>
              </div>
            </div>
            <div class="clearfix position-relative o_form_sheet">
              <div class="o_not_full oe_button_box">
                <button type="button" name="161" class="btn oe_stat_button">
                  <i class="fa fa-fw o_button_icon fa-book"></i>
                  <div
                    name="contracts_count"
                    class="o_field_widget o_stat_info o_readonly_modifier"
                    data-original-title
                    title
                  >
                    <span class="o_stat_value">0</span>
                    <span class="o_stat_text">Contracts</span>
                  </div>
                </button>
                <button type="button" name="197" class="btn oe_stat_button">
                  <i class="fa fa-fw o_button_icon fa-credit-card"></i>
                  <div
                    name="payslip_count"
                    class="o_field_widget o_stat_info o_readonly_modifier"
                    data-original-title
                    title
                  >
                    <span class="o_stat_value">0</span>
                    <span class="o_stat_text">Payslips</span>
                  </div>
                </button>
                <button type="button" name="184" class="btn oe_stat_button">
                  <i class="fa fa-fw o_button_icon fa-clock-o"></i>
                  <div
                    name="late_check_in_count"
                    class="o_field_widget o_stat_info o_readonly_modifier"
                    data-original-title
                    title
                  >
                    <span class="o_stat_value">0</span>
                    <span class="o_stat_text">Late Check-In</span>
                  </div>
                </button>
                <button type="button" name="222" class="btn oe_stat_button">
                  <i class="fa fa-fw o_button_icon fa-clock-o"></i>
                  <div class="o_field_widget o_stat_info">
                    <span class="o_stat_value">
                      <span
                        class="o_field_char o_field_widget o_readonly_modifier"
                        name="hours_last_month_display"
                        data-original-title
                        title
                      ></span> Hours
                    </span>
                    <span class="o_stat_text">Last Month</span>
                  </div>
                </button>
              </div>
              <div class="ribbon ribbon-top-right o_invisible_modifier o_widget">
                <span class="bg-danger">Archived</span>
              </div>
              <div
                class="o_field_image o_field_widget oe_avatar"
                aria-atomic="true"
                name="image_1920"
                data-original-title
                title
              >
                <img
                  class="img img-fluid"
                  alt="Binary file"
                  src="data:image/png;base64,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"
                  border="1"
                  name="image_1920"
                />

                <div class="o_form_image_controls">
                  <button
                    class="fa fa-pencil fa-lg float-left o_select_file_button"
                    title="Edit"
                    aria-label="Edit"
                  ></button>
                  <button
                    class="fa fa-trash-o fa-lg float-right o_clear_file_button"
                    title="Clear"
                    aria-label="Clear"
                  ></button>

                  <span class="o_form_binary_progress">Uploading...</span>

                  <div class="o_hidden_input_file" aria-atomic="true">
                    <form
                      class="o_form_binary_form"
                      method="post"
                      enctype="multipart/form-data"
                      action="/web/binary/upload"
                    >
                      <input
                        type="hidden"
                        name="csrf_token"
                        value="11287b33f1b4c6155c2317b56119f2adaa74c037o"
                      />
                      <input type="hidden" name="callback" />

                      <input type="file" class="o_input_file" name="ufile" />
                    </form>
                    <iframe style="display: none"></iframe>
                  </div>
                </div>
              </div>
              <div class="oe_title">
                <h1>
                  <input
                    class="o_field_char o_field_widget o_input o_required_modifier"
                    name="name"
                    placeholder="Employee's Name"
                    type="text"
                  />
                </h1>
                <h2>
                  <input
                    class="o_field_char o_field_widget o_input"
                    name="job_title"
                    placeholder="Job Position"
                    type="text"
                  />
                </h2>
              </div>
              <div class="o_group">
                <div class="row">
                  <div class="col-12 col-md-6">
                    <table class="o_group o_inner_group">
                      <tbody>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label"
                              for="o_field_input_273"
                              data-original-title
                              title
                            >Work Mobile</label>
                          </td>
                          <td style="width: 100%;">
                            <input
                              class="o_field_phone o_field_widget o_input"
                              name="mobile_phone"
                              placeholder
                              type="text"
                              id="o_field_input_273"
                            />
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label"
                              for="o_field_input_274"
                              data-original-title
                              title
                            >Work Phone</label>
                          </td>
                          <td style="width: 100%;">
                            <input
                              class="o_field_phone o_field_widget o_input"
                              name="work_phone"
                              placeholder
                              type="text"
                              id="o_field_input_274"
                            />
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label"
                              for="o_field_input_275"
                              data-original-title
                              title
                            >Work Email</label>
                          </td>
                          <td style="width: 100%;">
                            <input
                              class="o_field_email o_field_widget o_input"
                              name="work_email"
                              placeholder
                              type="text"
                              id="o_field_input_275"
                            />
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label"
                              for="o_field_input_276"
                              data-original-title
                              title
                            >Work Location</label>
                          </td>
                          <td style="width: 100%;">
                            <input
                              class="o_field_char o_field_widget o_input"
                              name="work_location"
                              placeholder
                              type="text"
                              id="o_field_input_276"
                            />
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_invisible_modifier"
                              for="o_field_input_277"
                              data-original-title
                              title
                            >Company</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_widget o_field_many2one o_with_button o_invisible_modifier"
                              aria-atomic="true"
                              name="company_id"
                            >
                              <div class="o_input_dropdown">
                                <input
                                  type="text"
                                  class="o_input ui-autocomplete-input"
                                  autocomplete="off"
                                  id="o_field_input_277"
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
                  <div class="col-12 col-md-6">
                    <table class="o_group o_inner_group">
                      <tbody>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label"
                              for="o_field_input_278"
                              data-original-title
                              title
                            >Department</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_widget o_field_many2one"
                              aria-atomic="true"
                              name="department_id"
                            >
                              <div class="o_input_dropdown">
                                <input
                                  type="text"
                                  class="o_input ui-autocomplete-input"
                                  autocomplete="off"
                                  id="o_field_input_278"
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
                              for="o_field_input_279"
                              data-original-title
                              title
                            >Job Position</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_widget o_field_many2one"
                              aria-atomic="true"
                              name="job_id"
                            >
                              <div class="o_input_dropdown">
                                <input
                                  type="text"
                                  class="o_input ui-autocomplete-input"
                                  autocomplete="off"
                                  id="o_field_input_279"
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
                              for="o_field_input_280"
                              data-original-title
                              title
                            >Manager</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_widget o_field_many2one"
                              aria-atomic="true"
                              name="parent_id"
                            >
                              <div class="o_input_dropdown">
                                <input
                                  type="text"
                                  class="o_input ui-autocomplete-input"
                                  autocomplete="off"
                                  id="o_field_input_280"
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
              <div class="o_notebook">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a
                      data-toggle="tab"
                      disable_anchor="true"
                      href="#notebook_page_358"
                      class="nav-link active"
                      role="tab"
                    >Work Information</a>
                  </li>
                  <li class="nav-item">
                    <a
                      data-toggle="tab"
                      disable_anchor="true"
                      href="#notebook_page_359"
                      class="nav-link"
                      role="tab"
                    >Private Information</a>
                  </li>
                  <li class="nav-item">
                    <a
                      data-toggle="tab"
                      disable_anchor="true"
                      href="#notebook_page_360"
                      class="nav-link"
                      role="tab"
                    >HR Settings</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="notebook_page_358">
                    <div id="o_work_employee_container">
                      <div id="o_work_employee_main">
                        <table class="o_group o_inner_group">
                          <tbody>
                            <tr>
                              <td colspan="2" style="width: 100%;">
                                <div class="o_horizontal_separator">Location</div>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label"
                                  for="o_field_input_282"
                                  data-original-title
                                  title
                                >Work Address</label>
                              </td>
                              <td style="width: 100%;">
                                <div
                                  class="o_field_widget o_field_many2one o_with_button"
                                  aria-atomic="true"
                                  name="address_id"
                                >
                                  <div class="o_input_dropdown">
                                    <input
                                      type="text"
                                      class="o_input ui-autocomplete-input"
                                      autocomplete="off"
                                      id="o_field_input_282"
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
                        <table class="o_group o_inner_group">
                          <tbody>
                            <tr>
                              <td colspan="2" style="width: 100%;">
                                <div class="o_horizontal_separator">Responsibles</div>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label"
                                  for="o_field_input_283"
                                  data-original-title
                                  title
                                >Coach</label>
                              </td>
                              <td style="width: 100%;">
                                <div
                                  class="o_field_widget o_field_many2one"
                                  aria-atomic="true"
                                  name="coach_id"
                                >
                                  <div class="o_input_dropdown">
                                    <input
                                      type="text"
                                      class="o_input ui-autocomplete-input"
                                      autocomplete="off"
                                      id="o_field_input_283"
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
                                  for="o_field_input_284"
                                  data-original-title
                                  title
                                >Time Off</label>
                              </td>
                              <td style="width: 100%;">
                                <div
                                  class="o_field_widget o_field_many2one"
                                  aria-atomic="true"
                                  name="leave_manager_id"
                                >
                                  <div class="o_input_dropdown">
                                    <input
                                      type="text"
                                      class="o_input ui-autocomplete-input"
                                      autocomplete="off"
                                      id="o_field_input_284"
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
                        <table class="o_group o_inner_group">
                          <tbody>
                            <tr>
                              <td colspan="2" style="width: 100%;">
                                <div class="o_horizontal_separator">Schedule</div>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label o_invisible_modifier o_readonly_modifier"
                                  for="o_field_input_287"
                                  data-original-title
                                  title
                                >Calendar Mismatch</label>
                              </td>
                              <td style="width: 100%;">
                                <div
                                  class="o_field_boolean o_field_widget custom-control custom-checkbox o_invisible_modifier o_readonly_modifier"
                                  name="calendar_mismatch"
                                >
                                  <input
                                    type="checkbox"
                                    id="checkbox-364"
                                    class="custom-control-input"
                                    disabled
                                  />
                                  <label
                                    for="o_field_input_287"
                                    class="custom-control-label"
                                  >&#8203;</label>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label"
                                  for="o_field_input_288"
                                  data-original-title
                                  title
                                >Working Hours</label>
                              </td>
                              <td style="width: 100%;">
                                <div>
                                  <div
                                    class="o_field_widget o_field_many2one o_with_button o_required_modifier"
                                    aria-atomic="true"
                                    name="resource_calendar_id"
                                  >
                                    <div class="o_input_dropdown">
                                      <input
                                        type="text"
                                        class="o_input ui-autocomplete-input"
                                        autocomplete="off"
                                        id="o_field_input_288"
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
                                  <span
                                    class="o_calendar_warning_tooltip text-danger o_invisible_modifier"
                                  >Calendar Mismatch : The employee's calendar does not match its current contract calendar. This could lead to unexpected behaviors.</span>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label"
                                  for="o_field_input_289"
                                  data-original-title
                                  title
                                >Timezone</label>
                              </td>
                              <td style="width: 100%;"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div id="o_employee_right">
                        <h4 class="o_org_chart_title mb16 mt0">Organization Chart</h4>
                        <div name="child_ids" class="o_field_widget" data-original-title title>
                          <div class="alert alert-info" role="alert">
                            <p>
                              <b>No hierarchy position.</b>
                            </p>
                            <p>the current version does not support hierarchical positions</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="notebook_page_359">
                    <div class="o_group">
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <table class="o_group o_inner_group">
                            <tbody>
                              <tr>
                                <td colspan="2" style="width: 100%;">
                                  <div class="o_horizontal_separator">Private Contact</div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label o_invisible_modifier"
                                    for="o_field_input_291"
                                    data-original-title
                                    title
                                  >appointee</label>
                                </td>
                                <td style="width: 100%;">
                                  <div
                                    class="o_field_widget o_field_many2one o_invisible_modifier"
                                    aria-atomic="true"
                                    name="appointee_id"
                                  >
                                    <div class="o_input_dropdown">
                                      <input
                                        type="text"
                                        class="o_input ui-autocomplete-input"
                                        autocomplete="off"
                                        id="o_field_input_291"
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
                                    for="o_field_input_292"
                                    data-original-title
                                    title
                                  >Address</label>
                                </td>
                                <td style="width: 100%;">
                                  <div
                                    class="o_field_widget o_field_many2one"
                                    aria-atomic="true"
                                    name="address_home_id"
                                  >
                                    <div class="o_input_dropdown">
                                      <input
                                        type="text"
                                        class="o_input ui-autocomplete-input"
                                        autocomplete="off"
                                        id="o_field_input_292"
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
                                    class="o_form_label o_readonly_modifier"
                                    for="o_field_input_293"
                                    data-original-title
                                    title
                                  >Email</label>
                                </td>
                                <td style="width: 100%;">
                                  <span
                                    class="o_field_char o_field_widget o_readonly_modifier"
                                    name="private_email"
                                  ></span>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label o_readonly_modifier"
                                    for="o_field_input_294"
                                    data-original-title
                                    title
                                  >Phone</label>
                                </td>
                                <td style="width: 100%;">
                                  <span
                                    class="o_field_char o_field_widget o_readonly_modifier"
                                    name="phone"
                                  ></span>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label o_invisible_modifier"
                                    for="o_field_input_295"
                                    data-original-title
                                    title
                                  >Bank Account Number</label>
                                </td>
                                <td style="width: 100%;">
                                  <div
                                    class="o_field_widget o_field_many2one o_invisible_modifier"
                                    aria-atomic="true"
                                    name="bank_account_id"
                                  >
                                    <div class="o_input_dropdown">
                                      <input
                                        type="text"
                                        class="o_input ui-autocomplete-input"
                                        autocomplete="off"
                                        id="o_field_input_295"
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
                                    for="o_field_input_296"
                                    data-original-title
                                    title
                                  >Km Home-Work</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_integer o_field_number o_field_widget o_input"
                                    name="km_home_work"
                                    placeholder
                                    type="text"
                                    id="o_field_input_296"
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
                                <td colspan="2" style="width: 100%;">
                                  <div class="o_horizontal_separator">Citizenship</div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_297"
                                    data-original-title
                                    title
                                  >Nationality (Country)</label>
                                </td>
                                <td style="width: 100%;">
                                  <div
                                    class="o_field_widget o_field_many2one"
                                    aria-atomic="true"
                                    name="country_id"
                                  >
                                    <div class="o_input_dropdown">
                                      <input
                                        type="text"
                                        class="o_input ui-autocomplete-input"
                                        autocomplete="off"
                                        id="o_field_input_297"
                                      />
                                      <a role="button" class="o_dropdown_button" draggable="false"></a>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_298"
                                    data-original-title
                                    title
                                  >Identification No</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_char o_field_widget o_input"
                                    name="identification_id"
                                    placeholder
                                    type="text"
                                    id="o_field_input_298"
                                  />
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_299"
                                    data-original-title
                                    title
                                  >Passport No</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_char o_field_widget o_input"
                                    name="passport_id"
                                    placeholder
                                    type="text"
                                    id="o_field_input_299"
                                  />
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_300"
                                    data-original-title
                                    title
                                  >Gender</label>
                                </td>
                                <td style="width: 100%;">
                                  <select
                                    class="o_input o_field_widget"
                                    name="gender"
                                    id="o_field_input_300"
                                  >
                                    <option value="false" style></option>
                                    <option value="&quot;male&quot;" style>Male</option>
                                    <option value="&quot;female&quot;" style>Female</option>
                                    <option value="&quot;other&quot;" style>Other</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_301"
                                    data-original-title
                                    title
                                  >Date of Birth</label>
                                </td>
                                <td style="width: 100%;">
                                  <div
                                    class="o_datepicker o_field_date o_field_widget"
                                    aria-atomic="true"
                                    id="datepicker365"
                                    data-target-input="nearest"
                                    name="birthday"
                                  >
                                    <input
                                      type="text"
                                      class="o_datepicker_input o_input datetimepicker-input"
                                      name="birthday"
                                      data-target="#datepicker365"
                                      placeholder
                                      id="o_field_input_301"
                                    />
                                    <span class="o_datepicker_button"></span>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_302"
                                    data-original-title
                                    title
                                  >Place of Birth</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_char o_field_widget o_input"
                                    name="place_of_birth"
                                    placeholder
                                    type="text"
                                    id="o_field_input_302"
                                  />
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_303"
                                    data-original-title
                                    title
                                  >Country of Birth</label>
                                </td>
                                <td style="width: 100%;">
                                  <div
                                    class="o_field_widget o_field_many2one"
                                    aria-atomic="true"
                                    name="country_of_birth"
                                  >
                                    <div class="o_input_dropdown">
                                      <input
                                        type="text"
                                        class="o_input ui-autocomplete-input"
                                        autocomplete="off"
                                        id="o_field_input_303"
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
                        <div class="col-12 col-md-6">
                          <table class="o_group o_inner_group">
                            <tbody>
                              <tr>
                                <td colspan="2" style="width: 100%;">
                                  <div class="o_horizontal_separator">Marital Status</div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_304"
                                    data-original-title
                                    title
                                  >Marital Status</label>
                                </td>
                                <td style="width: 100%;">
                                  <select
                                    class="o_input o_field_widget"
                                    name="marital"
                                    id="o_field_input_304"
                                  >
                                    <option value="false" style></option>
                                    <option value="&quot;single&quot;" style>Single</option>
                                    <option value="&quot;married&quot;" style>Married</option>
                                    <option value="&quot;cohabitant&quot;" style>Legal Cohabitant</option>
                                    <option value="&quot;widower&quot;" style>Widower</option>
                                    <option value="&quot;divorced&quot;" style>Divorced</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label o_invisible_modifier"
                                    for="o_field_input_305"
                                    data-original-title
                                    title
                                  >Spouse Complete Name</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_char o_field_widget o_input o_invisible_modifier"
                                    name="spouse_complete_name"
                                    placeholder
                                    type="text"
                                    id="o_field_input_305"
                                  />
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label o_invisible_modifier"
                                    for="o_field_input_306"
                                    data-original-title
                                    title
                                  >Spouse Birthdate</label>
                                </td>
                                <td style="width: 100%;">
                                  <div
                                    class="o_datepicker o_field_date o_field_widget o_invisible_modifier"
                                    aria-atomic="true"
                                    id="datepicker366"
                                    data-target-input="nearest"
                                    name="spouse_birthdate"
                                  >
                                    <input
                                      type="text"
                                      class="o_datepicker_input o_input datetimepicker-input"
                                      name="spouse_birthdate"
                                      data-target="#datepicker366"
                                      placeholder
                                      id="o_field_input_306"
                                    />
                                    <span class="o_datepicker_button"></span>
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
                                <td colspan="2" style="width: 100%;">
                                  <div class="o_horizontal_separator">Dependant</div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_307"
                                    data-original-title
                                    title
                                  >Number of Children</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_integer o_field_number o_field_widget o_input"
                                    name="children"
                                    placeholder
                                    type="text"
                                    id="o_field_input_307"
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
                                <td colspan="2" style="width: 100%;">
                                  <div class="o_horizontal_separator">Emergency</div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_308"
                                    data-original-title
                                    title
                                  >Emergency Contact</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_char o_field_widget o_input"
                                    name="emergency_contact"
                                    placeholder
                                    type="text"
                                    id="o_field_input_308"
                                  />
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_309"
                                    data-original-title
                                    title
                                  >Emergency Phone</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_char o_field_widget o_input"
                                    name="emergency_phone"
                                    placeholder
                                    type="text"
                                    id="o_field_input_309"
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
                                <td colspan="2" style="width: 100%;">
                                  <div class="o_horizontal_separator">Work Permit</div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_310"
                                    data-original-title
                                    title
                                  >Visa No</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_char o_field_widget o_input"
                                    name="visa_no"
                                    placeholder
                                    type="text"
                                    id="o_field_input_310"
                                  />
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_311"
                                    data-original-title
                                    title
                                  >Work Permit No</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_char o_field_widget o_input"
                                    name="permit_no"
                                    placeholder
                                    type="text"
                                    id="o_field_input_311"
                                  />
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_312"
                                    data-original-title
                                    title
                                  >Visa Expire Date</label>
                                </td>
                                <td style="width: 100%;">
                                  <div
                                    class="o_datepicker o_field_date o_field_widget"
                                    aria-atomic="true"
                                    id="datepicker367"
                                    data-target-input="nearest"
                                    name="visa_expire"
                                  >
                                    <input
                                      type="text"
                                      class="o_datepicker_input o_input datetimepicker-input"
                                      name="visa_expire"
                                      data-target="#datepicker367"
                                      placeholder
                                      id="o_field_input_312"
                                    />
                                    <span class="o_datepicker_button"></span>
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
                                <td colspan="2" style="width: 100%;">
                                  <div class="o_horizontal_separator">Education</div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_313"
                                    data-original-title
                                    title
                                  >Certificate Level</label>
                                </td>
                                <td style="width: 100%;">
                                  <select
                                    class="o_input o_field_widget"
                                    name="certificate"
                                    id="o_field_input_313"
                                  >
                                    <option value="false" style></option>
                                    <option value="&quot;bachelor&quot;" style>Bachelor</option>
                                    <option value="&quot;master&quot;" style>Master</option>
                                    <option value="&quot;other&quot;" style>Other</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_314"
                                    data-original-title
                                    title
                                  >Field of Study</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_char o_field_widget o_input"
                                    name="study_field"
                                    placeholder
                                    type="text"
                                    id="o_field_input_314"
                                  />
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_315"
                                    data-original-title
                                    title
                                  >School</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_char o_field_widget o_input"
                                    name="study_school"
                                    placeholder
                                    type="text"
                                    id="o_field_input_315"
                                  />
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="notebook_page_360">
                    <div class="o_group">
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <table class="o_group o_inner_group">
                            <tbody>
                              <tr>
                                <td colspan="2" style="width: 100%;">
                                  <div class="o_horizontal_separator">Status</div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_317"
                                    data-original-title
                                    title
                                  >Related User</label>
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
                                        id="o_field_input_317"
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
                                    for="o_field_input_318"
                                    data-original-title
                                    title
                                  >Biometric Device ID</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_char o_field_widget o_input"
                                    name="device_id"
                                    placeholder
                                    type="text"
                                    id="o_field_input_318"
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
                                <td colspan="2" style="width: 100%;">
                                  <div class="o_horizontal_separator">Attendance</div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_319"
                                    data-original-title
                                    title
                                  >PIN Code</label>
                                </td>
                                <td style="width: 100%;">
                                  <input
                                    class="o_field_char o_field_widget o_input"
                                    name="pin"
                                    placeholder
                                    type="text"
                                    id="o_field_input_319"
                                  />
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_320"
                                    data-original-title
                                    title
                                  >Badge ID</label>
                                </td>
                                <td style="width: 100%;">
                                  <div class="o_row">
                                    <input
                                      class="o_field_char o_field_widget o_input"
                                      name="barcode"
                                      placeholder
                                      type="text"
                                      id="o_field_input_320"
                                    />
                                    <button
                                      type="button"
                                      class="btn btn btn-link"
                                      name="generate_random_barcode"
                                      data-original-title
                                      title
                                    >
                                      <span>Generate</span>
                                    </button>
                                    <button
                                      type="button"
                                      name="141"
                                      class="btn btn btn-link o_invisible_modifier"
                                      data-original-title
                                      title
                                    >
                                      <span>Print Badge</span>
                                    </button>
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
</template>