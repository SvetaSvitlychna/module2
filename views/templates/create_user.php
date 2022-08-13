<?php if (!session_id()) @session_start();
$this->layout('template', ['title' => 'Create user']);?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-primary-gradient">
        <a class="navbar-brand d-flex align-items-center fw-500" href="users.php"><img alt="logo" class="d-inline-block align-top mr-2" src="img/logo.png"> Учебный проект</a> <button aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarColor02" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php if(!$auth->isLoggedIn()):?>
                        <a class="nav-link" href="/login">Войти</a>
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
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-plus-circle'></i> Добавить пользователя
            </h1>



        </div>
        <form action="/create" method="POST" enctype="multipart/form-data">
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
                                    <label class="form-label" for="simpleinput">Имя</label>
                                    <input type="text" id="simpleinput" class="form-control" name="first_name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Surname</label>
                                    <input type="text" id="simpleinput" class="form-control" name="last_name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Username</label>
                                    <input type="text" id="simpleinput" class="form-control" name="username">
                                </div>
                                <!-- title -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Job</label>
                                    <input type="text" id="simpleinput" class="form-control" name="job">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Company</label>
                                    <input type="text" id="simpleinput" class="form-control" name="company">
                                </div>

                                <!-- tel -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Phone</label>
                                    <input type="text" id="simpleinput" class="form-control" name="phone">
                                </div>

                                <!-- address -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Address</label>
                                    <input type="text" id="simpleinput" class="form-control" name="user_address">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Security and media</h2>
                            </div>
                            <div class="panel-content">
                                <!-- email -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Email</label>
                                    <input type="text" id="simpleinput" class="form-control" name="email">
                                </div>

                                <!-- password -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Password</label>
                                    <input type="password" id="simpleinput" class="form-control" name="password">
                                </div>

                                
                                <!-- status -->
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Choose status</label>
                                    <select class="form-control" id="example-select" name="status">
                                        <?php $statusList ;
                                        foreach ($statusList as $key =>$status):?>
                                            <option  name="<?php echo $key?>" value="<?php echo $key ?>">
                                            <?php echo $status;?>
                                            </option>
                                        <?php endforeach; ?>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="example-fileinput">Avatar upload</label>
                                    <input type="file" id="example-fileinput" class="form-control-file" name="image">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="col-xl-12">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Nets</h2>
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- telegram -->
                                        <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="base-7 icon-stack-3x" style="color:#4680C2"></i>
                                                        <i class="fab fa-telegram icon-stack-1x text-white"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control border-left-0 bg-transparent pl-0" name="telegram">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- facebook -->
                                        <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="base-7 icon-stack-3x" style="color:#38A1F3"></i>
                                                        <i class="fab fa-facebook icon-stack-1x text-white"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control border-left-0 bg-transparent pl-0" name="fb">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                        <button class="btn btn-success">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script src="/../js/vendors.bundle.js"></script>
    <script src="/../js/app.bundle.js"></script>
    <script>

        $(document).ready(function()
        {

          
        });

    </script>
</body>
