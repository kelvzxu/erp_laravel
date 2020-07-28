@extends('layouts.admin')
@section('title','Payment Invoice')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="{{ route('reconcile.bill_store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{route('payment_bills.index')}}">Payments</a>
                    </li>
                    <li class="breadcrumb-item active">Reconcile payments</li>
                </ol>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row o-content">
        <div class="col-12">
            <div class="o_reconciliation">
                <div class="o_form_view">
                    <div class="o_form_sheet_bg">
                        <div class="o_form_sheet">
                            <div class="o_manual_statement">
                                <div class="o_reconciliation_lines">
                                    <div class="o_reconciliation_line" data-mode="match" tabindex="0" data-partner="3">
                                        <table class="accounting_view">
                                            <caption style="caption-side: top;">
                                                <div class="float-right o_buttons">
                                                    <button type="submit" class="o_reconcile btn btn-primary">Reconcile</button>
                                                </div>
                                                <div class="o_field_widget o_field_many2one o_with_button o_required_modifier"
                                                    aria-atomic="true" name="partner_id">
                                                    <div class="o_input_dropdown">
                                                        <input type="hidden" name="id" value="{{$partner->id}}" readonly>
                                                        <input type="text" name="partner" class="o_input ui-autocomplete-input" value="{{$partner->partner_name}}" readonly>
                                                    </div>
                                                    <a type="button" href="{{ route('customer.show', $partner->id) }}"
                                                        class="fa fa-external-link btn btn-secondary o_external_button"
                                                        title="External link"></a>
                                                </div>
                                            </caption>
                                            <thead>
                                                <tr>
                                                    <td colspan="3">
                                                        <span>{{$account->name}}</span>
                                                    </td>
                                                    <td colspan="2">{{$account->code}}</td>
                                                    <td class="cell_info_popover">
                                                        <span class="line_info_button fa fa-info-circle"></span>
                                                    </td>
                                                </tr>

                                            </thead>
                                            <tbody class="item_line">
                                                <tr class="table-row">
                                                    <td class="cell_account_code"> Credit Note</td>
                                                    <td class="cell_due_date">
                                                    {{ date("Y-m-d")}}
                                                    </td>
                                                    <td class="cell_label">
                                                        {{$partner->partner_name}} - Credit Note
                                                    </td>
                                                    <td class="cell_left" id="payment-debit">
                                                        
                                                    </td>
                                                    <td class="cell_right" id="payment-credit">
                                                    <input type="hidden" name="payment-credit" value="{{$partner->credit}}">
                                                    Rp. {{ number_format($partner->credit)}}
                                                    </td>
                                                    <td class="cell_info_popover"></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="cell_account_code"></td>
                                                    <td class="cell_due_date"></td>
                                                    <td class="cell_label">Open balance</td>
                                                    <td class="cell_left">
                                                        <input type="hidden" name="amount_total" value="{{$partner->credit}}">
                                                        <div id="total" class="grand_total"> Rp. {{ number_format($partner->credit)}}</div>
                                                    </td>
                                                    <td class="cell_right"></td>
                                                    <td class="cell_info_popover"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="o_notebook">
                                            <div class="o_notebook_headers">
                                                <ul class="nav nav-tabs ml-0 mr-0">
                                                    <li class="nav-item" title="" data-toggle="tooltip"
                                                        data-original-title="Match with entries that are not from receivable/payable accounts">
                                                        <a data-toggle="tab" disable_anchor="true"
                                                            href="#notebook_page_match_other_undefined"
                                                            class="nav-link nav-match_other active" role="tab"
                                                            aria-selected="true">Miscellaneous Matching
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="notebook_page_match_other_undefined">
                                                    <div class="match">
                                                        <div>
                                                            <table>
                                                                <tbody class="account_line">
                                                                    @foreach($data as $row)
                                                                        <tr class="mv_line">
                                                                            <td class="cell_account_code">{{$account->code}}</td>
                                                                            <td class="cell_due_date">
                                                                                {{$row->date}}
                                                                                <input type="hidden" class="date" value="{{$row->date}}">
                                                                            </td>
                                                                            <td class="cell_label">
                                                                                {{$row->name}}
                                                                                <input type="hidden" class="name" name="invoice_no[]" value="{{$row->name}}">
                                                                            </td>
                                                                            <td class="cell_left">
                                                                                <span class="">
                                                                                    <span class="line_amount">
                                                                                        Rp. {{ number_format($row->amount_total)}}
                                                                                        <input type="hidden" class="amount" name="invoice_no[]" value="{{$row->amount_total}}">
                                                                                    </span>
                                                                                </span>
                                                                            </td>
                                                                            <td class="cell_right">
                                                                            </td>
                                                                            <td class="cell_info_popover">
                                                                                <span class="line_info_button fa fa-info-circle"></span>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
<script src="{{asset('js/asset_common/reconcile.js')}}"></script>
@endsection
