<footer class="w-100 pt-xl-5 pb-xl-5 pt-3 pb-3">
    <div class="container container-custom">
        <div class="row">
            <div class="col-xl-3 col-12 text-center text-xl-left">
                <div class="logo-footer w-100">
                    <a href='index.html'><img src="{{asset('public/frontend_updated/img/logo-footer.png')}}" alt="Organic Food"></a>
                </div>
            </div>
            <div class="col-xl-9 col-12 d-xl-flex justify-content-end nav-links">
                <ul class="list-inline col-xl-7 col-12 px-sm-3 px-0 mx-xl-0 mx-auto d-flex justify-content-between" role="navigation">
                    <li class="list-inline-item"><a class="text-white" href="#">How it works</a></li>
                    <li class="list-inline-item"><a class="text-white" href="#">About</a></li>
                    <li class="list-inline-item"><a class="text-white" href="#">Help</a></li>
                    <li class="list-inline-item"><a class="text-white" href="#">FAQ</a></li>
                    <li class="list-inline-item"><a class="text-white" href="#">Contact</a></li>
                </ul>
                <ul class="social-networks list-inline col-xl-2 col-4 d-flex justify-content-between mx-xl-3 mx-auto my-xl-0 mt-2">
                    <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                </ul> 
            </div>
        </div>
    </div>
</footer>
<!-- jQuery -->
<script src="{{asset('public/frontend_updated/js/jquery-slim.min.js')}}"></script>
<script src="{{asset('public/frontend_updated/js/jquery.min.js')}}"></script>
<script src="{{asset('public/frontend_updated/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/frontend_updated/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/frontend_updated/js/slick.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<!--<script src="sweetalert2.all.min.js"></script>-->
<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
   <!--<script src="{{asset('public/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>-->
<!--<script src="{{asset('public/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>-->
<script>
$('.dropdown-menu a').click(function () {
$('a.dropdown-toggle').text($(this).text());
$('a.dropdown-toggle').val($(this).text()).addClass('add')
        .append('<i class="fas fa-chevron-down"></i>');
});

//dropdown button changing value
$('.dropdown-menu button').click(function () {
$('button.dropdown-toggle').text($(this).text());
$('button.dropdown-toggle').val($(this).text()).prepend("<img src='{{asset('public/frontend_updated/img/ico-cal.png')}}'>");
});

//slick slider initiator
$(document).ready(function () {
$('.product-gallery').slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});


$(".checkBox").change(function () {
    $(".checkBox").prop('checked', false);
    $(this).prop('checked', true);
});




const menuIconEl = $('.menu-icon');
const sidenavEl = $('.sidenav');
const sidenavCloseEl = $('.sidenav__close-icon');

// Add and remove provided class names
function toggleClassName(el, className) {
    if (el.hasClass(className)) {
        el.removeClass(className);
    } else {
        el.addClass(className);
    }
}

// Open the side nav on click
menuIconEl.on('click', function () {
    toggleClassName(sidenavEl, 'active');
});

// Close the side nav on click
sidenavCloseEl.on('click', function () {
    toggleClassName(sidenavEl, 'active');
});
});




$('#example').DataTable();
</script>