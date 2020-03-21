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
                            <table>
                                <tr>
                                    <td width="30%">No Invoice</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td>Customer</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td>reference</td>
                                    <td>:</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td width="30%">Invoice Date</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td>Payment Term</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td>phone</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                </tr>
                            </table>
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
                                    
                                </tbody>
                                <!-- MENAMPILKAN PRODUK YANG TELAH DITAMBAHKAN -->
                                
                                <!-- FORM UNTUK MEMILIH PRODUK YANG AKAN DITAMBAHKAN -->
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input type="hidden" name="_method" value="PUT" class="form-control">
                                            <select name="product_id" class="form-control">
                                                
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