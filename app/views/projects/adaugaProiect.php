<?php require APPROOT . '/views/initial/header.php';?>
<div class="container">
    <div class="row">
            <div class = "card card-body bg-light mt-5">
                <h2>Adauga Proiect</h2>
                <form action="<?php echo URLROOT;?>/projects/adaugaProiect" method="post">
                    <div class = "form-group">
                        <label for="den">Denumire: <sup>*</sup></label><br>
                        <input type="text" name = "den" class = "form-control form-control-lg <?php echo (!empty($data['den_error'])) ? 'is-invalid': '';?>" 
                        value = "<?php echo $data['den'];?>">                      
                        <span class="invalid-feedback"><?php echo $data['den_error'];?></span>
                    </div>
                    <div class = "form-group">
                        <label for="descriere">Descriere: <sup>*</sup></label><br>
                        <textarea name = "descriere" class = "form-control form-control-lg <?php echo (!empty($data['desc_error'])) ? 'is-invalid': '';?>" 
                        ><?php echo $data['descriere'];?></textarea>
                        <span class="invalid-feedback"><?php echo $data['desc_error'];?></span>
                    </div>

                        <input type="submit" value = "Adauga" class="btn btn-success">
            </form>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/initial/footer.php';?>