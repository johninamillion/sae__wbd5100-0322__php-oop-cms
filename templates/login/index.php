<form class="form" method="post">
    <div class="form__row">
        <label class="form__label" for="username"><?= _( 'Username' ) ?></label>
        <input id="username" name="username" type="text" placeholder="<?= _( 'your_username' ) ?>">
    </div>
    <div class="form__row">
        <label class="form__label" for="password"><?= _( 'Password' ) ?></label>
        <input id="password" name="password" type="password" placeholder="<?= _( '********' ) ?>">
    </div>
    <div class="form__row">
        <input class="form__submit" type="submit" value="<?= _( 'Login' ) ?>">
    </div>
</form>