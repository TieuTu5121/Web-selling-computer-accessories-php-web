<?php 
    define('TITLE', 'NT Shopper - '); 
    include('partials/header.php')
    
?>

<body>

    <!-- Topbar Start -->
    <?php include('partials/topbar.php') ?>
    
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?php include('partials/navbar.php') ?>
<!-- Shop Detail Start -->

<div class="row px-xl-5">
    <div class="col-lg-8 table-responsive mb-5">
        <table class="table table-bordered text-center mb-0">
            <thead class="bg-secondary text-dark">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                
                <!-- Ham foreach -->
                <tr class="align-middle">
                    <td class="align-middle cart_product">
                        <!-- image -->
                        <a href=""><img src="
                        
                        " alt="" width="100"/></a>
                    </td>
                    <td class="align-middle cart_description">
                        <!-- href link toi san pham, h5 chua ten -->
                        <h5><a href="/product/...">         </a></h5>
                    </td>
                    <td class="align-middle cart_price">
                        <!-- number_format chua price -->
                        <p><?= number_format(0).' VNĐ'?></p>
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
                                <!-- value chua quantity mua -->
                                <input type="text" name="product_quantity" class="form-control bg-secondary text-center input-number product_quantity_input" 
                                    value="                             " name="product_quantity">
                                <div class="input-group-btn">
                                    <button type="button submit" name="update_quantity" class="btn btn-primary btn-plus" data-type="plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                    </td>
                    <td class="align-middle product_total">
                        <!-- number_format chua gia * quantity -->
                        <p class="product_total_price"><?= number_format(0).' VNĐ'?></p>
                    </td>
                    <td class="align-middle product_delete">
                        <!-- them vao href /cart-delete/ + id de xoa --> 
                        <a href=""><button class="btn btn-sm btn-primary product_quantity_delete">
                        <i class="fa fa-times"></i></button></a>
                    </td>
                </tr>
               

            </tbody>
        </table>
    </div>
    <div class="col-lg-4">
        <div class="card border-secondary mb-5">
            <div class="card-header bg-secondary border-0">
                <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 pt-1">
                    <h6 class="font-weight-medium">Subtotal</h6>

                    <h6 class="font-weight-medium total-price" data-price="{{ $cart->total_price }}">
                        <!-- Tong tien -->
                    </h6>
                </div>
                <div class="d-flex justify-content-between mb-3 pt-1">
                    <h6 class="font-weight-medium">Ship</h6>

                    <h6 class="font-weight-medium total-price" data-price="{{ $cart->total_price }}">
                        <!-- Tien ship -->
                    </h6>
                </div>
            </div>
            <div class="card-footer border-secondary bg-transparent">
                <div class="d-flex justify-content-between mt-2">
                    <h5 class="font-weight-bold">Total</h5>
                    <h5 class="font-weight-bold total-price-all">
                        <!-- subtotal + ship -->
                    </h5>
                </div>
                <a href="" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>
            </div>
        </div>
    </div>

</div>


    <!-- Footer Start -->
    <?php include('partials/footer.php') ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <?php include('partials/javascript.php') ?>
</body>

</html>