
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASEURL; ?>lib/easing/easing.min.js"></script>
<script src="<?= BASEURL; ?>lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Contact Javascript File -->
<script src="<?= BASEURL; ?>mail/jqBootstrapValidation.min.js"></script>
<script src="<?= BASEURL; ?>mail/contact.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"
integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Template Javascript -->
<script src="<?= BASEURL; ?>js/main.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>



