<template>
  <form @submit.prevent="submit" method="post">
    <div class="o_action_manager">
      <div class="o_action o_view_controller">
        <div class="o_cp_controller">
          <div class="o_control_panel">
            <div>
              <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b">
                  <router-link class="text-primary" :to="{ name:'product_index' }">Products</router-link>
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
                        type="submit"
                        class="btn btn-primary text-white o_form_button_save"
                        accesskey="s"
                      >Save</button>
                      <router-link
                        type="button"
                        class="btn btn-secondary o_form_button_cancel"
                        :to="{ name:'product_index' }"
                      >Discard</router-link>
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
                    id="picture"
                    class="img img-fluid"
                    v-bind:src="'/images/icons/camera.png'"
                    border="1"
                  />

                  <div class="o_form_image_controls">
                    <span class="input-group-btn">
                      <span class="btn btn-default btn-file bg-primary text-white">
                        Browse…
                        <input
                          type="file"
                          id="imgInp"
                          ref="file"
                          name="photo"
                          v-on:change="handleFileUpload()"
                        />
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
                      v-model="state.name"
                    />
                  </h1>
                  <div name="options">
                    <div>
                      <div
                        class="o_field_boolean o_field_widget custom-control custom-checkbox"
                        name="sale_ok"
                      >
                        <input
                          type="checkbox"
                          id="o_field_input_201"
                          class="custom-control-input"
                          v-model="state.can_be_sold"
                        />
                        <label for="o_field_input_201" class="custom-control-label">&#8203;</label>
                      </div>
                      <label class="o_form_label" for="o_field_input_201">Can be Sold</label>
                    </div>
                    <div>
                      <div
                        class="o_field_boolean o_field_widget custom-control custom-checkbox"
                        name="purchase_ok"
                      >
                        <input
                          type="checkbox"
                          id="o_field_input_202"
                          class="custom-control-input"
                          v-model="state.can_be_purchase"
                        />
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
                          v-if="accounts == true"
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
                            <table class="o_group o_inner_group">
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
                                    <select
                                      class="o_input o_field_widget o_required_modifier"
                                      name="type"
                                      v-model="state.category_id"
                                    >
                                      <option
                                        v-for="row in category"
                                        :select="row.value == state.category_id"
                                        :key="row.id"
                                        :value="row.id"
                                      >{{ row.name }}</option>
                                      <button
                                        type="button"
                                        class="fa fa-external-link btn btn-secondary o_external_button"
                                        tabindex="-1"
                                        draggable="false"
                                        aria-label="External link"
                                        title="External link"
                                      ></button>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="o_td_label">
                                    <label
                                      class="o_form_label"
                                      for="o_field_input_208"
                                    >Internal Reference</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <input
                                      class="o_field_char o_field_widget o_input"
                                      name="default_code"
                                      placeholder
                                      type="text"
                                      v-model="state.code"
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
                                      v-model="state.barcode"
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
                                        <span>Rp&nbsp;</span>
                                        <input
                                          class="o_input"
                                          placeholder
                                          type="text"
                                          v-model="state.price"
                                        />
                                      </div>
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
                                    <input
                                      type="text"
                                      class="o_field_char o_field_widget o_input"
                                      autocomplete="off"
                                      v-model="state.tax_id"
                                    />
                                  </td>
                                </tr>
                                <tr>
                                  <td class="o_td_label">
                                    <label
                                      class="o_form_label"
                                      for="o_field_input_210"
                                      data-original-title
                                      title
                                    >Cost</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <div name="pricing">
                                      <div
                                        class="o_field_monetary o_field_number o_input o_field_widget oe_inline"
                                        name="list_price"
                                      >
                                        <span>Rp&nbsp;</span>
                                        <input
                                          class="o_input"
                                          placeholder
                                          type="text"
                                          v-model="state.cost"
                                        />
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="o_td_label">
                                    <label class="o_form_label" for="o_field_input_213">Company</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <select
                                      class="o_input o_field_widget"
                                      name="type"
                                      v-model="state.company_id"
                                    >
                                      <option
                                        v-for="row in company"
                                        :select="row.id == state.company_id"
                                        :key="row.id"
                                        :value="row.id"
                                      >{{ row.company_name }}</option>
                                      <button
                                        type="button"
                                        class="fa fa-external-link btn btn-secondary o_external_button"
                                        tabindex="-1"
                                        draggable="false"
                                        aria-label="External link"
                                        title="External link"
                                      ></button>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="o_td_label">
                                    <label
                                      class="o_form_label o_required_modifier"
                                    >Unit of Measure</label>
                                  </td>
                                  <td style="width: 100%;">
                                    <select
                                      class="o_input o_field_widget o_required_modifier"
                                      @change="onChangeUom(state)"
                                      v-model="state.uom_id"
                                    >
                                      <option
                                        v-for="row in uom"
                                        :select="row.id == state.uom_id"
                                        :key="row.id"
                                        :value="row.id"
                                      >{{ row.name }}</option>
                                      <button
                                        type="button"
                                        class="fa fa-external-link btn btn-secondary o_external_button"
                                      ></button>
                                    </select>
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
                                    <select
                                      class="o_input o_field_widget o_required_modifier"
                                      @change="onChangeUomPo(state)"
                                      name="type"
                                      v-model="state.uom_po_id"
                                    >
                                      <option
                                        v-for="row in uom"
                                        :select="row.id == state.uom_po_id"
                                        :key="row.id"
                                        :value="row.id"
                                      >{{ row.name }}</option>
                                      <button
                                        type="button"
                                        class="fa fa-external-link btn btn-secondary o_external_button"
                                        tabindex="-1"
                                        draggable="false"
                                        aria-label="External link"
                                        title="External link"
                                      ></button>
                                    </select>
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
                                v-model="state.description"
                                style="overflow-y: hidden; height: 50px; resize: none;"
                              ></textarea>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="notebook_page_240">
                      <div class="o_group">
                        <div class="row">
                          <div class="col-6">
                            <table class="o_group o_inner_group">
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
                                        v-model="state.weight"
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
                                        v-model="state.volume"
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
                                  <td class="o_td_label o_invisible_modifier">
                                    <label
                                      class="o_form_label"
                                      for="o_field_input_251"
                                      data-original-title
                                      title
                                    >Responsible</label>
                                  </td>
                                  <td class="o_invisible_modifier" style="width: 100%;">
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
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <table class="o_group o_inner_group o_invisible_modifier o_group_col_6">
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
                      </div>
                    </div>
                    <div v-if="accounts == true" class="tab-pane" id="notebook_page_252">
                      <div class="o_group">
                        <table class="o_group o_inner_group o_group_col_6">
                          <tbody>
                            <tr>
                              <td colspan="2" style="width: 100%;">
                                <div class="o_horizontal_separator">Account Properties</div>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label"
                                  for="o_field_input_585"
                                  data-original-title
                                  title
                                >Income Account</label>
                              </td>
                              <td style="width: 100%;">
                                <div
                                  class="o_field_widget o_field_many2one o_with_button"
                                  aria-atomic="true"
                                  name="property_account_income_categ_id"
                                >
                                  <div class="o_input_dropdown">
                                    <input
                                      type="text"
                                      class="o_input ui-autocomplete-input"
                                      autocomplete="off"
                                      id="o_field_input_585"
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
                                  for="o_field_input_586"
                                  data-original-title
                                  title
                                >Expense Account</label>
                              </td>
                              <td style="width: 100%;">
                                <div
                                  class="o_field_widget o_field_many2one o_with_button"
                                  aria-atomic="true"
                                  name="property_account_expense_categ_id"
                                >
                                  <div class="o_input_dropdown">
                                    <input
                                      type="text"
                                      class="o_input ui-autocomplete-input"
                                      autocomplete="off"
                                      id="o_field_input_586"
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
                                <div class="o_horizontal_separator">Account Stock Properties</div>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label"
                                  for="o_field_input_587"
                                  data-original-title
                                  title
                                >Stock Input Account</label>
                              </td>
                              <td style="width: 100%;">
                                <div
                                  class="o_field_widget o_field_many2one o_with_button"
                                  aria-atomic="true"
                                  name="property_stock_account_input_categ_id"
                                >
                                  <div class="o_input_dropdown">
                                    <input
                                      type="text"
                                      class="o_input ui-autocomplete-input"
                                      autocomplete="off"
                                      id="o_field_input_587"
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
                                  for="o_field_input_588"
                                  data-original-title
                                  title
                                >Stock Output Account</label>
                              </td>
                              <td style="width: 100%;">
                                <div
                                  class="o_field_widget o_field_many2one o_with_button"
                                  aria-atomic="true"
                                  name="property_stock_account_output_categ_id"
                                >
                                  <div class="o_input_dropdown">
                                    <input
                                      type="text"
                                      class="o_input ui-autocomplete-input"
                                    />
                                    <a role="button" class="o_dropdown_button" draggable="false"></a>
                                  </div>
                                  <button
                                    type="button"
                                    class="fa fa-external-link btn btn-secondary o_external_button"
                                  ></button>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label"
                                  for="o_field_input_589"
                                  data-original-title
                                  title
                                >Stock Valuation Account</label>
                              </td>
                              <td style="width: 100%;">
                                <div
                                  class="o_field_widget o_field_many2one o_with_button"
                                  aria-atomic="true"
                                  name="property_stock_valuation_account_id"
                                >
                                  <div class="o_input_dropdown">
                                    <input
                                      type="text"
                                      class="o_input ui-autocomplete-input"
                                      autocomplete="off"
                                      id="o_field_input_589"
                                    />
                                    <a role="button" class="o_dropdown_button" draggable="false"></a>
                                  </div>
                                  <button
                                    type="button"
                                    class="fa fa-external-link btn btn-secondary o_external_button"
                                  ></button>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td class="o_td_label">
                                <label
                                  class="o_form_label"
                                >Stock Journal</label>
                              </td>
                              <td style="width: 100%;">
                                <div
                                  class="o_field_widget o_field_many2one o_with_button"
                                  aria-atomic="true"
                                  name="property_stock_journal"
                                >
                                  <div class="o_input_dropdown">
                                    <input
                                      type="text"
                                      class="o_input ui-autocomplete-input"
                                    />
                                    <a role="button" class="o_dropdown_button" draggable="false"></a>
                                  </div>
                                  <button
                                    type="button"
                                    class="fa fa-external-link btn btn-secondary o_external_button"
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
                        <a
                          href="#"
                          role="menuitem"
                          class="dropdown-item o_add_follower"
                        >Add Followers</a>
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
  </form>
</template>
<script>
export default {
  data() {
    return {
      state: {
        photo: "",
        name: "",
        can_be_sold: false,
        can_be_purchase: false,
        type: "consum",
        category_id: 1,
        code: "",
        company_id: "",
        barcode: "",
        price: "0",
        tax_id: "0",
        cost: "0",
        uom_id: "1",
        uom_po_id: "1",
        uom_category: "1",
        description: "",
        create_uid: "",
        volume: "0",
        weight: "0",
      },
      type: [
        { label: "Consumable", value: "consum" },
        { label: "Service", value: "service" },
        { label: "Storable Product", value: "product" },
      ],
      category: [],
      uom: [],
      company: [],
      accounts: false,
    };
  },
  mounted() {
    this.fetchCategory();
    this.fetchUom();
    this.fetchCompany();
    this.fetchUserId();
    this.CheckAccounting();
  },
  methods: {
    // Prepare Product relation Component
    fetchUserId() {
      this.user = document.getElementById("current_email").value;
      const url = "/api/user/" + this.user;
      axios
        .get(url)
        .then((response) => {
          this.user = response.data.result;
          this.state.create_uid = this.user.id;
        })
        .catch((error) => console.error(error));
    },
    fetchCategory() {
      axios
        .get("/api/Products/category")
        .then((response) => {
          this.category = response.data.result;
        })
        .catch((error) => console.error(error));
    },
    fetchUom() {
      axios
        .get("/api/uom/list")
        .then((response) => {
          this.uom = response.data.data;
        })
        .catch((error) => console.error(error));
    },
    fetchCompany() {
      axios
        .get("/api/company")
        .then((response) => {
          this.company = response.data.data;
        })
        .catch((error) => console.error(error));
    },
    onChangeUom(self) {
      axios
        .get(`/api/uom/get_uom/${self.uom_id}`)
        .then((response) => {
          this.result = response.data.result;
          self.uom_category = this.result.category_id;
          self.uom_po_id = self.uom_id;
        })
        .catch((error) => console.error(error));
    },
    onChangeUomPo(self) {
      this.search_uom(self);
    },
    search_uom(self){
      axios
        .get(`/api/uom/get_uom/${self.uom_po_id}`)
        .then((response) => {
          this.result = response.data.result;
          if (this.result.category_id != self.uom_category) {
            self.uom_po_id = self.uom_id;
            Swal.fire({
              type: "warning",
              title: "Something went wrong!",
              text:
                "The default Unit of Measure and the purchase Unit of Measure must be in the same category.",
            });
          }
        })
        .catch((error) => console.error(error));
    },
    // validate Addons
    CheckAccounting() {
      axios
        .get("/api/Addons/Check/Accounting")
        .then((response) => {
          this.accounts = response.data.result;
        })
        .catch((error) => console.error(error));
    },
    // handle Upload File
    handleFileUpload() {
      this.createImage(this.$refs.file.files[0]);
    },
    createImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = (e) => {
        vm.state.photo = e.target.result;
        this.set_image(vm.state.photo);
      };
      reader.readAsDataURL(file);
    },
    set_image(file) {
      document.getElementById("picture").src = file;
    },
    store_quant(){
      axios.post("/api/Products/quant/store",this.state).then((response)=>{
        if (response.data.status == "success") {
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$router.push({ name: "product_index" });
        } else {
          Swal.fire({
            type: "warning",
            title: "Something went wrong!",
            text: response.data.message,
          });
        }
      })
    },
    submit($e) {
      axios
        .post("/api/Product/store", this.state)
        .then((response) => {
          if (this.state.type == 'product')
            this.store_quant();
          else {
            if (response.data.status == "success") {
              Toast.fire({
                icon: "success",
                title: response.data.message,
              });
              this.$router.push({ name: "product_index" });
            } else {
              Swal.fire({
                type: "warning",
                title: "Something went wrong!",
                text: response.data.message,
              });
            }
          }

        })
        .catch((error) => {
          if (error) {
            if (error.response.status == 422) {
              var error = error.response.data.errors;
              error = error[Object.keys(error)[0]];
              Swal.fire({
                type: "warning",
                title: "Something went wrong!",
                text: error[0],
              });
            }
          }
        });
    },
  },
};
</script>