<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item active">
                <router-link class="text-primary" :to="{ name:'department_index' }">Departments</router-link>
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
                <div>
                  <router-link
                    title="Create New Departments"
                    type="button"
                    class="btn btn-primary text-white o-kanban-button-new"
                    :to="{ name:'department_create' }"
                  >Create</router-link>

                  <button type="button" class="btn btn-secondary o_button_import">Import</button>
                </div>
              </div>
              <aside class="o_cp_sidebar"></aside>
            </div>
            <div class="o_cp_right">
              <nav class="o_cp_pager" role="search" aria-label="Pager">
                <div class="o_pager">
                  <span class="o_pager_counter">
                    <span class="o_pager_value">1-4</span> /
                    <span class="o_pager_limit">4</span>
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
              <nav class="btn-group o_cp_switch_buttons" role="toolbar" aria-label="View switcher">
                <button
                  type="button"
                  accesskey="k"
                  class="btn btn-secondary fa fa-lg fa-th-large o_cp_switch_kanban active"
                  aria-label="View kanban"
                  data-view-type="kanban"
                  title
                  tabindex="-1"
                  data-original-title="View kanban"
                ></button>

                <button
                  type="button"
                  accesskey="l"
                  class="btn btn-secondary fa fa-lg fa-list-ul o_cp_switch_list"
                  aria-label="View list"
                  data-view-type="list"
                  title
                  tabindex="-1"
                  data-original-title="View list"
                ></button>
              </nav>
            </div>
          </div>
        </div>
      </div>

      <div class="o_content">
        <div
          class="o_kanban_view oe_background_grey o_kanban_dashboard o_hr_kanban o_kanban_ungrouped"
        >
          <div class="oe_kanban_color_0 o_kanban_record">
            <div class="o_kanban_card_header">
              <div class="o_kanban_card_header_title">
                <div class="o_primary">
                  <span>Administration</span>
                </div>
                <div class="o_secondary"></div>
              </div>
              <b-dropdown id="dropdown-1" class="o_dropdown_kanban">
                <template slot="button-content">
                  <i class="py-0 fa fa-ellipsis-v"></i>
                </template>
                <b-dropdown-item>First Action</b-dropdown-item>
                <b-dropdown-item>Second Action</b-dropdown-item>
                <b-dropdown-item>Third Action</b-dropdown-item>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-item active>Active action</b-dropdown-item>
                <b-dropdown-item disabled>Disabled action</b-dropdown-item>
              </b-dropdown>
            </div>
            <div class="container o_kanban_card_content" modifiers="{}">
              <div class="row" modifiers="{}">
                <div class="col-6 o_kanban_primary_left" modifiers="{}">
                  <button
                    class="btn btn-primary oe_kanban_action oe_kanban_action_button"
                    modifiers="{}"
                    options="{}"
                    data-name="145"
                    data-type="action"
                    type="button"
                  >Employees</button>
                </div>
                <div class="col-6 o_kanban_primary_right" modifiers="{}"></div>
                <div class="col-12 o_kanban_primary_bottom bottom_block" modifiers="{}">
                  <div class="row" modifiers="{}">
                    <div class="col-3" modifiers="{}">
                      <a
                        title="Absent Employee(s), Whose leaves request are either confirmed or validated on today"
                        href="#"
                        class="oe_kanban_action oe_kanban_action_a"
                      >Absence</a>
                    </div>
                    <div class="col-9" modifiers="{}">
                      <div
                        class="o_progressbar o_field_widget"
                        role="progressbar"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        aria-valuenow="0"
                        name="absence_of_today"
                      >
                        <div
                          class="o_progress"
                          aria-valuemin="0"
                          aria-valuemax="2"
                          aria-valuenow="0"
                        >
                          <div class="o_progressbar_complete" style="width: 0%;"></div>
                        </div>
                        <div class="o_progressbar_value">0 / 2</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="o_kanban_record o_kanban_ghost"></div>
          <div class="o_kanban_record o_kanban_ghost"></div>
          <div class="o_kanban_record o_kanban_ghost"></div>
          <div class="o_kanban_record o_kanban_ghost"></div>
          <div class="o_kanban_record o_kanban_ghost"></div>
          <div class="o_kanban_record o_kanban_ghost"></div>
        </div>
      </div>
    </div>
  </div>
</template>