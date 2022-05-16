//Preloader
(function ($) {
    'use strict';
    $(window).on('load', function () {
        if ($(".pre-loader").length > 0) {
            $(".pre-loader").fadeOut("slow");
        }
    });
})(jQuery)


// Doctor Slider
$(document).ready(function () {
    $('.slider-active').owlCarousel({
        loop: false,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,

            },
            600: {
                items: 2,

            },
            1000: {
                items: 3,
            }
        }
    })

    $('.price-slider-active').owlCarousel({
        loop: false,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,

            },
            600: {
                items: 2,

            },
            1000: {
                items: 3,
            }
        }
    });
});
$(document).ready(function () {
    // -------------------sticky menu---------------------
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
        if (scroll < 245) {
            $(".sticky").removeClass("header-sticky");
        } else {
            $(".sticky").addClass("header-sticky");
        }
    });
});


//SSL
$(document).ready(function () {
    $('#sslczPay').click(function () {
        $('#addCasePayment').modal('show')
    })
    $('#sslczPayBtn').click(function (e) {
        e.preventDefault();
        var obj = {};
        obj.cus_price = $('#total_price').val();
        obj.cus_case_id = $('#case_id').val();
        obj.cus_mobile = $('#cus_mobile').val();
        obj.cus_addr = $('#cus_addr').val();
        obj.amount = $('#INSTRALLMENT').val();
        // console.log(obj)
        $('#sslczPayBtn').prop('postdata', obj);
        $('#addCasePayment').modal('hide').data('bs.modal', null);
        $('.modal-backdrop').remove();
    });
});
(function (window, document) {
    var loader = function () {
        var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
        // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
        script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
        tag.parentNode.insertBefore(script, tag);
    };

    window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
})(window, document);

//Covid
$(document).ready(function () {
    var updated=$("#updated");
    var death = $("#death");
    var newEffected = $('#newEffected');
    var recovered = $('#recovered');
    var totalEffected = $('#totalEffected');
    const covid = async () => {
        try {
            var data = await fetch('https://corona.lmao.ninja/v2/countries/50');
            var res = await data.json();
            updated.text(res.updated)
            death.text(res.todayDeaths)
            newEffected.text(res.todayCases)
            recovered.text(res.todayRecovered)
            totalEffected.text(res.cases)
        } catch (error) {
            updated.text("Updating...")
            death.text("Updating...")
            newEffected.text("Updating...")
            recovered.text("Updating...")
            totalEffected.text("Updating...")
        }
    }
    covid();
});

//offline
setInterval(() => {
    if (navigator.onLine !== true) {
        toastr["success"]("You Are Currently Offline!");
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "4000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    }
}, 5000);


// //selection
// let mode = JSON.parse(localStorage.getItem("theme_mode"));
// const check_toggle = document.querySelector("#check_toggle");
// const toggle = document.querySelector(".toggle");
// const toggle_icon = document.querySelector(".toggle_icon");
// const check_box = document.querySelector(".check_box");
// const body = document.body;
// const img = document.querySelector('img');
// //darkmode
// window.addEventListener("load", () => {
//     if (mode == true) {
//         $('head').append(`
// <style>
// html{
//     filter: invert(1) hue-rotate(180deg);
// }
// img{
//     filter: invert(1) hue-rotate(180deg);
// }
// </style>
// `)
//         check_box.checked = true
//         check_toggle.classList.add('toggle_effect');
//         toggle_icon.classList.remove('fa-moon');
//         toggle_icon.classList.add('fa-sun');
//     }
// })
// check_toggle.addEventListener('click', () => {
//     check_toggle.classList.toggle('toggle_effect');
//     toggle_icon.classList.toggle('fa-sun');
//     toggle_icon.classList.toggle('fa-moon');
//     if (check_box.checked) {
//         $('head').append(`
// <style>
// html{
//     filter: invert(0) hue-rotate(0deg);
// }
// img{
//     filter: invert(0) hue-rotate(0deg);
// }
// </style>
// `)
//         localStorage.setItem('theme_mode', false)
//         check_box.checked = false;
//     } else {
//         localStorage.setItem('theme_mode', true)
//         check_box.checked = true;
//         $('head').removeAttr(`
// <style>
// html{
//     filter: invert(1) hue-rotate(180deg);
// }
// img{
//     filter: invert(1) hue-rotate(180deg);
// }
// </style>
// `)
//     }
// })

// $('[data-action="sidebar_toggle"]').click(function () {
//     // if (window.innerWidth > 991) {
//     if (window.innerWidth > 375) {
//         document.getElementById("page-container").classList.toggle('sidebar-o')
//     } else {
//         document.getElementById("page-container").classList.toggle('sidebar-o-xs')
//     }
// })

$(document).ready(function () {
    $('[data-action="sidebar_toggle"]').click(function () {
        if (window.innerWidth > 991) {
            $("#page-container").toggleClass('sidebar-o');
        } else {
            $("#page-container").toggleClass('sidebar-o-xs');
        }
    })
});
