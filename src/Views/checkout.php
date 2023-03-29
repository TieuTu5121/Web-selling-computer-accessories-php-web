<?php define('TITLE', 'NT Shopper'); 
    include('partials/header.php')
?>

<body>

    <!-- Topbar Start -->
    <?php include('partials/topbar.php') ?>
    
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?php include('partials/navbar.php') ?>
    
    <!-- Navbar End -->

    <!-- Featured End -->


    <!-- Categories Start -->

    <!-- Categories End -->

    <!-- <div class="row ">
        <div class="d-inline-flex" style="margin-left:40px">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">/</p>
            <p class="m-0">Shop</p>
        </div>
    </div> -->
    <!-- Page Header End -->
    <div class="container-fluid pt-5">
        <form class="row px-xl-5" method="POST" action="
        {{ route('checkouts.proccess') }}
        ">
            @csrf
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Địa chỉ thanh toán</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Họ và tên</label>
                            <input class="form-control" value="" name="customer_name"
                                type="text" placeholder="John">
                            

                        </div>

                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" name="customer_email" value="{{ old('customer_email') }}"
                                type="text" placeholder="example@email.com">
                            
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Số điện thoại</label>
                            <input class="form-control" name="customer_phone" value="{{ old('customer_phone') }}"
                                type="text" placeholder="+123 456 789">
                            
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Địa chỉ</label>
                            <input class="form-control" name="customer_address" value="{{ old('customer_address') }}"
                                type="text" placeholder="123 Street">
                            
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Ghi chú </label>
                            <textarea class="form-control" value="{{ old('note') }}" name="note" type="text"
                                placeholder="123 Street"></textarea>
                            
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="total_area card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Tổng đơn hàng</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Sản phẩm</h5>
                        @foreach ($content as $item)
                            <div class="d-flex justify-content-between">
                                <p> {{ $item->qty }} x {{ $item->name }}</p>
                                <p>                                                                                                                                                                                      
                                    {{number_format($item->price * $item->qty).' VNĐ'}}
                                </p>

                                {{-- @if ($item->product->sale)
                                    <p
                                        style="
                                                                                                                                                                                                                                                                                                                                                                                                                            
                                        ${{ $item->product_quantity * $item->product->sale_price }}
                                    </p>
                                @endif --}}

                            </div>
                        @endforeach
                        <hr class="mt-0">
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
                                <h6 class="font-weight-medium coupon-div"
                                    data-price="{{ session('discount_amount_price') }}">
                                    ${{ session('discount_amount_price') }}</h6>
                            </div>
                        @endif --}}

                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tổng thanh toán:</h5>
                            <h5 class="font-weight-bold total-price-all">{{ Cart::total(0) }} VNĐ</h5>
                            <input type="hidden" id="total" value="" name="total">
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Phương thức thanh toán</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" checked value="monney" name="payment">
                                <label class="custom-control-label">Thanh toán khi nhận hàng</label>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">
                            Đặt hàng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endsection



    <!-- Footer Start -->
    <?php include('partials/footer.php') ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <?php include('partials/javascript.php') ?>
</body>

</html>

