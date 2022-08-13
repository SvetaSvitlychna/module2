<?php if(!session_id())  @session_start();
$this->layout('template', ['title' => 'page_profile'])?>
<body class="mod-bg-1 mod-nav-link">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-primary-gradient">
    <a class="navbar-brand d-flex align-items-center fw-500" href="users.php"><img alt="logo" class="d-inline-block align-top mr-2" src="img/logo.png"> Учебный проект</a> <button aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarColor02" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">

                <?php if(!$auth->isLoggedIn()):?>
                <a class="nav-link" href="/register">Sign up</a></li>

            <li class="nav-item">
                <a class="nav-link" href="/login">Log in</a> </li>

            <?php else:?>
                <li class="nav-item">
                    <a class="nav-link" href="/profile">Profile</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Log out</a></li>
            <?php endif;?>

        </ul>
    </div>
</nav>
        <main id="js-page-content" role="main" class="page-content mt-3">
            <div class="subheader">


                    <?php echo $status->displayStatus($user)?>
                <?php if(is_null($user['image'])):?>
                    <span class="rounded-circle profile-image d-block " style="background-image:url('/../img/demo/avatars/avatar-b.png'); background-size: cover;"></span>
                    </span>
                <?php else:?>
                <img src="uploads/<?php  echo $user['image']?>" class="rounded-circle shadow-2 img-thumbnail" alt="">
                <?php endif;?>
                <h1 class="subheader-title">
                     <?php echo $user['first_name'].' '.$user['last_name'];?>
                </h1>
            </div>
            <div class="row">
              <div class="col-lg-6 col-xl-6 m-auto">
                    <!-- profile summary -->
                    <div class="card mb-g rounded-top">
                        <div class="row no-gutters row-grid">
                            <div class="col-12">
                                <div class="d-flex flex-column align-items-center justify-content-center p-4">

                                    <img src="../../public/img/demo/avatars/avatar-admin-lg.png" class="rounded-circle shadow-2 img-thumbnail" alt="">
                                    <h5 class="mb-0 fw-700 text-center mt-3">
                                        <?php echo $user['first_name'].' '.$user['last_name'];?>
                                    </h5>
                                    <div class="mt-4 text-center demo">
<!--                                        <a href="javascript:void(0);" class="fs-xl" style="color:#C13584">-->
<!--                                            <i class="fab fa-instagram"></i>-->
<!--                                        </a>-->
                                        <a href="javascript:void(0);" class="fs-xl" style="color:#4680C2">
                                            <i class="fab fa-facebook-messenger"><?php echo $user['fb'];?></i>
                                        </a>
                                        <a href="javascript:void(0);" class="fs-xl" style="color:#0088cc">
                                            <i class="fab fa-telegram"><?php echo $user['telegram'];?></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3 text-center">
                                    <a href="tel:<?php echo $user['phone'];?>" class="mt-1 d-block fs-sm fw-400 text-dark">
                                        <i class="fas fa-mobile-alt text-muted mr-2"></i> <?php echo $user['phone'];?></a>
                                    <a href="mailto:<?php echo $user['email'];?>" class="mt-1 d-block fs-sm fw-400 text-dark">
                                        <i class="fas fa-mouse-pointer text-muted mr-2"></i> <?php echo $user['email'];?></a>
                                    <address class="fs-sm fw-400 mt-4 text-muted">
                                        <i class="fas fa-map-pin mr-2"></i> <?php echo $user['user_address'];?>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </main>
    </body>

    <script src="/../js/vendors.bundle.js"></script>
    <script src="/../js/app.bundle.js"></script>
    <script>

        $(document).ready(function()
        {

        });

    </script>
</html>