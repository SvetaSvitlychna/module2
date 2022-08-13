<?php  if (!session_id()) @session_start();
$this->layout('template', ['title' => 'registration']);

?>
<body>
    <div class="page-wrapper auth">
        <div class="page-inner bg-brand-gradient">
            <div class="page-content-wrapper bg-transparent m-0">
                <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                    <div class="d-flex align-items-center container p-0">
                        <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9 border-0">
                            <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                                <img src="img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                                <span class="page-logo-text mr-1">Учебный проект</span>
                            </a>
                        </div>
                        <span class="text-white opacity-50 ml-auto mr-2 hidden-sm-down">
                            Sign in?
                        </span>
                        <a href="/login" class="btn-link text-white ml-auto ml-sm-0">
                            Log in
                        </a>
                    </div>
                </div>
                <div class="flex-1" style="background: url(../../public/img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                        <div class="row">
                            <div class="col-xl-12">
                                <h2 class="fs-xxl fw-500 mt-4 text-white text-center">
                                    REGISTRATION

                                </h2>
                            </div>
                            <div class="col-xl-6 ml-auto mr-auto">
                                <div class="card p-4 rounded-plus bg-faded">
                                    <?php echo $flash->display(); ?>
                                    <form id="js-login" novalidate="" action="/register" method="POST">
                                        <div class="form-group">
                                            <label class="form-label" for="emailverify">Email</label>
                                            <input name="email" type="email" id="emailverify" class="form-control" placeholder="email" required>
                                            <div class="invalid-feedback">Field in the field.</div>
                                            <div class="help-block">Email will be your login for logging in</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="emailverify">Username</label>
                                            <input name="username" type="text" id="username" class="form-control" placeholder="username" required>
                                            <div class="invalid-feedback">Field in the field</div>
                                            <div class="help-block">Email will be your login for logging in</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="userpassword">Password <br></label>
                                            <input name="password" type="password" id="userpassword" class="form-control" placeholder="password" required>
                                            <div class="invalid-feedback">Field in the field</div>
                                        </div>
                                       
                                        <div class="row no-gutters">
                                            <div class="col-md-4 ml-auto text-right">
                                                <button id="js-login-btn" type="submit" class="btn btn-block btn-danger btn-lg mt-3">Sign in</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../../public/js/vendors.bundle.js"></script>
    <script>
        $("#js-login-btn").click(function(event)
        {

            // Fetch form to apply custom Bootstrap validation
            var form = $("#js-login")

            if (form[0].checkValidity() === false)
            {
                event.preventDefault()
                event.stopPropagation()
            }

            form.addClass('was-validated');
            // Perform ajax submit here...
        });

    </script>
</body>
</html>
