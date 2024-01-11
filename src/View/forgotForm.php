<?
// Generate a new CSRF token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
?>

<section class="<?= $cssPrefix; ?>-banner-container">
    <div class="_width__max">
        <div class="<?= $cssPrefix; ?>-grid -column-2 -align-v-center -gap-c-default">
            <div class="__copy">
                <h1 class="-banner _tf-paytone-one">Forgotten your password</h1>
                <?
                // Load the session alert outputs
                require_once __DIR__ . '/messageAlert.php';
                ?>
                <section class="<?= $cssPrefix; ?>-form-container _margin__top-default">
                    <form action="forgot" method="post" id="forgot-form">
                        <div class="__group">
                            <label for="email">Email address</label>
                            <input type="email" id="email" name="email" class="__input" placeholder="Email address..." required />
                        </div>
                        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                        <hr class="_hr__grey-light" />
                        <div class="__buttons <?= $cssPrefix; ?>-button-container _margin__top-default">
                            <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -align-v-center">
                                <a href="/" title="Cancel password reset" class="__button -green _margin__right-micro">Cancel</a>
                                <button type="submit" name="forgot" class="__button -stretch btn-primary">Send reset link</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
            <div class="__img"></div>
        </div>
    </div>
</section>