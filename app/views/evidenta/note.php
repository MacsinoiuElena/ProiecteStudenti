<?php require APPROOT . '/views/initial/header.php';?>
<div class="container">
    <div class="row">
    <div class = "col-md-6 mx-auto">
            <div class = "card card-body bg-light mt-5">
                <h2>Nota</h2>
                <form action="<?php echo URLROOT;?>/evidenta/note/<?php echo $data['id_s'];?>/<?php echo $data['id_p'];?>" method="post">
                    <div class="form-group">
                        <label for="nota">Nota:</label><br>
                            <input type="number"  name="nota" class="form-control form-control-lg <?php echo (!empty($data['nota_err'])) ? 'is-invalid': '';?>" value="<?php echo $data['nota'];?>"/>
                            <span class="invalid-feedback"><?php echo $data['nota_err'];?></span>
                    </div>
                    <?php echo $data['nota'];?>
                        <input type="submit" value = "Noteaza" class="btn btn-success">
            </form>
            </div>
        </div>
    </div>
    </div>
<?php require APPROOT . '/views/initial/footer.php';?>