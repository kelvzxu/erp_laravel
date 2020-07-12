<div class="oe_title"> 
    <span class="o_form_label">
        Invoice
        <input type="hidden" class="input200 bg-white" readonly style="border:none" v-model="form.invoice_no">
    </span>
    <h1><span class="o_field_char o_field_widget o_readonly_modifier o_required_modifier" name="name">{{$invoice->invoice_no}}</span></h1>
</div>
<div class="o_group">
    <div class="row">
        <div class="col-12 col-md-6">
            <table class="o_group o_inner_group">
                <tbody>
                    <tr>
                        <td class="o_td_label">
                            <label class="o_form_label o_required_modifier">Customer</label>
                        </td>
                        <td>
                            <div class="wrap-input200">
                                <input type="text" id="client" class="input200" readonly>
                                <input type="hidden" id="client_id" class="form-control" v-model="form.client">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="o_td_label">
                            <label class="o_form_label">Address</label>
                        </td>
                        <td>
                            <div class="wrap-input200">
                                <textarea id="address" class="input200" v-model="form.client_address" require></textarea>
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
                                data-original-title="" title="">Invoice Date</label></td>
                        <td>
                            <div class="wrap-input200">
                                <input type="text" class="input200" v-model="form.invoice_date" value="<?php echo date("Y-m-d");?>"require>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="o_td_label"><label class="o_form_label o_readonly_modifier"
                                for="o_field_input_20">Due Date</label></td>
                        <td>
                            <div class="wrap-input200">
                                <input type="date" class="input200" v-model="form.due_date" require>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="o_td_label"><label class="o_form_label o_readonly_modifier"
                                for="o_field_input_20">Source Document</label></td>
                        <td>
                            <div class="wrap-input200">
                                <input type="text" class="input200" v-model="form.title" require>
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
                    <th>Product Name</th>
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
                    <td class="table-remove">
                        <span @click="remove(product)" class="table-remove-btn"><i class="fa fa-trash"></i></span>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td class="table-empty" colspan="2">
                        <span @click="addLine" class="table-add_line">Add Line</span>
                    </td>
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