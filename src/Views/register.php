<?php define('TITLE', 'NT Shopper'); 
    include('partials/header.php')
?>

<body>

    <!-- Topbar Start -->
    <?php include('partials/topbar.php') ?>
    
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?php include('partials/navbar.php') ?>


<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <form method="POST" action="/register">
                            

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control"
                                        name="name" value="" required autocomplete="name">

                                    
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="customer_email"
                                    class="col-md-4 col-form-label text-md-end">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control"
                                        name="email" value="" required autocomplete="email">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="customer_phone" class="col-md-4 col-form-label text-md-end">Phone</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control"
                                        name="phone" value="" required autocomplete="phone">

                                    
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="phone" class="col-md-4 col-form-label text-md-end">Gender</label>

                                <div class="col-md-6">
                                    <select name="gender" required class="form-control">
                                        <option value="male">Male</option>
                                        <option value="fe-male">FeMale</option>
                                    </select>

                                </div>
                            </div> 

                            <div class="row mb-3">
                                <label for="customer_password"
                                    class="col-md-4 col-form-label text-md-end">Password</label>

                                <div class="col-md-6">
                                    <input id="password" required type="password"
                                        class="form-control " name="password"
                                         autocomplete="new-password">

                                   
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="customer_password-confirm"
                                    class="col-md-4 col-form-label text-md-end">Confirm password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password-confirm" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="phone" class="col-md-4 col-form-label text-md-end">Address</label>

                                <div class="col-md-6">
                                    <textarea id="address" type="text" class="form-control"
                                        name="address" value="" required autocomplete="address"></textarea>

                                    
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
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
    <script>
            document.getElementById("register-form").addEventListener("submit", function(event) {
            // ở đây kiểm tra xem hai trường password có giống nhau không
                var password = document.getElementById("password").value;
                var passwordConfirm = document.getElementById("password-confirm").value;
                if (password !== passwordConfirm) {
                    alert("Hai trường password phải giống nhau!");
                    event.preventDefault(); // ngăn chặn việc gửi form đi
                }
            });
    </script>
</body>

</html>