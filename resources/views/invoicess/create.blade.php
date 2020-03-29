@extends('layouts.admin')
@section('title','SK - New Invoice')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12">
                    <h3>Create New Invoice</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <a href="" class="btn btn-primary">Save</a>
                    <a href="" class="btn btn-primary">Print</a>
                </div>
            </div>
            <div class="container bg-white my-3 rounded">
                <div class="content">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center my-3">
                                <h3 class="font-weight-bold"><u>INVOICE</u></h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mb-1">
                                <label class="col-3 col-form-label">No. Invoice</label>
                                <label class="col-1 col-form-label">:</label>
                                <div class="col-8">
                                    <input type="text" name="invoice_id" id="invoice_id" class="form-control @error('invoice_id') is-invalid @enderror" value="{{ old('invoice_id') }}"  autocomplete="invoice_id" autofocus>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-3 col-form-label">Customer</label>
                                <label class="col-1 col-form-label">:</label>
                                <div class="col-8">
                                    <select name="customer" id="customer" class="form-control">
                                        <option value="">Select customer</option>
                                        @foreach ($customer as $row)
                                            <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-3 col-form-label">Address</label>
                                <label class="col-1 col-form-label">:</label>
                                <div class="col-8">
                                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"  autocomplete="address" autofocus>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-3 col-form-label">reference</label>
                                <label class="col-1 col-form-label">:</label>
                                <div class="col-8">
                                    <input type="text" name="reference" id="reference" class="form-control @error('reference') is-invalid @enderror" value="{{ old('reference') }}"  autocomplete="reference" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="row mb-1">
                                <label class="col-3 col-form-label">Invoice date</label>
                                <label class="col-1 col-form-label">:</label>
                                <div class="col-8">
                                    <input type="text" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}"  autocomplete="date" autofocus readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-3 col-form-label">Payment Term</label>
                                <label class="col-1 col-form-label">:</label>
                                <div class="col-8">
                                    <input type="text" name="payment_term" id="payment_term" class="form-control @error('payment_term') is-invalid @enderror" value="{{ old('payment_term') }}"  autocomplete="reference" autofocus>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-3 col-form-label">Phone</label>
                                <label class="col-1 col-form-label">:</label>
                                <div class="col-8">
                                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"  autocomplete="reference" autofocus>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-3 col-form-label">email</label>
                                <label class="col-1 col-form-label">:</label>
                                <div class="col-8">
                                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"  autocomplete="reference" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <form action="" method="post">
                            @csrf
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Produk</td>
                                        <td>Qty</td>
                                        <td>Harga</td>
                                        <td>Subtotal</td>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <!-- MENAMPILKAN PRODUK YANG TELAH DITAMBAHKAN -->
                                <tbody>
                                    @php $no = 1 @endphp
                                    <!-- @foreach ($invoice->detail as $detail) -->
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>{{ $detail->qty }}</td>
                                        <td>Rp {{ number_format($detail->price) }}</td>
                                        <td>Rp {{ $detail->subtotal }}</td>
                                        <td>
                                            <form action="{{ route('invoice.delete_product', ['id' => $detail->id]) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE" class="form-control">
                                                <button class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- @endforeach -->
                                </tbody>
                                    
                                <!-- MENAMPILKAN PRODUK YANG TELAH DITAMBAHKAN -->
                                
                                <!-- FORM UNTUK MEMILIH PRODUK YANG AKAN DITAMBAHKAN -->
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input type="hidden" name="_method" value="PUT" class="form-control">
                                            <select name="product_id" class="form-control">
                                                <option value="">Pilih Produk</option>
                                                @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" min="1" value="1" name="qty" class="form-control" required>
                                        </td>
                                        <td colspan="3">
                                            <button class="btn btn-primary btn-sm">Tambahkan</button>
                                        </td>
                                    </tr>
                                </tfoot>
                                <!-- FORM UNTUK MEMILIH PRODUK YANG AKAN DITAMBAHKAN -->
                            </table>
                            </form>
                        </div>
                        
                        <!-- MENAMPILKAN TOTAL & TAX -->
                        <div class="col-md-4 offset-md-8">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <td>Sub Total</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td>Pajak</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>:</td>
                                    
                                </tr>
                            </table>
                        </div>
                        <!-- MENAMPILKAN TOTAL & TAX -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
let date = new Date()
var today =
    ("0" + (date.getUTCMonth() + 1)).slice(-2) + "/" +
    ("0" + (date.getUTCDate() + 1)).slice(-2)+ "/" +
    date.getUTCFullYear();
$("#date").val(today);
$("#customer").change(function() {
    var status = $("#customer").val();
    if (status == "NULL"){
        $("#email").val();
        $("#phone").val();
    }
    else{
        $.ajax  ({
            url: "{{asset('api/customer/search')}}",
            type: 'post',
            dataType: 'json',
            data :{
                'id': status
            },
            success: function (result) {
                $("#phone").val(result.data.phone);
                $("#email").val(result.data.email);
                $("#address").val(result.data.address);
            }
        })
    }
})

</script>
@endsection