<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item active">
                <router-link class="text-primary" :to="{ name:'contract_index' }">Contracts</router-link>
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
                    type="button"
                    class="btn btn-primary text-white o-kanban-button-new"
                    :to="{ name:'contract_create' }"
                  >Create</router-link>

                  <button type="button" class="btn btn-secondary o_button_import">Import</button>
                </div>
              </div>
              <aside class="o_cp_sidebar"></aside>
            </div>
            <div class="o_cp_right">
              <nav class="o_cp_pager" role="search" aria-label="Pager">
                <div class="o_pager o_hidden">
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
              <nav class="btn-group o_cp_switch_buttons" role="toolbar" aria-label="View switcher">
                <button
                  type="button"
                  accesskey="k"
                  class="btn btn-secondary fa fa-lg fa-th-large o_cp_switch_kanban"
                  aria-label="View kanban"
                  data-view-type="kanban"
                  title
                  tabindex="-1"
                  data-original-title="View kanban"
                ></button>

                <button
                  type="button"
                  accesskey="l"
                  class="btn btn-secondary fa fa-lg fa-list-ul o_cp_switch_list active"
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
        <div class>
          <div class="o_view_nocontent">
            <div class="o_nocontent_help"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>