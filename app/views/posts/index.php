<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php echo flash('post_added'); ?>
<?php echo flash('deleted'); ?>
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Posts</h1>
        </div>
        <div class="col-md-6">
            <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
                <i class="fa fa-pencil">Add Post</i>
            </a>
        </div>
    </div>
<?php foreach ($data['posts'] as $post): ?>
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $post->tittle; ?></h4>
        <div class="bg-light p-2 mb-3">
            Written by USER <?php echo $post->name ?> on <?php echo $post->postCreated ?>
        </div>
        <p class="card-text">
            <?php echo $post->body ?>
        </p>
        <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">More</a>
    </div>
<?php endforeach; ?>

<?php echo $_SESSION['user_name']; ?>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>