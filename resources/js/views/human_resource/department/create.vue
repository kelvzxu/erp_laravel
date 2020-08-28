<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item" accesskey="b">
                <router-link class="text-primary" :to="{ name:'department_index' }">Departments</router-link>
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
              <aside class="o_cp_sidebar">
              </aside>
            </div>
            <div class="o_cp_right">
              
            </div>
          </div>
        </div>
      </div>

      <div class="o_content">
        <div class="o_form_view o_form_editable">
          <div class="o_form_sheet_bg">
            <div class="clearfix position-relative o_form_sheet">
              <div class="ribbon ribbon-top-right o_invisible_modifier o_widget">
                <span class="bg-danger">Archived</span>
              </div>
              <div
                class="o_field_boolean o_field_widget custom-control custom-checkbox o_invisible_modifier"
                name="active"
                data-original-title
                title
              >
                <input type="checkbox" id="o_field_input_203" class="custom-control-input" />
                <label for="o_field_input_203" class="custom-control-label">&#8203;</label>
              </div>
              <table class="o_group o_inner_group">
                <tbody>
                  <tr>
                    <td class="o_td_label">
                      <label
                        class="o_form_label o_required_modifier"
                        for="o_field_input_198"
                        data-original-title
                        title
                      >Department Name</label>
                    </td>
                    <td style="width: 50%;">
                      <input
                        class="o_field_char o_field_widget o_input o_required_modifier"
                        name="name"
                        placeholder
                        type="text"
                        id="o_field_input_198"
                      />
                    </td>
                    <td class="o_td_label">
                      <label
                        class="o_form_label"
                        for="o_field_input_199"
                        data-original-title
                        title
                      >Manager</label>
                    </td>
                    <td style="width: 50%;">
                      <div
                        class="o_field_widget o_field_many2one"
                        aria-atomic="true"
                        name="manager_id"
                      >
                        <div class="o_input_dropdown">
                          <input
                            type="text"
                            class="o_input ui-autocomplete-input"
                            autocomplete="off"
                            id="o_field_input_199"
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
                        for="o_field_input_200"
                        data-original-title
                        title
                      >Parent Department</label>
                    </td>
                    <td style="width: 50%;">
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
                            id="o_field_input_200"
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
                    <td class="o_td_label">
                      <label
                        class="o_form_label o_invisible_modifier"
                        for="o_field_input_201"
                        data-original-title
                        title
                      >Company</label>
                    </td>
                    <td style="width: 50%;">
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
                            id="o_field_input_201"
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
      </div>
    </div>
  </div>
</template>