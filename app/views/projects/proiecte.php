<?php require APPROOT . '/views/initial/header.php';?>
<div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">Proiecte</h1><br>
        <?php if (!empty($data['proiect'])){?>
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Denumire</th>
                <th scope="col">Descriere</th>
                <th scope="col" colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                $nr = 0;
                foreach ($data['proiect'] as $proiect){
                                $nr += 1;?>
                                  <tr>
                                  <th scope="row"><?php echo $nr;?></th>
                                  <td><?php echo $proiect->denumire;?></td>
                                  <td><?php echo $proiect->descriere;?></td>
                                  <td><form class = "pull-right" action="<?php echo URLROOT;?>/projects/stergeProiect/<?php echo $proiect->id; ?>" method="post">
                                      <button type="submit" class = "btn btn-danger" onclick="return alert('Are You sure?')">Sterge</button>
                                      </form></td>
                                      <td><a href="<?php echo URLROOT;?>/projects/modificaProiect/<?php echo $proiect->id;?>" class ="btn btn-dark">Modifca</a></td>
                                  </tr>
                                <?php
                            }?>
            </tbody>
        </table>
        <?php }else{
              echo "<h6 class='mt-5'>Nu exista inregistrari</h6>";
        }?>
        <?php if(!empty($data['error'])){?>
        <div  class="alert alert-danger" role="alert"><?php echo $data['error'];?></div>
      <?php }?>
      </div>
    </div>
  </div>
  <?php require APPROOT . '/views/initial/footer.php';?>