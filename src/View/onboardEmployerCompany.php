<?
require_once __DIR__ . '/../../config/global.static.php';

// Generate a new CSRF token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
?>

<section class="<?= $cssPrefix; ?>-dashboard-container">
    <div class="_width__max">
        <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -gap-c-medium">
            <div class="__copy">
                <?
                // Load the session alert outputs
                require_once __DIR__ . '/messageAlert.php';
                ?>
                <h2>Next, some details about your company?</h2>
                <section class="<?= $cssPrefix; ?>-form-container _margin__top-default">
                    <form action="company" method="post" id="company-form">
                        <div class="<?= $cssPrefix; ?>-grid -column-2 -gap-c-default">
                            <div class="__group">
                                <label for="name">Company name *</label>
                                <input type="text" id="name" name="name" class="__input -grey" placeholder="Company name..." required />
                                <div class="__tip">Provide a preferred name, as this is what future applicants will know you by.</div>
                            </div>
                            <div class="__group">
                                <label for="desc">Short Description *</label>
                                <input type="text" id="desc" name="desc" class="__input -grey" placeholder="Briefly tell us about your company......" required />
                            </div>
                            <div class="__group">
                                <label for="telephone">Contact number *</label>
                                <input type="telephone" id="telephone" name="telephone" class="__input -grey" placeholder="Contact number..." required />
                                <div class="__tip">It's helpful to provide a direct contact number, such as a mobile or direct dial number.</div>
                            </div>
                            <div class="__group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" class="__input -grey" placeholder="Email address..." required />
                                <div class="__tip">It's helpful to provide a direct contact number, such as a mobile or direct dial number.</div>
                            </div>
                            <div class="__group">
                                <label for="country">Country *</label>
                                <select id="country" name="country" class="__select -grey" required>
                                    <option value="">Select...</option>
                                    <?
                                    sort($arrayCountries);
                                    foreach ($arrayCountries as $c) {
                                        echo '<option value="' . $c . '">' . $c . '</option>';
                                    }
                                    ?>
                                    <option value="Other">Other</option>
                                </select>
                                <div class="__tip">This is the Country you're currently living within.</div>
                            </div>
                            <div class="__group">
                                <label for="city">City *</label>
                                <select id="city" name="city" class="__select -grey" required>
                                    <option value="">Select...</option>
                                    <?
                                    // Dynamic list, depending on Country selection
                                    sort($arrayCitiesGB);
                                    foreach ($arrayCitiesGB as $v) {
                                        echo '<option value="' . $v . '">' . $v . '</option>';
                                    }
                                    ?>
                                    <option value="Other">Other</option>
                                </select>
                                <div class="__tip">This is the City you're currently living within or near by.</div>
                            </div>
                        </div>
                        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                        <hr class="_hr__grey-light" />
                        <div class="__buttons <?= $cssPrefix; ?>-button-container _margin__top-default _text-align__right">
                            <button type="submit" name="company" class="__button">Continue to final step</button>
                        </div>
                    </form>
                </section>
            </div>
            <div class="<?= $cssPrefix; ?>-steps-container">
                <div class="__step <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small">
                    <div class="__bullet"></div>
                    <div class="__copy">
                        <p class="__title">About you</p>
                        <p class="__desc">Let's start by learning about you?</p>
                    </div>
                </div>
                <div class="__step <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small">
                    <div class="__bullet -active"></div>
                    <div class="__copy">
                        <p class="__title">About your company</p>
                        <p class="__desc">Now about your company?</p>
                    </div>
                </div>
                <div class="__step <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small">
                    <div class="__bullet"></div>
                    <div class="__copy">
                        <p class="__title">Discovery</p>
                        <p class="__desc">How do you want to be found?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>