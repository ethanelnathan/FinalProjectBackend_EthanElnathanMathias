@extends('barangLayout')
@section('content cart')
<link rel="stylesheet" type="text/css" href="{{ asset('css/kategori.css') }} ">
{{-- make cart table --}}
<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    {{-- table data temporary session after add cart --}}
    <tbody>
        @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php $total += $details['harga'] * $details['jumlah'] @endphp
                <tr data-id="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">Rp{{ $details['harga'] }}</td>
                    <td data-th="Quantity"style="text-align: center">
                        <label for="">{{ $details['jumlah'] }}</label>
                    </td>
                    <td data-th="Subtotal" class="text-center">Rp{{ $details['harga'] * $details['jumlah'] }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    {{-- display total card --}}
    <tfoot>
        <tr>
            <td colspan="5" class="text-right"><h3><strong>Total Rp{{ $total }}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/kategori') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <a class="btn btn-success" href='https://bncc.net'>Checkout</a>
            </td>
        </tr>
    </tfoot>
</table>
@endsection

@section('scripts')

{{-- remove data item from cart --}}
<script type="text/javascript">

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

</script>
@endsection
