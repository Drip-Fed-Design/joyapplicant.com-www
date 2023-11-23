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
                <h1 class="-banner _tf-paytone-one">Register for 0% frustration</h1>
                <?
                // Load the session alert outputs
                require_once __DIR__ . '/messageAlert.php';
                ?>
                <section class="<?= $cssPrefix; ?>-form-container _margin__top-default">
                    <form action="register" method="post" id="registration-form">
                        <div class="__group">
                            <label for="email">Email address</label>
                            <input type="email" id="email" name="email" class="__input" placeholder="Email address..." required />
                        </div>
                        <div class="<?= $cssPrefix; ?>-grid -column-2 -align-v-center -gap-c-small">
                            <div class="__group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="__input" placeholder="Password..." minlength="8" maxlength="16" required />
                            </div>
                            <div class="__group">
                                <label for="password-confirm">Confirm Password</label>
                                <input type="password" id="password-confirm" name="password_confirm" class="__input" placeholder="Confirm Password..." minlength="8" maxlength="16" required />
                            </div>
                        </div>
                        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                        <hr class="_hr__grey-light" />
                        <div class="__buttons <?= $cssPrefix; ?>-button-container _margin__top-default">
                            <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -align-v-center">
                                <a href="support" title="Need support creating JoyApplicant account" class="__button -green _margin__right-micro">Help</a>
                                <button type="submit" name="register" class="__button -stretch btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                    <p class="_font-size__secondary">Already have an account? <a href="login" title="Log in to access your JoyApplicant account">Log into JoyApplicant</a>.</p>
                </section>
            </div>
            <div class="__img"></div>
        </div>
    </div>
</section>