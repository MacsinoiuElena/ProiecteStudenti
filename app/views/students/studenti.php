<?php require APPROOT . '/views/initial/header.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-lg-12 text-center">
      <h1 class="mt-5">Studenti</h1><br>
      <?php if (!empty($data['student'])) { ?>
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Nume</th>
              <th scope="col">Prenume</th>
              <th scope="col">Email</th>
              <th scope="col">Grupa</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $nr = 0;
            foreach ($data['student'] as $student) {
              $nr += 1; ?>
              <tr>
                <th scope="row"><?php echo $nr; ?></th>
                <td><?php echo $student->nume; ?></td>
                <td><?php echo $student->prenume; ?></td>
                <td><?php echo $student->email; ?></td>
                <td><?php echo $student->grupa; ?></td>
                <td><div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Actions
                  </button>
                  <div class="dropdown-menu">
                    <form action="<?php echo URLROOT; ?>/students/sterge/<?php echo $student->id; ?>" method="post">
                      <button type="submit" onclick="return alert('Are You sure?')" class=" dropdown-item">Sterge</button>
                    </form>
                    <a href="<?php echo URLROOT; ?>/students/modificaStudent/<?php echo $student->id; ?>" class="dropdown-item">Modifca</a>
                    <div class="dropdown-divider"></div>
                    <a href="<?php echo URLROOT; ?>/evidenta/plusProiect/<?php echo $student->id; ?>" class="dropdown-item">Adauga proiect</a>
                    <a href="<?php echo URLROOT; ?>/evidenta/minusProiect/<?php echo $student->id; ?>" class="dropdown-item">Sterge Proiect</a>
                  </div>
                </div></td>
              </tr>
            <?php
            } ?>
          </tbody>
        </table>
      <?php } else {
        echo "<h6 class='mt-5'>Nu exista inregistrari</h6>";
      } ?>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/initial/footer.php'; ?>