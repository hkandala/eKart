/*----------------------Main Script--------------------------*/
var signUpBlock = false;

$(document).ready(function () {
    $('.dropdown-button').dropdown({
            constrain_width: false,
            gutter: 0,
            belowOrigin: true
        }
    );
    $('#search-trigger').click(function () {
        $('nav.original').css('top', '-100px');
        setTimeout(function () {
            $('nav.search').css('top', '0');
            $('#search').focus();
        }, 300);
    });
    $('#search').on('focusout', function () {
        $('nav.search').css('top', '-100px');
        setTimeout(function () {
            $('nav.original').css('top', '0');
        }, 300);
    });
    $("#owl-demo").owlCarousel({
        autoPlay: 5000,
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true
    });
    $(".products").owlCarousel({
        items : 5,
        pagination: false
    }).each(function() {
        var owl = $(this);
        $(this).parent().find(".next-btn").click(function() {
            owl.trigger("owl.next");
        });
        $(this).parent().find(".prev-btn").click(function() {
            owl.trigger("owl.prev");
        });
    });
    $("#login .modal-content .mdi-navigation-close").click(function () {
        $("#login").closeModal();
    });
    $('.modal-trigger').leanModal();
    $('a[href=#login]').click(function () {
        $('#login .modal-content .login-block').show();
        $('#login .progress').hide();
        $('#login .modal-content .signup-block').hide();
    });
    $('#login span').click(function () {
        $('#login .modal-content .login-block').hide();
        if(!signUpBlock) {
            $('#login .progress').show();
            $("#login .modal-content .signup-block").load('include/php/signup-form.php', function() {
                $('#login .progress').hide();
                $('#login .modal-content .signup-block').show();
                signUpBlock = true;
            });
        } else {
            $('#login .modal-content .signup-block').show();
        }
    });
    $(".login-form").submit(function(e) {
        e.preventDefault();
        return loginValidate();
    });
    $(".login-block #loginEmail").blur(function () {
        if(!loginEmailValidate()) {
            $(".login-block #loginEmail").addClass("invalid").removeClass("valid");
        } else {
            $(".login-block #loginEmail").addClass("valid").removeClass("invalid");
        }
    });
    $(".login-block #loginPassword").blur(function () {
        if(!loginPasswordValidate()) {
            $(".login-block #loginPassword").addClass("invalid").removeClass("valid");
        } else {
            $(".login-block #loginPassword").addClass("valid").removeClass("invalid");
        }
    });
});

function loginEmailValidate() {
    var mail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,4}))$/;
    var em = $(".login-block #loginEmail").val();
    return mail.test(em);
}

function loginPasswordValidate() {
    var pass = $(".login-block #loginPassword").val();
    return (pass.length >= 5);
}

function loginValidate () {
    if(!loginEmailValidate()) {
        $(".login-block #loginEmail").addClass("invalid").removeClass("valid");
    }
    if(!loginPasswordValidate()) {
        $(".login-block #loginPassword").addClass("invalid").removeClass("valid");
    }
    if(loginEmailValidate() && loginPasswordValidate()) {
        var loginObj = {
            email: $(".login-block #loginEmail").val(),
            password: $(".login-block #loginPassword").val()
        };
        $(".login-form .loadingButton .preloader-wrapper").fadeIn('fast');
        $.post('include/php/loginCheck.php', loginObj, function(response) {
            if(response == 'Logged In') {
                $('.login-form .feedback').html(response);
                window.location = window.location;
            } else if (response != '') {
                $(".login-form .loadingButton .preloader-wrapper").fadeOut('fast');
                $('.login-form .feedback').html(response);
            } else {
                $(".login-form .loadingButton .preloader-wrapper").fadeOut('fast');
                $('.login-form .feedback').html('Unknown Error, Please try again');
            }
        }).fail(function() {
            $(".login-form .loadingButton .preloader-wrapper").fadeOut('fast');
            $('.login-form .feedback').html('Unable to connect to the network');
        });
    }
    return (loginEmailValidate() && loginPasswordValidate());
}
/*-----------------------------------------------------------*/