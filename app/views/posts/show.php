<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<h1><?php echo $data['post']->tittle; ?></h1>
<div class="bg-secondary">
    Written by <?php echo $data['user']->name; ?>
</div>
<p><?php echo $data['post']->body?></p>
<hr>
<?php if($data['post']->user_id==$_SESSION['user_id']):?>
    <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id;?>" class="btn btn-dark">Edit</a>
    <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
        <input type="submit" value="Delete" class="btn btn-danger">
    </form>
<?php endif;?>

<?php require APPROOT . '/views/inc/footer.php'; ?>
