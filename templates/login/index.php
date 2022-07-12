<?php /** @var SAE\PHPCMS\View $this */ ?>

<form class="form" method="post">
    <div class="form__row">
        <label class="form__label" for="username"><?= _( 'Username' ) ?></label>
        <input id="username" name="username" type="text" placeholder="<?= _( 'your_username' ) ?>">
        <?php $this->Messages->printInputErrors( 'username' ); ?>
    </div>
    <div class="form__row">
        <label class="form__label" for="password"><?= _( 'Password' ) ?></label>
        <input id="password" name="password" type="password" placeholder="<?= _( '********' ) ?>">
        <?php $this->Messages->printInputErrors( 'password' ); ?>
    </div>
    <div class="form__row">
        <input class="form__submit" type="submit" value="<?= _( 'Login' ) ?>">
    </div>
</form>