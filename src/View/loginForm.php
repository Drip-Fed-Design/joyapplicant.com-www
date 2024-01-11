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
                <h1 class="-banner _tf-paytone-one">Sign in for 0% frustration</h1>
                <?
                // Load the session alert outputs
                require_once __DIR__ . '/messageAlert.php';
                ?>
                <section class="<?= $cssPrefix; ?>-form-container _margin__top-default">
                    <form action="login" method="post" id="login-form">
                        <div class="<?= $cssPrefix; ?>-grid -column-2 -align-v-center -gap-c-small">
                            <div class="__group">
                                <label for="email">Email address</label>
                                <input type="email" id="email" name="email" class="__input" placeholder="Email address..." autocomplete="on" required />
                            </div>
                            <div class="__group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="__input" placeholder="Password..." autocomplete="on" required />
                            </div>
                        </div>
                        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                        <hr class="_hr__grey-light" />
                        <div class="__buttons <?= $cssPrefix; ?>-button-container _margin__top-default">
                            <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -align-v-center">
                                <a href="forgot" title="Forgot your log in details to 0% job applicant frustration" class="__button -green _margin__right-micro">Forgot password</a>
                                <button type="submit" name="login" class="__button -stretch btn-primary">Sign in</button>
                            </div>
                        </div>
                    </form>
                    <p class="_font-size__secondary">Don't have an account? <a href="/public/register" title="Register to experience 0% job applicant frustration">Register with JoyApplicant now</a>.</p>
                </section>
            </div>
            <div class="__img"></div>
        </div>
    </div>
</section>