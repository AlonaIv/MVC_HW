<?php
\Core\View::render('admin/blocks/header', ['pageTitle' => 'Parks']);
?>

    <section class="pt-5 pb-5">
        <h3>Parks</h3>
        <hr>
        <?php if (!empty($parks)): ?>
            <table class="table table-dark table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Serial Number</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($parks as $park): ?>
                    <tr>
                        <th><?= $park->id ?></th>
                        <th><?= $park->serial_number ?></th>
                        <th><?= $park->address ?></th>
                        <th>
                            <form method="POST" action="<?= url("admin/parks/{$park->id}/destroy") ?>" class="btn-group"
                                  role="group" aria-label="Basic mixed styles example">
                                <a href="<?= url("admin/parks/{$park->id}/edit") ?>" class="btn btn-warning">Edit</a>
                                <button class="btn btn-danger">Remove</button>
                            </form>
                        </th>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <h6>There are no parks yet</h6>
        <?php endif; ?>
    </section>

<?php
\Core\View::render('admin/blocks/footer');
