<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                id="navbar-vertical">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">

                    
                    <div class="nav-item dropdown">
                                <a href="#" class="nav-link" data-toggle="dropdown">Speaker<i
                                        class="fa fa-angle-down float-right mt-1"></i></a>
                                
                    </div>
                    <div class="nav-item dropdown">
                                <a href="#" class="nav-link" data-toggle="dropdown">Headphones<i
                                        class="fa fa-angle-down float-right mt-1"></i></a>
                                
                    </div>
                    <div class="nav-item dropdown">
                                <a href="#" class="nav-link" data-toggle="dropdown">Mouse<i
                                        class="fa fa-angle-down float-right mt-1"></i></a>
                                
                    </div>
                    <div class="nav-item dropdown">
                                <a href="#" class="nav-link" data-toggle="dropdown">Keyboard<i
                                        class="fa fa-angle-down float-right mt-1"></i></a>
                                
                    </div>
                    
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">NT</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="<?= BASEURL ?>" class="nav-item nav-link active">Home</a>


                        <a href="
                        /order
                        " class="nav-link">Order</a>

                    </div>
                    <div class="navbar-nav ml-auto py-0">
                        <?php if ($user): ?>
                            <div class="dropdown">
                                <a class="btn btn-secondary" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $user->name ?> <i class="fa fa-angle-down float-right m-1"></i></a>
                            
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="/logout">Logout</a>
                                </div>
                            </div>
                        <?php else: ?>
                            <a href="/login" class="nav-item nav-link">Login</a>
                            <a href="/register" class="nav-item nav-link">Register</a>
                        <?php endif ?>



                    </div>
                </div>
            </nav>
            
            <div id="header-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="height: 410px;">
                        <img class="img-fluid" src="https://nguyenvu.store/wp-content/uploads/2023/02/SIDEBAR-NOEL-copy-2.webp" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            
                        </div>
                    </div>
                    <div class="carousel-item" style="height: 410px;">
                        <img class="img-fluid" src="https://nguyenvu.store/wp-content/uploads/2023/02/Untitled-1-1.webp" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            
                        </div>
                    </div>
                    <div class="carousel-item" style="height: 410px;">
                        <img class="img-fluid" src="https://nguyenvu-store-medias.tn-cdn.net/2023/03/Xa-kho-Akko-DS-Horizon.webp" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-prev-icon mb-n2"></span>
                    </div>
                </a>
                <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-next-icon mb-n2"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
