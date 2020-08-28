<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item active">
                <router-link class="text-primary" :to="{ name:'employee_index' }">Employees</router-link>
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
                    type="button"
                    class="btn btn-primary text-white o-kanban-button-new"
                    :to="{ name:'employee_create' }"
                  >Create</router-link>

                  <button type="button" class="btn btn-secondary">
                      Import
                  </button>
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

      <div class="o_content o_controller_with_searchpanel">
        <div class="o_search_panel d-none d-md-block" style="height:100vh">
          <section class="o_search_panel_section o_search_panel_category">
            <header class="o_search_panel_section_header text-uppercase">
              <i class="mr-1 fa fa-users o_search_panel_section_icon" style></i>
              <b>Department</b>
            </header>

            <ul class="list-group d-block o_search_panel_field" data-field-name="department_id">
              <li
                class="o_search_panel_category_value border-0 list-group-item"
                data-category-id="section_110"
              >
                <header class="list-group-item-action active">
                  <label class="o_search_panel_label mb0 d-block">
                    <span class="o_search_panel_label_title">
                      <b>All</b>
                    </span>
                  </label>
                </header>
              </li>

              <li
                class="o_search_panel_category_value border-0 list-group-item"
                data-id="1"
                data-category-id="section_110"
              >
                <header class="list-group-item-action">
                  <label for="Administration" class="o_search_panel_label mb0">
                    <span class="o_search_panel_label_title">Administration</span>
                  </label>
                </header>
              </li>

              <li
                class="o_search_panel_category_value border-0 list-group-item"
                data-id="6"
                data-category-id="section_110"
              >
                <header class="list-group-item-action">
                  <label for="Merchandise" class="o_search_panel_label mb0">
                    <span class="o_search_panel_label_title">Merchandise</span>
                  </label>
                </header>
              </li>

              <li
                class="o_search_panel_category_value border-0 list-group-item"
                data-id="4"
                data-category-id="section_110"
              >
                <header class="list-group-item-action">
                  <label for="R &amp; D" class="o_search_panel_label mb0">
                    <span class="o_search_panel_label_title">R &amp; D</span>
                  </label>
                </header>
              </li>

              <li
                class="o_search_panel_category_value border-0 list-group-item"
                data-id="2"
                data-category-id="section_110"
              >
                <header class="list-group-item-action">
                  <label for="Sales" class="o_search_panel_label mb0">
                    <span class="o_search_panel_label_title">Sales</span>
                  </label>
                </header>
              </li>
            </ul>
          </section>
        </div>
        <div
          class="o_kanban_view o_hr_employee_kanban o_renderer_with_searchpanel o_kanban_ungrouped"
        >
          <div
            class="oe_kanban_global_click o_kanban_record_has_image_fill o_hr_kanban_record o_kanban_record"
            modifiers="{}"
            tabindex="0"
            role="article"
          >
            <div
              class="o_field_image o_field_widget o_kanban_image_fill_left o_hr_rounded_circle"
              aria-atomic="true"
              name="image_128"
              data-zoom="1"
              data-zoom-image="http://server.odoo/web/image?model=hr.employee&amp;id=2&amp;field=image_1920&amp;unique=08272020095139"
              style="background-image: url(&quot;http://server.odoo/web/image?model=hr.employee&amp;id=2&amp;field=image_128&amp;unique=08272020095139&quot;);"
            ></div>

            <div class="oe_kanban_details" modifiers="{}">
              <div class="o_kanban_record_top" modifiers="{}">
                <div class="o_kanban_record_headings" modifiers="{}">
                  <strong class="o_kanban_record_title" modifiers="{}">
                    <div class="float-right" modifiers="{}">
                      <span
                        class="fa fa-circle text-danger"
                        role="img"
                        aria-label="Absent"
                        title="Absent"
                        name="presence_absent"
                        modifiers="{}"
                      ></span>
                    </div>

                    <span>Chen Yan Xi</span>
                  </strong>
                  <span class="o_kanban_record_subtitle" modifiers="{}">
                    <span>head Accountant</span>
                  </span>
                </div>
              </div>
              <div class="o_field_many2manytags o_field_widget o_kanban_tags" name="category_ids"></div>
              <ul modifiers="{}">
                <li id="last_login" modifiers="{}"></li>
                <li class="o_text_overflow" modifiers="{}">
                  <span>michellechen@gmail.com</span>
                </li>
              </ul>
            </div>
          </div>
          <div
            class="oe_kanban_global_click o_kanban_record_has_image_fill o_hr_kanban_record o_kanban_record"
            modifiers="{}"
            tabindex="0"
            role="article"
          >
            <div
              class="o_field_image o_field_widget o_kanban_image_fill_left o_hr_rounded_circle"
              aria-atomic="true"
              name="image_128"
              data-zoom="1"
              data-zoom-image="http://server.odoo/web/image?model=hr.employee&amp;id=3&amp;field=image_1920&amp;unique=08282020095018"
              style="background-image: url(&quot;http://server.odoo/web/image?model=hr.employee&amp;id=3&amp;field=image_128&amp;unique=08282020095018&quot;);"
            ></div>

            <div class="oe_kanban_details" modifiers="{}">
              <div class="o_kanban_record_top" modifiers="{}">
                <div class="o_kanban_record_headings" modifiers="{}">
                  <strong class="o_kanban_record_title" modifiers="{}">
                    <div class="float-right" modifiers="{}">
                      <span
                        class="fa fa-circle text-success"
                        role="img"
                        aria-label="Present"
                        title="Present"
                        name="presence_present"
                        modifiers="{}"
                      ></span>
                    </div>

                    <span>Feng Timo</span>
                  </strong>
                  <span class="o_kanban_record_subtitle" modifiers="{}">
                    <span>Sales Manager</span>
                  </span>
                </div>
              </div>
              <div class="o_field_many2manytags o_field_widget o_kanban_tags" name="category_ids"></div>
              <ul modifiers="{}">
                <li id="last_login" modifiers="{}"></li>
                <li class="o_text_overflow" modifiers="{}">
                  <span>ceokelvin12@gmail.com</span>
                </li>
              </ul>
            </div>
          </div>
          <div
            class="oe_kanban_global_click o_kanban_record_has_image_fill o_hr_kanban_record o_kanban_record"
            modifiers="{}"
            tabindex="0"
            role="article"
          >
            <div
              class="o_field_image o_field_widget o_kanban_image_fill_left o_hr_rounded_circle"
              aria-atomic="true"
              name="image_128"
              data-zoom="1"
              data-zoom-image="http://server.odoo/web/image?model=hr.employee&amp;id=1&amp;field=image_1920&amp;unique=08272020140137"
              style="background-image: url(&quot;http://server.odoo/web/image?model=hr.employee&amp;id=1&amp;field=image_128&amp;unique=08272020140137&quot;);"
            ></div>

            <div class="oe_kanban_details" modifiers="{}">
              <div class="o_kanban_record_top" modifiers="{}">
                <div class="o_kanban_record_headings" modifiers="{}">
                  <strong class="o_kanban_record_title" modifiers="{}">
                    <div class="float-right" modifiers="{}">
                      <span
                        class="fa fa-circle text-success"
                        role="img"
                        aria-label="Present"
                        title="Present"
                        name="presence_present"
                        modifiers="{}"
                      ></span>
                    </div>

                    <span>Kelvin Leonardi</span>
                  </strong>
                  <span class="o_kanban_record_subtitle" modifiers="{}">
                    <span>chief executive officer</span>
                  </span>
                </div>
              </div>
              <div class="o_field_many2manytags o_field_widget o_kanban_tags" name="category_ids"></div>
              <ul modifiers="{}">
                <li id="last_login" modifiers="{}"></li>
                <li class="o_text_overflow" modifiers="{}">
                  <span>kelvin@witech.co.id</span>
                </li>
              </ul>
            </div>
          </div>
          <div
            class="oe_kanban_global_click o_kanban_record_has_image_fill o_hr_kanban_record o_kanban_record"
            modifiers="{}"
            tabindex="0"
            role="article"
          >
            <div
              class="o_field_image o_field_widget o_kanban_image_fill_left o_hr_rounded_circle"
              aria-atomic="true"
              name="image_128"
              data-zoom="1"
              data-zoom-image="http://server.odoo/web/image?model=hr.employee&amp;id=4&amp;field=image_1920&amp;unique=08272020095126"
              style="background-image: url(&quot;http://server.odoo/web/image?model=hr.employee&amp;id=4&amp;field=image_128&amp;unique=08272020095126&quot;);"
            ></div>

            <div class="oe_kanban_details" modifiers="{}">
              <div class="o_kanban_record_top" modifiers="{}">
                <div class="o_kanban_record_headings" modifiers="{}">
                  <strong class="o_kanban_record_title" modifiers="{}">
                    <div class="float-right" modifiers="{}">
                      <span
                        class="fa fa-circle text-danger"
                        role="img"
                        aria-label="Absent"
                        title="Absent"
                        name="presence_absent"
                        modifiers="{}"
                      ></span>
                    </div>

                    <span>Oguri Yui</span>
                  </strong>
                  <span class="o_kanban_record_subtitle" modifiers="{}">
                    <span>developer</span>
                  </span>
                </div>
              </div>
              <div class="o_field_many2manytags o_field_widget o_kanban_tags" name="category_ids"></div>
              <ul modifiers="{}">
                <li id="last_login" modifiers="{}"></li>
                <li class="o_text_overflow" modifiers="{}">
                  <span>yuioguri@gmail.com</span>
                </li>
              </ul>
            </div>
          </div>
          <div
            class="oe_kanban_global_click o_kanban_record_has_image_fill o_hr_kanban_record o_kanban_record"
            modifiers="{}"
            tabindex="0"
            role="article"
          >
            <div
              class="o_field_image o_field_widget o_kanban_image_fill_left o_hr_rounded_circle"
              aria-atomic="true"
              name="image_128"
              data-zoom="1"
              data-zoom-image="http://server.odoo/web/image?model=hr.employee&amp;id=5&amp;field=image_1920&amp;unique=08262020100157"
              style="background-image: url(&quot;http://server.odoo/web/image?model=hr.employee&amp;id=5&amp;field=image_128&amp;unique=08262020100157&quot;);"
            ></div>

            <div class="oe_kanban_details" modifiers="{}">
              <div class="o_kanban_record_top" modifiers="{}">
                <div class="o_kanban_record_headings" modifiers="{}">
                  <strong class="o_kanban_record_title" modifiers="{}">
                    <div class="float-right" modifiers="{}">
                      <span
                        class="fa fa-circle text-success"
                        role="img"
                        aria-label="Present"
                        title="Present"
                        name="presence_present"
                        modifiers="{}"
                      ></span>
                    </div>

                    <span>Yoona</span>
                  </strong>
                  <span class="o_kanban_record_subtitle" modifiers="{}">
                    <span>Staff Purchasing</span>
                  </span>
                </div>
              </div>
              <div class="o_field_many2manytags o_field_widget o_kanban_tags" name="category_ids"></div>
              <ul modifiers="{}">
                <li id="last_login" modifiers="{}">
                  <span
                    style="font-size: 100%"
                    class="oe_kanban_button oe_kanban_color_3"
                    title="Thu 27th Aug - Fri 28th Aug"
                    modifiers="{}"
                  >
                    <span>ABSEN</span>
                  </span>
                </li>
                <li class="o_text_overflow" modifiers="{}">
                  <span>kelvinzxu12@gmail.com</span>
                </li>
              </ul>
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