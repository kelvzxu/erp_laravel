@extends('layouts.admin')
@section('title','Payment Invoice')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="" method="post" enctype="multipart/form-data">
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
                                <div class="notification_area"></div>
                                <div class="o_reconciliation_lines">
                                    <div class="o_reconciliation_line" data-mode="match" tabindex="0" data-partner="3">
                                        <table class="accounting_view">
                                            <caption style="caption-side: top;">
                                                <div class="float-right o_buttons">
                                                    <button
                                                        class="o_validate btn btn-secondary d-none">Reconcile</button>
                                                    <button
                                                        class="o_reconcile btn btn-primary d-none">Reconcile</button>
                                                    <button class="o_no_valid btn btn-secondary">Skip</button>
                                                </div>
                                                <div class="o_field_widget o_field_many2one o_with_button o_required_modifier"
                                                    aria-atomic="true" name="partner_id">
                                                    <div class="o_input_dropdown">
                                                        <input type="text" class="o_input ui-autocomplete-input" value="">
                                                    </div>
                                                    <a type="button" hreff=""
                                                        class="fa fa-external-link btn btn-secondary o_external_button"
                                                        title="External link"></a>
                                                </div>
                                            </caption>
                                            <thead>
                                                <tr>
                                                    <td colspan="3">
                                                        <span>Piutang Usaha</span>
                                                    </td>
                                                    <td colspan="2">11210010</td>
                                                    <td class="cell_info_popover">
                                                        <span class="line_info_button fa fa-info-circle"></span></td>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                <tr class="mv_line   ">
                                                    <td class="cell_account_code">&#8203;0</td>
                                                    <td class="cell_due_date">
                                                        1
                                                    </td>
                                                    <td class="cell_label">
                                                        2
                                                    </td>
                                                    <td class="cell_left">
                                                        3
                                                    </td>
                                                    <td class="cell_right">
                                                        4
                                                    </td>
                                                    <td class="cell_info_popover">4</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>

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
                                                                <tbody>
                                                                    <tr class="mv_line   " data-line-id="28">
                                                                        <td class="cell_account_code">11210010&#8203;
                                                                        </td>
                                                                        <td class="cell_due_date">
                                                                            06/17/2020
                                                                        </td>
                                                                        <td class="cell_label">
                                                                            INV/2020/0005
                                                                        </td>
                                                                        <td class="cell_left">
                                                                            <span class="">
                                                                                <span class="line_amount">
                                                                                </span>
                                                                                <span class="line_amount">
                                                                                    Rp 825.00
                                                                                </span>
                                                                            </span>
                                                                        </td>
                                                                        <td class="cell_right">
                                                                        </td>
                                                                        <td class="cell_info_popover"><span
                                                                                class="line_info_button fa fa-info-circle"
                                                                                ></span></td>
                                                                    </tr>
                                                                    <tr class="mv_line   " data-line-id="19">
                                                                        <td class="cell_account_code">11210010&#8203;
                                                                        </td>
                                                                        <td class="cell_due_date">
                                                                            06/16/2020
                                                                        </td>
                                                                        <td class="cell_label">
                                                                            BNK1/2020/0002: Customer Payment
                                                                        </td>
                                                                        <td class="cell_left">
                                                                        </td>
                                                                        <td class="cell_right">
                                                                            <span class="">
                                                                                <span class="line_amount">
                                                                                </span>
                                                                                <span class="line_amount">
                                                                                    Rp 89,989.00
                                                                                </span>
                                                                            </span>
                                                                        </td>
                                                                        <td class="cell_info_popover"><span
                                                                                class="line_info_button fa fa-info-circle"
                                                                                ></span></td>
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
<script src="{{asset('js/asset_common/payment.js')}}"></script>
@endsection
