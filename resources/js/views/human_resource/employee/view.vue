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
                  <div class="o_form_buttons_view" role="toolbar" aria-label="Main actions">
                    <button
                      type="button"
                      class="btn btn-primary o_form_button_edit"
                      accesskey="a"
                    >Edit</button>
                    <button
                      type="button"
                      class="btn btn-secondary o_form_button_create"
                      accesskey="c"
                    >Create</button>
                  </div>
                  <div
                    class="o_form_buttons_edit o_hidden"
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
                <div class="btn-group">
                  <div class="btn-group o_dropdown">
                    <button
                      class="o_dropdown_toggler_btn btn btn-secondary dropdown-toggle"
                      data-toggle="dropdown"
                      aria-expanded="false"
                    >Print</button>

                    <div class="dropdown-menu o_dropdown_menu" role="menu">
                      <a
                        class="dropdown-item undefined"
                        role="menuitem"
                        data-section="print"
                        data-index="0"
                        href="#"
                      >Print Badge</a>

                      <a
                        class="dropdown-item undefined"
                        role="menuitem"
                        data-section="print"
                        data-index="1"
                        href="#"
                      >Time Off Summary</a>
                    </div>
                  </div>

                  <div class="btn-group o_dropdown">
                    <button
                      class="o_dropdown_toggler_btn btn btn-secondary dropdown-toggle"
                      data-toggle="dropdown"
                      aria-expanded="false"
                    >Action</button>

                    <div class="dropdown-menu o_dropdown_menu" role="menu">
                      <a
                        class="dropdown-item o_sidebar_item_archive"
                        role="menuitem"
                        data-section="other"
                        data-index="0"
                        href="#"
                      >Archive</a>

                      <a
                        class="dropdown-item o_sidebar_item_unarchive o_hidden"
                        role="menuitem"
                        data-section="other"
                        data-index="1"
                        href="#"
                      >Unarchive</a>

                      <a
                        class="dropdown-item undefined"
                        role="menuitem"
                        data-section="other"
                        data-index="2"
                        href="#"
                      >Delete</a>

                      <a
                        class="dropdown-item undefined"
                        role="menuitem"
                        data-section="other"
                        data-index="3"
                        href="#"
                      >Duplicate</a>

                      <a
                        class="dropdown-item undefined"
                        role="menuitem"
                        data-section="other"
                        data-index="4"
                        href="#"
                      >Time off Analysis</a>
                    </div>
                  </div>
                </div>
              </aside>
            </div>
            <div class="o_cp_right">
              <div class="btn-group o_search_options position-static" role="search"></div>
              <nav class="o_cp_pager" role="search" aria-label="Pager">
                <div class="o_pager">
                  <span class="o_pager_counter">
                    <span class="o_pager_value">3</span> /
                    <span class="o_pager_limit">5</span>
                  </span>
                  <span class="btn-group" aria-atomic="true">
                    <button
                      type="button"
                      class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                      accesskey="p"
                      aria-label="Previous"
                      title="Previous"
                      tabindex="-1"
                    ></button>
                    <button
                      type="button"
                      class="fa fa-chevron-right btn btn-secondary o_pager_next"
                      accesskey="n"
                      aria-label="Next"
                      title="Next"
                      tabindex="-1"
                    ></button>
                  </span>
                </div>
              </nav>
              <nav class="btn-group o_cp_switch_buttons" role="toolbar" aria-label="View switcher"></nav>
            </div>
          </div>
        </div>
      </div>

      <div class="o_content">
        <div class="o_form_view o_form_readonly">
          <div class="o_form_sheet_bg">
            <div
              class="o_field_boolean o_field_widget custom-control custom-checkbox o_invisible_modifier"
              name="active"
              data-original-title
              title
            >
              <input type="checkbox" id="checkbox-321" class="custom-control-input" disabled />
              <label for="o_field_input_325" class="custom-control-label">&#8203;</label>
            </div>
            <a
              class="o_form_uri o_field_widget o_invisible_modifier o_readonly_modifier"
              href="#id=3&amp;model=res.partner"
              name="user_partner_id"
              id="o_field_input_326"
              data-original-title
              title
            >
              <span>Kelvin Leonardi</span>
            </a>
            <span
              name="hr_presence_state"
              class="o_field_widget o_invisible_modifier o_readonly_modifier"
              data-original-title
              title
            >Present</span>
            <div class="o_form_statusbar">
              <div class="o_statusbar_buttons">
                <button
                  type="button"
                  name="button_create_appointee"
                  class="btn btn-primary"
                  title
                  data-original-title="Click to create appointee for this employee"
                >
                  <span>Create Appointee</span>
                </button>
                <button
                  type="button"
                  class="btn btn btn-primary o_employee_chat_btn"
                  data-original-title
                  title
                  style="display: none;"
                >
                  <span>Chat</span>
                </button>
                <button
                  type="button"
                  name="134"
                  class="btn btn-secondary"
                  data-original-title
                  title
                >
                  <span>Launch Plan</span>
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
                    <span class="o_stat_value">1</span>
                    <span class="o_stat_text">Contracts</span>
                  </div>
                </button>
                <button
                  type="button"
                  name="185"
                  class="btn oe_stat_button"
                  context="{'search_default_employee_id': active_id}"
                  help="Remaining leaves"
                  data-original-title
                  title
                >
                  <i class="fa fa-fw o_button_icon fa-calendar"></i>
                  <div class="o_field_widget o_stat_info">
                    <span class="o_stat_value">
                      <span
                        class="o_field_char o_field_widget o_readonly_modifier"
                        name="allocation_used_display"
                        data-original-title
                        title
                      >-11</span>/
                      <span
                        class="o_field_char o_field_widget o_readonly_modifier"
                        name="allocation_display"
                        data-original-title
                        title
                      >0</span> Days
                    </span>
                    <span class="o_stat_text">Time Off</span>
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
                    <span class="o_stat_value">2</span>
                    <span class="o_stat_text">Payslips</span>
                  </div>
                </button>
                <button
                  type="button"
                  name="action_to_open_late_check_in_records"
                  class="btn oe_stat_button"
                >
                  <i class="fa fa-fw o_button_icon fa-clock-o"></i>
                  <div
                    name="late_check_in_count"
                    class="o_field_widget o_stat_info o_readonly_modifier"
                    data-original-title
                    title
                  >
                    <span class="o_stat_value">1</span>
                    <span class="o_stat_text">Late Check-In</span>
                  </div>
                </button>
                <button
                  type="button"
                  name="223"
                  id="hr_attendance_button"
                  class="btn oe_stat_button"
                >
                  <div
                    role="img"
                    id="oe_hr_attendance_status"
                    class="fa fa-fw fa-circle o_button_icon oe_hr_attendance_status_green"
                    attrs="{'invisible': [('attendance_state', '=', 'checked_out')]}"
                    aria-label="Available"
                    title="Available"
                  ></div>
                  <div
                    role="img"
                    id="oe_hr_attendance_status"
                    class="fa fa-fw fa-circle o_button_icon oe_hr_attendance_status_red o_invisible_modifier"
                    attrs="{'invisible': [('attendance_state', '=', 'checked_in')]}"
                    aria-label="Not available"
                    title="Not available"
                  ></div>
                  <div
                    class="o_stat_info"
                    attrs="{'invisible': ['|', ('last_check_in', '=', False), ('last_check_out', '!=', False)]}"
                  >
                    <span class="o_stat_text">Attended Since</span>
                    <span class="o_stat_value">
                      <span
                        class="o_field_date o_field_widget o_readonly_modifier"
                        name="last_check_in"
                        data-original-title
                        title
                      >21 hours</span>
                    </span>
                  </div>
                  <div
                    class="o_stat_info o_invisible_modifier"
                    attrs="{'invisible': [('last_check_out', '=', False)]}"
                  >
                    <span class="o_stat_text">Not Attended Since</span>
                    <span class="o_stat_value">
                      <span
                        class="o_field_date o_field_widget o_readonly_modifier o_field_empty"
                        name="last_check_out"
                        data-original-title
                        title
                      ></span>
                    </span>
                  </div>
                  <div
                    class="o_stat_info o_invisible_modifier"
                    attrs="{'invisible': [('last_check_in', '!=', False)]}"
                  >
                    <span class="o_stat_text">Attendance</span>
                  </div>
                </button>
                <button
                  type="button"
                  name="222"
                  class="btn oe_stat_button"
                  context="{'search_default_employee_id': active_id, 'search_default_check_in_filter': '1'}"
                  help="Worked hours last month"
                  data-original-title
                  title
                >
                  <i class="fa fa-fw o_button_icon fa-clock-o"></i>
                  <div class="o_field_widget o_stat_info">
                    <span class="o_stat_value">
                      <span
                        class="o_field_char o_field_widget o_readonly_modifier"
                        name="hours_last_month_display"
                        data-original-title
                        title
                      >0</span> Hours
                    </span>
                    <span class="o_stat_text">Last Month</span>
                  </div>
                </button>
                <button
                  type="button"
                  id="hr_presence_button"
                  class="btn oe_stat_button o_invisible_modifier"
                  disabled="disabled"
                >
                  <div
                    role="img"
                    class="fa fa-fw fa-circle text-success o_button_icon"
                    attrs="{'invisible': [('hr_presence_state', '!=', 'present')]}"
                    aria-label="Available"
                    title="Available"
                  ></div>
                  <div
                    role="img"
                    class="fa fa-fw fa-circle text-warning o_button_icon o_invisible_modifier"
                    attrs="{'invisible': [('hr_presence_state', '!=', 'to_define')]}"
                    aria-label="Away"
                    title="Away"
                  ></div>
                  <div
                    role="img"
                    class="fa fa-fw fa-circle text-danger o_button_icon o_invisible_modifier"
                    attrs="{'invisible': [('hr_presence_state', '!=', 'absent')]}"
                    aria-label="Not available"
                    title="Not available"
                  ></div>
                  <div
                    class="o_stat_info o_invisible_modifier"
                    attrs="{'invisible': [('hr_presence_state', '=', 'present')]}"
                  >
                    <span class="o_stat_text">Not Connected</span>
                  </div>
                  <div
                    class="o_stat_info"
                    attrs="{'invisible': [('hr_presence_state', '!=', 'present')]}"
                  >
                    <span
                      class="o_stat_value"
                      attrs="{'invisible': [('last_activity_time', '=', False)]}"
                    >
                      <span
                        class="o_field_char o_field_widget o_readonly_modifier"
                        name="last_activity_time"
                        data-original-title
                        title
                      >11:07 AM</span>
                    </span>
                    <span
                      class="o_stat_value o_invisible_modifier"
                      attrs="{'invisible': [('last_activity_time', '!=', False)]}"
                    >
                      <span
                        class="o_field_date o_field_widget o_readonly_modifier"
                        name="last_activity"
                        data-original-title
                        title
                      >08/28/2020</span>
                    </span>
                    <span class="o_stat_text">Present Since</span>
                  </div>
                </button>
                <a
                  class="o_form_uri o_field_widget o_invisible_modifier o_readonly_modifier o_field_empty"
                  href="#"
                  name="current_leave_id"
                  id="o_field_input_330"
                  data-original-title
                  title
                >
                  <span></span>
                </a>
                <div
                  class="o_field_boolean o_field_widget custom-control custom-checkbox o_invisible_modifier o_readonly_modifier"
                  name="show_leaves"
                  data-original-title
                  title
                >
                  <input type="checkbox" id="checkbox-322" class="custom-control-input" disabled />
                  <label for="o_field_input_331" class="custom-control-label">&#8203;</label>
                </div>
                <div
                  class="o_field_boolean o_field_widget custom-control custom-checkbox o_invisible_modifier o_readonly_modifier"
                  name="is_absent"
                  data-original-title
                  title
                >
                  <input type="checkbox" id="checkbox-323" class="custom-control-input" disabled />
                  <label for="o_field_input_332" class="custom-control-label">&#8203;</label>
                </div>
                <button
                  type="button"
                  disabled="disabled"
                  class="btn oe_stat_button o_invisible_modifier"
                  context="{'search_default_employee_id': active_id}"
                >
                  <div
                    role="img"
                    class="fa fa-fw fa-plane o_button_icon text-danger"
                    aria-label="Off Till"
                    title="Off Till"
                  ></div>
                  <div class="o_field_widget o_stat_info">
                    <span class="o_stat_value">
                      <span
                        class="o_field_date o_field_widget o_readonly_modifier o_field_empty"
                        name="leave_date_to"
                        data-original-title
                        title
                      ></span>
                    </span>
                    <span class="o_stat_text">Off Till</span>
                  </div>
                </button>
                <span
                  name="attendance_state"
                  class="o_field_widget o_invisible_modifier o_readonly_modifier"
                  data-original-title
                  title
                >Checked in</span>
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
                  src="http://server.odoo/web/image?model=hr.employee&amp;id=1&amp;field=image_128&amp;unique=08272020140137"
                  border="1"
                  name="image_1920"
                  data-zoom="1"
                  data-zoom-image="http://server.odoo/web/image?model=hr.employee&amp;id=1&amp;field=image_1920&amp;unique=08272020140137"
                />
              </div>
              <div class="oe_title">
                <h1>
                  <span
                    class="o_field_char o_field_widget o_required_modifier"
                    name="name"
                    placeholder="Employee's Name"
                    data-original-title
                    title
                  >Kelvin Leonardi</span>
                </h1>
                <h2>
                  <span
                    class="o_field_char o_field_widget"
                    name="job_title"
                    placeholder="Job Position"
                    data-original-title
                    title
                  >chief executive officer</span>
                </h2>
                <div
                  class="o_field_many2manytags o_field_widget o_field_empty"
                  name="category_ids"
                  placeholder="Tags"
                  data-original-title
                  title
                ></div>
              </div>
              <div class="o_group">
                <table class="o_group o_inner_group o_group_col_6">
                  <tbody>
                    <tr>
                      <td class="o_td_label">
                        <label
                          class="o_form_label o_form_label_empty"
                          for="o_field_input_273"
                          data-original-title
                          title
                        >Work Mobile</label>
                      </td>
                      <td style="width: 100%;">
                        <a
                          class="o_field_phone o_field_widget o_form_uri o_field_empty"
                          name="mobile_phone"
                          href="tel:false"
                          id="o_field_input_273"
                        >false</a>
                      </td>
                    </tr>
                    <tr>
                      <td class="o_td_label">
                        <label
                          class="o_form_label o_form_label_empty"
                          for="o_field_input_274"
                          data-original-title
                          title
                        >Work Phone</label>
                      </td>
                      <td style="width: 100%;">
                        <a
                          class="o_field_phone o_field_widget o_form_uri o_field_empty"
                          name="work_phone"
                          href="tel:false"
                          id="o_field_input_274"
                        >false</a>
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
                        <a
                          class="o_field_email o_field_widget o_form_uri o_text_overflow"
                          name="work_email"
                          href="mailto:kelvin@witech.co.id"
                          id="o_field_input_275"
                        >kelvin@witech.co.id</a>
                      </td>
                    </tr>
                    <tr>
                      <td class="o_td_label">
                        <label
                          class="o_form_label o_form_label_empty"
                          for="o_field_input_276"
                          data-original-title
                          title
                        >Work Location</label>
                      </td>
                      <td style="width: 100%;">
                        <span
                          class="o_field_char o_field_widget o_field_empty"
                          name="work_location"
                        ></span>
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
                        <a
                          class="o_form_uri o_field_widget o_invisible_modifier"
                          href="#id=1&amp;model=res.company"
                          name="company_id"
                          id="o_field_input_277"
                        >
                          <span>Odoo</span>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table class="o_group o_inner_group o_group_col_6">
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
                        <a
                          class="o_form_uri o_field_widget"
                          href="#id=1&amp;model=hr.department"
                          name="department_id"
                          id="o_field_input_278"
                        >
                          <span>Administration</span>
                        </a>
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
                        <a
                          class="o_form_uri o_field_widget"
                          href="#id=3&amp;model=hr.job"
                          name="job_id"
                          id="o_field_input_279"
                        >
                          <span>chief executive officer</span>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td class="o_td_label">
                        <label
                          class="o_form_label o_form_label_empty"
                          for="o_field_input_280"
                          data-original-title
                          title
                        >Manager</label>
                      </td>
                      <td style="width: 100%;">
                        <a
                          class="o_form_uri o_field_widget o_field_empty"
                          href="#"
                          name="parent_id"
                          id="o_field_input_280"
                        >
                          <span></span>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="o_notebook">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a
                      data-toggle="tab"
                      disable_anchor="true"
                      href="#notebook_page_281"
                      class="nav-link active"
                      role="tab"
                    >Work Information</a>
                  </li>
                  <li class="nav-item">
                    <a
                      data-toggle="tab"
                      disable_anchor="true"
                      href="#notebook_page_290"
                      class="nav-link"
                      role="tab"
                    >Private Information</a>
                  </li>
                  <li class="nav-item">
                    <a
                      data-toggle="tab"
                      disable_anchor="true"
                      href="#notebook_page_316"
                      class="nav-link"
                      role="tab"
                    >HR Settings</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="notebook_page_281">
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
                                <a
                                  class="o_form_uri o_field_widget"
                                  href="#id=3&amp;model=res.partner"
                                  name="address_id"
                                  id="o_field_input_282"
                                >
                                  <span>Kelvin Leonardi</span>
                                </a>
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
                                  class="o_form_label o_form_label_empty"
                                  for="o_field_input_283"
                                  data-original-title
                                  title
                                >Coach</label>
                              </td>
                              <td style="width: 100%;">
                                <a
                                  class="o_form_uri o_field_widget o_field_empty"
                                  href="#"
                                  name="coach_id"
                                  id="o_field_input_283"
                                >
                                  <span></span>
                                </a>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label o_form_label_empty"
                                  for="o_field_input_284"
                                  data-original-title
                                  title
                                >Time Off</label>
                              </td>
                              <td style="width: 100%;">
                                <a
                                  class="o_form_uri o_field_widget o_field_empty"
                                  href="#"
                                  name="leave_manager_id"
                                  id="o_field_input_284"
                                >
                                  <span></span>
                                </a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <table class="o_group o_inner_group o_invisible_modifier">
                          <tbody>
                            <tr>
                              <td colspan="2" style="width: 100%;">
                                <div class="o_horizontal_separator">Departure</div>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label o_form_label_empty"
                                  for="o_field_input_285"
                                  data-original-title
                                  title
                                >Departure Reason</label>
                              </td>
                              <td style="width: 100%;">
                                <span name="departure_reason" class="o_field_widget o_field_empty"></span>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label o_form_label_empty"
                                  for="o_field_input_286"
                                  data-original-title
                                  title
                                >Additional Information</label>
                              </td>
                              <td style="width: 100%;">
                                <span
                                  class="o_field_text o_field_widget o_field_empty"
                                  name="departure_description"
                                ></span>
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
                                    id="checkbox-324"
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
                                  <a
                                    class="o_form_uri o_field_widget o_required_modifier"
                                    href="#id=1&amp;model=resource.calendar"
                                    name="resource_calendar_id"
                                    id="o_field_input_288"
                                  >
                                    <span>Standard 40 hours/week</span>
                                  </a>
                                  <span
                                    attrs="{'invisible': [('calendar_mismatch', '=', False)]}"
                                    class="fa fa-exclamation-triangle text-danger o_calendar_warning pl-3 o_invisible_modifier"
                                  ></span>
                                  <span
                                    class="o_calendar_warning_tooltip text-danger"
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
                              <td style="width: 100%;">
                                <span name="tz" class="o_field_widget">Asia/Jakarta</span>
                              </td>
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
                            <p>This employee has no manager or subordinate.</p>
                            <p>In order to get an organigram, set a manager and save the record.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="notebook_page_290">
                    <div class="o_group">
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Private Contact</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier o_form_label_empty"
                                for="o_field_input_291"
                                data-original-title
                                title
                              >appointee</label>
                            </td>
                            <td style="width: 100%;">
                              <a
                                class="o_form_uri o_field_widget o_invisible_modifier o_field_empty"
                                href="#"
                                name="appointee_id"
                                id="o_field_input_291"
                              >
                                <span></span>
                              </a>
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
                              <a
                                class="o_form_uri o_field_widget"
                                href="#id=3&amp;model=res.partner"
                                name="address_home_id"
                                id="o_field_input_292"
                              >
                                <span>Kelvin Leonardi</span>
                              </a>
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
                              >kelvin@witech.co.id</span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_readonly_modifier o_form_label_empty"
                                for="o_field_input_294"
                                data-original-title
                                title
                              >Phone</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_char o_field_widget o_readonly_modifier o_field_empty"
                                name="phone"
                              ></span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_form_label_empty"
                                for="o_field_input_295"
                                data-original-title
                                title
                              >Bank Account Number</label>
                            </td>
                            <td style="width: 100%;">
                              <a
                                class="o_form_uri o_field_widget o_field_empty"
                                href="#"
                                name="bank_account_id"
                                id="o_field_input_295"
                              >
                                <span></span>
                              </a>
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
                              <span
                                class="o_field_integer o_field_number o_field_widget"
                                name="km_home_work"
                              >0</span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Citizenship</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_form_label_empty"
                                for="o_field_input_297"
                                data-original-title
                                title
                              >Nationality (Country)</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                name="country_id"
                                class="o_field_widget o_field_empty"
                                id="o_field_input_297"
                              >
                                <span></span>
                              </span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_form_label_empty"
                                for="o_field_input_298"
                                data-original-title
                                title
                              >Identification No</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_char o_field_widget o_field_empty"
                                name="identification_id"
                              ></span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_form_label_empty"
                                for="o_field_input_299"
                                data-original-title
                                title
                              >Passport No</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_char o_field_widget o_field_empty"
                                name="passport_id"
                              ></span>
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
                              <span name="gender" class="o_field_widget">Male</span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_form_label_empty"
                                for="o_field_input_301"
                                data-original-title
                                title
                              >Date of Birth</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_date o_field_widget o_field_empty"
                                name="birthday"
                              ></span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_form_label_empty"
                                for="o_field_input_302"
                                data-original-title
                                title
                              >Place of Birth</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_char o_field_widget o_field_empty"
                                name="place_of_birth"
                              ></span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_form_label_empty"
                                for="o_field_input_303"
                                data-original-title
                                title
                              >Country of Birth</label>
                            </td>
                            <td style="width: 100%;">
                              <a
                                class="o_form_uri o_field_widget o_field_empty"
                                href="#"
                                name="country_of_birth"
                                id="o_field_input_303"
                              >
                                <span></span>
                              </a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_group_col_6">
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
                              <span name="marital" class="o_field_widget">Single</span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier o_form_label_empty"
                                for="o_field_input_305"
                                data-original-title
                                title
                              >Spouse Complete Name</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_char o_field_widget o_invisible_modifier o_field_empty"
                                name="spouse_complete_name"
                              ></span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier o_form_label_empty"
                                for="o_field_input_306"
                                data-original-title
                                title
                              >Spouse Birthdate</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_date o_field_widget o_invisible_modifier o_field_empty"
                                name="spouse_birthdate"
                              ></span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_group_col_6">
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
                              <span
                                class="o_field_integer o_field_number o_field_widget"
                                name="children"
                              >0</span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Emergency</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_form_label_empty"
                                for="o_field_input_308"
                                data-original-title
                                title
                              >Emergency Contact</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_char o_field_widget o_field_empty"
                                name="emergency_contact"
                              ></span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_form_label_empty"
                                for="o_field_input_309"
                                data-original-title
                                title
                              >Emergency Phone</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_char o_field_widget o_field_empty"
                                name="emergency_phone"
                              ></span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Work Permit</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_form_label_empty"
                                for="o_field_input_310"
                                data-original-title
                                title
                              >Visa No</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_char o_field_widget o_field_empty"
                                name="visa_no"
                              ></span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_form_label_empty"
                                for="o_field_input_311"
                                data-original-title
                                title
                              >Work Permit No</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_char o_field_widget o_field_empty"
                                name="permit_no"
                              ></span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_form_label_empty"
                                for="o_field_input_312"
                                data-original-title
                                title
                              >Visa Expire Date</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_date o_field_widget o_field_empty"
                                name="visa_expire"
                              ></span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_group_col_6">
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
                              <span name="certificate" class="o_field_widget">Other</span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_form_label_empty"
                                for="o_field_input_314"
                                data-original-title
                                title
                              >Field of Study</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_char o_field_widget o_field_empty"
                                name="study_field"
                              ></span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_form_label_empty"
                                for="o_field_input_315"
                                data-original-title
                                title
                              >School</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_char o_field_widget o_field_empty"
                                name="study_school"
                              ></span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane" id="notebook_page_316">
                    <div class="o_group">
                      <table class="o_group o_inner_group o_group_col_6">
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
                              <a
                                class="o_form_uri o_field_widget"
                                href="#id=2&amp;model=res.users"
                                name="user_id"
                                id="o_field_input_317"
                              >
                                <span>Kelvin Leonardi</span>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_form_label_empty"
                                for="o_field_input_318"
                                data-original-title
                                title
                              >Biometric Device ID</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                class="o_field_char o_field_widget o_field_empty"
                                name="device_id"
                              ></span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Attendance</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_form_label_empty"
                                for="o_field_input_319"
                                data-original-title
                                title
                              >PIN Code</label>
                            </td>
                            <td style="width: 100%;">
                              <span class="o_field_char o_field_widget o_field_empty" name="pin"></span>
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
                                <span
                                  class="o_field_char o_field_widget o_field_empty"
                                  name="barcode"
                                ></span>
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
</template>