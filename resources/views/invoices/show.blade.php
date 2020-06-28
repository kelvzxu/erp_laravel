@extends('layouts.admin')
@section('title',"Invoice | $invoice->invoice_no")
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
<style>
    .disabled {
        pointer-events: none;
        cursor: default;
    }
</style>
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('invoices')}}">Invoices</a></li>
                <li class="breadcrumb-item active">{{$invoice->invoice_no}}</li>
            </ol>
        </div>
        <div>
            <div class="o_cp_left">
                <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                    <div>
                        @if($invoice->status == "Complete") 
                            @if($invoice->deliver == False )
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#journalPosted">Edit</button>                        
                            @endif
                            @if($invoice->deliver == True )
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deliverwarning">Edit</button>                        
                            @endif
                        @else 
                            <a type="button" href="{{route('invoices.edit', $invoice)}}" class="btn btn-primary o-kanban-button-new">Edit</a>
                        @endif
                        <a type="button" class="btn btn-secondary o-kanban-button-new" accesskey="c" href="{{route('invoices.create')}}">
                            Create
                        </a>
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
    <div class="o_form_view o_sale_order o_form_editable">

        <div class="o_form_statusbar">
            <div class="o_statusbar_buttons">
                @if($invoice->status == "Pending" ) 
                    <a href="{{route('invoices.approved', $invoice)}}" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"> Posted</i></a>
                @endif
                @if($invoice->deliver == False )                
                    <a href="{{route('Delivere.store', $invoice)}}" class="btn btn-primary"><i class="fa fa-truck"> Delivere</i></a>
                @endif
                <a href="{{route('invoices.print', $invoice)}}" class="btn btn-success"><i class="fa fa-print"></i> Print</a>
                <button type="button" name="action_cancel" states="draft,sent,sale"
                    class="btn btn-secondary" data-original-title="" title=""><span>Cancel</span>
                </button>
                <button type="button"
                    name="action_draft" states="cancel" class="btn btn-secondary o_invisible_modifier" data-original-title=""
                    title=""><span>Set to Quotation</span>
                </button>
            </div>
            <div class="o_field_many2many o_field_widget o_invisible_modifier o_readonly_modifier"
                name="authorized_transaction_ids" id="o_field_input_290" data-original-title="" title=""></div>
            <div class="o_statusbar_status o_field_widget o_readonly_modifier" name="state" data-original-title="" title="">
                @if($invoice->status == "Pending" ) 
                    <button type="button" data-value="sale" disabled="disabled" title="Not active state" aria-pressed="false"
                        class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                        Paid
                    </button>
                    <button type="button" data-value="sent" disabled="disabled" title="Not active state" aria-pressed="false"
                        class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                        Delivery
                    </button>
                    <button type="button" data-value="sent" disabled="disabled" title="Not active state" aria-pressed="false"
                        class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                        Posted
                    </button>
                    <button type="button" data-value="draft" disabled="disabled" title="Current state" aria-pressed="true"
                        class="btn o_arrow_button btn-primary disabled d-none d-md-block" aria-current="step">
                        Draft
                    </button>
                @endif
                @if($invoice->status == "Complete" ) 
                    @if($invoice->deliver_validate == True ) 
                        @if($invoice->paid == True ) 
                            <button type="button" data-value="sent" disabled="disabled" title="Current state" aria-pressed="true"
                                class="btn o_arrow_button btn-primary disabled d-none d-md-block" aria-current="step">
                                Paid
                            </button>
                            <button type="button" data-value="sale" disabled="disabled" title="Not active state" aria-pressed="false"
                                class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                                Delivery
                            </button>
                            <button type="button" data-value="sent" disabled="disabled" title="Not active state" aria-pressed="false"
                                class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                                Posted
                            </button>
                            <button type="button" data-value="draft" disabled="disabled" title="Current state" aria-pressed="true"
                                class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                                Draft
                            </button>
                        @endif
                        @if($invoice->paid == False ) 
                            <button type="button" data-value="sale" disabled="disabled" title="Not active state" aria-pressed="false"
                                class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                                Paid
                            </button>
                            <button type="button" data-value="sent" disabled="disabled" title="Current state" aria-pressed="true"
                                class="btn o_arrow_button btn-primary disabled d-none d-md-block" aria-current="step">
                                Delivery
                            </button>
                            <button type="button" data-value="sent" disabled="disabled" title="Not active state" aria-pressed="false"
                                class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                                Posted
                            </button>
                            <button type="button" data-value="draft" disabled="disabled" title="Current state" aria-pressed="true"
                                class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                                Draft
                            </button>
                        @endif
                    @endif
                    @if($invoice->deliver_validate == False ) 
                        <button type="button" data-value="sale" disabled="disabled" title="Not active state" aria-pressed="false"
                            class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                            Paid
                        </button>
                        <button type="button" data-value="sent" disabled="disabled" title="Not active state" aria-pressed="false"
                            class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                            Delivery
                        </button>
                        <button type="button" data-value="sent" disabled="disabled" title="Current state" aria-pressed="true"
                            class="btn o_arrow_button btn-primary disabled d-none d-md-block" aria-current="step">
                            Posted
                        </button>
                        <button type="button" data-value="draft" disabled="disabled" title="Current state" aria-pressed="true"
                            class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                            Draft
                        </button>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mt-4">
        <div class="card container">
            <div class="row mt-4 mx-2">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Invoice No.</label>
                        <p>{{$invoice->invoice_no}}</p>
                    </div>
                    <div class="form-group">
                        <label>Grand Total</label>
                        <p>Rp. {{ number_format($invoice->grand_total)}}</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Client</label>
                        <input type="hidden" id="client_id" value="{{$invoice->client}}">
                        <p id="client">{{$invoice->client}}</p>
                    </div>
                    <div class="form-group">
                        <label>Client Address</label>
                        <pre class="pre">{{$invoice->client_address}}</pre>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Title</label>
                        <p>{{$invoice->title}}</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Invoice Date</label>
                            <p>{{$invoice->invoice_date}}</p>
                        </div>
                        <div class="col-sm-6">
                            <label>Due Date</label>
                            <p>{{$invoice->due_date}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="mb-4 mx-2">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->products as $data)
                            <tr>
                            <td id="product" class="table-name">{{$data->product->name}}</td>
                            <td class="table-price">Rp. {{ number_format($data->price)}}</td>
                            <td class="table-qty">{{$data->qty}}</td>
                            <td class="table-total text-right">Rp. {{ number_format($data->qty * $data->price)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="table-empty" colspan="2"></td>
                            <td class="table-label">Sub Total</td>
                            <td class="table-amount">Rp. {{number_format($invoice->sub_total)}}</td>
                        </tr>
                        <tr>
                            <td class="table-empty" colspan="2"></td>
                            <td class="table-label">Discount</td>
                            <td class="table-amount">Rp. {{number_format($invoice->discount)}}</td>
                        </tr>
                        <tr>
                            <td class="table-empty" colspan="2"></td>
                            <td class="table-label">Grand Total</td>
                            <td class="table-amount">Rp. {{number_format($invoice->grand_total)}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<br>
@endsection
@section('modal')
<div class="modal fade" id="deliverwarning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Something Went Wrong</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{asset('images/icons/warning.png')}}" alt=""><br>
                <p class="mb-0">You Can't Edit this Record </p>
                <p class="mb-0">
                    because this order has been delivered to the customer.<br>
                    if there is a change in the number of items it is expected to return the order
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="journalPosted" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Something Went Wrong</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{asset('images/icons/warning.png')}}" alt=""><br>
                <p class="mb-0">You Can't Edit this Record </p>
                <p class="mb-0">
                    because this factor has been posted in a journal entry.<br>
                    if there is a change in the number of items it is expected to return the order
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/asset_common/invoice.js')}}"></script>
@endsection