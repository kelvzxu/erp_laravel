<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item" accesskey="b">
                <router-link class="text-primary" :to="{ name:'contract_index' }">Contracts</router-link>
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
              <div class="o_statusbar_buttons"></div>
              <div class="o_statusbar_status o_field_widget" name="state" data-original-title title>
                <button
                  type="button"
                  data-value="cancel"
                  title="Not active state, click to change it"
                  aria-pressed="false"
                  class="btn o_arrow_button btn-secondary"
                >Cancelled</button>

                <button
                  type="button"
                  data-value="close"
                  title="Not active state, click to change it"
                  aria-pressed="false"
                  class="btn o_arrow_button btn-secondary"
                >Expired</button>

                <button
                  type="button"
                  data-value="open"
                  title="Not active state, click to change it"
                  aria-pressed="false"
                  class="btn o_arrow_button btn-secondary"
                >Running</button>

                <button
                  type="button"
                  data-value="draft"
                  disabled="disabled"
                  title="Current state"
                  aria-pressed="true"
                  class="btn o_arrow_button btn-primary disabled"
                  aria-current="step"
                >New</button>
              </div>
            </div>
            <div class="clearfix position-relative o_form_sheet">
              <div class="o_not_full oe_button_box"></div>
              <div class="ribbon ribbon-top-right o_invisible_modifier o_widget">
                <span class="bg-danger">Archived</span>
              </div>
              <div class="oe_title pr-0" name="title">
                <h1 class="d-flex flex-row justify-content-between">
                  <input
                    class="o_field_char o_field_widget o_input o_required_modifier text-truncate"
                    name="name"
                    placeholder="Contract Reference"
                    type="text"
                  />
                </h1>
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
                              for="o_field_input_279"
                              data-original-title
                              title
                            >Employee</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_widget o_field_many2one"
                              aria-atomic="true"
                              name="employee_id"
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
                  <div class="col-12 col-md-6">
                    <table class="o_group o_inner_group">
                      <tbody>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_invisible_modifier o_required_modifier"
                              for="o_field_input_281"
                              data-original-title
                              title
                            >Company</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_widget o_field_many2one o_with_button o_invisible_modifier o_required_modifier"
                              aria-atomic="true"
                              name="company_id"
                            >
                              <div class="o_input_dropdown">
                                <input
                                  type="text"
                                  class="o_input ui-autocomplete-input"
                                  autocomplete="off"
                                  id="o_field_input_281"
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
                              for="o_field_input_282"
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
                                style="display: none;"
                              ></button>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_invisible_modifier o_readonly_modifier"
                              for="o_field_input_283"
                              data-original-title
                              title
                            >Currency</label>
                          </td>
                          <td style="width: 100%;">
                            <a
                              class="o_form_uri o_field_widget o_invisible_modifier o_readonly_modifier"
                              href="#id=12&amp;model=res.currency"
                              name="currency_id"
                              id="o_field_input_283"
                            >
                              <span>IDR</span>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_required_modifier"
                              for="o_field_input_284"
                              data-original-title
                              title
                            >Employee Category</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_widget o_field_many2one o_with_button o_required_modifier"
                              aria-atomic="true"
                              name="type_id"
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
                              ></button>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_required_modifier"
                              for="o_field_input_285"
                              data-original-title
                              title
                            >Salary Structure</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_widget o_field_many2one o_required_modifier"
                              aria-atomic="true"
                              name="struct_id"
                            >
                              <div class="o_input_dropdown">
                                <input
                                  type="text"
                                  class="o_input ui-autocomplete-input"
                                  autocomplete="off"
                                  id="o_field_input_285"
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
                      href="#notebook_page_286"
                      class="nav-link active"
                      role="tab"
                    >Contract Details</a>
                  </li>
                  <li class="nav-item">
                    <a
                      data-toggle="tab"
                      disable_anchor="true"
                      href="#notebook_page_295"
                      class="nav-link"
                      role="tab"
                    >Salary Information</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="notebook_page_286">
                    <div class="o_group">
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <table class="o_group o_inner_group">
                            <tbody>
                              <tr>
                                <td colspan="2" style="width: 100%;">
                                  <div class="o_horizontal_separator">Contract Terms</div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label o_required_modifier"
                                    for="o_field_input_287"
                                    data-original-title
                                    title
                                  >Start Date</label>
                                </td>
                                <td style="width: 100%;">
                                  <div
                                    class="o_datepicker o_field_date o_field_widget o_required_modifier"
                                    aria-atomic="true"
                                    id="datepicker306"
                                    data-target-input="nearest"
                                    name="date_start"
                                  >
                                    <input
                                      type="text"
                                      class="o_datepicker_input o_input datetimepicker-input"
                                      name="date_start"
                                      data-target="#datepicker306"
                                      placeholder
                                      id="o_field_input_287"
                                    />
                                    <span class="o_datepicker_button"></span>
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
                                  >End Date</label>
                                </td>
                                <td style="width: 100%;">
                                  <div class="o_row">
                                    <div
                                      class="o_datepicker o_field_date o_field_widget"
                                      aria-atomic="true"
                                      id="datepicker307"
                                      data-target-input="nearest"
                                      name="date_end"
                                    >
                                      <input
                                        type="text"
                                        class="o_datepicker_input o_input datetimepicker-input"
                                        name="date_end"
                                        data-target="#datepicker307"
                                        placeholder
                                        id="o_field_input_288"
                                      />
                                      <span class="o_datepicker_button"></span>
                                    </div>
                                    <span class="text-muted">(If fixed-term contract)</span>
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
                                  >End of Trial Period</label>
                                </td>
                                <td style="width: 100%;">
                                  <div
                                    class="o_datepicker o_field_date o_field_widget"
                                    aria-atomic="true"
                                    id="datepicker308"
                                    data-target-input="nearest"
                                    name="trial_date_end"
                                  >
                                    <input
                                      type="text"
                                      class="o_datepicker_input o_input datetimepicker-input"
                                      name="trial_date_end"
                                      data-target="#datepicker308"
                                      placeholder
                                      id="o_field_input_289"
                                    />
                                    <span class="o_datepicker_button"></span>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_291"
                                    data-original-title
                                    title
                                  >Working Schedule</label>
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
                                          id="o_field_input_291"
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
                                    <select
                                      class="o_input o_field_widget"
                                      name="schedule_pay"
                                      id="o_field_input_313"
                                      data-original-title
                                      title
                                    >
                                      <option value="false" style></option>
                                      <option value="&quot;monthly&quot;" style>Monthly</option>
                                      <option value="&quot;quarterly&quot;" style>Quarterly</option>
                                      <option value="&quot;semi-annually&quot;" style>Semi-annually</option>
                                      <option value="&quot;annually&quot;" style>Annually</option>
                                      <option value="&quot;weekly&quot;" style>Weekly</option>
                                      <option value="&quot;bi-weekly&quot;" style>Bi-weekly</option>
                                      <option value="&quot;bi-monthly&quot;" style>Bi-monthly</option>
                                    </select>
                                    <span
                                      class="o_calendar_warning_tooltip text-danger o_invisible_modifier"
                                    >Calendar Mismatch : The employee's calendar does not match this contract's calendar. This could lead to unexpected behaviors.</span>
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
                                  >HR Responsible</label>
                                </td>
                                <td style="width: 100%;">
                                  <div
                                    class="o_field_widget o_field_many2one"
                                    aria-atomic="true"
                                    name="hr_responsible_id"
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
                            </tbody>
                          </table>
                        </div>
                        <div class="col-12 col-md-6">
                          <table class="o_group o_inner_group">
                            <tbody>
                              <tr>
                                <td colspan="2" style="width: 100%;">
                                  <div class="o_horizontal_separator">Accounting</div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label o_invisible_modifier"
                                    for="o_field_input_293"
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
                                        id="o_field_input_293"
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
                                    for="o_field_input_294"
                                    data-original-title
                                    title
                                  >Salary Journal</label>
                                </td>
                                <td style="width: 100%;">
                                  <div
                                    class="o_field_widget o_field_many2one"
                                    aria-atomic="true"
                                    name="journal_id"
                                  >
                                    <div class="o_input_dropdown">
                                      <input
                                        type="text"
                                        class="o_input ui-autocomplete-input"
                                        autocomplete="off"
                                        id="o_field_input_294"
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
                    <table class="o_group o_inner_group">
                      <tbody>
                        <tr>
                          <td colspan="2" style="width: 100%;">
                            <div class="o_horizontal_separator">Notes</div>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 100%;">
                            <textarea
                              class="o_field_text o_field_widget o_input"
                              name="notes"
                              placeholder
                              type="text"
                              id="o_field_input_314"
                              style="overflow-y: hidden; height: 50px; resize: none;"
                              data-original-title
                              title
                            ></textarea>
                            <textarea
                              disabled
                              style="position: absolute; opacity: 0; height: 10px; border-top-width: 0px; border-bottom-width: 0px; padding: 0px; overflow: hidden; top: -10000px; left: -10000px; width: 1064px;"
                            ></textarea>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="notebook_page_295">
                    <div class="o_group">
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <table class="o_group o_inner_group">
                            <tbody>
                              <tr>
                                <td colspan="2" style="width: 100%;">
                                  <div class="o_horizontal_separator">Monthly Advantages in Cash</div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_296"
                                    data-original-title
                                    title
                                  >Wage</label>
                                </td>
                                <td style="width: 100%;">
                                  <div class="o_row" name="wage">
                                    <div
                                      class="o_field_monetary o_field_number o_input o_field_widget o_required_modifier"
                                      name="wage"
                                    >
                                      <span>Rp.</span>
                                      <input
                                        class="o_input"
                                        placeholder
                                        type="text"
                                        id="o_field_input_296"
                                      />
                                    </div>
                                    <span>/ month</span>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2" style="width: 100%;">
                                  <textarea
                                    class="o_field_text o_field_widget o_input o_invisible_modifier"
                                    name="advantages"
                                    placeholder="Advantages..."
                                    type="text"
                                    id="o_field_input_315"
                                    style="overflow-y: hidden; height: 50px; resize: none;"
                                    data-original-title
                                    title
                                  ></textarea>
                                  <textarea
                                    disabled
                                    style="position: absolute; opacity: 0; height: 10px; border-top-width: 0px; border-bottom-width: 0px; padding: 0px; overflow: hidden; top: -10000px; left: -10000px; width: 0px;"
                                  ></textarea>
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
                                  <div class="o_horizontal_separator">Monthly Advantages in Cash</div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_297"
                                    data-original-title
                                    title
                                  >HRA</label>
                                </td>
                                <td style="width: 100%;">
                                  <div class="o_row">
                                    <div
                                      class="o_field_monetary o_field_number o_input o_field_widget"
                                      name="hra"
                                    >
                                      <span>Rp</span>
                                      <input
                                        class="o_input"
                                        placeholder
                                        type="text"
                                        id="o_field_input_297"
                                      />
                                    </div>
                                    <span>/ month</span>
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
                                  >DA</label>
                                </td>
                                <td style="width: 100%;">
                                  <div class="o_row">
                                    <div
                                      class="o_field_monetary o_field_number o_input o_field_widget"
                                      name="da"
                                    >
                                      <span>Rp</span>
                                      <input
                                        class="o_input"
                                        placeholder
                                        type="text"
                                        id="o_field_input_298"
                                      />
                                    </div>
                                    <span>/ month</span>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_299"
                                    data-original-title
                                    title
                                  >Travel Allowance</label>
                                </td>
                                <td style="width: 100%;">
                                  <div class="o_row">
                                    <div
                                      class="o_field_monetary o_field_number o_input o_field_widget"
                                      name="travel_allowance"
                                    >
                                      <span>Rp</span>
                                      <input
                                        class="o_input"
                                        placeholder
                                        type="text"
                                        id="o_field_input_299"
                                      />
                                    </div>
                                    <span>/ month</span>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_300"
                                    data-original-title
                                    title
                                  >Meal Allowance</label>
                                </td>
                                <td style="width: 100%;">
                                  <div class="o_row">
                                    <div
                                      class="o_field_monetary o_field_number o_input o_field_widget"
                                      name="meal_allowance"
                                    >
                                      <span>Rp</span>
                                      <input
                                        class="o_input"
                                        placeholder
                                        type="text"
                                        id="o_field_input_300"
                                      />
                                    </div>
                                    <span>/ month</span>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_301"
                                    data-original-title
                                    title
                                  >Medical Allowance</label>
                                </td>
                                <td style="width: 100%;">
                                  <div class="o_row">
                                    <div
                                      class="o_field_monetary o_field_number o_input o_field_widget"
                                      name="medical_allowance"
                                    >
                                      <span>Rp</span>
                                      <input
                                        class="o_input"
                                        placeholder
                                        type="text"
                                        id="o_field_input_301"
                                      />
                                    </div>
                                    <span>/ month</span>
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
                                  >Other Allowance</label>
                                </td>
                                <td style="width: 100%;">
                                  <div class="o_row">
                                    <div
                                      class="o_field_monetary o_field_number o_input o_field_widget"
                                      name="other_allowance"
                                    >
                                      <span>Rp</span>
                                      <input
                                        class="o_input"
                                        placeholder
                                        type="text"
                                        id="o_field_input_302"
                                      />
                                    </div>
                                    <span>/ month</span>
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
                                  <div class="o_horizontal_separator">Overtime</div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_303"
                                    data-original-title
                                    title
                                  >Day Wage</label>
                                </td>
                                <td style="width: 100%;">
                                  <div class="o_row" name="day_wage">
                                    <div
                                      class="o_field_monetary o_field_number o_input o_field_widget"
                                      name="over_day"
                                    >
                                      <span>Rp</span>
                                      <input
                                        class="o_input"
                                        placeholder
                                        type="text"
                                        id="o_field_input_303"
                                      />
                                    </div>
                                    <span>/day</span>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="o_td_label">
                                  <label
                                    class="o_form_label"
                                    for="o_field_input_304"
                                    data-original-title
                                    title
                                  >Hour Wage</label>
                                </td>
                                <td style="width: 100%;">
                                  <div class="o_row" name="hour_wage">
                                    <div
                                      class="o_field_monetary o_field_number o_input o_field_widget"
                                      name="over_hour"
                                    >
                                      <span>Rp</span>
                                      <input
                                        class="o_input"
                                        placeholder
                                        type="text"
                                        id="o_field_input_304"
                                      />
                                    </div>
                                    <span>/hour</span>
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