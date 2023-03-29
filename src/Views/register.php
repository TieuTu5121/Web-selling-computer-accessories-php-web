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
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Full Name<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Email<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-4 col-form-label">Phone<span class="text-danger"></span></label>
                        <div class="col-sm-8">
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-sm-4 col-form-label">Gender<span class="text-danger"></span></label>
                        <div class="col-sm-8">
                            <select id="gender" name="gender" class="form-control" required>
                                <option value="" disabled selected>Select your gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password<span class="text-danger"></span></label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="confirm-password" class="col-sm-4 col-form-label">Confirm Password<span class="text-danger"></span></label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-4 col-form-label">Address<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="address" name="address" placeholder="Enter your address" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8 offset-sm-4">
                            <button type="submit" class="btn btn-primary">Register</button>
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
        $(document).ready(function() {
        const form = document.querySelector('form');
        const nameInput = document.querySelector('#name');
        const emailInput = document.querySelector('#email');
        const phoneInput = document.querySelector('#phone');
        const passwordInput = document.querySelector('#password');
        const confirmPasswordInput = document.querySelector('#confirm-password');
        const addressInput = document.querySelector('#address');
        let isValid = true;
        form.addEventListener('submit', function(event) {
            if (nameInput.value === '') {
                event.preventDefault();
                showError(nameInput, 'Please enter your full name.');
                isValid = false;
            } else {
                showSuccess(nameInput);
            }

            if (emailInput.value === '') {
                event.preventDefault();
                showError(emailInput, 'Please enter your email address.');
                isValid = false;
            } else if (!isValidEmail(emailInput.value)) {
                event.preventDefault();
                showError(emailInput, 'Please enter a valid email address.');
                isValid = false;
            } else {
                showSuccess(emailInput);
            }

            if (phoneInput.value !== '' && !isValidPhoneNumber(phoneInput.value)) {
                event.preventDefault();
                showError(phoneInput, 'Please enter a valid phone number.');
                isValid = false;
            } else {
                showSuccess(phoneInput);
            }

            if (passwordInput.value === '') {
                event.preventDefault();
                showError(passwordInput, 'Please enter a password.');
                isValid = false;
            } else if (!isValidPassword(passwordInput.value)) {
                event.preventDefault();
                showError(passwordInput, 'Password must be at least 6 characters long.');
                isValid = false;
            } else {
                showSuccess(passwordInput);
            }

            if (confirmPasswordInput.value === '') {
                event.preventDefault();
                showError(confirmPasswordInput, 'Please confirm your password.');
                isValid = false;
            } else if (passwordInput.value !== confirmPasswordInput.value) {
                event.preventDefault();
                showError(confirmPasswordInput, 'Passwords do not match.');
                isValid = false;
            } else {
                showSuccess(confirmPasswordInput);
            }

            if (addressInput.value === '') {
                event.preventDefault();
                showError(addressInput, 'Please enter your address.');
                isValid = false;
            } else {
                showSuccess(addressInput);
            }

            if (!isValid) {
                event.preventDefault();
            } else {
                // Disable submit button after successful validation
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
            }
        });

        function showError(input, message) {
            const formGroup = input.parentElement;
            const errorDiv = formGroup.querySelector('.error');

            if (errorDiv) {
                errorDiv.remove();
            }

            const error = document.createElement('div');
            error.className = 'error';
            error.innerText = message;

            formGroup.appendChild(error);
            formGroup.classList.add('has-error');
        }

        function showSuccess(input) {
            const formGroup = input.parentElement;
            const errorDiv = formGroup.querySelector('.error');

            if (errorDiv) {
                errorDiv.remove();
            }

            formGroup.classList.remove('has-error');
        }

        function isValidEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        function isValidPhoneNumber(phone) {
            const regex = /^\d{10}$/;
            return regex.test(phone);
        }

        function isValidPassword(password) {
            return password.length >= 6;
        }
    });
    </script>
</body>

</html>