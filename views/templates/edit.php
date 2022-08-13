<?php if (!session_id()) @session_start();
$this->layout('template', ['title' => 'edit']);
//d(123);exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="description" content="Chartist.html">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
    <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-primary-gradient">
        <a class="navbar-brand d-flex align-items-center fw-500" href="users.php"><img alt="logo" class="d-inline-block align-top mr-2" src="img/logo.png"> Учебный проект</a> <button aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarColor02" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">

                    <?php if(!$auth->isLoggedIn()):?>

                    <a class="nav-link" href="/login">Войти</a> </li>
                <!--            </li>-->
                <!--            <li class="nav-item">-->
                <?php else:?>
                    <a class="nav-link" href="/logout">Выйти</a>
                <?php endif;?>
                </li>
            </ul>
        </div>
    </nav>
    <main id="js-page-content" role="main" class="page-content mt-3">
        <?php echo $flash->display(); ?>
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-plus-circle'></i> Редактировать
            </h1>

        </div>
        <form action="/edit" method="POST">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Общая информация</h2>
                            </div>
                            <div class="panel-content">
                                <!-- username -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Username</label>
                                    <input type="text" id="simpleinput" class="form-control"  name="username" value="<?php echo $user['username']?>">
                                </div>
                                <!-- first_name -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">First name</label>
                                    <input type="text" id="simpleinput" class="form-control"  name="first_name" value="<?php echo $user['first_name']?>">
                                </div>
                                <!-- last name -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Last name</label>
                                    <input type="text" id="simpleinput" class="form-control"  name="last_name" value="<?php echo $user['last_name']?>">
                                </div>
                                <!-- company -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Company</label>
                                    <input type="text" id="simpleinput" class="form-control" name="company" value="<?php echo $user['company']?>">
                                </div>
                                <!-- job -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Job</label>
                                    <input type="text" id="simpleinput" class="form-control" name="job" value="<?php echo $user['job']?>">
                                </div>

                                <!-- tel -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Phone</label>
                                    <input type="text" id="simpleinput" class="form-control" name="phone" value="<?php echo $user['phone']?>">
                                </div>

                                <!-- address -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">User Address</label>
                                    <input type="text" id="simpleinput" class="form-control" name="user_address" value="<?php echo $user['user_address']?>">
                                </div>
                                <div class="form-group">
                                    <input type="hidden"value="<?php echo $user['id']?>" name="id">
                                </div>
                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script src="../../public/js/vendors.bundle.js"></script>
    <script src="../../public/js/app.bundle.js"></script>
    <script>

        $(document).ready(function()
        {

            $('input[type=radio][name=contactview]').change(function()
                {
                    if (this.value == 'grid')
                    {
                        $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-g');
                        $('#js-contacts .col-xl-12').removeClassPrefix('col-xl-').addClass('col-xl-4');
                        $('#js-contacts .js-expand-btn').addClass('d-none');
                        $('#js-contacts .card-body + .card-body').addClass('show');

                    }
                    else if (this.value == 'table')
                    {
                        $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-1');
                        $('#js-contacts .col-xl-4').removeClassPrefix('col-xl-').addClass('col-xl-12');
                        $('#js-contacts .js-expand-btn').removeClass('d-none');
                        $('#js-contacts .card-body + .card-body').removeClass('show');
                    }

                });

                //initialize filter
                initApp.listFilter($('#js-contacts'), $('#js-filter-contacts'));
        });

    </script>
</body>
</html>