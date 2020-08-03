<template>
  <div class="o_action_manager">
    <div class="o_action o_view_controller">
      <div class="o_cp_controller">
        <div class="o_control_panel">
          <div>
            <ol class="breadcrumb" role="navigation">
              <li class="breadcrumb-item" accesskey="b">
                <a href="#">Products</a>
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
            <div class="o_cp_right">
              <div class="btn-group o_search_options position-static" role="search"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="o_content">
        <div class="o_form_view o_form_editable">
          <div class="o_form_sheet_bg">
            <div class="clearfix position-relative o_form_sheet">
              <div
                name="product_variant_count"
                class="o_field_widget o_stat_info o_invisible_modifier o_readonly_modifier"
              >
                <span class="o_stat_value">0</span>
                <span class="o_stat_text">Variants</span>
              </div>
              <div
                class="o_field_boolean o_field_widget custom-control custom-checkbox o_invisible_modifier o_readonly_modifier"
                name="is_product_variant"
              >
                <input type="checkbox" id="checkbox-260" class="custom-control-input" disabled />
                <label for="o_field_input_272" class="custom-control-label">&#8203;</label>
              </div>
              <div
                class="o_field_one2many o_field_widget o_field_x2many o_field_x2many_list o_invisible_modifier"
                name="attribute_line_ids"
                id="o_field_input_307"
              >
                <div class="o_cp_controller">
                  <div class="o_x2m_control_panel">
                    <nav class="o_cp_buttons" aria-label="Control panel toolbar" role="toolbar"></nav>
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
              </div>
              <div class="o_not_full oe_button_box">
                <button type="button" name="action_open_quants" class="btn oe_stat_button">
                  <i class="fa fa-fw o_button_icon fa-cubes"></i>
                  <div class="o_field_widget o_stat_info">
                    <span class="o_stat_value" widget="statinfo">
                      <div
                        name="qty_available"
                        class="o_field_widget o_stat_info o_readonly_modifier mr4"
                      >
                        <span class="o_stat_value">0.000</span>
                        <span class="o_stat_text"></span>
                      </div>
                      <span
                        class="o_field_char o_field_widget o_readonly_modifier"
                        name="uom_name"
                      >Units</span>
                    </span>
                    <span class="o_stat_text">On Hand</span>
                  </div>
                </button>
                <button
                  type="button"
                  name="action_product_tmpl_forecast_report"
                  context="{'default_product_tmpl_id': id}"
                  class="btn oe_stat_button"
                >
                  <i class="fa fa-fw o_button_icon fa-cubes"></i>
                  <div class="o_field_widget o_stat_info">
                    <span class="o_stat_value">
                      <div
                        name="virtual_available"
                        class="o_field_widget o_stat_info o_readonly_modifier mr4"
                      >
                        <span class="o_stat_value">0.000</span>
                        <span class="o_stat_text"></span>
                      </div>
                      <span
                        class="o_field_char o_field_widget o_readonly_modifier"
                        name="uom_name"
                      >Units</span>
                    </span>
                    <span class="o_stat_text">Forecasted</span>
                  </div>
                </button>
                <button
                  type="button"
                  name="action_view_stock_move_lines"
                  class="btn oe_stat_button"
                >
                  <i class="fa fa-fw o_button_icon fa-exchange"></i>
                  <span>Traceability</span>
                </button>
                <button
                  type="button"
                  class="btn oe_stat_button"
                  name="action_view_sales"
                  help="Sold in the last 365 days"
                  data-original-title
                  title
                >
                  <i class="fa fa-fw o_button_icon fa-signal"></i>
                  <div class="o_field_widget o_stat_info">
                    <span class="o_stat_value">
                      <div
                        name="sales_count"
                        class="o_field_widget o_stat_info o_readonly_modifier mr4"
                      >
                        <span class="o_stat_value">0.00</span>
                        <span class="o_stat_text"></span>
                      </div>
                      <span
                        class="o_field_char o_field_widget o_readonly_modifier"
                        name="uom_name"
                      >Units</span>
                    </span>
                    <span class="o_stat_text">Sold</span>
                  </div>
                </button>
                <button type="button" class="btn oe_stat_button" name="640">
                  <i class="fa fa-fw o_button_icon fa-flask"></i>
                  <div name="bom_count" class="o_field_widget o_stat_info o_readonly_modifier">
                    <span class="o_stat_value">0</span>
                    <span class="o_stat_text">Bill of Materials</span>
                  </div>
                </button>
                <button
                  type="button"
                  class="btn oe_stat_button"
                  name="action_view_po"
                  help="Purchased in the last 365 days"
                  data-original-title
                  title
                >
                  <i class="fa fa-fw o_button_icon fa-shopping-cart"></i>
                  <div class="o_field_widget o_stat_info">
                    <span class="o_stat_value">
                      <div
                        name="purchased_product_qty"
                        class="o_field_widget o_stat_info o_readonly_modifier mr4"
                      >
                        <span class="o_stat_value">0.00</span>
                        <span class="o_stat_text"></span>
                      </div>
                      <span
                        class="o_field_char o_field_widget o_readonly_modifier"
                        name="uom_name"
                      >Units</span>
                    </span>
                    <span class="o_stat_text">Purchased</span>
                  </div>
                </button>
              </div>
              <div class="ribbon ribbon-top-right o_invisible_modifier o_widget">
                <span class="bg-danger">Archived</span>
              </div>
              <span
                class="o_field_integer o_field_number o_field_widget o_invisible_modifier o_readonly_modifier"
                name="id"
              ></span>
              <div class="o_field_image o_field_widget oe_avatar" aria-atomic="true">
                <img
                  id="img-upload"
                  class="img img-fluid"
                  v-bind:src="'/images/icons/camera.png'"
                  border="1"
                />

                <div class="o_form_image_controls">
                  <span class="input-group-btn">
                    <span class="btn btn-default btn-file bg-primary text-white">
                      Browse…
                      <input type="file" id="imgInp" name="photo" @change="readfile"/>
                      <input type="hidden" id="filename" v-model="state.photo"/>
                    </span>
                  </span>
                </div>
              </div>
              <div class="oe_title">
                <label class="o_form_label oe_edit_only" for="o_field_input_200">Product Name</label>
                <h1>
                  <input
                    class="o_field_char o_field_widget o_input o_field_translate o_required_modifier"
                    name="name"
                    placeholder="Product Name"
                    type="text"
                    v-model="name"
                  />
                </h1>
                <div name="options">
                  <div>
                    <div
                      class="o_field_boolean o_field_widget custom-control custom-checkbox"
                      name="sale_ok"
                    >
                      <input type="checkbox" id="o_field_input_201" class="custom-control-input" v-model="state.can_be_sold"/>
                      <label for="o_field_input_201" class="custom-control-label">&#8203;</label>
                    </div>
                    <label class="o_form_label" for="o_field_input_201">Can be Sold</label>
                  </div>
                  <div>
                    <div
                      class="o_field_boolean o_field_widget custom-control custom-checkbox"
                      name="purchase_ok"
                    >
                      <input type="checkbox" id="o_field_input_202" class="custom-control-input" v-model="state.can_be_purchase"/>
                      <label for="o_field_input_202" class="custom-control-label">&#8203;</label>
                    </div>
                    <label class="o_form_label" for="o_field_input_202">Can be Purchased</label>
                  </div>
                </div>
              </div>
              <div class="o_notebook">
                <div class="o_notebook_headers">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a
                        data-toggle="tab"
                        disable_anchor="true"
                        href="#notebook_page_204"
                        class="nav-link active"
                        role="tab"
                        aria-selected="true"
                      >General Information</a>
                    </li>
                    <li class="nav-item">
                      <a
                        data-toggle="tab"
                        disable_anchor="true"
                        href="#notebook_page_240"
                        class="nav-link"
                        role="tab"
                        aria-selected="false"
                      >Inventory</a>
                    </li>
                    <li class="nav-item">
                      <a
                        data-toggle="tab"
                        disable_anchor="true"
                        href="#notebook_page_252"
                        class="nav-link"
                        role="tab"
                      >Accounting</a>
                    </li>
                  </ul>
                </div>
                <div class="tab-content">
                  <div class="tab-pane active" id="notebook_page_204">
                    <div class="o_group">
                      <div class="row">
                        <div class="col-6">
                      <table class="o_group o_inner_group ">
                        <tbody>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_required_modifier"
                                for="o_field_input_206"
                                data-original-title
                                title
                              >Product Type</label>
                            </td>
                            <td style="width: 100%;">
                              <select
                                class="o_input o_field_widget o_required_modifier"
                                name="type"
                                v-model="state.type"
                              >
                                <option
                                  v-for="row in type"
                                  :select="row.value == state.type"
                                  :key="row.value"
                                  :value="row.value"
                                >{{ row.label }}</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_required_modifier"
                                for="o_field_input_207"
                                data-original-title
                                title
                              >Product Category</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one o_with_button o_required_modifier"
                                aria-atomic="true"
                                name="categ_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_207"
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
                              <label class="o_form_label" for="o_field_input_208">Internal Reference</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_char o_field_widget o_input"
                                name="default_code"
                                placeholder
                                type="text"
                                id="o_field_input_208"
                              />
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_209"
                                data-original-title
                                title
                              >Barcode</label>
                            </td>
                            <td style="width: 100%;">
                              <input
                                class="o_field_char o_field_widget o_input"
                                name="barcode"
                                placeholder
                                type="text"
                                id="o_field_input_209"
                              />
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
                                class="o_form_label"
                                for="o_field_input_210"
                                data-original-title
                                title
                              >Sales Price</label>
                            </td>
                            <td style="width: 100%;">
                              <div name="pricing">
                                <div
                                  class="o_field_monetary o_field_number o_input o_field_widget oe_inline"
                                  name="list_price"
                                >
                                  <span>Rp</span>
                                  <input
                                    class="o_input"
                                    placeholder
                                    type="text"
                                    id="o_field_input_210"
                                  />
                                </div>
                                <span
                                  name="valuation"
                                  class="o_field_widget o_invisible_modifier o_readonly_modifier"
                                  data-original-title
                                  title
                                >Manual</span>
                                <span
                                  name="cost_method"
                                  class="o_field_widget o_invisible_modifier o_readonly_modifier"
                                  data-original-title
                                  title
                                >Standard Price</span>
                                <button
                                  type="button"
                                  name="open_pricelist_rules"
                                  class="btn oe_inline o_invisible_modifier"
                                  invisible="1"
                                >
                                  <i class="fa fa-fw o_button_icon fa-arrow-right"></i>
                                  <span
                                    class="o_field_integer o_field_number o_field_widget o_invisible_modifier o_readonly_modifier"
                                    name="pricelist_item_count"
                                  >0</span>
                                  <span
                                    attrs="{'invisible': [('pricelist_item_count', '=', 1)]}"
                                  >Extra Prices</span>
                                  <span
                                    attrs="{'invisible': [('pricelist_item_count', '!=', 1)]}"
                                    class="o_invisible_modifier"
                                  >Extra Price</span>
                                </button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_211"
                                data-original-title
                                title
                              >Customer Taxes</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_many2manytags o_input o_field_widget"
                                name="taxes_id"
                              >
                                <div
                                  class="badge badge-pill o_tag_color_0"
                                  data-color="0"
                                  data-index="0"
                                  data-id="1"
                                  title="Tag color: No color"
                                >
                                  <span class="o_badge_text" title="10%">
                                    <span role="img" aria-label="Tag color: No color"></span>10%
                                  </span>

                                  <a
                                    href="#"
                                    class="fa fa-times o_delete"
                                    title="Delete"
                                    aria-label="Delete"
                                  ></a>
                                </div>

                                <div
                                  class="o_field_widget o_field_many2one"
                                  aria-atomic="true"
                                  name="taxes_id"
                                >
                                  <div class="o_input_dropdown">
                                    <input
                                      type="text"
                                      class="o_input ui-autocomplete-input"
                                      autocomplete="off"
                                      id="o_field_input_211"
                                    />
                                    <a role="button" class="o_dropdown_button" draggable="false"></a>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_212"
                                data-original-title
                                title
                              >Cost</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                name="standard_price_uom"
                                attrs="{'invisible': [('product_variant_count', '>', 1), ('is_product_variant', '=', False)]}"
                                class="o_row"
                              >
                                <span
                                  class="o_field_monetary o_field_number o_field_widget o_readonly_modifier oe_inline"
                                  name="standard_price"
                                >0.00</span>
                                <span class="oe_read_only">
                                  per
                                  <span
                                    class="o_field_char o_field_widget o_readonly_modifier"
                                    name="uom_name"
                                  >Units</span>
                                </span>
                                <span name="update_cost_price">
                                  <button
                                    type="button"
                                    name="652"
                                    class="btn btn-link pt-0 oe_inline"
                                  >
                                    <span>Update Cost</span>
                                  </button>
                                  <button
                                    type="button"
                                    name="button_bom_cost"
                                    help="Compute the price of the product using products and operations of related bill of materials, for manufactured products only."
                                    class="btn btn-link oe_read_only pt-0 o_invisible_modifier"
                                    data-original-title
                                    title
                                  >
                                    <span>Compute Price from BoM</span>
                                  </button>
                                </span>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label class="o_form_label" for="o_field_input_213">Company</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one"
                                aria-atomic="true"
                                name="company_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_213"
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
                                class="o_form_label o_required_modifier"
                                for="o_field_input_214"
                                data-original-title
                                title
                              >Unit of Measure</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one o_with_button o_required_modifier"
                                aria-atomic="true"
                                name="uom_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_214"
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
                                for="o_field_input_215"
                                data-original-title
                                title
                              >Purchase Unit of Measure</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one o_with_button o_required_modifier"
                                aria-atomic="true"
                                name="uom_po_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_215"
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
                                class="o_form_label o_invisible_modifier o_readonly_modifier"
                                for="o_field_input_216"
                              >Currency</label>
                            </td>
                            <td style="width: 100%;">
                              <a
                                class="o_form_uri o_field_widget o_invisible_modifier o_readonly_modifier"
                                href="#id=12&amp;model=res.currency"
                                name="currency_id"
                                id="o_field_input_216"
                              >
                                <span>IDR</span>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier o_readonly_modifier"
                                for="o_field_input_217"
                              >Cost Currency</label>
                            </td>
                            <td style="width: 100%;">
                              <a
                                class="o_form_uri o_field_widget o_invisible_modifier o_readonly_modifier"
                                href="#"
                                name="cost_currency_id"
                                id="o_field_input_217"
                              >
                                <span></span>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier o_readonly_modifier"
                                for="o_field_input_218"
                              >Product</label>
                            </td>
                            <td style="width: 100%;">
                              <a
                                class="o_form_uri o_field_widget o_invisible_modifier o_readonly_modifier"
                                href="#"
                                name="product_variant_id"
                                id="o_field_input_218"
                              >
                                <span></span>
                              </a>
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
                            <div class="o_horizontal_separator">Internal Notes</div>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 50%;">
                            <textarea
                              class="o_field_text o_field_translate o_field_widget o_input"
                              name="description"
                              placeholder="This note is only for internal purposes."
                              type="text"
                              id="o_field_input_289"
                              style="overflow-y: hidden; height: 50px; resize: none;"
                            ></textarea>
                            <textarea
                              disabled
                              style="position: absolute; opacity: 0; height: 10px; border-top-width: 0px; border-bottom-width: 0px; padding: 0px; overflow: hidden; top: -10000px; left: -10000px; width: 1043px;"
                            ></textarea>
                            <span
                              class="o_field_translate btn btn-link o_field_widget o_input"
                              name="description"
                              placeholder="This note is only for internal purposes."
                              type="text"
                              id="o_field_input_289"
                            >EN</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="notebook_page_240">
                    <div class="o_group">
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Operations</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_241"
                                data-original-title
                                title
                              >Routes</label>
                            </td>
                            <td style="width: 100%;">
                              <div aria-atomic="true" name="route_ids" class="o_field_widget">
                                <div aria-atomic="true">
                                  <div>
                                    <div class="custom-control custom-checkbox">
                                      <input
                                        type="checkbox"
                                        id="o_many2many_checkbox_268"
                                        class="custom-control-input"
                                        data-record-id="1"
                                      />
                                      <label
                                        for="o_many2many_checkbox_268"
                                        class="custom-control-label o_form_label"
                                      >Replenish on Order (MTO)</label>
                                    </div>
                                  </div>
                                  <div>
                                    <div class="custom-control custom-checkbox">
                                      <input
                                        type="checkbox"
                                        id="o_many2many_checkbox_269"
                                        class="custom-control-input"
                                        data-record-id="5"
                                      />
                                      <label
                                        for="o_many2many_checkbox_269"
                                        class="custom-control-label o_form_label"
                                      >Manufacture</label>
                                    </div>
                                  </div>
                                  <div>
                                    <div class="custom-control custom-checkbox">
                                      <input
                                        type="checkbox"
                                        id="o_many2many_checkbox_270"
                                        class="custom-control-input"
                                        data-record-id="15"
                                      />
                                      <label
                                        for="o_many2many_checkbox_270"
                                        class="custom-control-label o_form_label"
                                      >Buy</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_242"
                                data-original-title
                                title
                              >Manufacturing Lead Time</label>
                            </td>
                            <td style="width: 100%;">
                              <div attrs="{'invisible':[('type','=','service')]}">
                                <input
                                  class="o_field_float o_field_number o_field_widget o_input oe_inline"
                                  name="produce_delay"
                                  placeholder
                                  type="text"
                                  id="o_field_input_242"
                                /> days
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_invisible_modifier o_readonly_modifier"
                                for="o_field_input_243"
                              >Category Routes</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_many2manytags o_field_widget o_invisible_modifier o_readonly_modifier"
                                name="route_from_categ_ids"
                              ></div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_244"
                                data-original-title
                                title
                              >Customer Lead Time</label>
                            </td>
                            <td style="width: 100%;">
                              <div attrs="{'invisible': [('sale_ok', '=', False)]}">
                                <input
                                  class="o_field_float o_field_number o_field_widget o_input oe_inline"
                                  name="sale_delay"
                                  placeholder
                                  type="text"
                                  style="vertical-align:baseline"
                                  id="o_field_input_244"
                                /> days
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Traceability</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label o_required_modifier"
                                for="o_field_input_246"
                                data-original-title
                                title
                              >Tracking</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_radio o_vertical o_field_widget o_required_modifier"
                                name="tracking"
                              >
                                <div
                                  class="custom-control custom-radio o_radio_item"
                                  aria-atomic="true"
                                >
                                  <input
                                    type="radio"
                                    class="custom-control-input o_radio_input"
                                    data-value="serial"
                                    data-index="0"
                                    id="radio245_serial"
                                  />
                                  <label
                                    class="custom-control-label o_form_label"
                                    for="radio245_serial"
                                  >By Unique Serial Number</label>
                                </div>

                                <div
                                  class="custom-control custom-radio o_radio_item"
                                  aria-atomic="true"
                                >
                                  <input
                                    type="radio"
                                    class="custom-control-input o_radio_input"
                                    data-value="lot"
                                    data-index="1"
                                    id="radio245_lot"
                                  />
                                  <label
                                    class="custom-control-label o_form_label"
                                    for="radio245_lot"
                                  >By Lots</label>
                                </div>

                                <div
                                  class="custom-control custom-radio o_radio_item"
                                  aria-atomic="true"
                                >
                                  <input
                                    type="radio"
                                    class="custom-control-input o_radio_input"
                                    checked="true"
                                    data-value="none"
                                    data-index="2"
                                    id="radio245_none"
                                  />
                                  <label
                                    class="custom-control-label o_form_label"
                                    for="radio245_none"
                                  >No Tracking</label>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="o_group o_inner_group o_invisible_modifier o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Counterpart Locations</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_247"
                                data-original-title
                                title
                              >Production Location</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one o_with_button"
                                aria-atomic="true"
                                name="property_stock_production"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_247"
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
                                for="o_field_input_248"
                                data-original-title
                                title
                              >Inventory Location</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one o_with_button"
                                aria-atomic="true"
                                name="property_stock_inventory"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_248"
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
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Logistics</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label class="o_form_label" for="o_field_input_249">Weight</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_row"
                                name="weight"
                                attrs="{'invisible':[('product_variant_count', '>', 1), ('is_product_variant', '=', False)]}"
                              >
                                <input
                                  class="o_field_float o_field_number o_field_widget o_input"
                                  name="weight"
                                  placeholder
                                  type="text"
                                  id="o_field_input_249"
                                />
                                <span>
                                  <span
                                    class="o_field_char o_field_widget o_readonly_modifier"
                                    name="weight_uom_name"
                                  >kg</span>
                                </span>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label class="o_form_label" for="o_field_input_250">Volume</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_row"
                                name="volume"
                                attrs="{'invisible':[('product_variant_count', '>', 1), ('is_product_variant', '=', False)]}"
                              >
                                <input
                                  class="o_field_float o_field_number o_field_widget o_input"
                                  name="volume"
                                  placeholder
                                  type="text"
                                  id="o_field_input_250"
                                />
                                <span>
                                  <span
                                    class="o_field_char o_field_widget o_readonly_modifier"
                                    name="volume_uom_name"
                                  >m³</span>
                                </span>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_251"
                                data-original-title
                                title
                              >Responsible</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one o_with_button"
                                aria-atomic="true"
                                name="responsible_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_251"
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
                    <table class="o_group o_inner_group o_invisible_modifier">
                      <tbody>
                        <tr>
                          <td colspan="2" style="width: 100%;">
                            <div class="o_horizontal_separator">Packaging</div>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 50%;">
                            <div
                              class="o_field_one2many o_field_widget o_field_x2many o_field_x2many_list"
                              name="packaging_ids"
                              id="o_field_input_310"
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
                                          data-name="name"
                                          tabindex="-1"
                                          class="o_column_sortable"
                                          title="Packaging"
                                        >Packaging</th>
                                        <th
                                          data-name="qty"
                                          tabindex="-1"
                                          class="o_column_sortable o_list_number_th"
                                          title="Contained Quantity"
                                        >Contained Quantity</th>
                                        <th
                                          data-name="product_uom_id"
                                          tabindex="-1"
                                          title="Unit of Measure"
                                        >Unit of Measure</th>
                                        <th
                                          data-name="company_id"
                                          tabindex="-1"
                                          class="o_column_sortable"
                                          title="Company"
                                        >Company</th>
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
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                    </tfoot>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="o_group o_inner_group">
                      <tbody>
                        <tr>
                          <td colspan="2" style="width: 100%;">
                            <div class="o_horizontal_separator">Description for Delivery Orders</div>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 50%;">
                            <textarea
                              class="o_field_text o_field_translate o_field_widget o_input"
                              name="description_pickingout"
                              placeholder="This note is added to delivery orders."
                              type="text"
                              id="o_field_input_298"
                              style="overflow-y: hidden; height: 50px; resize: none;"
                            ></textarea>
                            <textarea
                              disabled
                              style="position: absolute; opacity: 0; height: 10px; border-top-width: 0px; border-bottom-width: 0px; padding: 0px; overflow: hidden; top: -10000px; left: -10000px; width: 0px;"
                            ></textarea>
                            <span
                              class="o_field_translate btn btn-link o_field_widget o_input"
                              name="description_pickingout"
                              placeholder="This note is added to delivery orders."
                              type="text"
                              id="o_field_input_298"
                            >EN</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="o_group o_inner_group">
                      <tbody>
                        <tr>
                          <td colspan="2" style="width: 100%;">
                            <div class="o_horizontal_separator">Description for Receipts</div>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 50%;">
                            <textarea
                              class="o_field_text o_field_translate o_field_widget o_input"
                              name="description_pickingin"
                              placeholder="This note is added to receipt orders (e.g. where to store the product in the warehouse)."
                              type="text"
                              id="o_field_input_299"
                              style="overflow-y: hidden; height: 50px; resize: none;"
                            ></textarea>
                            <textarea
                              disabled
                              style="position: absolute; opacity: 0; height: 10px; border-top-width: 0px; border-bottom-width: 0px; padding: 0px; overflow: hidden; top: -10000px; left: -10000px; width: 0px;"
                            ></textarea>
                            <span
                              class="o_field_translate btn btn-link o_field_widget o_input"
                              name="description_pickingin"
                              placeholder="This note is added to receipt orders (e.g. where to store the product in the warehouse)."
                              type="text"
                              id="o_field_input_299"
                            >EN</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="o_group o_inner_group o_invisible_modifier">
                      <tbody>
                        <tr>
                          <td colspan="2" style="width: 100%;">
                            <div class="o_horizontal_separator">Description for Internal Transfers</div>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 50%;">
                            <textarea
                              class="o_field_text o_field_translate o_field_widget o_input"
                              name="description_picking"
                              placeholder="This note is added to internal transfer orders (e.g. where to pick the product in the warehouse)."
                              type="text"
                              id="o_field_input_300"
                              style="overflow-y: hidden; height: 50px; resize: none;"
                            ></textarea>
                            <textarea
                              disabled
                              style="position: absolute; opacity: 0; height: 10px; border-top-width: 0px; border-bottom-width: 0px; padding: 0px; overflow: hidden; top: -10000px; left: -10000px; width: 0px;"
                            ></textarea>
                            <span
                              class="o_field_translate btn btn-link o_field_widget o_input"
                              name="description_picking"
                              placeholder="This note is added to internal transfer orders (e.g. where to pick the product in the warehouse)."
                              type="text"
                              id="o_field_input_300"
                            >EN</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="notebook_page_252">
                    <div class="o_group">
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Receivables</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_253"
                                data-original-title
                                title
                              >Income Account</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one"
                                aria-atomic="true"
                                name="property_account_income_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_253"
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
                      <table class="o_group o_inner_group o_group_col_6">
                        <tbody>
                          <tr>
                            <td colspan="2" style="width: 100%;">
                              <div class="o_horizontal_separator">Payables</div>
                            </td>
                          </tr>
                          <tr>
                            <td class="o_td_label">
                              <label
                                class="o_form_label"
                                for="o_field_input_254"
                                data-original-title
                                title
                              >Expense Account</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one"
                                aria-atomic="true"
                                name="property_account_expense_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_254"
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
                              <label class="o_form_label" for="o_field_input_255">Asset Type</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one"
                                aria-atomic="true"
                                name="asset_category_id"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_255"
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
                                for="o_field_input_256"
                                data-original-title
                                title
                              >Price Difference Account</label>
                            </td>
                            <td style="width: 100%;">
                              <div
                                class="o_field_widget o_field_many2one"
                                aria-atomic="true"
                                name="property_account_creditor_price_difference"
                              >
                                <div class="o_input_dropdown">
                                  <input
                                    type="text"
                                    class="o_input ui-autocomplete-input"
                                    autocomplete="off"
                                    id="o_field_input_256"
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
                    <table class="o_group o_inner_group">
                      <tbody>
                        <tr></tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <aside class="o_chatter oe_chatter">
            <div class="o_chatter_topbar">
              <button
                type="button"
                class="btn btn-link o_chatter_button_new_message"
                title="Send a message"
                disabled
              >Send message</button>
              <button
                class="btn btn-link o_chatter_button_log_note"
                title="Log a note. Followers will not be notified."
                disabled
              >Log note</button>
              <button
                class="btn btn-link o_chatter_button_schedule_activity"
                title="Log or schedule an activity"
                disabled
              >
                <i class="fa fa-clock-o" title="Dates"></i> Schedule activity
              </button>

              <div class="o_topbar_right_area">
                <div class="o_followers btn-group o_field_widget" name="message_follower_ids">
                  <div class="o_followers_title_box btn-group">
                    <button
                      class="btn btn-link"
                      title="No follower"
                      data-toggle="dropdown"
                      aria-expanded="false"
                      disabled
                    >
                      <i class="fa fa-user" role="img" aria-label="Followers"></i>
                      <span class="o_followers_count">0</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right o_followers_list" role="menu">
                      <a href="#" role="menuitem" class="dropdown-item o_add_follower">Add Followers</a>
                      <a
                        href="#"
                        role="menuitem"
                        class="dropdown-item o_add_follower_channel"
                      >Add Channels</a>
                    </div>
                  </div>
                  <div class="o_followers_actions btn-group">
                    <button
                      class="btn btn-link o_followers_follow_button o_followers_notfollow"
                      disabled
                    >
                      <span class="o_follow">Follow</span>
                      <i class="fa fa-times o_followers_unfollow"></i>
                      <span class="o_followers_unfollow">Unfollow</span>
                      <i class="fa fa-check o_followers_following"></i>
                      <span class="o_followers_following">Following</span>
                    </button>
                  </div>
                </div>
                <button
                  class="btn btn-link o_chatter_button_attachment"
                  title="View all the attachments of the current record"
                  aria-label="Attachments 0"
                  disabled
                >
                  <span>
                    <i class="fa fa-paperclip"></i>
                    <span class="o_chatter_attachment_button_count">0</span>
                  </span>
                </button>
              </div>
            </div>
            <div class="o_mail_activity o_field_widget" name="activity_ids"></div>
            <div class="o_mail_thread">
              <div class="o_mail_thread_content">
                <div class="o_thread_date_separator">
                  <span class="o_thread_date">Today</span>
                </div>

                <div class="o_thread_message o_mail_not_discussion" data-message-id="0">
                  <div class="o_thread_message_sidebar">
                    <div class="o_thread_message_sidebar_image">
                      <img
                        alt
                        src="/web/image/res.partner/3/image_128"
                        data-oe-model="res.partner"
                        data-oe-id
                        class="o_thread_message_avatar rounded-circle"
                      />

                      <span class="o_updatable_im_status" data-partner-id="3"></span>
                    </div>
                  </div>
                  <div class="o_thread_message_core">
                    <p class="o_mail_info text-muted">
                      <strong
                        data-oe-model="res.partner"
                        data-oe-id
                        class="o_thread_author"
                      >YourCompany, Mitchell Admin</strong>
                      -
                      <small
                        class="o_mail_timestamp"
                        title="08/03/2020 20:07:31"
                      >2 minutes ago</small>

                      <span class="o_thread_icons"></span>
                    </p>
                    <div class="o_thread_message_content">
                      <p>Creating a new record...</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      state: {
        photo: "",
        name:"",
        can_be_sold: "",
        can_be_purchase:"",
        type:"consum",
      },
      type:[
        { label:"Consumable", value:"consum"},
        { label:"Service", value:"service"},
        { label:"Storable Product", value:"product"}
      ],
    };
  },
  methods: {
    readfile(e) {
      var filename = document.getElementById("filename").value;
      this.state.photo=filename;
    },
  },
};
</script>