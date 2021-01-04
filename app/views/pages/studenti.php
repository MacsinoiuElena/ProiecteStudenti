<?php require APPROOT . '/views/initial/header.php';?>
<div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">Studenti</h1><br>
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Nume</th>
                <th scope="col">Prenume</th>
                <th scope="col">Email</th>
                <th scope="col">Grupa</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach ($data['student'] as $student){
                                ?>
                                  <tr>
                                  <th scope="row"><?php echo $student->id;?></th>
                                  <td><?php echo $student->nume;?></td>
                                  <td><?php echo $student->prenume;?></td>
                                  <td><?php echo $student->email;?></td>
                                  <td><?php echo $student->grupa;?></td>
                                  <td><form class = "pull-right" action="<?php echo URLROOT;?>/pages/sterge/<?php echo $student->id; ?>" method="post">
                                      <input type="submit" value="Sterge" class = "btn btn-danger">
                                      </form></td>
                                  </tr>
                                <?php
                            }?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php require APPROOT . '/views/initial/footer.php';?>