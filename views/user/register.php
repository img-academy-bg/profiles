<?php

// views/user/register.php

?>
<div class="col-md-6 offset-md-3">
    <form method="post" action="<?= create_url('user', 'register') ?>" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="firstName" class="form-label">First name:</label>
      <input type="text" name="first_name" id="firstName" class="form-control" placeholder="John">
    </div>
    <div class="mb-3">
      <label for="lastName" class="form-label">Last name:</label>
      <input type="text" name="last_name" id="lastName" class="form-control" placeholder="Doe">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email address:</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="j.doe@example.com">
    </div>
    <div class="mb-3">
      <label for="pass" class="form-label">Password:</label>
      <input type="password" name="pass" id="pass" class="form-control">
    </div>
    <div class="mb-3">
      <label for="confirmPass" class="form-label">Confirm password:</label>
      <input type="password" name="confirm_pass" id="confirmPass" class="form-control">
    </div>
    <div class="mb-3">
      <label for="avatar" class="form-label">Avatar:</label>
      <input type="file" name="avatar" id="avatar" class="form-control">
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" name="t_and_t" id="termsAndConditions">
      <label for="termsAndConditions" class="form-check-label">Agree with terms and conditions</label>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div>
<div class="row">
  <div class="col-md-6 offset-md-3 mt-3">
    <a href="<?= 'index.php?page=user&action=login'; ?>">Login</a> |
    <a href="#">Forgot password?</a> |
    <a href="<?= 'index.php?page=' . DEFAULT_PAGE . '&action=' . DEFAULT_ACTION; ?>">Home page</a>
  </div>
</div>