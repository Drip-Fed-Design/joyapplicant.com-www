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
                <h1 class="-banner _tf-paytone-one">Reset your password</h1>
                <?
                // Load the session alert outputs
                require_once __DIR__ . '/messageAlert.php';
                ?>
                <section class="<?= $cssPrefix; ?>-form-container _margin__top-default">
                    <form action="reset?email=<?= urlencode($email); ?>&pwtoken=<?= $pwtoken; ?>" method="post" id="reset-form">
                        <div class="<?= $cssPrefix; ?>-grid -column-2 -align-v-center -gap-c-small">
                            <div class="__group">
                                <label for="password-new">New Password</label>
                                <input type="password" id="password-new" name="password_new" class="__input" placeholder="Password..." minlength="8" maxlength="16" required />
                            </div>
                            <div class="__group">
                                <label for="password-confirm">Confirm New Password:</label>
                                <input type="password" id="password-confirm" name="password_confirm" class="__input" placeholder="Confirm Password..." minlength="8" maxlength="16" required />
                            </div>
                        </div>
                        <input type="hidden" name="email" value="<?= htmlspecialchars($email); ?>">
                        <input type="hidden" name="pwtoken" value="<?= htmlspecialchars($pwtoken); ?>">
                        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                        <hr class="_hr__grey-light" />
                        <div class="__buttons <?= $cssPrefix; ?>-button-container _margin__top-default">
                            <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -align-v-center">
                                <a href="/" title="Cancel password reset" class="__button -green _margin__right-micro">Cancel</a>
                                <button type="submit" name="reset" class="__button -stretch btn-primary">Reset password</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
            <div class="__img"></div>
        </div>
    </div>
</section>