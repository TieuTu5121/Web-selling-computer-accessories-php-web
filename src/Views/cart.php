<?php 
    define('TITLE', 'NT Shopper - '. $product->name); 
    include('partials/header.php')
    use App\Models\Cart;
?>

<body>

    <!-- Topbar Start -->
    <?php include('partials/topbar.php') ?>
    
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?php include('partials/navbar.php') ?>
<!-- Shop Detail Start -->


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
                
                <?php foreach ($cartdetail as $item): ?>
                <tr class="align-middle">
                    <td class="align-middle cart_product">
                        <a href=""><img src="<?= $item->product_image ?>" alt="" width="100"/></a>
                    </td>
                    <td class="align-middle cart_description">
                        <h5><a href="/product/<?= $item->product_id ?>"><?= $item->product_name ?></a></h5>
                        <p>ID: <?= $item->id ?></p>
                    </td>
                    <td class="align-middle cart_price">
                        <p><?= number_format($item->product_price).' VNĐ'?></p>
                    </td>
                    <td class="align-middle cart_quantity">
                        <form action="/updateqty" method="POST">
                            
                            <input type="hidden" value="<?= $item->id ?>" name="id">
                            <div class="input-group product_quantity_button quantity mx-auto" style="width: 130px;">
                                <div class="input-group-btn">
                                    <button type="button submit" name="update_quantity" class="btn btn-primary btn-minus" data-type="minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" name="product_quantity" class="form-control bg-secondary text-center input-number product_quantity_input" 
                                    value="<?= $item->product_quantity ?>" id="<?= $item->id ?>" name="product_quantity">
                                <div class="input-group-btn">
                                    <button type="button submit" name="update_quantity" class="btn btn-primary btn-plus" data-type="plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                    </td>
                    <td class="align-middle product_total">
                        <p class="product_total_price"><?= number_format($item->product_price * $item->product_quantity).' VNĐ'?></p>
                    </td>
                    <td class="align-middle product_delete">
                        <a href="/cart-delete/ <?= $item->id ?>"><button class="btn btn-sm btn-primary product_quantity_delete">
                        <i class="fa fa-times"></i></button></a>
                    </td>
                </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
    <div class="col-lg-4 total_area">
        <form class="mb-5" method="POST" action="
              
              ">
            
            <div class="input-group">
                <input type="text" class="form-control p-4" value="
                
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
                        <?= Cart::count() ?>
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
                        <? Cart::pricetotal(0) ?> VNĐ
                    </h6>
                </div>
                <div class="d-flex justify-content-between mb-3 pt-1">
                    <h6 class="font-weight-medium">Thuế:</h6>
                    <h6 class="font-weight-medium total_price">
                        {{ Cart::tax(0) }} VNĐ
                    </h6>
                </div>

            </div>
        </div>
        <div class="card-footer border-secondary bg-transparent">
            <div class="d-flex justify-content-between mt-2">
                <h5 class="font-weight-bold">Tổng thanh toán</h5>
                <h5 class="font-weight-bold total-price-all"><?= Cart::total(0) ?> VNĐ</h5>
            </div>
            <a href="/checkouts" class="btn btn-block btn-primary my-3 py-3">Proceed
                To Checkout</a>
        </div>
    </div>
</div>
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