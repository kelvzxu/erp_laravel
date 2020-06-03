<div class="row">
    <div class="col-sm-4 mt-4">
        <div class="wrap-input200">
            <label>Bills No.</label>
            <input type="text" class="input200" v-model="form.purchase_no" readonly>
            <p v-if="errors.purchase_no" class="error">@{{errors.purchase_no[0]}}</p>
        </div>
        <div class="wrap-input200">
            <label>Client</label>
            <input type="text" id="client" class="input200" readonly>
            <input type="hidden" id="client_id" class="input200" v-model="form.client">
            <p v-if="errors.client" class="error">@{{errors.client[0]}}</p>
        </div>
    </div>
    <div class="col-sm-4 mt-4">
        <div class="wrap-input200">
            <label>Client Address</label>
            <textarea class="input200" v-model="form.client_address"></textarea>
            <p v-if="errors.client_address" class="error">@{{errors.client_address[0]}}</p>
        </div>
    </div>
    <div class="col-sm-4 mt-4">
        <div class="wrap-input200">
            <label>Title</label>
            <input type="text" class="input200" v-model="form.title">
            <p v-if="errors.title" class="error">@{{errors.title[0]}}</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label>Bills Date</label>
                <input type="text" class="input200" v-model="form.purchase_date" readonly>
                <p v-if="errors.purchase_date" class="error">@{{errors.purchase_date[0]}}</p>
            </div>
            <div class="col-sm-6">
                <label>Due Date</label>
                <input type="text" class="input200" v-model="form.due_date" readonly>
                <p v-if="errors.due_date" class="error">@{{errors.due_date[0]}}</p>
            </div>
        </div>
    </div>
</div>
<hr>
<div v-if="errors.products_empty">
    <p class="alert alert-danger">@{{errors.products_empty[0]}}</p>
    <hr>
</div>
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
            <td class="table-empty" colspan="2" style="border:none;"></td>
            <td class="table-label">Sub Total</td>
            <td class="table-amount">@{{subTotal}}</td>
        </tr>
        <tr>
            <td class="table-empty" colspan="2" style="border:none;"></td>
            <td class="table-label">Discount</td>
            <td class="table-discount" :class="{'table-error': errors.discount}">
                <input type="text"style="border:none"  class="form-control table-discount_input" v-model="form.discount">
            </td>
        </tr>
        <tr>
            <td class="table-empty" colspan="2" style="border:none;"></td>
            <td class="table-label">Grand Total</td>
            <td class="table-amount">@{{grandTotal}}</td>
        </tr>
    </tfoot>
</table>