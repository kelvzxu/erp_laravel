<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item" accesskey="b">
                <router-link class="text-primary" :to="{ name:'job_index' }">Employees</router-link>
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
                  name="set_recruit"
                  states="open"
                  class="btn btn-primary o_invisible_modifier"
                  data-original-title
                  title
                >
                  <span>Start Recruitment</span>
                </button>
                <button
                  type="button"
                  name="set_open"
                  states="recruit"
                  class="btn btn-secondary"
                  data-original-title
                  title
                >
                  <span>Stop Recruitment</span>
                </button>
              </div>
              <div
                class="o_statusbar_status o_field_widget o_readonly_modifier o_required_modifier"
                name="state"
                data-original-title
                title
              >
                <button
                  type="button"
                  data-value="open"
                  disabled="disabled"
                  title="Not active state"
                  aria-pressed="false"
                  class="btn o_arrow_button btn-secondary disabled"
                >Not Recruiting</button>

                <button
                  type="button"
                  data-value="recruit"
                  disabled="disabled"
                  title="Current state"
                  aria-pressed="true"
                  class="btn o_arrow_button btn-primary disabled"
                  aria-current="step"
                >Recruitment in Progress</button>
              </div>
            </div>
            <div class="clearfix position-relative o_form_sheet">
              <div class="o_not_full oe_button_box"></div>
              <div class="oe_title">
                <label
                  class="o_form_label oe_edit_only"
                  for="o_field_input_403"
                  data-original-title
                  title
                >Job Position</label>
                <h1>
                  <input
                    class="o_field_char o_field_widget o_input o_field_translate o_required_modifier"
                    name="name"
                    placeholder="e.g. Sales Manager"
                    type="text"
                    id="o_field_input_403"
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
                              for="o_field_input_404"
                              data-original-title
                              title
                            >Company</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_widget o_field_many2one o_with_button "
                              aria-atomic="true"
                              name="company_id"
                            >
                              <div class="o_input_dropdown">
                                <input
                                  type="text"
                                  class="o_input ui-autocomplete-input"
                                  autocomplete="off"
                                  id="o_field_input_404"
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
                              for="o_field_input_405"
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
                                  id="o_field_input_405"
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
                              class="o_form_label"
                              for="o_field_input_406"
                              data-original-title
                              title
                            >Expected New Employees</label>
                          </td>
                          <td style="width: 100%;">
                            <input
                              class="o_field_integer o_field_number o_field_widget o_input"
                              name="no_of_recruitment"
                              placeholder
                              type="text"
                              id="o_field_input_406"
                            />
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div>
                <label
                  class="o_form_label"
                  for="o_field_input_407"
                  data-original-title
                  title
                >Job Description</label>
                <textarea
                  class="o_field_text o_field_widget o_input"
                  name="description"
                  placeholder
                  type="text"
                  id="o_field_input_407"
                  style="overflow-y: hidden; height: 50px; resize: none;"
                ></textarea>
                <textarea
                  disabled
                  style="position: absolute; opacity: 0; height: 10px; border-top-width: 0px; border-bottom-width: 0px; padding: 0px; overflow: hidden; top: -10000px; left: -10000px; width: 1020px;"
                ></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>