<?php require APPROOT . '/views/initial/header.php';?>
<div class="container">
    <div class="row">
    <div class = "col-md-6 mx-auto">
            <div class = "card card-body bg-light mt-5">
                <h2>Adauga Student</h2>
                <form action="<?php echo URLROOT;?>/pages/adauga_student" method="post">
                    <div class = "form-group">
                        <label for="name">Nume: <sup>*</sup></label><br>
                        <input type="text" name = "name" class = "form-control form-control-lg <?php echo (!empty($data['name_error'])) ? 'is-invalid': '';?>" 
                        value = "<?php echo $data['name'];?>"/>                      
                        <span class="invalid-feedback"><?php echo $data['name_error'];?></span>
                    </div>
                    <div class = "form-group">
                        <label for="fname">Prenume: <sup>*</sup></label><br>
                        <input type="text" name = "fname" class = "form-control form-control-lg <?php echo (!empty($data['fname_error'])) ? 'is-invalid': '';?>" 
                        value = "<?php echo $data['fname'];?>"/>                      
                        <span class="invalid-feedback"><?php echo $data['fname_error'];?></span>
                    </div>

                    <div class = "form-group">
                        <label for="email">Email: <sup>*</sup></label><br>
                        <input type="email" name = "email" class = "form-control form-control-lg <?php echo (!empty($data['email_error'])) ? 'is-invalid': '';?>" 
                        value = "<?php echo $data['email'];?>"/>                      
                        <span class="invalid-feedback"><?php echo $data['email_error'];?></span>
                    </div>

                    <div class = "form-group">
                        <label for="group">Grupa: <sup>*</sup></label><br>
                        <input type="text" name = "group" class = "form-control form-control-lg <?php echo (!empty($data['group_error'])) ? 'is-invalid': '';?>" 
                        value = "<?php echo $data['group'];?>"/>                      
                        <span class="invalid-feedback"><?php echo $data['group_error'];?></span>
                    </div>

                    <div class="form-group">
                        <label for="den">Proiect: <sup>*</sup></label><br>
                        <select name="den" id="proiect" class = "form-control form-control-lg <?php echo (!empty($data['den_error'])) ? 'is-invalid': '';?>" >
                            <option value="" disabled selected>Alege proiectul</option>
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