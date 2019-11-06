@extends('layouts.shop')

@section('content')

<div class="hero-wrap hero-bread" style="background-image: url('/theme/images/bg_6.jpg');">
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
        <h1 class="mb-0 bread">My Cart</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="row">
      <div class="col-md-12 ftco-animate">
        <div class="cart-list">
          <table class="table">
              <thead class="thead-primary">
                <tr class="text-center">
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @if ($order)
                  @foreach ($order->products as $product)
                    <tr class="text-center product-{{ $product->id }}">
                      <td class="product-remove" data-product-id="{{ $product->id }}">
                        <a href="#">
                          <span class="ion-ios-close"></span>
                        </a>
                      </td>

                      <td class="image-prod"><div class="img" style="background-image:url(/theme/images/product-3.jpg);"></div></td>

                      <td class="product-name">
                        <h3>{{ $product->name }}</h3>
                        <p>Far far away, behind the word mountains, far from the countries</p>
                      </td>

                      <td class="price">${{ $product->price }}</td>

                      <td class="quantity">
                        <div class="input-group mb-3">
                          <input type="text" name="quantity" class="quantity form-control input-number" value="{{ $product->pivot->quantity }}" min="1" max="100">
                        </div>
                      </td>

                      <td class="total">${{ $product->price * $product->pivot->quantity }}</td>
                    </tr><!-- END TR-->
                  @endforeach
                @endif
              </tbody>
          </table>
        </div>
      </div>
    </div>
  <div class="row justify-content-center">
    <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3">
          <h3>Cart Totals</h3>
          <p class="d-flex">
            <span>Subtotal</span>
            <span class="show-total-price">${{ $order ? $order->total_price : 0 }}</span>
          </p>
          <p class="d-flex">
            <span>Delivery</span>
            <span>$0.00</span>
          </p>
          <p class="d-flex">
            <span>Discount</span>
            <span>$3.00</span>
          </p>
          <hr>
          <p class="d-flex total-price">
            <span>Total</span>
            <span class="show-total-price">${{ $order ? $order->total_price : 0 }}</span>
          </p>
        </div>
        <p class="text-center">
          <a href="checkout.html" class="btn btn-primary py-3 px-4">
            Proceed to Checkout
          </a>
        </p>
    </div>
  </div>
  </div>
</section>

@endsection

@section('js')
  <script type="text/javascript">
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('.product-remove').click(function() {
        if (confirm('Delete this product, are you sure?')) {
          var url = '/orders/delete';
          var productId = $(this).data('product-id');

          var data = {
            'product_id': productId
          };

          $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(result) {
              if (result.status) {
                $('.product-' + productId).remove();
                $('.show-total-price').text('$' + result.total_price);
              }
            },
            error: function() {
              alert('Something went wrong!');
              location.reload();
            }
          });
        }
      });
    });
  </script>
@endsection
