<div class="col-md-2">
    <?php include_once 'views/partials/menu.php'; ?>
</div>
<div class="col-md-10">
    <?php if (!empty($viewModel['profiles'])): ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Names</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Birthday</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($viewModel['profiles'] as $index => $profile): ?>
                    <tr>
                        <th scope="row"><?= ($index + 1) + ($viewModel['itemsPerPage'] * ($viewModel['currentPage'] - 1)); ?></th>
                        <td>
                            <a href="<?= create_url('profiles', 'single', ['id' => $profile['id']]); ?>">
                                <?= $profile['first_name'] . ' ' . $profile['last_name'] ?>
                            </a>
                        </td>
                        <td><?= $profile['email']; ?></td>
                        <td><?= $profile['phone']; ?></td>
                        <td><?= $profile['birthday']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($viewModel['currentPage'] > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= create_url(DEFAULT_PAGE, DEFAULT_ACTION, ['currentPage' => $viewModel['currentPage'] - 1]); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php
                if ($viewModel['currentPage'] > 1):
                    if ($viewModel['currentPage'] > $viewModel['maxPageLinks']) {
                        $displayLinksTo = $viewModel['currentPage'] - $viewModel['maxPageLinks'];                    
                    } else {
                        $displayLinksTo = 1;
                    }
                    for ($i = $displayLinksTo; $i <= $viewModel['currentPage'] - 1; $i++):
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= create_url(DEFAULT_PAGE, DEFAULT_ACTION, ['currentPage' => $i]); ?>">
                                <?= $i; ?>
                            </a>
                        </li>
                        <?php
                    endfor;
                endif;
                ?>

                <li class="page-item active">
                    <a class="page-link" href="#">
                        <?= $viewModel['currentPage']; ?>
                    </a>
                </li>

                <?php
                if ($viewModel['currentPage'] < $viewModel['totalPages']):
                    $displayLinksTo = $viewModel['currentPage'] + $viewModel['maxPageLinks'];
                    if ($displayLinksTo > $viewModel['totalPages']) {
                        $displayLinksTo = $viewModel['totalPages'];
                    }
                    for ($i = $viewModel['currentPage'] + 1; $i <= $displayLinksTo; $i++):
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= create_url(DEFAULT_PAGE, DEFAULT_ACTION, ['currentPage' => $i]); ?>">
                                <?= $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= create_url(DEFAULT_PAGE, DEFAULT_ACTION, ['currentPage' => $viewModel['currentPage'] + 1]); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php else: ?>
        <div class="alert alert-warning">No profiles loaded</div>
    <?php endif; ?>
</div>