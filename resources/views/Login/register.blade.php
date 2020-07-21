<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="pebas - http://themeforest.net/user/pebas/">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
   
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


    <!-- Title -->
    <title>MRP - HEN-D </title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="images/favico.png">

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- Lightbox -->
    <link href="{{asset('css/ekko-lightbox.css')}}" rel="stylesheet">
    <link href="{{asset('css/dark.css')}}" rel="stylesheet">

    <!-- Calendar -->
    <link href="{{asset('css/zabuto_calendar.min.css')}}" rel="stylesheet">

    <!-- Template -->
    <link href="{{asset('style.css')}}" rel="stylesheet">

    <!-- Custom Color -->
    <link href="{{asset('css/color.css')}}" rel="stylesheet">

    <!-- Custom Box -->
    <link href="{{asset('css/box.css')}}" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js">
</script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js">
</script>
<![endif]-->
</head>

<body>
    <!-- preloader -->
    <div class='preloader'>
        <div class="preloader-content-wrapper">
            <div class="preloader-content">
                <i class="fa fa-cog fa-3x fa-spin"></i>
            </div>
        </div>
    </div>
    <!-- .preloader -->

    <!-- top bar -->
    <header class="top-bar">
        <div class="container">
            <div class="row">
                <!-- languages -->
                <div class="col-md-4 col-xs-6">
                    <div class="languages nav-root">
                        <!-- trigger -->
                        <div class="pt-nav-trigger">
                            <button><i class="fa fa-globe"></i> English <i class="fa fa-angle-down"></i>
                            </button>
                        </div>
                        <!-- trigger -->

                        <!-- menu list -->
                        <nav class="pt-nav">
                            <ul>
                                <li><a href="#"><i class="fa fa-globe"></i> English <i class="fa fa-angle-down"></i></a>

                                    <ul>
                                        <li><a href="#">Netherland</a>
                                        </li>
                                        <li><a href="#">France</a>
                                        </li>
                                        <li><a href="#">Russian</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- .menu list -->
                        </nav>
                    </div>
                </div>
                <!-- .languages -->

                <!-- add info -->
                <div class="col-md-8 col-xs-12 clearfix">
                    <div class="add-info">

                        <!-- menu list -->
                        <nav>
                            <ul class="list-inline">
                                <li><a href="#"><i class="fa fa-phone"></i> +380 (0)222 3543</a>
                                </li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i> loremim@dolorsit.com</a>
                                </li>
                            </ul>
                            <!-- .menu list -->
                        </nav>

                    </div>
                </div>
                <!-- .add info -->
            </div>
        </div>
    </header>
    <!-- .top bar -->




    <!-- vertical tab -->
<section>
    <div class="container-fluid">
        @include('flash-message')
        <div class="row">
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <!-- Icon -->
                    <a href="MRP-Dashboard.html">
                    <img src="{{asset('images/logo.png')}}" alt="HTML tutorial"/>
                    </a>
                </div>
            </div>
           
           <div class="col-sm-12">
                <div class="pos-rel">
                    <!-- Nav pills -->
                    <ul class="nav nav-pills justify-content-center nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary" data-toggle="pill" style="background-color:#cc0000">Personal Details</a>
                        </li>
                    </ul>
                    <div class="connected-line"></div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="organizer-details" class="container">
                            <div class="seminor-login-form">
                                {!! Form::open(['route' => 'register.store']) !!}
                                <div class="form-group">
                                    <input class="form-control" required autocomplete="off" name="name">
                                    <label class="form-control-placeholder">Name</label>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" required autocomplete="off" name="email">
                                    <label class="form-control-placeholder" for="email">Email</label>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required autocomplete="off" name="position">
                                    <label class="form-control-placeholder" for="contact-person">Position</label>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required autocomplete="off" name="contact_number">
                                    <label class="form-control-placeholder" for="contact-number">Contact Number</label>
                                </div>
                            </div>
                        </div>
                        <!-- Nav pills -->
                    <ul class="nav nav-pills justify-content-center nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary" data-toggle="pill" style="background-color:#cc0000">Institutional Details</a>
                        </li>
                    </ul>
                    <div class="connected-line"></div>
                        <div  class="container">
                            <div class="seminor-login-form">
                                <div class="form-group">
                                    <input class="form-control" required autocomplete="off" name="school">
                                    <label class="form-control-placeholder" for="contact-person">School Name</label>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required autocomplete="off" name="address">
                                    <label class="form-control-placeholder" for="contact-email">School Address</label>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required autocomplete="off" name="student_no" type="number">
                                    <label class="form-control-placeholder" for="student_no">Number Of Student</label>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required autocomplete="off" name="office_number">
                                    <label class="form-control-placeholder" for="contact-number">Office Number</label>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-pills justify-content-center nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary" data-toggle="pill" style="background-color:#cc0000">Set Up Password</a>
                            </li>
                        </ul>
                    <div class="container">
                        <div class="seminor-login-form">
                            <div class="form-group">
                                <label class="form-control-placeholder" for="contact-person">Password</label>
                                <input type="password" minlength="8" class="form-control text-left" required autocomplete="off" name="password"
                                id="password" style="background-color: #fff; text-align: left;">
                            </div>
                            <div class="form-group">
                                <label class="form-control-placeholder" for="contact-email">Password Confirmation</label>
                                <input type="password" class="form-control text-left" required autocomplete="off" id="confirm_password"
                                oninput="check(this)" name="confirm_password" style="background-color: #fff; text-align: left;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="container-checkbox">
                                I'am the contact person and responsible for the info provided.
                            <input type="checkbox" required>
                            <span class="checkmark-box"></span>
                            </label>
                        </div>
                        <div class="btn-check-log">
                            {{-- <button type="submit" class="btn-check-login">Submit</button> --}}
                            {!! Form::submit('Submit', ['class' => 'btn-check-login']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        
<!-- sponsor logos -->
    <section class="box-section sponsors">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <!-- 1 -->
                        <div class="col-md-2">
                            <div class="sponsor-logo text-center">
                                <a href="#">
                                    <img src="images/logo_1.png" title="" alt="" />
                                </a>
                            </div>
                        </div>
                        <!-- .1 -->
                        <!-- 2 -->
                        <div class="col-md-2">
                            <div class="sponsor-logo text-center">
                                <a href="#">
                                    <img src="" title="" alt="" />
                                </a>
                            </div>
                        </div>
                        <!-- .2 -->
                        <!-- 3 -->
                        <div class="col-md-2">
                            <div class="sponsor-logo text-center">
                                <a href="#">
                                    <img src="" title="" alt="" />
                                </a>
                            </div>
                        </div>
                        <!-- .3 -->
                        <!-- 4 -->
                        <div class="col-md-2">
                            <div class="sponsor-logo text-center">
                                <a href="#">
                                    <img src="" title="" alt="" />
                                </a>
                            </div>
                        </div>
                        <!-- .4 -->
                        <!-- 5 -->
                        <div class="col-md-2">
                            <div class="sponsor-logo text-center">
                                <a href="#">
                                    <img src="" title="" alt="" />
                                </a>
                            </div>
                        </div>
                        <!-- .5 -->
                        <!-- 6 -->
                        <div class="col-md-2">
                            <div class="sponsor-logo text-center">
                                <a href="#">
                                    <img src="" title="" alt="" />
                                </a>
                            </div>
                        </div>
                        <!-- 6 -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- .sponsor logos -->

    <!-- logo & social -->
    <section class="blue-background ">
        <div class="container ">
            <div class="row ">

                <!-- logo -->
                <div class="col-md-6 col-xs-6 text-left ">
                    <div class="logo-white ">
                        <a href="# ">
                            <img src="images/logo_white.png " title=" " alt=" " />
                        </a>
                    </div>
                </div>
                <!-- .logo -->

                <!-- social -->
                <div class="col-md-6 col-xs-6 text-right ">
                    <ul class="social list-inline list-unstyled ">
                        <li><a href="# "><i class="fa fa-twitter-square "></i></a>
                        </li>
                        <li><a href="# "><i class="fa fa-facebook-square "></i></a>
                        </li>
                        <li><a href="# "><i class="fa fa-google-plus-square "></i></a>
                        </li>
                    </ul>
                </div>
                <!-- .social -->

            </div>
        </div>
    </section>
    <!-- .logo & social -->


    <!-- footer -->
    <footer class="dark-background ">
        <div class="container ">
            <div class="row ">

                <!-- footer menu -->
                <div class="col-md-6 col-xs-6 text-left ">
                    <ul class="list-unstyled list-inline ">
                        <li>
                            <a href="# ">Home</a>
                        </li>
                        <li>
                            <a href="# ">Pages</a>
                        </li>
                        <li>
                            <a href="# ">Causes</a>
                        </li>
                        <li>
                            <a href="# ">Events</a>
                        </li>
                        <li>
                            <a href="# ">Gallery</a>
                        </li>
                        <li>
                            <a href="# ">Blog</a>
                        </li>
                        <li>
                            <a href="# ">Shop</a>
                        </li>
                        <li>
                            <a href="# ">Contact</a>
                        </li>
                        <li>
                            <a href="# ">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="# ">Terms</a>
                        </li>
                    </ul>
                </div>
                <!-- footer menu -->

                <!-- copyrights -->
                <div class="col-md-6 col-xs-6 text-right ">
                    <p>&copy; 2014 GORISING - All rights reserved - made by pebas</p>
                </div>
                <!-- .copyrights -->
            </div>
        </div>
    </footer>
    <!-- .footer -->

    <!-- jQuery (necessary for Bootstrap 's JavaScript plugins) -->
    <script src={{asset('js/jquery-1.11.1.min.js')}}></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src={{asset('js/jquery.nicescroll.min.js')}}></script>
    <script src={{asset('js/bootstrap.min.js')}}></script>

    <!-- Include all template custom js -->
    <script src={{asset('js/jquery.downCount.js')}}></script>
    <script src={{asset('js/bootstrap-slider.js')}}></script>
    <script src={{asset('js/zabuto_calendar.min.js')}}></script>
    <script src={{asset('js/ekko-lightbox.js')}}></script>
    <script src={{asset('js/custom.js')}}></script>
    <script language='javascript' type='text/javascript'>
        function check(input) {
            console.log(input.value)
            console.log(document.getElementById('password').value)
            if (input.value != document.getElementById('password').value) {
                input.setCustomValidity('Password is not match');
            } else {
                // input is valid -- reset the error message
                input.setCustomValidity('');
            }
        }
    </script>
</body>

</html>
