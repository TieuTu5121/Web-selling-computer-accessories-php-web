<?php define('TITLE', 'NT Shopper'. $product->name); 
    include('partials/header.php')
?>

<body>

    <!-- Topbar Start -->
    <?php include('partials/topbar.php') ?>
    
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?php include('partials/navbar.php') ?>

    <div class="col-lg-8 table-responsive mb-5">
        <table class="table table-bordered text-center mb-0">
            <thead class="bg-secondary text-dark">
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                
                <?php foreach ($content as $item): ?>
                <tr class="align-middle">
                    <td class="align-middle cart_product">
                        <a href=""><img src="{{asset('uploads/product/' .$item->options->image )}}" alt="" width="100"/></a>
                    </td>
                    <td class="align-middle cart_description">
                        <h5><a href="{{ route('product.detail', $item->id) }}">{{$item->name}}</a></h5>
                        <p>ID: {{$item->id}}</p>
                    </td>
                    <td class="align-middle cart_price">
                        <p>{{number_format($item->price).' VNĐ'}}</p>
                    </td>
                    <td class="align-middle cart_quantity">
                        <form action="{{ route('carts.updateqty') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$item->rowId}}" name="cart_rowId">
                            <div class="input-group cart_quantity_button quantity mx-auto" style="width: 130px;">
                                <div class="input-group-btn">
                                    <button type="button submit" name="update_quantity" class="btn btn-primary btn-minus" data-type="minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" name="cart_quantity" class="form-control bg-secondary text-center input-number cart_quantity_input" 
                                    value="{{ $item->qty }}" id="{{ $item->rowId }}" name="cart_quantity">
                                <div class="input-group-btn">
                                    <button type="button submit" name="update_quantity" class="btn btn-primary btn-plus" data-type="plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                    </td>
                    <td class="align-middle cart_total">
                        <p class="cart_total_price">{{number_format($item->price * $item->qty).' VNĐ'}}</p>
                    </td>
                    <td class="align-middle cart_delete">
                        <a href="{{ route('carts.delete', $item->rowId) }}"><button class="btn btn-sm btn-primary cart_quantity_delete">
                        <i class="fa fa-times"></i></button></a>
                    </td>
                </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
    <div class="col-lg-4 total_area">
        <form class="mb-5" method="POST" action="
              {{-- {{ route('client.carts.apply_coupon') }} --}}
              ">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control p-4" value="
                {{-- {{ Session::get('coupon_code') }} --}}
                " name="coupon_code"
                    placeholder="Coupon Code">
                <div class="input-group-append">
                    <button class="btn btn-primary">Apply Coupon</button>
                </div>
            </div>
        </form>
        <div class=" card border-secondary mb-5">
            <div class="card-header bg-secondary border-0">
                <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 pt-1">
                    <h6 class="font-weight-medium">Tổng số sản phẩm:</h6>
                    <h6 class="font-weight-medium total_price">
                        {{ Cart::count() }}
                    </h6>
                </div>
                <div class="d-flex justify-content-between mb-3 pt-1">
                    <h6 class="font-weight-medium">Phí vận chuyển:</h6>
                    <h6 class="font-weight-medium total_price">
                        Miễn phí
                    </h6>
                </div>
                <div class="d-flex justify-content-between mb-3 pt-1">
                    <h6 class="font-weight-medium">Thành tiền:</h6>
                    <h6 class="font-weight-medium total_price">
                        {{ Cart::pricetotal(0) }} VNĐ
                    </h6>
                </div>
                <div class="d-flex justify-content-between mb-3 pt-1">
                    <h6 class="font-weight-medium">Thuế:</h6>
                    <h6 class="font-weight-medium total_price">
                        {{ Cart::tax(0) }} VNĐ
                    </h6>
                </div>

                {{-- @if (session('discount_amount_price'))
                <div class="d-flex justify-content-between">
                    <h6 class="font-weight-medium">Coupon </h6>
                    <h6 class="font-weight-medium coupon-div" data-price="{{ session('discount_amount_price') }}">
                        ${{ session('discount_amount_price') }}</h6>
                </div>
                @endif --}}

            </div>
        </div>
        <div class="card-footer border-secondary bg-transparent">
            <div class="d-flex justify-content-between mt-2">
                <h5 class="font-weight-bold">Tổng thanh toán</h5>
                <h5 class="font-weight-bold total-price-all">{{ Cart::total(0) }} VNĐ</h5>
            </div>
            <a href="{{ route('checkouts.index') }}" class="btn btn-block btn-primary my-3 py-3">Proceed
                To Checkout</a>
        </div>
    </div>
</div>
</div>
<?php include('partials/footer.php') ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <?php include('partials/javascript.php') ?>
</body>

</html>