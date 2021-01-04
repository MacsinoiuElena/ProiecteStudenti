<?php require APPROOT . '/views/initial/header.php';?>
<div class="jumbotron jumbotron-flud">
    <div class="container">
        <h1 class="display-5"><?php echo $data['title'];?></h1>
        <p class="lead">
          <ul>
            <li><?php echo $data['description1'];?></li>
            <li><?php echo $data['description2'];?></li>
          </ul></p>
    </div>
</div>
  <?php require APPROOT . '/views/initial/footer.php';?>