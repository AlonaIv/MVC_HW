<?php
\Core\View::render('admin/blocks/header', ['pageTitle' => 'Create park']);
?>

    <div class="container pt-5 pb-5">
        <div class="row">
            <h3>Create Park</h3>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <form class="card mt-5" method="POST" action="<?= url('admin/parks/store') ?>">
                    <div class="card-header">
                        <h3>Create</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="serial_number" class="form-label">Serial Number</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number" value="<?= $fields['serial_number'] ?? '' ?>">
                        </div>
                        <?= showInputError('serial_number', $errors ?? []); ?>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= $fields['address'] ?? '' ?>">
                        </div>
                        <?= showInputError('address', $errors ?? []); ?>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
\Core\View::render('admin/blocks/footer');
