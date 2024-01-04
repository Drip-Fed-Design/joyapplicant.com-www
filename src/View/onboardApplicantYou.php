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
                <h2>Tell us about you</h2>
                <p>We'll keep questions to a minimum, but just enough to provide you with the best experience.</p>
                <section class="<?= $cssPrefix; ?>-form-container _margin__top-default">
                    <form action="you" method="post" id="you-form">
                        <h4>What do we call you?</h4>
                        <div class="__form-section">
                            <div class="<?= $cssPrefix; ?>-grid -column-2 -gap-c-default">
                                <div class="__group">
                                    <label for="firstname">First name *</label>
                                    <input type="text" id="firstname" name="firstname" class="__input -grey" placeholder="First name..." required />
                                    <div class="__tip">Provide a preferred name, as this is what future applicants will know you by.</div>
                                </div>
                                <div class="__group">
                                    <label for="lastname">Last name *</label>
                                    <input type="text" id="lastname" name="lastname" class="__input -grey" placeholder="Last name..." required />
                                </div>
                            </div>
                        </div>
                        <h4>Where are you from?</h4>
                        <div class="__form-section">
                            <div class="<?= $cssPrefix; ?>-grid -column-2 -gap-c-default">
                                <div class="__group">
                                    <label for="country">Country *</label>
                                    <select id="country" name="country" class="__select -grey" required>
                                        <option value="">Select...</option>
                                        <optgroup label="Most Selected">
                                            <?
                                            sort($arrayCountriesPopular);
                                            foreach ($arrayCountriesPopular as $c) {
                                                echo '<option value="' . $c . '">' . $c . '</option>';
                                            }
                                            ?>
                                        </optgroup>
                                        <optgroup label="All">
                                            <?
                                            sort($arrayCountries);
                                            foreach ($arrayCountries as $c) {
                                                echo '<option value="' . $c . '">' . $c . '</option>';
                                            }
                                            ?>
                                        </optgroup>
                                    </select>
                                    <div class="__tip">This is the Country you're currently living within.</div>
                                </div>
                                <div class="__group">
                                    <label for="postcodezip">Postcode / Zip Code *</label>
                                    <input type="text" id="postcodezip" name="postcodezip" class="__input -grey" placeholder="Postcode / Zip Code..." required />
                                    <div class="__tip">This is the postal or zip code where you're currently living.</div>
                                </div>
                            </div>
                        </div>
                        <h4>How can others call you?</h4>
                        <div class="__form-section">
                            <div class="<?= $cssPrefix; ?>-grid -column-2 -gap-c-default">
                                <div class="__group">
                                    <label for="telephone">Contact number *</label>
                                    <input type="telephone" id="telephone" name="telephone" class="__input -grey" placeholder="Contact number..." required />
                                    <div class="__tip">It's helpful to provide a direct contact number, such as a mobile or direct dial number.</div>
                                </div>
                                <div class="__group">
                                    <label for="findus">How did you hear about us *</label>
                                    <select id="findus" name="findus" class="__select -grey" required>
                                        <option value="">Select...</option>
                                        <?
                                        foreach ($arrayFeedbackFindUs as $k => $f) {
                                            echo '<option value="' . $k . '">' . $f . '</option>';
                                        }
                                        ?>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                        <hr class="_hr__grey-light" />
                        <div class="__buttons <?= $cssPrefix; ?>-button-container _margin__top-default _text-align__right">
                            <button type="submit" name="you" class="__button">Continue</button>
                        </div>
                    </form>
                </section>
            </div>
            <div class="<?= $cssPrefix; ?>-steps-container">
                <div class="__step <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small">
                    <div class="__bullet -active"></div>
                    <div class="__copy">
                        <p class="__title">About you</p>
                        <p class="__desc">Let's start by learning about you?</p>
                    </div>
                </div>
                <div class="__step <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small">
                    <div class="__bullet"></div>
                    <div class="__copy">
                        <p class="__title">Work experience</p>
                        <p class="__desc">Tell us about your latest two employments?</p>
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

<script type="text/javascript">
    var citiesByCountry = {
        "Canada": <?php echo json_encode($arrayCitiesCA); ?>,
        "United States": <?php echo json_encode($arrayCitiesUS); ?>,
        "Ireland": <?php echo json_encode($arrayCitiesIE); ?>,
        "United Kingdom": <?php echo json_encode($arrayCitiesGB); ?>
        // Add other countries and their cities when supported
    };

    document.addEventListener('DOMContentLoaded', function() {
        var countrySelect = document.getElementById('country');
        var citySelect = document.getElementById('city');

        countrySelect.addEventListener('change', function() {
            var selectedCountry = this.value;
            var cities = citiesByCountry[selectedCountry] || [];

            // Clear current city options
            while (citySelect.firstChild) {
                citySelect.removeChild(citySelect.firstChild);
            }

            // Add a default option
            var defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Select city...';
            citySelect.appendChild(defaultOption);

            // Populate city options
            cities.forEach(function(city) {
                var option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
            });
        });
    });
</script>