<?php require APPROOT . '/views/initial/header.php';?>
<div class="container">
    <div class="row">
    <div class = "col-md-6 mx-auto">
            <div class = "card card-body bg-light mt-5">
                <h2>Adauga Tema</h2>
                <form action="<?php echo URLROOT;?>/evidenta/plusProiect/<?php echo $data['id'];?>" method="post">
                        <div class="form-group">
                        <label for="den">Proiect: <sup>*</sup></label><br>
                        <select name="den" id="proiect" class = "form-control form-control-lg <?php echo (!empty($data['den_error'])) ? 'is-invalid': '';?>" >
                            <option value=""  selected>Adauga proiect</option>
                            <?php 
                            foreach ($data['proiect'] as $proiect){ 
                                ?><option value = "<?php echo $proiect->denumire;?>"><?php echo $proiect->denumire;?></option>
                                <?php
                            }?>
                        </select>
                        <span class="invalid-feedback"><?php echo $data['den_error'];?></span>
                    </div>
                        <input type="submit" value = "Adauga" class="btn btn-success">
            </form>
            </div>
        </div>
    </div>
    </div>
<?php require APPROOT . '/views/initial/footer.php';?>