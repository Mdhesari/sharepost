<?php require_once APPROOT . '/views/inc/header.php';?>

<section class="row">
    <div id="profile_container" class="col-md-3 col-12">
        <div class="card">
            <!-- __profile__picture__ -->
            <img class="card-img-top ml-auto mr-auto mt-3"
                src="<?php echo URLROOT; ?>/assets/pictures/profile/default.jpg" alt="Your Picture">

            <!-- __content__ -->
            <div class="card-body">
                <!-- __title -->
                <h5 class="card-title text-center">
                    <?php echo $_SESSION['user_fullname']; ?>
                    <!-- Check user accessiblity -->
                    <?php if (isAdminMaster()): ?>
                    <i class="fa fa-star"></i>
                    <?php endif;?>
                </h5>

                <!-- __subtitle__ -->
                <h6 class="card-subtitle text-lead text-center text-muted">
                    <?php echo $data['user']->bio; ?>
                </h6>

                <!-- __info__ -->
                <ul class="list-group mt-2 text-silent">
                    <li class="list-group item my-2 text-muted">
                        <i class="fa fa-envelope">
                            <?php echo $data['user_posts_count']; ?></i>
                    </li>
                    <li class="list-group item my-2 text-muted">
                        <i class="fa fa-location-arrow"> Iran, Tehran
                            <!-- <?php echo var_export($data['location']); ?> --></i>
                    </li>
                </ul>
                <!-- __end__card__body -->
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-6">
                        <a class="text-link text-danger" href="#" id="logout-btn"
                            onclick="if   (confirm('Are you sure?! \nYou want to logout!')){
                        window.location = '<?php echo URLROOT; ?>/users/logout';
                        }">
                            <i class="fa fa-chevron-circle-right"></i> Logout
                        </a>
                    </div>
                    <div class="col-6 text-right ">
                        <a href="<?php echo URLROOT; ?>/users/dashboard" class="text-link text-primary">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                    </div>
                    <!-- __end__row -->
                </div>
                <!-- __end__card__footer -->
            </div>
            <!-- __end__card -->
        </div>
        <!-- __end__profile__container -->
    </div>

    <div id="posts_container" class="col-lg-8 col-md-9 col-12">
        <h3 class="display-4">My Posts
            <a href="<?php echo URLROOT; ?>/posts/add" class="text-link text-success ml-2" title="Add New Post">
                <i class="fa fa-plus-square"></i>
            </a>
        </h3>
        <!-- posts area -->
        <section class="mt-5" id="posts">
            <?php
flash('addpost-success');
flash('delete-success');
flash('editpost-success');
?>
            <?php if (empty($data['posts'])): ?>
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">No Posts yet!</h4>
                <p>share and spread your ideas with others...</p>
                <hr>
                <p class="mb-0">Whenever you had problem just read the guide page.</p>
            </div>
            <?php else: ?>
            <div class="card-columns">
                <?php foreach ($data['posts'] as $post): ?>
                <article class="card">
                    <?php if (strlen($post->image) > 8): ?>
                    <img src="<?php echo URLROOT; ?>/assets/pictures/posts/<?php echo $post->user_id . '/' . $post->image ?>"
                        class="card-img-top" alt="...">
                    <?php endif;?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $post->description; ?>
                        </h5>
                        <p class="card-text">
                            <?php echo $post->text; ?>
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->id; ?>" class="btn btn-link">Read
                            More</a>
                        <small class="text-muted">
                            <?php echo time_elapsed_string($post->date) ?></small>
                    </div>
                </article>
                <?php endforeach;?>
            </div>
            <?php endif;?>
        </section>
    </div>



</section>

<?php require_once APPROOT . '/views/inc/footer.php';?>