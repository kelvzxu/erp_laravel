<div class="row">
    <div class="col-sm-4 mt-4">
        <div class="wrap-input200">
            <label>Purchase No.</label>
            <input type="hidden" class="input200" name="receipt_no" value="{{$receipt->receipt_no}}" readonly>
            <input type="text" class="input200" name="purchase_no" value="{{ $purchase->purchase_no }}" readonly>
        </div>
        <div class="wrap-input200">
            <label>Client</label>
            <input type="text" id="client" class="input200" value="{{ $purchase->vendor->partner_name }}"readonly>
            <input type="hidden" id="client_id" class="form-control"  value="{{ $purchase->client }}"  name="client" readonly>
        </div>
    </div>
    <div class="col-sm-4 mt-4">
        <div class="wrap-input200">
            <label>Client Address</label>
            <input type="text" class="input200" name="client_address" value="{{ $purchase->vendor->street }} {{ $purchase->vendor->city }}" readonly></input>
        </div>
    </div>
    <div class="col-sm-4 mt-4">
        <div class="wrap-input200">
            <label>Title</label>
            <input type="text" class="input200" name="title" value="{{ $purchase->title }}"  name="title" readonly>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label>Purchase Date</label>
                <input type="text" class="input200" name="purchase_date" value="{{ $purchase->purchase_date }}"readonly>
            </div>
            <div class="col-sm-6">
                <label>Due Date</label>
                <input type="text" class="input200" name="due_date" value="{{ $purchase->due_date }}"readonly>
            </div>
        </div>
    </div>
</div>
<div v-if="errors.products_empty">
    <hr>
</div>
<table class="table table-bordered table-form">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Buy Qty</th>
            <th>Retur Qty</th>
        </tr>
    </thead>
    <tbody>
    @foreach($purchase->products as $data)
        <tr>
            <td class="table-name">
                <input type="hidden" class="form-control" name="product[]" value="{{$data->name}}" readonly>
                <input type="text" style="border:none" class="form-control bg-white" value="{{$data->product->name}}" name="product_name[]" readonly>
            </td>
            <td class="table-price">
                <input type="text" style="border:none" class="form-control bg-white" value="Rp. {{ number_format($data->price)}}" readonly>
                <input type="hidden" style="border:none" class="form-control" value="{{$data->price}}" name="price[]" >
            </td>
            <td class="table-qty">
                <input type="text" style="border:none"  class="form-control bg-white" value="{{$data->qty}}" name="buy_qty[]" readonly>
            </td>
            <td class="table-qty">
                <input type="number" style="border:none"  class="form-control" value="0" name="return_qty[]">
            </td>
        </tr>
    @endforeach
    </tbody>
</table>