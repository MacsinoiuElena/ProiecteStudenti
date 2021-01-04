<?php require APPROOT . '/views/initial/header.php';?>
<div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
      <h1 class="mt-5">Evidenta Studenti</h1><br>
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Nume</th>
                <th scope="col">Prenume</th>
                <th scope="col">Email</th>
                <th scope="col">Grupa</th>
                <th scope="col">Denumire Proiect</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $nr = 0;
                foreach ($data['evidenta'] as $evidenta){
                                $nr += 1;
                                ?>
                                  <tr>
                                  <th scope="row"><?php echo $nr;?></th>
                                  <td><?php echo $evidenta->nume;?></td>
                                  <td><?php echo $evidenta->prenume;?></td>
                                  <td><?php echo $evidenta->email;?></td>
                                  <td><?php echo $evidenta->grupa;?></td>
                                  <td><?php echo $evidenta->denumire;?></td>
                                  </tr>
                                <?php
                            }?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php require APPROOT . '/views/initial/footer.php';?>