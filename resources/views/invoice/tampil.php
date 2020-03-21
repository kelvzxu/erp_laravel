@php $no = 1 @endphp
@foreach ($invoice ?? ''->detail as $detail)
<tr>
    <td>{{ $no++ }}</td>
    <td>{{ $detail->product->title }}</td>
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
@endforeach
<option value="">Pilih Produk</option>
@foreach ($products as $product)
<option value="{{ $product->id }}">{{ $product->title }}</option>
@endforeach
<td>Rp {{ number_format($invoice ?? ''->total) }}</td>
<td>2% (Rp {{ number_format($invoice ?? ''->tax) }})</td>
<td>Rp {{ number_format($invoice ?? ''->total_price) }}</td>