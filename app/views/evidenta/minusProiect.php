<?php require APPROOT . '/views/initial/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2>Sterge Proiecte</h2>
                <form action="<?php echo URLROOT; ?>/evidenta/minusProiect/<?php echo $data['id']; ?>" method="post">
                    <div class="form-group">
                        <?php $i = 1; ?>
                        <?php foreach ($data['proiecte'] as $proiect) {
                        ?>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name='checkboxvar[]' value='<?php echo $proiect->denumire; ?>' class="custom-control-input" id="<?php echo 'denCheck' . $i; ?>">
                                <label class="custom-control-label" for="<?php echo 'denCheck' . $i; ?>"><?php echo $proiect->denumire; ?></label><br>
                            </div>
                        <?php
                            $i += 1;
                        } ?>
                        <span class="invalid-feedback"><?php echo $data['den_error']; ?></span>
                    </div>
                    <input type="submit" value="Sterge" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/initial/footer.php'; ?>