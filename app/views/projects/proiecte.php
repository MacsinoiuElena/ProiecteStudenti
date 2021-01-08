<?php require APPROOT . '/views/initial/header.php';?>
<div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">Lista Proiecte</h1><br>
        <?php if (!empty($data['proiect'])){?>
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Denumire</th>
                <th scope="col">Descriere</th>
                <th scope="col"></th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach ($data['proiect'] as $proiect){
                                ?>
                                  <tr>
                                  <th scope="row"><?php echo $proiect->id;?></th>
                                  <td><?php echo $proiect->denumire;?></td>
                                  <td><?php echo $proiect->descriere;?></td>
                                  <td><form class = "pull-right" action="<?php echo URLROOT;?>/projects/stergeProiect/<?php echo $proiect->id; ?>" method="post">
                                      <input type="submit" value="Sterge" class = "btn btn-danger">
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
        <?php echo $data['error'];?>
      </div>
    </div>
  </div>
  <?php require APPROOT . '/views/initial/footer.php';?>