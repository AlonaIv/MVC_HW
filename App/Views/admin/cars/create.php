<?php
\Core\View::render('admin/blocks/header', ['pageTitle' => 'Create car']);
?>

    <div class="container pt-5 pb-5">
        <div class="row">
            <h3>Create Car</h3>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <form class="card mt-5" method="POST" action="<?= url('admin/cars/store') ?>">
                    <div class="card-header">
                        <h3>Create</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="park_id" class="form-label">#park</label>
                            <input type="text" class="form-control" id="park_id" name="park_id" value="<?= $fields['park_id'] ?? '' ?>">
                        </div>
                        <?= showInputError('park_id', $errors ?? []); ?>

                        <div class="mb-3">
                            <label for="model" class="form-label">Model</label>
                            <input type="text" class="form-control" id="model" name="model" value="<?= $fields['model'] ?? '' ?>">
                        </div>
                        <?= showInputError('model', $errors ?? []); ?>

                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="text" class="form-control" id="year" name="year" value="<?= $fields['year'] ?? '' ?>">
                        </div>
                        <?= showInputError('year', $errors ?? []); ?>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" name="price" value="<?= $fields['price'] ?? '' ?>">
                        </div>
                        <?= showInputError('price', $errors ?? []); ?>

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
