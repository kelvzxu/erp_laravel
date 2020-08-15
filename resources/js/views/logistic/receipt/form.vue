<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item">
                <a href="#">Quotations</a>
              </li>
              <li class="breadcrumb-item" accesskey="b">
                <a href="#">S00001</a>
              </li>
              <li class="breadcrumb-item active">WH/OUT/00001</li>
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
                <div class="btn-group o_hidden"></div>
              </aside>
            </div>
            <div class="o_cp_right">
              <div class="btn-group o_search_options position-static" role="search"></div>
              <nav class="o_cp_pager" role="search" aria-label="Pager"></nav>
              <nav class="btn-group o_cp_switch_buttons" role="toolbar" aria-label="View switcher"></nav>
            </div>
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
                  name="action_confirm"
                  class="btn btn-primary o_invisible_modifier"
                  data-original-title
                  title
                >
                  <span>Mark as Todo</span>
                </button>
                <button
                  type="button"
                  name="action_assign"
                  class="btn btn-primary o_invisible_modifier"
                  data-original-title
                  title
                >
                  <span>Check Availability</span>
                </button>
                <button
                  type="button"
                  name="button_validate"
                  class="btn btn-primary"
                  data-original-title
                  title
                >
                  <span>Validate</span>
                </button>
                <button
                  type="button"
                  name="button_validate"
                  class="btn o_btn_validate btn-secondary o_invisible_modifier"
                  data-original-title
                  title
                >
                  <span>Validate</span>
                </button>
                <button
                  type="button"
                  name="do_print_picking"
                  class="btn btn-secondary"
                  data-original-title
                  title
                >
                  <span>Print</span>
                </button>
                <button
                  type="button"
                  name="500"
                  class="btn btn-secondary o_invisible_modifier"
                  data-original-title
                  title
                >
                  <span>Print</span>
                </button>
                <button
                  type="button"
                  name="520"
                  class="btn btn-secondary o_invisible_modifier"
                  data-original-title
                  title
                >
                  <span>Return</span>
                </button>
                <button
                  type="button"
                  name="do_unreserve"
                  class="btn btn-secondary"
                  data-original-title
                  title
                >
                  <span>Unreserve</span>
                </button>
                <button
                  type="button"
                  name="button_scrap"
                  class="btn btn-secondary"
                  data-original-title
                  title
                >
                  <span>Scrap</span>
                </button>
                <button
                  type="button"
                  name="action_toggle_is_locked"
                  help="If the picking is unlocked you can edit initial demand (for a draft picking) or done quantities (for a done picking)."
                  class="btn btn-secondary"
                  data-original-title
                  title
                >
                  <span>Unlock</span>
                </button>
                <button
                  type="button"
                  name="action_toggle_is_locked"
                  class="btn btn-primary o_invisible_modifier"
                  data-original-title
                  title
                >
                  <span>Lock</span>
                </button>
                <button
                  type="button"
                  name="action_cancel"
                  class="btn btn-secondary"
                  data-original-title
                  title
                >
                  <span>Cancel</span>
                </button>
              </div>
              <div
                class="o_statusbar_status o_field_widget o_readonly_modifier"
                name="state"
                data-original-title
                title
              >
                <button
                  type="button"
                  data-value="done"
                  disabled="disabled"
                  title="Not active state"
                  aria-pressed="false"
                  class="btn o_arrow_button btn-secondary disabled"
                >Done</button>

                <button
                  type="button"
                  data-value="assigned"
                  disabled="disabled"
                  title="Current state"
                  aria-pressed="true"
                  class="btn o_arrow_button btn-primary disabled"
                  aria-current="step"
                >Ready</button>

                <button
                  type="button"
                  data-value="confirmed"
                  disabled="disabled"
                  title="Not active state"
                  aria-pressed="false"
                  class="btn o_arrow_button btn-secondary disabled"
                >Waiting</button>

                <button
                  type="button"
                  data-value="draft"
                  disabled="disabled"
                  title="Not active state"
                  aria-pressed="false"
                  class="btn o_arrow_button btn-secondary disabled"
                >Draft</button>
              </div>
              <div
                class="o_field_boolean o_field_widget custom-control custom-checkbox o_invisible_modifier o_readonly_modifier"
                name="picking_type_entire_packs"
                data-original-title
                title
              >
                <input type="checkbox" id="checkbox-497" class="custom-control-input" disabled />
                <label for="o_field_input_470" class="custom-control-label">&#8203;</label>
              </div>
            </div>
            <div class="clearfix position-relative o_form_sheet">
              <div class="o_not_full oe_button_box">
                <button
                  type="button"
                  name="action_picking_move_tree"
                  class="btn oe_stat_button"
                  help="List view of operations"
                  context="{'picking_type_code': picking_type_code, 'default_picking_id': id, 'form_view_ref':'stock.view_move_form', 'address_in_id': partner_id, 'default_picking_type_id': picking_type_id, 'default_location_id': location_id, 'default_location_dest_id': location_dest_id}"
                  data-original-title
                  title
                >
                  <i class="fa fa-fw o_button_icon fa-arrows-v"></i>
                  <div class="o_form_field o_stat_info">
                    <span class="o_stat_text">Operations</span>
                  </div>
                </button>
                <div
                  class="o_field_boolean o_field_widget custom-control custom-checkbox o_invisible_modifier o_readonly_modifier"
                  name="has_scrap_move"
                  data-original-title
                  title
                >
                  <input type="checkbox" id="checkbox-498" class="custom-control-input" disabled />
                  <label for="o_field_input_471" class="custom-control-label">&#8203;</label>
                </div>
                <div
                  class="o_field_boolean o_field_widget custom-control custom-checkbox o_invisible_modifier o_readonly_modifier"
                  name="has_tracking"
                  data-original-title
                  title
                >
                  <input type="checkbox" id="checkbox-499" class="custom-control-input" disabled />
                  <label for="o_field_input_472" class="custom-control-label">&#8203;</label>
                </div>
                <button
                  type="button"
                  name="action_see_move_scrap"
                  class="btn oe_stat_button o_invisible_modifier"
                >
                  <i class="fa fa-fw o_button_icon fa-arrows-v"></i>
                  <span>Scraps</span>
                </button>
                <button
                  type="button"
                  name="action_see_packages"
                  class="btn oe_stat_button o_invisible_modifier"
                >
                  <i class="fa fa-fw o_button_icon fa-cubes"></i>
                  <span>Packages</span>
                </button>
                <button
                  type="button"
                  name="496"
                  class="btn oe_stat_button o_invisible_modifier"
                  invisible="1"
                >
                  <i class="fa fa-fw o_button_icon fa-arrow-up"></i>
                  <span>Traceability</span>
                </button>
                <button
                  type="button"
                  name="action_view_stock_valuation_layers"
                  class="btn oe_stat_button o_invisible_modifier"
                >
                  <i class="fa fa-fw o_button_icon fa-dollar"></i>
                  <span>Valuation</span>
                </button>
              </div>
              <h1 class="d-none d-md-block">
                <span
                  class="o_field_char o_field_widget o_readonly_modifier"
                  name="name"
                  data-original-title
                  title
                >WH/OUT/00001</span>
              </h1>
              <div class="o_group">
                <div class="row">
                  <div class="col-6">
                    <table class="o_group o_inner_group">
                      <tbody>
                        <tr>
                          <td class="o_td_label">
                            <div class>
                              <label
                                class="o_form_label"
                                for="o_field_input_425"
                                style="font-weight:bold;"
                                data-original-title
                                title
                              >Delivery Address</label>
                              <label
                                class="o_form_label o_invisible_modifier"
                                for="o_field_input_425"
                                style="font-weight:bold;"
                              >Receive From</label>
                              <label
                                class="o_form_label o_invisible_modifier"
                                for="o_field_input_425"
                                style="font-weight:bold;"
                              >Contact</label>
                            </div>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_widget o_field_many2one o_with_button"
                              aria-atomic="true"
                              name="partner_id"
                            >
                              <div class="o_input_dropdown">
                                <input
                                  type="text"
                                  class="o_input ui-autocomplete-input"
                                  autocomplete="off"
                                  id="o_field_input_425"
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
                              class="o_form_label o_readonly_modifier o_required_modifier"
                              for="o_field_input_426"
                              data-original-title
                              title
                            >Operation Type</label>
                          </td>
                          <td style="width: 100%;">
                            <a
                              class="o_form_uri o_field_widget o_readonly_modifier o_required_modifier"
                              href="#id=2&amp;model=stock.picking.type"
                              name="picking_type_id"
                              id="o_field_input_426"
                            >
                              <span>My Company: Delivery Orders</span>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_invisible_modifier o_readonly_modifier o_required_modifier"
                              for="o_field_input_427"
                              data-original-title
                              title
                            >Source Location</label>
                          </td>
                          <td style="width: 100%;">
                            <a
                              class="o_form_uri o_field_widget o_invisible_modifier o_readonly_modifier o_required_modifier"
                              href="#id=8&amp;model=stock.location"
                              name="location_id"
                              id="o_field_input_427"
                            >
                              <span>WH/Stock</span>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_invisible_modifier o_readonly_modifier o_required_modifier"
                              for="o_field_input_428"
                              data-original-title
                              title
                            >Destination Location</label>
                          </td>
                          <td style="width: 100%;">
                            <a
                              class="o_form_uri o_field_widget o_invisible_modifier o_readonly_modifier o_required_modifier"
                              href="#id=5&amp;model=stock.location"
                              name="location_dest_id"
                              id="o_field_input_428"
                            >
                              <span>Partner Locations/Customers</span>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_invisible_modifier o_readonly_modifier o_form_label_empty"
                              for="o_field_input_429"
                              data-original-title
                              title
                            >Back Order of</label>
                          </td>
                          <td style="width: 100%;">
                            <a
                              class="o_form_uri o_field_widget o_invisible_modifier o_readonly_modifier o_field_empty"
                              href="#"
                              name="backorder_id"
                              id="o_field_input_429"
                            >
                              <span></span>
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-6">
                    <table class="o_group o_inner_group">
                      <tbody>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_required_modifier"
                              for="o_field_input_430"
                              data-original-title
                              title
                            >Scheduled Date</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_datepicker o_field_date o_field_widget o_required_modifier"
                              aria-atomic="true"
                              id="datepicker500"
                              data-target-input="nearest"
                              name="scheduled_date"
                            >
                              <input
                                type="text"
                                class="o_datepicker_input o_input datetimepicker-input"
                                name="scheduled_date"
                                data-target="#datepicker500"
                                placeholder
                                id="o_field_input_430"
                              />
                              <span class="o_datepicker_button"></span>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_invisible_modifier o_readonly_modifier o_form_label_empty"
                              for="o_field_input_431"
                              data-original-title
                              title
                            >Effective Date</label>
                          </td>
                          <td style="width: 100%;">
                            <span
                              class="o_field_date o_field_widget o_invisible_modifier o_readonly_modifier o_field_empty"
                              name="date_done"
                            ></span>
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label"
                              for="o_field_input_432"
                              data-original-title
                              title
                            >Source Document</label>
                          </td>
                          <td style="width: 100%;">
                            <input
                              class="o_field_char o_field_widget o_input"
                              name="origin"
                              placeholder="e.g. PO0032"
                              type="text"
                              id="o_field_input_432"
                            />
                          </td>
                        </tr>
                        <tr>
                          <td class="o_td_label">
                            <label
                              class="o_form_label o_invisible_modifier"
                              for="o_field_input_433"
                              data-original-title
                              title
                            >Assign Owner</label>
                          </td>
                          <td style="width: 100%;">
                            <div
                              class="o_field_widget o_field_many2one o_invisible_modifier"
                              aria-atomic="true"
                              name="owner_id"
                            >
                              <div class="o_input_dropdown">
                                <input
                                  type="text"
                                  class="o_input ui-autocomplete-input"
                                  autocomplete="off"
                                  id="o_field_input_433"
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
                  <li class="nav-item o_invisible_modifier">
                    <a
                      data-toggle="tab"
                      disable_anchor="true"
                      href="#notebook_page_482"
                      class="nav-link"
                      role="tab"
                    >Detailed Operations</a>
                  </li>
                  <li class="nav-item o_invisible_modifier">
                    <a
                      data-toggle="tab"
                      disable_anchor="true"
                      href="#notebook_page_483"
                      class="nav-link"
                      role="tab"
                    >Detailed Operations</a>
                  </li>
                  <li class="nav-item">
                    <a
                      data-toggle="tab"
                      disable_anchor="true"
                      href="#notebook_page_484"
                      class="nav-link active"
                      role="tab"
                    >Operations</a>
                  </li>
                  <li class="nav-item">
                    <a
                      data-toggle="tab"
                      disable_anchor="true"
                      href="#notebook_page_485"
                      class="nav-link"
                      role="tab"
                    >Additional Info</a>
                  </li>
                  <li class="nav-item">
                    <a
                      data-toggle="tab"
                      disable_anchor="true"
                      href="#notebook_page_486"
                      class="nav-link"
                      role="tab"
                    >Note</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane" id="notebook_page_482">
                    <div
                      class="o_field_one2many o_field_widget o_field_x2many o_field_x2many_list o_readonly_modifier"
                      name="move_line_nosuggest_ids"
                      id="o_field_input_477"
                      data-original-title
                      title
                    >
                      <div class="o_cp_controller">
                        <div class="o_x2m_control_panel">
                          <nav
                            class="o_cp_buttons"
                            aria-label="Control panel toolbar"
                            role="toolbar"
                          ></nav>
                          <nav class="o_cp_pager" aria-label="Pager" role="toolbar">
                            <div class="o_pager o_hidden">
                              <span class="o_pager_counter">
                                <span class="o_pager_value"></span> /
                                <span class="o_pager_limit"></span>
                              </span>
                              <span class="btn-group" aria-atomic="true">
                                <button
                                  type="button"
                                  class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                                  aria-label="Previous"
                                  title="Previous"
                                  tabindex="-1"
                                ></button>
                                <button
                                  type="button"
                                  class="fa fa-chevron-right btn btn-secondary o_pager_next"
                                  aria-label="Next"
                                  title="Next"
                                  tabindex="-1"
                                ></button>
                              </span>
                            </div>
                          </nav>
                        </div>
                      </div>
                      <div class="o_list_view">
                        <div class="table-responsive">
                          <table
                            class="o_list_table table table-sm table-hover table-striped o_list_table_ungrouped o_empty_list"
                          >
                            <thead>
                              <tr>
                                <th
                                  data-name="product_id"
                                  tabindex="-1"
                                  class="o_column_sortable"
                                  data-original-title
                                  title
                                >Product</th>
                                <th
                                  data-name="product_uom_qty"
                                  tabindex="-1"
                                  class="o_column_sortable o_list_number_th"
                                  data-original-title
                                  title
                                >Reserved</th>
                                <th
                                  data-name="qty_done"
                                  tabindex="-1"
                                  class="o_column_sortable o_list_number_th"
                                  data-original-title
                                  title
                                >Done</th>
                              </tr>
                            </thead>
                            <tbody class="ui-sortable">
                              <tr>
                                <td colspan="3">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="3">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="3">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="3">&nbsp;</td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td class="product_id"></td>
                                <td class="product_uom_qty"></td>
                                <td class="qty_done"></td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div
                      class="o_field_one2many o_field_widget o_field_x2many o_field_x2many_list o_invisible_modifier"
                      name="package_level_ids_details"
                      id="o_field_input_478"
                      data-original-title
                      title
                    >
                      <div class="o_cp_controller">
                        <div class="o_x2m_control_panel">
                          <nav
                            class="o_cp_buttons"
                            aria-label="Control panel toolbar"
                            role="toolbar"
                          ></nav>
                          <nav class="o_cp_pager" aria-label="Pager" role="toolbar">
                            <div class="o_pager o_hidden">
                              <span class="o_pager_counter">
                                <span class="o_pager_value"></span> /
                                <span class="o_pager_limit"></span>
                              </span>
                              <span class="btn-group" aria-atomic="true">
                                <button
                                  type="button"
                                  class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                                  aria-label="Previous"
                                  title="Previous"
                                  tabindex="-1"
                                ></button>
                                <button
                                  type="button"
                                  class="fa fa-chevron-right btn btn-secondary o_pager_next"
                                  aria-label="Next"
                                  title="Next"
                                  tabindex="-1"
                                ></button>
                              </span>
                            </div>
                          </nav>
                        </div>
                      </div>
                      <div class="o_list_view">
                        <div class="table-responsive">
                          <table
                            class="o_list_table table table-sm table-hover table-striped o_list_table_ungrouped o_empty_list"
                          >
                            <thead>
                              <tr>
                                <th
                                  data-name="package_id"
                                  tabindex="-1"
                                  class="o_column_sortable"
                                  data-original-title
                                  title
                                >Package</th>
                                <th data-name="state" tabindex="-1" data-original-title title>State</th>
                                <th data-name="is_done" tabindex="-1" data-original-title title>Done</th>
                                <th data-name="action_show_package_details"></th>
                                <th class="o_list_record_remove_header"></th>
                              </tr>
                            </thead>
                            <tbody class="ui-sortable">
                              <tr>
                                <td colspan="5" class="o_field_x2many_list_row_add">
                                  <a href="#" role="button">Add a line</a>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="5">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="5">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="5">&nbsp;</td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td class="package_id"></td>
                                <td class="state"></td>
                                <td class="is_done"></td>
                                <td class="action_show_package_details"></td>
                                <td></td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                    <button
                      type="button"
                      class="btn btn-primary o_invisible_modifier"
                      name="put_in_pack"
                      invisible="1"
                      data-original-title
                      title
                    >
                      <span>Put in Pack</span>
                    </button>
                  </div>
                  <div class="tab-pane" id="notebook_page_483">
                    <div
                      class="o_field_one2many o_field_widget o_field_x2many o_field_x2many_list o_readonly_modifier"
                      name="move_line_ids_without_package"
                      id="o_field_input_479"
                      data-original-title
                      title
                    >
                      <div class="o_cp_controller">
                        <div class="o_x2m_control_panel">
                          <nav
                            class="o_cp_buttons"
                            aria-label="Control panel toolbar"
                            role="toolbar"
                          ></nav>
                          <nav class="o_cp_pager" aria-label="Pager" role="toolbar">
                            <div class="o_pager o_hidden">
                              <span class="o_pager_counter">
                                <span class="o_pager_value"></span> /
                                <span class="o_pager_limit"></span>
                              </span>
                              <span class="btn-group" aria-atomic="true">
                                <button
                                  type="button"
                                  class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                                  aria-label="Previous"
                                  title="Previous"
                                  tabindex="-1"
                                ></button>
                                <button
                                  type="button"
                                  class="fa fa-chevron-right btn btn-secondary o_pager_next"
                                  aria-label="Next"
                                  title="Next"
                                  tabindex="-1"
                                ></button>
                              </span>
                            </div>
                          </nav>
                        </div>
                      </div>
                      <div class="o_list_view">
                        <div class="table-responsive">
                          <table
                            class="o_list_table table table-sm table-hover table-striped o_list_table_ungrouped"
                          >
                            <thead>
                              <tr>
                                <th
                                  data-name="product_id"
                                  tabindex="-1"
                                  class="o_column_sortable"
                                  data-original-title
                                  title
                                >
                                  Product
                                  <span class="o_resize"></span>
                                </th>
                                <th
                                  data-name="product_uom_qty"
                                  tabindex="-1"
                                  class="o_column_sortable o_list_number_th"
                                  data-original-title
                                  title
                                >
                                  Reserved
                                  <span class="o_resize"></span>
                                </th>
                                <th
                                  data-name="qty_done"
                                  tabindex="-1"
                                  class="o_column_sortable o_list_number_th"
                                  data-original-title
                                  title
                                >
                                  Done
                                  <span class="o_resize"></span>
                                </th>
                              </tr>
                            </thead>
                            <tbody class="ui-sortable">
                              <tr class="o_data_row" data-id="stock.move.line_409">
                                <td
                                  class="o_data_cell o_field_cell o_list_many2one o_readonly_modifier o_required_modifier"
                                  tabindex="-1"
                                  title="Four Person Desk"
                                >Four Person Desk</td>
                                <td
                                  class="o_data_cell o_field_cell o_list_number o_readonly_modifier o_required_modifier"
                                  tabindex="-1"
                                  title="1.000"
                                >1.000</td>
                                <td
                                  class="o_data_cell o_field_cell o_list_number"
                                  tabindex="-1"
                                  title="0.000"
                                >0.000</td>
                              </tr>
                              <tr>
                                <td colspan="3">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="3">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="3">&nbsp;</td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td class="product_id"></td>
                                <td class="product_uom_qty"></td>
                                <td class="qty_done"></td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div
                      class="o_field_one2many o_field_widget o_field_x2many o_field_x2many_list o_invisible_modifier"
                      name="package_level_ids_details"
                      id="o_field_input_478"
                      data-original-title
                      title
                    >
                      <div class="o_cp_controller">
                        <div class="o_x2m_control_panel">
                          <nav
                            class="o_cp_buttons"
                            aria-label="Control panel toolbar"
                            role="toolbar"
                          ></nav>
                          <nav class="o_cp_pager" aria-label="Pager" role="toolbar">
                            <div class="o_pager o_hidden">
                              <span class="o_pager_counter">
                                <span class="o_pager_value"></span> /
                                <span class="o_pager_limit"></span>
                              </span>
                              <span class="btn-group" aria-atomic="true">
                                <button
                                  type="button"
                                  class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                                  aria-label="Previous"
                                  title="Previous"
                                  tabindex="-1"
                                ></button>
                                <button
                                  type="button"
                                  class="fa fa-chevron-right btn btn-secondary o_pager_next"
                                  aria-label="Next"
                                  title="Next"
                                  tabindex="-1"
                                ></button>
                              </span>
                            </div>
                          </nav>
                        </div>
                      </div>
                      <div class="o_list_view">
                        <div class="table-responsive">
                          <table
                            class="o_list_table table table-sm table-hover table-striped o_list_table_ungrouped o_empty_list"
                          >
                            <thead>
                              <tr>
                                <th
                                  data-name="package_id"
                                  tabindex="-1"
                                  class="o_column_sortable"
                                  data-original-title
                                  title
                                >Package</th>
                                <th data-name="state" tabindex="-1" data-original-title title>State</th>
                                <th data-name="is_done" tabindex="-1" data-original-title title>Done</th>
                                <th data-name="action_show_package_details"></th>
                                <th class="o_list_record_remove_header"></th>
                              </tr>
                            </thead>
                            <tbody class="ui-sortable">
                              <tr>
                                <td colspan="5" class="o_field_x2many_list_row_add">
                                  <a href="#" role="button">Add a line</a>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="5">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="5">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="5">&nbsp;</td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td class="package_id"></td>
                                <td class="state"></td>
                                <td class="is_done"></td>
                                <td class="action_show_package_details"></td>
                                <td></td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                    <button
                      type="button"
                      class="btn btn-primary o_invisible_modifier"
                      name="put_in_pack"
                      invisible="1"
                      data-original-title
                      title
                    >
                      <span>Put in Pack</span>
                    </button>
                  </div>
                  <div class="tab-pane active" id="notebook_page_484">
                    <div
                      class="o_field_one2many o_field_widget o_field_x2many o_field_x2many_list"
                      name="move_ids_without_package"
                      id="o_field_input_480"
                      data-original-title
                      title
                    >
                      <div class="o_cp_controller">
                        <div class="o_x2m_control_panel">
                          <nav
                            class="o_cp_buttons"
                            aria-label="Control panel toolbar"
                            role="toolbar"
                          ></nav>
                          <nav class="o_cp_pager" aria-label="Pager" role="toolbar">
                            <div class="o_pager o_hidden">
                              <span class="o_pager_counter">
                                <span class="o_pager_value"></span> /
                                <span class="o_pager_limit"></span>
                              </span>
                              <span class="btn-group" aria-atomic="true">
                                <button
                                  type="button"
                                  class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                                  aria-label="Previous"
                                  title="Previous"
                                  tabindex="-1"
                                ></button>
                                <button
                                  type="button"
                                  class="fa fa-chevron-right btn btn-secondary o_pager_next"
                                  aria-label="Next"
                                  title="Next"
                                  tabindex="-1"
                                ></button>
                              </span>
                            </div>
                          </nav>
                        </div>
                      </div>
                      <div class="o_list_view o_list_optional_columns">
                        <div class="table-responsive">
                          <table
                            class="o_list_table table table-sm table-hover table-striped o_list_table_ungrouped"
                            style="table-layout: fixed;"
                          >
                            <thead>
                              <tr>
                                <th
                                  data-name="product_id"
                                  tabindex="-1"
                                  class="o_column_sortable"
                                  data-original-title
                                  title
                                  style="width: 223px;"
                                >
                                  Product
                                  <span class="o_resize"></span>
                                </th>
                                <th
                                  data-name="product_uom_qty"
                                  tabindex="-1"
                                  class="o_column_sortable o_list_number_th"
                                  data-original-title
                                  title
                                  style="min-width: 92px; width: 183px;"
                                >
                                  Demand
                                  <span class="o_resize"></span>
                                </th>
                                <th
                                  data-name="reserved_availability"
                                  tabindex="-1"
                                  class="o_list_number_th"
                                  data-original-title
                                  title
                                  style="min-width: 92px; width: 183px;"
                                >
                                  Reserved
                                  <span class="o_resize"></span>
                                </th>
                                <th
                                  data-name="quantity_done"
                                  tabindex="-1"
                                  class="o_list_number_th"
                                  data-original-title
                                  title
                                  style="min-width: 92px; width: 367px;"
                                >
                                  Done
                                  <span class="o_resize"></span>
                                </th>
                                <th data-name="action_show_details" style="width: 18px;"></th>
                                <th data-name="action_assign_serial" style="width: 18px;"></th>
                                <th class="o_list_record_remove_header" style="width: 32px;"></th>
                              </tr>
                            </thead>
                            <tbody class="ui-sortable">
                              <tr class="o_data_row o_selected_row" data-id="stock.move_417">
                                <td
                                  class="o_data_cell o_field_cell o_list_many2one o_readonly_modifier o_required_modifier"
                                  tabindex="-1"
                                  title="Four Person Desk"
                                >
                                  <a
                                    class="o_form_uri o_field_widget o_readonly_modifier o_required_modifier"
                                    href="#"
                                    name="product_id"
                                  >Four Person Desk</a>
                                </td>
                                <td
                                  class="o_data_cell o_field_cell o_list_number o_readonly_modifier o_required_modifier"
                                  tabindex="-1"
                                  title="1.000"
                                >
                                  <span
                                    class="o_field_float o_field_number o_field_widget o_readonly_modifier o_required_modifier"
                                    name="product_uom_qty"
                                  >1.000</span>
                                </td>
                                <td
                                  class="o_data_cell o_field_cell o_list_number o_readonly_modifier"
                                  tabindex="-1"
                                  title="1.000"
                                >
                                  <span
                                    class="o_field_float o_field_number o_field_widget o_readonly_modifier"
                                    name="reserved_availability"
                                  >1.000</span>
                                </td>
                                <td
                                  class="o_data_cell o_field_cell o_list_number"
                                  tabindex="-1"
                                  title="0.000"
                                >
                                  <input
                                    class="o_field_float o_field_number o_field_widget o_input"
                                    name="quantity_done"
                                    placeholder
                                    type="text"
                                  />
                                </td>
                                <td
                                  class="o_data_cell o_list_button o_invisible_modifier"
                                  tabindex="-1"
                                >
                                  <button
                                    type="button"
                                    name="action_show_details"
                                    class="btn o_icon_button o_invisible_modifier"
                                    title="Register lots, packs, location"
                                  >
                                    <i class="fa fa-fw o_button_icon fa-list"></i>
                                  </button>
                                </td>
                                <td
                                  class="o_data_cell o_list_button o_invisible_modifier"
                                  tabindex="-1"
                                >
                                  <button
                                    type="button"
                                    name="action_assign_serial"
                                    role="img"
                                    title="Assign Serial Numbers"
                                    class="btn o_icon_button o_invisible_modifier"
                                  >
                                    <i class="fa fa-fw o_button_icon fa-plus-square"></i>
                                  </button>
                                </td>
                                <td class="o_list_record_remove">
                                  <button
                                    class="fa fa-trash-o"
                                    name="delete"
                                    aria-label="Delete row 1"
                                  ></button>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="7" class="o_field_x2many_list_row_add">
                                  <a href="#" role="button">Add a line</a>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="7">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="7">&nbsp;</td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td class="product_id"></td>
                                <td class="product_uom_qty"></td>
                                <td class="reserved_availability"></td>
                                <td class="quantity_done"></td>
                                <td class="action_show_details"></td>
                                <td class="action_assign_serial"></td>
                                <td></td>
                              </tr>
                            </tfoot>
                            <i class="o_optional_columns_dropdown_toggle fa fa-ellipsis-v"></i>
                          </table>
                        </div>
                        <div class="o_optional_columns text-center dropdown">
                          <a
                            class="dropdown-toggle text-dark o-no-caret"
                            href="#"
                            role="button"
                            data-toggle="dropdown"
                            aria-expanded="false"
                          ></a>
                          <div
                            class="dropdown-menu o_optional_columns_dropdown dropdown-menu-right"
                            role="menu"
                          >
                            <div class="dropdown-item">
                              <div class="custom-control custom-checkbox">
                                <input
                                  type="checkbox"
                                  id="checkbox-501"
                                  class="custom-control-input"
                                  name="description_picking"
                                />
                                <label
                                  for="checkbox-501"
                                  class="custom-control-label"
                                >Description (description_picking)</label>
                              </div>
                            </div>
                            <div class="dropdown-item">
                              <div class="custom-control custom-checkbox">
                                <input
                                  type="checkbox"
                                  id="checkbox-502"
                                  class="custom-control-input"
                                  name="date_expected"
                                />
                                <label
                                  for="checkbox-502"
                                  class="custom-control-label"
                                >Expected Date (date_expected)</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <span
                      class="o_field_integer o_field_number o_field_widget o_invisible_modifier o_readonly_modifier"
                      name="id"
                      data-original-title
                      title
                    >1</span>
                    <div
                      class="o_field_one2many o_field_widget o_field_x2many o_field_x2many_list o_invisible_modifier"
                      name="package_level_ids"
                      id="o_field_input_481"
                      data-original-title
                      title
                    >
                      <div class="o_cp_controller">
                        <div class="o_x2m_control_panel">
                          <nav
                            class="o_cp_buttons"
                            aria-label="Control panel toolbar"
                            role="toolbar"
                          ></nav>
                          <nav class="o_cp_pager" aria-label="Pager" role="toolbar">
                            <div class="o_pager o_hidden">
                              <span class="o_pager_counter">
                                <span class="o_pager_value"></span> /
                                <span class="o_pager_limit"></span>
                              </span>
                              <span class="btn-group" aria-atomic="true">
                                <button
                                  type="button"
                                  class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                                  aria-label="Previous"
                                  title="Previous"
                                  tabindex="-1"
                                ></button>
                                <button
                                  type="button"
                                  class="fa fa-chevron-right btn btn-secondary o_pager_next"
                                  aria-label="Next"
                                  title="Next"
                                  tabindex="-1"
                                ></button>
                              </span>
                            </div>
                          </nav>
                        </div>
                      </div>
                      <div class="o_list_view">
                        <div class="table-responsive">
                          <table
                            class="o_list_table table table-sm table-hover table-striped o_list_table_ungrouped o_empty_list"
                          >
                            <thead>
                              <tr>
                                <th
                                  data-name="package_id"
                                  tabindex="-1"
                                  class="o_column_sortable"
                                  data-original-title
                                  title
                                >Package</th>
                                <th data-name="state" tabindex="-1" data-original-title title>State</th>
                                <th data-name="is_done" tabindex="-1" data-original-title title>Done</th>
                                <th data-name="action_show_package_details"></th>
                                <th class="o_list_record_remove_header"></th>
                              </tr>
                            </thead>
                            <tbody class="ui-sortable">
                              <tr>
                                <td colspan="5" class="o_field_x2many_list_row_add">
                                  <a href="#" role="button">Add a line</a>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="5">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="5">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="5">&nbsp;</td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td class="package_id"></td>
                                <td class="state"></td>
                                <td class="is_done"></td>
                                <td class="action_show_package_details"></td>
                                <td></td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                    <button
                      type="button"
                      class="btn btn-primary o_invisible_modifier"
                      name="put_in_pack"
                      invisible="1"
                      data-original-title
                      title
                    >
                      <span>Put in Pack</span>
                    </button>
                  </div>
                  <div class="tab-pane" id="notebook_page_485">
                    <div class="o_group">
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Other Information</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier o_readonly_modifier"
                                for="o_field_input_438"
                                data-original-title
                                title
                              >Type of Operation</label>
                            </td>
                            <td style="width: 100%;">
                              <span
                                name="picking_type_code"
                                class="o_field_widget o_invisible_modifier o_readonly_modifier"
                                data-original-title
                                title
                              >Delivery</span>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_required_modifier"
                                for="o_field_input_439"
                                data-original-title
                                title
                              >Shipping Policy</label>
                            </td>
                            <td style="width: 100%;">
                              <select
                                class="o_input o_field_widget o_required_modifier"
                                name="move_type"
                                id="o_field_input_439"
                              >
                                <option value="false" style="display: none"></option>
                                <option value="&quot;direct&quot;" style>As soon as possible</option>
                                <option value="&quot;one&quot;" style>When all products are ready</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_440"
                                data-original-title
                                title
                              >Priority</label>
                            </td>
                            <td style="width: 100%;">
                              <div class="o_priority o_field_widget" name="priority">
                                <a
                                  href="#"
                                  title="Normal"
                                  aria-label="Normal"
                                  data-index="1"
                                  class="o_priority_star fa fa-star"
                                ></a>
                                <a
                                  href="#"
                                  title="Urgent"
                                  aria-label="Urgent"
                                  data-index="2"
                                  class="o_priority_star fa fa-star-o"
                                ></a>
                                <a
                                  href="#"
                                  title="Very Urgent"
                                  aria-label="Very Urgent"
                                  data-index="3"
                                  class="o_priority_star fa fa-star-o"
                                ></a>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_441"
                                data-original-title
                                title
                              >Responsible</label>
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
                                    id="o_field_input_441"
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
                                for="o_field_input_442"
                                data-original-title
                                title
                              >Procurement Group</label>
                            </td>
                            <td style="width: 100%;">
                              <a
                                class="o_form_uri o_field_widget o_readonly_modifier"
                                href="#id=1&amp;model=procurement.group"
                                name="group_id"
                                id="o_field_input_442"
                              >
                                <span>S00001</span>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier o_readonly_modifier"
                                for="o_field_input_443"
                                data-original-title
                                title
                              >Company</label>
                            </td>
                            <td style="width: 100%;">
                              <a
                                class="o_form_uri o_field_widget o_invisible_modifier o_readonly_modifier"
                                href="#id=1&amp;model=res.company"
                                name="company_id"
                                id="o_field_input_443"
                              >
                                <span>My Company</span>
                              </a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane" id="notebook_page_486">
                    <textarea
                      class="o_field_text o_field_widget o_input"
                      name="note"
                      placeholder="Add an internal note that will be printed on the Picking Operations sheet"
                      type="text"
                      id="o_field_input_474"
                      style="overflow-y: hidden; height: 50px; resize: none;"
                      data-original-title
                      title
                    ></textarea>
                    <textarea
                      disabled
                      style="position: absolute; opacity: 0; height: 10px; border-top-width: 0px; border-bottom-width: 0px; padding: 0px; overflow: hidden; top: -10000px; left: -10000px; width: 0px;"
                    ></textarea>
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
export default {};
</script>
