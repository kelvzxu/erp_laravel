<div class="oe_title">
    <span class="o_form_label">Request for Quotation</span>
    <h1><span class="o_field_char o_field_widget o_readonly_modifier o_required_modifier" name="name">{{$orders->order_no}}</span></h1>
</div>
<div class="o_group">
    <div class="row">
        <div class="col-12 col-md-6">
            <table class="o_group o_inner_group">
                <tbody>
                    <tr>
                        <td class="o_td_label">
                            <label class="o_form_label o_required_modifier">Vendor</label>
                        </td>
                        <td>
                            <div class="wrap-input200">
                                <input type="hidden" id="order_no" class="input200" v-model="form.order_no">
                                <input type="text" id="client" class="input200" readonly>
                                <input type="hidden" id="client_id" class="input200" v-model="form.vendor">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="o_td_label">
                            <label class="o_form_label">Vendor Reference</label>
                        </td>
                        <td>
                            <div class="wrap-input200">
                                <input class="input200" type="text" v-model="form.vendor_reference">
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
                        <td class="o_td_label"><label class="o_form_label o_required_modifier" for="o_field_input_19"
                                data-original-title="" title="">Order Date</label></td>
                        <td>
                            <div class="wrap-input200">
                                <input type="text" class="input200" v-model="form.order_date" readonly  value="<?php echo date("Y-m-d");?>"require>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="o_td_label"><label class="o_form_label o_invisible_modifier o_readonly_modifier"
                                for="o_field_input_20">Confirmation Date</label></td>
                        <td style="width: 100%;"><span
                                class="o_field_date o_field_widget o_invisible_modifier o_readonly_modifier"
                                name="date_approve"></span></td>
                    </tr>
                    <tr>
                        <td class="o_td_label"><label class="o_form_label o_invisible_modifier" for="o_field_input_21"
                                data-original-title="" title="">Source Document</label></td>
                        <td style="width: 100%;"><input class="o_field_char o_field_widget o_input o_invisible_modifier"
                                name="origin" placeholder="" type="text" id="o_field_input_21"></td>
                    </tr>
                    <tr>
                        <td class="o_td_label"><label class="o_form_label o_invisible_modifier o_required_modifier"
                                for="o_field_input_22">Company</label></td>
                        <td style="width: 100%;">
                            <div class="o_field_widget o_field_many2one o_with_button o_invisible_modifier o_required_modifier"
                                aria-atomic="true" name="company_id">
                                <div class="o_input_dropdown">
                                    <input type="text" class="o_input ui-autocomplete-input" autocomplete="off"
                                        id="o_field_input_22">
                                    <a role="button" class="o_dropdown_button" draggable="false"></a>
                                </div>
                                <button type="button" class="fa fa-external-link btn btn-secondary o_external_button"
                                    tabindex="-1" draggable="false" aria-label="External link" title="External link"></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<hr>
<div class="o_list_view o_list_optional_columns">
    <div class="table-responsive">
        <table class="table table-bordered table-form">
            <thead>
                <tr>
                    <th>Product ffName</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="data in form.products">
                    <td class="table-name" :class="{'table-error': errors['products.' + $index + '.name']}">
                        <input type="hidden" class="form-control" v-model="data.name" readonly>
                        <input type="text" style="border:none" class="form-control bg-white" v-model="data.product.name" readonly>
                    </td>
                    <td class="table-price" :class="{'table-error': errors['products.' + $index + '.price']}">
                        <input type="text" style="border:none" class="form-control"  v-model="data.price">
                    </td>
                    <td class="table-qty" :class="{'table-error': errors['products.' + $index + '.qty']}">
                        <input type="text" style="border:none"  class="form-control" v-model="data.qty">
                    </td>
                    <td class="table-total">
                        <span class="table-text">@{{data.qty * data.price}}</span>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td class="table-empty" colspan="2" style="border:none;"></td>
                    <td class="table-label">Sub Total</td>
                    <td class="table-amount">@{{subTotal}}</td>
                </tr>
                <tr>
                    <td class="table-empty" colspan="2" style="border:none;"></td>
                    <td class="table-label">Discount</td>
                    <td class="table-discount" :class="{'table-error': errors.discount}">
                        <input type="text" class="table-discount_input" v-model="form.discount">
                    </td>
                </tr>
                <tr>
                    <td class="table-empty" colspan="2" style="border:none;"></td>
                    <td class="table-label">Grand Total</td>
                    <td class="table-amount">@{{grandTotal}}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>