@extends('layouts.admin')
@section('title','Point Of Sale')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<form action="{{ route('pos.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{route('pos')}}">Point Of Sale</a></li>
                    <li class="breadcrumb-item active">Transaction</li>
                </ol>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        <div>
                            <button class="btn btn-primary my-2" type="submit" @click="create" :disabled="isProcessing">Save</button>
                            <a href="{{route('pos')}}" class="btn btn-secondary mby-2">Discard</a>
                        </div>
                    </div>
                </div>
                <div class="o_cp_right">
                    <div class="btn-group o_search_options position-static" role="search"></div>
                    <nav class="o_cp_pager" role="search" aria-label="Pager">
                        <div class="o_pager">
                            <span class="o_pager_counter">
                                <span class="o_pager_value">1</span> / <span class="o_pager_limit">1</span>
                            </span>
                            <span class="btn-group" aria-atomic="true">
                                <button type="button" class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                                    accesskey="p" aria-label="Previous" title="Previous" tabindex="-1" disabled=""></button>
                                <button type="button" class="fa fa-chevron-right btn btn-secondary o_pager_next"
                                    accesskey="n" aria-label="Next" title="Next" tabindex="-1" disabled=""></button>
                            </span>
                        </div>
                    </nav>
                    <nav class="btn-group o_cp_switch_buttons" role="toolbar" aria-label="View switcher"></nav>
                </div>
            </div>
        </div>
    </div>
    <section class="content" id="pos">
        <div class="card container bg-white mt-4">
            <div class="row">
                <div class="col-md-7">
                    <div class="row mt-4">
                        <label class="col-5 col-form-label">Barcode Product <div class="pull-right">:</div></label>
                        <div class="wrap-input200 col-5">
                            <input type="text" name="barcode" autocomplete="off" class="input200 ">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-5 col-form-label">Quantity <div class="pull-right">:</div></label>
                        <div class="wrap-input200 col-5">
                            <input type="number" name="Quantity" autocomplete="off" class="input200 ">
                        </div>
                    </div>
                        <!-- <div class="col-md-2 md-none float-right">
                            <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i></button>
                        </div> -->
                </div>
                <div class="col-md-5">
                    <div class="row mt-4">
                        <label class="col-sm-5 col-form-label">Customer</label>
                        <div class="wrap-input200 col-sm-6">
                            <select id="client" class="form-control" style="border:none" name="client" required>
                                <option value="">Select customer</option>
                                @foreach ($customer as $row)
                                    <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="text-danger">{{ $errors->first('customer') }}</p>
                    </div>
                    <div class="row">
                        <label class="col-sm-5 col-form-label"><h4>Total</h4></label>
                        <div class="col-sm-6">
                            <input type="hidden" name="total" id="total" maxlength="10" style="border:none; font-size:30px;" class="input200 {{ $errors->has('total') ? 'is-invalid':'' }}" value="{{ old('total') }}" autofocus>
                            <input type="text" name="grandtotal" id="grandtotal" maxlength="10" style="border:none; font-size:20px;" class="input200 {{ $errors->has('grandtotal') ? 'is-invalid':'' }}" value="{{ old('grandtotal') }}" autofocus>
                        </div>
                        <p class="text-danger">{{ $errors->first('grandtotal') }}</p>
                    </div>
                </div>
            </div>
            <hr style="border: 1px solid;">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive-lg my-4">
                        <table class="table">
                            <thead class="table table-sm">
                                <tr>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="productlist">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="table-label" colspan="2" style="border: none"><b>Pay</b></td>
                                    <td style="border: none">
                                        <input type="text" name="pay" required class="table-discount_input" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-empty" colspan="2" style="border: none"><b>Change</b></td>
                                    <td style="border: none" class="change">
                                    </td>
                                </tr>
                            </tfoot>   
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
    <script src="{{ asset('js/pos.js') }}"></script>
    <script>
    $('a#pos').addClass('mm-active');
    const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        })
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    $("input[name='grandtotal']").val('0');
    $("input[name='total']").val('0');
    $("input[name='barcode']").focus();
    $("input[name='barcode']").keypress(function(e){
        if(e.which == 13){
            e.preventDefault();
            $("input[name='Quantity']").focus();
        }
    });
    $("input[name='Quantity']").keypress(function(e){
        if(e.which == 13){
            e.preventDefault();
            var code = $("input[name='barcode']").val();
            var qty = $(this).val();
            var _this = $(this);
            $.ajax  ({
                url: "{{asset('api/getProduct')}}",
                type: 'get',
                dataType: 'json',
                data :{
                    's': code
                },
                success: function (result) {
                    if (result.status == "success") {
                        _this.val('');
                        $("input[name='barcode']").val('');
                        $("input[name='barcode']").focus();
                        $('.productlist').append(`
                            <tr> 
                                <th >`+result.data.barcode+`<input type="hidden" name="product[]" class="table-discount_input" value='`+result.data.id+`'></th>
                                <th >`+result.data.name+`<input type="hidden" name="name[]" class="table-discount_input" value='`+result.data.name+`'></th>
                                <th >Rp. `+formatNumber(result.data.price)+`<input type="hidden" name="price[]" class="table-discount_input price " value='`+result.data.price+`'></th>
                                <th > 
                                    <input type="text" name="qty[]" readonly class="table-discount_input qty" value=`+qty+`>
                                </th>
                                <th ><button class="btn btn-xs pull-right delete"><i class="fa fa-trash"></i></button></th>
                            <tr> 
                                    `);
                        let total = parseInt($("input[name='total']").val());
                        console.log(total);
                        total += parseInt(result.data.price)*qty;
                        console.log(total);
                        $("input[name='grandtotal']").val("Rp. "+formatNumber(total));
                        $("input[name='total']").val(total);
                        $("input[name='pay']").val('0');
                        // alert(result.data.name);
                    }
                    else{
                        swalWithBootstrapButtons(
                            'Something Wrong',
                            'Barcode Product Not Found',
                            'error'
                        )
                    }
                }
            })
        }
    })
    $('body').on('click','.delete',function(e){
        e.preventDefault();
        var price= $(this).closest('tr').find('input.price').val();
        var qty= $(this).closest('tr').find('input.qty').val();
        var grandtotal = parseInt($("input[name='total']").val());
        var total = grandtotal - parseInt(price)*parseInt(qty);
        $("input[name='grandtotal']").val("Rp. "+formatNumber(total));
        $("input[name='total']").val(total);
        $(this).closest('tr').remove();
    })
    $("input[name='pay']").keyup(function(e){
        var grandtotal = parseInt($("input[name='total']").val());
        var pay = parseInt($(this).val());
        var change = pay-grandtotal;
        $('.change').text("Rp. "+formatNumber(change));
    })
    $("button[type='submit']").click(function(e){
        var grandtotal = parseInt($("input[name='total']").val());
        var pay = parseInt($("input[name='pay']").val());
        if (pay < grandtotal){
            e.preventDefault();
            swalWithBootstrapButtons(
                    'Something Wrong',
                    'less customer money',
                    'error'
                )
        }
    })
    </script>
@endsection