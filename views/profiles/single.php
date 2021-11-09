<div class="col-md-2">
    <?php include_once 'views/partials/menu.php'; ?>
</div>
<div class="col-md-10">
    <?php if (empty($viewModel['profile'])): ?>
        <div class="alert alert-danger">Invalid profile</div>
    <?php else: ?>
        <div class="card mb-3" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="<?= $viewModel['profile']['avatar']; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title"><?= $viewModel['profile']['first_name'] . ' ' . $viewModel['profile']['last_name']; ?></h5>
                <p class="card-text">
                <ul>
                    <li>Email: <?= $viewModel['profile']['email']; ?></li>
                    <li>Phone: <?= $viewModel['profile']['phone']; ?></li>
                    <li>Birthday: <?= $viewModel['profile']['birthday']; ?></li>
                    <li>Gender: <?= $viewModel['profile']['gender']; ?></li>
                </ul>
                </p>
              </div>
            </div>
          </div>
        </div>
    <?php endif; ?>
</div>