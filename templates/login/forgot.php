<?php /** @var SAE\PHPCMS\View $this */ ?>

<form class="form" method="post">
    <div class="form__row">
        <label class="form__label" for="email"><?= _( 'E-Mail' ) ?></label>
        <input id="email" name="email" type="email" placeholder="<?= _( 'your@email.address' ) ?>">
        <?php $this->Messages->printInputErrors( 'email' ); ?>
    </div>
    <div class="form__row">
        <input class="form__submit" type="submit" value="<?= _( 'Reset Password' ) ?>">
    </div>
</form>