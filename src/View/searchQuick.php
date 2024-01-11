<?
// Generate a new CSRF token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
?>

<section class="<?= $cssPrefix; ?>-search-container -quick">
    <div class="_width__max">
        <div class="<?= $cssPrefix; ?>-grid -column-mmm-1fr-mmm _padding__rl-large -align-v-center -gap-c-medium">
            <div class="__logo">
                <img src="/public/uploads/microsoft.png" alt="Microsoft Jobs and Microsoft Careers" width="115" height="26" />
            </div>
            <div class="__logo">
                <img src="/public/uploads/hp.png" alt="Hewlett Packard HP Jobs and Hewlett Packard HP Careers" width="30" height="30" />
            </div>
            <div class="__logo">
                <img src="/public/uploads/twitch.png" alt="Twitch Jobs and Twitch Careers" width="73" height="24" />
            </div>
            <section class="<?= $cssPrefix; ?>-form-container">
                <form action="search" method="post" id="search-form">
                    <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -align-v-center ">
                        <div class="__group">
                            <input type="search" id="search" name="search" class="__input -inset" placeholder="Find your next dream role..." required />
                        </div>
                        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">

                        <div class="__buttons <?= $cssPrefix; ?>-button-container">
                            <button type="submit" name="search" class="__button -inset">Search</button>
                        </div>
                    </div>
                </form>
            </section>
            <div class="__logo">
                <img src="/public/uploads/paypal.png" alt="Paypal Jobs and Paypal Careers" width="29" height="34" />
            </div>
            <div class="__logo">
                <img src="/public/uploads/slack.png" alt="Slack Jobs and Slack Careers" width="87" height="32" />
            </div>
            <div class="__logo">
                <img src="/public/uploads/apple.png" alt="Apple Jobs and Apple Careers" width="29" height="34" />
            </div>
        </div>
    </div>
</section>