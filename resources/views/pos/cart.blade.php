<div class="col-md-4">
    <div class="card container bg-white">
        <div class="class-title my-3">
        <i class="fa fa-shopping-cart"></i> Cart
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(row, index) in shoppingCart">
                        <td>@{{ row.name }} (@{{ row.code }})</td>
                        <td>@{{ row.price | currency }}</td>
                        <td>@{{ row.qty }}</td>
                        <td>
                            <button 
                                @click.prevent="removeCart(index)"    
                                class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            @if (url()->current() == route('pos'))
            <a href="{{ route('order.checkout') }}" 
                class="btn btn-info btn-sm float-right">
                Checkout
            </a>
            @else
            <a href="{{ route('pos') }}"
                class="btn btn-secondary btn-sm float-right"
                >
                Kembali
            </a>
            @endif
        </div>
    </div>
</div>