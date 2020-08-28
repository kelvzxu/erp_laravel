<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item active">
                <router-link class="text-primary" :to="{ name:'job_index' }">Employees</router-link>
              </li>
            </ol>
            <div class="o_cp_searchview" role="search">
              <div class="o_searchview" role="search" aria-autocomplete="list">
                <span
                  class="o_searchview_more fa fa-search-minus"
                  title="Advanced Search..."
                  role="img"
                  aria-label="Advanced Search..."
                ></span>

                <div class="o_searchview_input_container">
                  <input
                    type="text"
                    class="o_searchview_input"
                    accesskey="Q"
                    placeholder="Search..."
                    role="searchbox"
                    aria-haspopup="true"
                  />
                  <div class="dropdown-menu o_searchview_autocomplete" role="menu"></div>
                </div>
              </div>
            </div>
          </div>
          <div>
            <div class="o_cp_left">
              <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                <div class="o_list_buttons" role="toolbar" aria-label="Main actions">
                  <router-link
                    title="Create New Departments"
                    type="button"
                    class="btn btn-primary text-white o-kanban-button-new"
                    :to="{ name:'job_create' }"
                  >Create</router-link>

                  <button type="button" class="btn btn-secondary o_button_import">Import</button>

                  <button
                    type="button"
                    class="btn btn-secondary fa fa-download o_list_export_xlsx"
                    title="Export All"
                  ></button>
                </div>
              </div>
              <aside class="o_cp_sidebar"></aside>
            </div>
            <div class="o_cp_right">
              <nav class="o_cp_pager" role="search" aria-label="Pager">
                <div class="o_pager">
                  <span class="o_pager_counter">
                    <span class="o_pager_value">1-5</span> /
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
                      disabled
                    ></button>
                    <button
                      type="button"
                      class="fa fa-chevron-right btn btn-secondary o_pager_next"
                      accesskey="n"
                      aria-label="Next"
                      title="Next"
                      tabindex="-1"
                      disabled
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
        <div class="o_list_view">
          <div class="table-responsive">
            <table
              class="o_list_table table table-sm table-hover table-striped o_list_table_ungrouped"
              style="table-layout: fixed;"
            >
              <thead>
                <tr>
                  <th
                    data-name="name"
                    tabindex="-1"
                    class="o_column_sortable"
                    data-original-title
                    title
                    style="width: 132px;"
                  >
                    Job Position
                    <span class="o_resize"></span>
                  </th>
                  <th
                    data-name="department_id"
                    tabindex="-1"
                    class="o_column_sortable"
                    data-original-title
                    title
                    style="width: 94px;"
                  >
                    Department
                    <span class="o_resize"></span>
                  </th>
                  <th
                    data-name="no_of_employee"
                    tabindex="-1"
                    class="o_column_sortable o_list_number_th"
                    data-original-title
                    title
                    style="min-width: 74px; max-width: 186px; width: 186px;"
                  >
                    Current Number of Employees
                    <span class="o_resize"></span>
                  </th>
                  <th
                    data-name="no_of_recruitment"
                    tabindex="-1"
                    class="o_column_sortable o_list_number_th"
                    data-original-title
                    title
                    style="min-width: 74px; width: 183px;"
                  >
                    Expected New Employees
                    <span class="o_resize"></span>
                  </th>
                  <th
                    data-name="expected_employees"
                    tabindex="-1"
                    class="o_column_sortable o_list_number_th"
                    data-original-title
                    title
                    style="min-width: 74px; max-width: 186px; width: 186px;"
                  >
                    Total Forecasted Employees
                    <span class="o_resize"></span>
                  </th>
                  <th
                    data-name="no_of_hired_employee"
                    tabindex="-1"
                    class="o_column_sortable o_list_number_th"
                    data-original-title
                    title
                    style="min-width: 74px; width: 128px;"
                  >
                    Hired Employees
                    <span class="o_resize"></span>
                  </th>
                  <th
                    data-name="state"
                    tabindex="-1"
                    class="o_column_sortable"
                    data-original-title
                    title
                    style="width: 147px;"
                  >
                    Status
                    <span class="o_resize"></span>
                  </th>
                </tr>
              </thead>
              <tbody class="ui-sortable">
                <tr class="o_data_row" data-id="hr.job_430">
                  <td
                    class="o_data_cell o_field_cell o_list_char o_required_modifier"
                    tabindex="-1"
                    title="head Accountant"
                  >head Accountant</td>
                  <td
                    class="o_data_cell o_field_cell o_list_many2one"
                    tabindex="-1"
                    title="Administration"
                  >Administration</td>
                  <td
                    class="o_data_cell o_field_cell o_list_number o_readonly_modifier"
                    tabindex="-1"
                    title="1"
                  >1</td>
                  <td class="o_data_cell o_field_cell o_list_number" tabindex="-1" title="0">0</td>
                  <td
                    class="o_data_cell o_field_cell o_list_number o_readonly_modifier"
                    tabindex="-1"
                    title="1"
                  >1</td>
                  <td class="o_data_cell o_field_cell o_list_number" tabindex="-1" title="0">0</td>
                  <td
                    class="o_data_cell o_field_cell o_readonly_modifier o_required_modifier"
                    tabindex="-1"
                    title="Not Recruiting"
                  >Not Recruiting</td>
                </tr>
                <tr class="o_data_row" data-id="hr.job_433">
                  <td
                    class="o_data_cell o_field_cell o_list_char o_required_modifier"
                    tabindex="-1"
                    title="Sales Manager"
                  >Sales Manager</td>
                  <td class="o_data_cell o_field_cell o_list_many2one" tabindex="-1" title></td>
                  <td
                    class="o_data_cell o_field_cell o_list_number o_readonly_modifier"
                    tabindex="-1"
                    title="1"
                  >1</td>
                  <td class="o_data_cell o_field_cell o_list_number" tabindex="-1" title="1">1</td>
                  <td
                    class="o_data_cell o_field_cell o_list_number o_readonly_modifier"
                    tabindex="-1"
                    title="2"
                  >2</td>
                  <td class="o_data_cell o_field_cell o_list_number" tabindex="-1" title="0">0</td>
                  <td
                    class="o_data_cell o_field_cell o_readonly_modifier o_required_modifier"
                    tabindex="-1"
                    title="Recruitment in Progress"
                  >Recruitment in Progress</td>
                </tr>
                <tr class="o_data_row" data-id="hr.job_435">
                  <td
                    class="o_data_cell o_field_cell o_list_char o_required_modifier"
                    tabindex="-1"
                    title="chief executive officer"
                  >chief executive officer</td>
                  <td class="o_data_cell o_field_cell o_list_many2one" tabindex="-1" title></td>
                  <td
                    class="o_data_cell o_field_cell o_list_number o_readonly_modifier"
                    tabindex="-1"
                    title="1"
                  >1</td>
                  <td class="o_data_cell o_field_cell o_list_number" tabindex="-1" title="1">1</td>
                  <td
                    class="o_data_cell o_field_cell o_list_number o_readonly_modifier"
                    tabindex="-1"
                    title="2"
                  >2</td>
                  <td class="o_data_cell o_field_cell o_list_number" tabindex="-1" title="0">0</td>
                  <td
                    class="o_data_cell o_field_cell o_readonly_modifier o_required_modifier"
                    tabindex="-1"
                    title="Recruitment in Progress"
                  >Recruitment in Progress</td>
                </tr>
                <tr class="o_data_row" data-id="hr.job_437">
                  <td
                    class="o_data_cell o_field_cell o_list_char o_required_modifier"
                    tabindex="-1"
                    title="developer"
                  >developer</td>
                  <td class="o_data_cell o_field_cell o_list_many2one" tabindex="-1" title></td>
                  <td
                    class="o_data_cell o_field_cell o_list_number o_readonly_modifier"
                    tabindex="-1"
                    title="1"
                  >1</td>
                  <td class="o_data_cell o_field_cell o_list_number" tabindex="-1" title="1">1</td>
                  <td
                    class="o_data_cell o_field_cell o_list_number o_readonly_modifier"
                    tabindex="-1"
                    title="2"
                  >2</td>
                  <td class="o_data_cell o_field_cell o_list_number" tabindex="-1" title="0">0</td>
                  <td
                    class="o_data_cell o_field_cell o_readonly_modifier o_required_modifier"
                    tabindex="-1"
                    title="Recruitment in Progress"
                  >Recruitment in Progress</td>
                </tr>
                <tr class="o_data_row" data-id="hr.job_439">
                  <td
                    class="o_data_cell o_field_cell o_list_char o_required_modifier"
                    tabindex="-1"
                    title="Staff Purchasing"
                  >Staff Purchasing</td>
                  <td class="o_data_cell o_field_cell o_list_many2one" tabindex="-1" title></td>
                  <td
                    class="o_data_cell o_field_cell o_list_number o_readonly_modifier"
                    tabindex="-1"
                    title="1"
                  >1</td>
                  <td class="o_data_cell o_field_cell o_list_number" tabindex="-1" title="1">1</td>
                  <td
                    class="o_data_cell o_field_cell o_list_number o_readonly_modifier"
                    tabindex="-1"
                    title="2"
                  >2</td>
                  <td class="o_data_cell o_field_cell o_list_number" tabindex="-1" title="0">0</td>
                  <td
                    class="o_data_cell o_field_cell o_readonly_modifier o_required_modifier"
                    tabindex="-1"
                    title="Recruitment in Progress"
                  >Recruitment in Progress</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td class="name"></td>
                  <td class="department_id"></td>
                  <td class="no_of_employee"></td>
                  <td class="no_of_recruitment"></td>
                  <td class="expected_employees"></td>
                  <td class="no_of_hired_employee"></td>
                  <td class="state"></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>