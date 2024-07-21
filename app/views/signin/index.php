<div class="row justify-content-center align-content-center align-items-center bg-dark h-100 mr-0" style="gap: 20px;">
  <form id="form-signin" class="contact-form col-6 needs-validation d-flex flex-column" style="gap: 20px;" method="post"
    novalidate>
    <h2 class="text-white">Authorization</h2>
    <div class="input-group has-validation">
      <input class="form-control rounded-pill" type="text" name="login" id="login" placeholder="Your login">
      <div class="invalid-feedback">
        Login should be more than 4 symbols and include a-Z A-Z 0-9
      </div>
    </div>
    <div class="input-group has-validation">
      <input class="form-control rounded-pill" id="password" type="text" name="password" placeholder="Your password">
      <div class="invalid-feedback">
        Password should be more than 6 symbols and include a-Z A-Z 0-9
      </div>
    </div>
    <button type="submit" class="site-btn">Sign in</button>
  </form>
  <? if ($data->signin_fail): ?>
    <p class="text-danger col-12 text-center"><?= $data->signin_fail ?></p>
  <? endif; ?>
</div>