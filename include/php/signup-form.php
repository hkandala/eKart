<i class="mdi-navigation-arrow-back"></i>
<h2>Sign Up</h2>
<form class="signup-form" action="include/php/signupCheck.php" method="post">
    <div class="col six">
        <div class="input-field">
            <i class="mdi-action-account-circle prefix"></i>
            <input type="text" name="fname" id="fname" class="validate"/>
            <label for="fname">First Name</label>
        </div>
    </div>
    <div class="col six">
        <div class="input-field">
            <i class="mdi-action-account-circle prefix"></i>
            <input type="text" name="lname" id="lname" class="validate"/>
            <label for="lname">Last Name</label>
        </div>
    </div>
    <div class="col six">
        <div class="input-field">
            <i class="mdi-communication-email prefix"></i>
            <input type="email" name="email" id="email" class="validate"/>
            <label for="email">Email ID</label>
        </div>
    </div>
    <div class="col six">
        <div class="input-field">
            <i class="mdi-communication-phone prefix"></i>
            <input type="text" name="phoneno" id="phoneno" class="validate"/>
            <label for="phoneno">Phone Number(+91)</label>
        </div>
    </div>
    <div class="col six">
        <div class="input-field">
            <i class="mdi-action-lock prefix"></i>
            <input type="password" name="password" id="password" class="validate"/>
            <label for="password">Password</label>
        </div>
    </div>
    <div class="col six">
        <div class="input-field">
            <i class="mdi-action-lock prefix"></i>
            <input type="password" name="confirmpassword" id="confirmpassword" class="validate"/>
            <label for="confirmpassword">Confirm Password</label>
        </div>
    </div>
    <div class="col six">
        <div class="input-field">
            <i class="mdi-action-lock prefix"></i>
            <input type="text" name="dob" id="dob" class="validate"/>
            <label for="dob">Date of Birth (yyyy-mm-dd)</label>
        </div>
    </div>
    <div class="col six">
        <div class="loadingButton">
            <input type="submit" class="btn-large" value="Submit"/>
            <div class="preloader-wrapper small active">
                <div class="spinner-layer spinner-green-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p class="feedback"></p>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('.signup-block .mdi-navigation-arrow-back').click(function () {
            $('#login .modal-content .login-block').show();
            $('#login .progress').hide();
            $('#login .modal-content .signup-block').hide();
        });
        $(".signup-form").submit(function(e) {
            e.preventDefault();
            return signUpValidate();
        });

        $(".signup-block #fname").blur(function () {
            if(!fnameValidate()) {
                $(".signup-block #fname").addClass("invalid").removeClass("valid");
            } else {
                $(".signup-block #fname").addClass("valid").removeClass("invalid");
            }
        });
        $(".signup-block #lname").blur(function () {
            if(!lnameValidate()) {
                $(".signup-block #lname").addClass("invalid").removeClass("valid");
            } else {
                $(".signup-block #lname").addClass("valid").removeClass("invalid");
            }
        });
        $(".signup-block #email").blur(function () {
            if(!emailValidate()) {
                $(".signup-block #email").addClass("invalid").removeClass("valid");
            } else {
                $(".signup-block #email").addClass("valid").removeClass("invalid");
            }
        });
        $(".signup-block #phoneno").blur(function () {
            if(!phoneNoValidate()) {
                $(".signup-block #phoneno").addClass("invalid").removeClass("valid");
            } else {
                $(".signup-block #phoneno").addClass("valid").removeClass("invalid");
            }
        });
        $(".signup-block #password").blur(function () {
            if(!passwordValidate()) {
                $(".signup-block #password").addClass("invalid").removeClass("valid");
            } else {
                $(".signup-block #password").addClass("valid").removeClass("invalid");
            }
        });
        $(".signup-block #confirmpassword").blur(function () {
            if(!confirmPasswordValidate()) {
                $(".signup-block #confirmpassword").addClass("invalid").removeClass("valid");
            } else {
                $(".signup-block #confirmpassword").addClass("valid").removeClass("invalid");
            }
        });
        $(".signup-block #dob").blur(function () {
            if(!dobValidate()) {
                $(".signup-block #dob").addClass("invalid").removeClass("valid");
            } else {
                $(".signup-block #dob").addClass("valid").removeClass("invalid");
            }
        });
    });

    function fnameValidate() {
        var letters = /^[a-z ,.'-]+$/i;
        var name = $(".signup-block #fname").val();
        return letters.test(name);
    }

    function lnameValidate() {
        var letters = /^[a-z ,.'-]+$/i;
        var name = $(".signup-block #lname").val();
        return letters.test(name);
    }

    function emailValidate() {
        var mail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,4}))$/;
        var em = $(".signup-block #email").val();
        return mail.test(em);
    }

    function phoneNoValidate() {
        var numbers = /[^0-9]/;
        var cont = $(".signup-block #phoneno").val();
        return cont.length!='' ? (cont.length == 10 && !numbers.test(cont) && cont.charAt(0) != "0") : true;
    }

    function passwordValidate() {
        var pass = $(".signup-block #password").val();
        return (pass.length >= 5);
    }

    function confirmPasswordValidate() {
        var pass = $(".signup-block #confirmpassword").val();
        if (pass.length >= 5) {
            return (pass === $(".signup-block #password").val());
        } else {
            return false;
        }
    }

    function dobValidate() {
        var valid = true;
        var date = $(".signup-block #dob").val();
        if(date != '' && date.length != 10) {
            valid = false;
        }

        date = date.replace(/-/g, '');
        console.log(date);
        var year = parseInt(date.substring(0, 4),10);
        var month   = parseInt(date.substring(4, 6),10);
        var day  = parseInt(date.substring(6, 8),10);
        console.log(day + '-' + month + '-' + year);

        if((month < 1) || (month > 12)) valid = false;
        else if((day < 1) || (day > 31)) valid = false;
        else if(((month == 4) || (month == 6) || (month == 9) || (month == 11)) && (day > 30)) valid = false;
        else if((month == 2) && (((year % 400) == 0) || ((year % 4) == 0)) && ((year % 100) != 0) && (day > 29)) valid = false;
        else if((month == 2) && ((year % 100) == 0) && (day > 29)) valid = false;

        return valid;
    }

    function signUpValidate () {
        if(!fnameValidate()) {
            $(".signup-block #fname").addClass("invalid").removeClass("valid");
        }
        if(!lnameValidate()) {
            $(".signup-block #lname").addClass("invalid").removeClass("valid");
        }
        if(!emailValidate()) {
            $(".signup-block #email").addClass("invalid").removeClass("valid");
        }
        if(!phoneNoValidate()) {
            $(".signup-block #phoneno").addClass("invalid").removeClass("valid");
        }
        if(!passwordValidate()) {
            $(".signup-block #password").addClass("invalid").removeClass("valid");
        }
        if(!confirmPasswordValidate()) {
            $(".signup-block #confirmpassword").addClass("invalid").removeClass("valid");
        }
        if(!dobValidate()) {
            $(".signup-block #dob").addClass("invalid").removeClass("valid");
        }
        if(fnameValidate() && lnameValidate() && emailValidate() && phoneNoValidate() && passwordValidate() && confirmPasswordValidate() && dobValidate()) {
            var signUpObj = {
                fname: $(".signup-block #fname").val(),
                lname: $(".signup-block #lname").val(),
                email: $(".signup-block #email").val(),
                phoneno: $(".signup-block #phoneno").val(),
                password: $(".signup-block #password").val(),
                dob: $(".signup-block #dob").val()
            };
            $(".signup-form .loadingButton .preloader-wrapper").fadeIn('fast');
            $.post('include/php/signupCheck.php', signUpObj, function(response) {
                if(response == "You have successfully registered") {
                    $(".signup-form .loadingButton .preloader-wrapper").fadeOut('fast');
                    $('.signup-form .feedback').html("You have successfully registered.");
                    setTimeout(function () {
                        $('#login .modal-content .login-block').show();
                        $('#login .progress').hide();
                        $('#login .modal-content .signup-block').hide();
                    }, 1000);
                } else if(response != '') {
                    $(".signup-form .loadingButton .preloader-wrapper").fadeOut('fast');
                    $('.signup-form .feedback').html(response);
                } else {
                    $(".signup-form .loadingButton .preloader-wrapper").fadeOut('fast');
                    $('.signup-form .feedback').html('Unknown Error, Please try again');
                }
            }).fail(function() {
                $(".signup-form .loadingButton .preloader-wrapper").fadeOut('fast');
                $('.signup-form .feedback').html('Unable to connect to the network');
            });
        }

        return (fnameValidate() && lnameValidate() && emailValidate() && phoneNoValidate() && passwordValidate() && confirmPasswordValidate() && dobValidate());
    }
</script>