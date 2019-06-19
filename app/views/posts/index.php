<?php require APPROOT.'/views/inc/header.php';?>
  <div class="row mb-3">
    <div class="col-md-6 ">
      <h1>POSTS</h1>
    </div>
    <div class="col-md-6">
      <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil">Add Post</i>
      </a>
    </div>
  </div>

  <?php foreach($data['post'] as $post): ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $post->title;?></h4>
      <div class="bg-light p-2 mb-3">
        Wtitten by user  <?php echo $post->name; ?> on <?php echo  $post->created_at ?>
      </div>
      <p class="card-text"><?php echo $post->body ?></p>
      <a href="<?php echo URLROOT; ?>/posts/show/<?php  echo $post->postId?>"class="btn btn-dark">MORE</a>
    </div>
  <?php endforeach; ?>
<?php require APPROOT.'/views/inc/footer.php';?>
