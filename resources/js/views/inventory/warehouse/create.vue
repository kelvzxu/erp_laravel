<template>
    <div class="o_action_manager">
        <div class="o_action o_view_controller">
            <div class="o_cp_controller">
                <div class="o_control_panel">
                    <div>
                        <ol class="breadcrumb" role="navigation">
                            <router-link class="text-primary" :to="{ name:'warehouse_index' }">Warehouses</li>
                            <li class="breadcrumb-item active">New</li>
                        </ol>
                        <div class="o_cp_searchview" role="search"></div>
                    </div>
                    <div>
                        <div class="o_cp_left">
                            <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                                <div>
                                    <div class="o_form_buttons_edit" role="toolbar" aria-label="Main actions"
                                        data-original-title="" title="">
                                        <button
                                            type="submit"
                                            class="btn btn-primary o_form_button_save"
                                            accesskey="s"
                                        >Save</button>
                                        <router-link
                                            type="button"
                                            class="btn btn-secondary o_form_button_cancel"
                                            :to="{ name:'uom_index' }"
                                        >Discard</router-link>
                                    </div>
                                </div>
                            </div>
                            <aside class="o_cp_sidebar">
                            </aside>
                        </div>
                        <div class="o_cp_right">
                            <div class="btn-group o_search_options position-static" role="search"></div>
                            <nav class="o_cp_pager" role="search" aria-label="Pager">
                            </nav>
                            <nav class="btn-group o_cp_switch_buttons" role="toolbar" aria-label="View switcher"></nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="o_content">
                <div class="o_form_view o_form_editable">
                    <div class="o_form_sheet_bg">
                        <div class="clearfix position-relative o_form_sheet">
                            <div class="o_not_full oe_button_box">
                            </div>
                            <div class="ribbon ribbon-top-right o_invisible_modifier o_widget">
                                <span class="bg-danger">Archived</span>
                            </div>
                            <label class="o_form_label oe_edit_only" for="o_field_input_657" data-original-title=""
                                title="">Warehouse</label>
                            <h1><input class="o_field_char o_field_widget o_input o_required_modifier" v-model="state.name"></h1>
                            <div class="o_group">
                                <table class="o_group o_inner_group o_group_col_6">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label o_required_modifier">Short Name</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <input class="o_field_char o_field_widget o_input o_required_modifier"
                                                    v-model="state.code">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="o_group o_inner_group o_group_col_6">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label">
                                                <label
                                                    class="o_form_label o_readonly_modifier o_required_modifier">Company</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <select class="o_input o_field_widget" name="type"
                                                    v-model="state.company_id">
                                                    <option v-for="row in company" :select="row.id == state.company_id"
                                                        :key="row.id" :value="row.id">{{ row.company_name }}</option>
                                                    <button type="button"
                                                        class="fa fa-external-link btn btn-secondary o_external_button"
                                                        tabindex="-1" draggable="false" aria-label="External link"
                                                        title="External link"></button>
                                                </select>
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
</template>