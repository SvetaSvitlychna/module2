<?php if (!session_id()) @session_start();
$this->layout('template', ['title' => 'media']);


?>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-primary-gradient">
    <a class="navbar-brand d-flex align-items-center fw-500" href="html/users.html"><img alt="logo" class="d-inline-block align-top mr-2" src="img/logo.png"> Учебный проект</a> <button aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarColor02" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
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
                    <a class="nav-link" href="/profile?id=<?php echo $auth->id(); ?>">Profile</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Log out</a></li>
            <?php endif;?>

        </ul>
    </div>
</nav>
<main id="js-page-content" role="main" class="page-content mt-3">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-image'></i> Avatar upload
        </h1>

    </div>
    <form action="/medias" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-6">
                <div id="panel-1" class="panel">
                    <div class="panel-container">
                        <?php echo $flash->display(); ?>
                        <div class="panel-hdr">

                            <h2>Current avatar</h2>

                        </div>
                        <div class="panel-content">
                            <div class="form-group">
                                <?php if(is_null($user['image'])):?>
                                    <span class="rounded-circle profile-image d-block " style="background-image:url('/../img/demo/avatars/avatar-b.png'); background-size: cover;"></span>
                                    </span>
                                <?php else:?>
                                    <img src="uploads/<?php  echo $user['image']?>" class="rounded-circle shadow-2 img-thumbnail" alt="" class="img-responsive" width="200">
                                <?php endif;?>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="example-fileinput">Choose avatar</label>
                                <input type="file" id="example-fileinput" class="form-control-file" name="image" value="<?php echo $user['image']?>">
                            </div>

                            <div class="form-group">
                                <input type="hidden"value="<?php echo $user['id']?>" name="id">
                            </div>
                            <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                <button class="btn btn-warning">Upload</button>
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

