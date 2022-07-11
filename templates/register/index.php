<form id="form__register" class="form" method="post">
    <div class="form__row">
        <label class="form__label" for="username"><?= _( 'Username' ) ?></label>
        <input id="username" name="username" type="text" placeholder="<?= _( 'your_username' ) ?>">
    </div>
    <div class="form__row">
        <label class="form__label" for="email"><?= _( 'E-Mail Address' ) ?></label>
        <input id="email" name="email" type="email" placeholder="<?= _( 'your@email.addresss' ) ?>">
    </div>
    <div class="form__row">
        <label class="form__label" for="password"><?= _( 'Password' ) ?></label>
        <input id="password" name="password" type="password" placeholder="<?= _( '********' ) ?>">
    </div>
    <div class="form__row">
        <label class="form__label" for="password_repeat"><?= _( 'Repeat password' ) ?></label>
        <input id="password_repeat" name="password_repeat" type="password" placeholder="<?= _( '********' ) ?>">
    </div>
    <div class="form__row">
        <input class="form__submit" type="submit" value="<?= _( 'Register' ) ?>">
    </div>
</form>