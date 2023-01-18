<?php
\Core\View::render('admin/blocks/header', ['pageTitle' => 'Update park']);
?>

    <div class="container pt-5 pb-5">
        <div class="row">
            <h3>Update Park</h3>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <form class="card mt-5" method="POST" action="<?= url("admin/parks/{$park->id}/update") ?>">
                    <div class="card-header">
                        <h3>Update</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="serial_number" class="form-label">Serial Number</label>
                            <input type="text" class="form-control" value="<?= $park->serial_number ?>"
                                   id="serial_number" name="serial_number">
                        </div>
                        <?= showInputError('serial_number', $errors ?? []); ?>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" value="<?= $park->address ?>" id="address"
                                   name="address">
                        </div>
                        <?= showInputError('address', $errors ?? []); ?>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
\Core\View::render('admin/blocks/footer');
