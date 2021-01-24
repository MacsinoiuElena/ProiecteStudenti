<?php

use function PHPSTORM_META\type;

require APPROOT . '/views/initial/header.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-lg-12 text-center">
      <h1 class="mt-5">Evidenta Studenti</h1><br>
      <?php if (!empty($data['evidenta'])) { ?>
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Nume</th>
              <th scope="col">Prenume</th>
              <th scope="col">Email</th>
              <th scope="col">Grupa</th>
              <th scope="col">Lista Proiecte</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $nr = 0;
            foreach ($data['evidenta'] as $evidenta) {
              $nr += 1;
            ?>
              <tr>
                <th scope="row"><?php echo $nr; ?></th>
                <td><?php echo $evidenta->nume; ?></td>
                <td><?php echo $evidenta->prenume; ?></td>
                <td><?php echo $evidenta->email; ?></td>
                <td><?php echo $evidenta->grupa; ?></td>
                <td>
                  <?php foreach ($data['displayProj'] as $Proj) {
                    if ($Proj->id_student == $evidenta->id) {
                      $arr = explode("/", $Proj->denumire);
                      $note = explode("/", $Proj->nota);
                      $id_p = explode("/", $Proj->id_proiect);?>

                          
                      <div class="btn-group">
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Proiecte
                      </button>
                      <div class="dropdown-menu">
                        <?php
                        $var = 0;
                        foreach($arr as $p){?>
                          <a class="dropdown-item" href="<?php echo URLROOT; ?>/evidenta/note/<?php echo $evidenta->id; ?>/<?php echo $id_p[$var]; ?>"><?php  echo $p;?></a>
                          <a class="dropdown-item" href="#">Nota pentru <?php  echo $p;?>: <?php echo $note[$var];?></a>
                         
                        <?php 
                      $var += 1;}?>
                      </div>
                    </div>
                    <?php
                    }
                  } ?>
                </td>
                </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php }else{
        echo "<h6 class='mt-5'>Nu exista inregistrari</h6>";
      } ?>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/initial/footer.php'; ?>