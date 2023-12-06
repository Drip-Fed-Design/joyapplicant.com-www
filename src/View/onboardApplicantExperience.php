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
                <h2>Next, what's your most recent work experience?</h2>
                <section class="<?= $cssPrefix; ?>-form-container _margin__top-default">
                    <form action="experience" method="post" id="experience-form">
                        <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-default">
                            <input type="checkbox" id="entry" name="entry" class="__input -grey" value="1" />
                            <label for="entry">I don't have any work experience, that's why I'm here!</label>
                        </div>
                        <div class="<?= $cssPrefix; ?>-grid -column-2 -gap-c-default">
                            <div class="__group">
                                <label for="role">Title of role *</label>
                                <input type="text" id="role" name="role" class="__input -grey" placeholder="Title of role..." required />
                            </div>
                            <div class="__group">
                                <label for="company">Company *</label>
                                <input type="text" id="company" name="company" class="__input -grey" placeholder="Company..." required />
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
                            </div>
                        </div>
                        <div class="__group <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-default">
                            <input type="checkbox" id="current" name="current" class="__input -grey" value="1" />
                            <label for="current">I am currently working in this role.</label>
                        </div>
                        <div class="<?= $cssPrefix; ?>-grid -column-4 -gap-c-default">
                            <div class="__group">
                                <label for="startmonth">Start date *</label>
                                <select id="startmonth" name="startmonth" class="__select -grey" required>
                                    <option value="">Select...</option>
                                    <?
                                    foreach ($arrayMonths as $n => $m) {
                                        echo '<option value="' . $n . '">' . $m . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="__group">
                                <label for="startyear" style="visibility:hidden;">Start year *</label>
                                <select id="startyear" name="startyear" class="__select -grey" required>
                                    <option value="">Select...</option>
                                    <?
                                    $currentYear = date('Y');
                                    // Loop to generate each year option
                                    for ($year = $currentYear; $year >= $currentYear - 25; $year--) {
                                        echo '<option value="' . $year . '">' . $year . '</option>';
                                    }
                                    ?>
                                    <option value="Over 25 years">Over 25 years</option>
                                </select>
                            </div>
                            <div class="__group">
                                <label for="endmonth">End date *</label>
                                <select id="endmonth" name="endmonth" class="__select -grey" required>
                                    <option value="">Select...</option>
                                    <?
                                    foreach ($arrayMonths as $n => $m) {
                                        echo '<option value="' . $n . '">' . $m . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="__group">
                                <label for="endyear" style="visibility:hidden;">End year *</label>
                                <select id="endyear" name="endyear" class="__select -grey" required>
                                    <option value="">Select...</option>
                                    <?
                                    $currentYear = date('Y');
                                    // Loop to generate each year option
                                    for ($year = $currentYear; $year >= $currentYear - 25; $year--) {
                                        echo '<option value="' . $year . '">' . $year . '</option>';
                                    }
                                    ?>
                                    <option value="Over 25 years">Over 25 years</option>
                                </select>
                            </div>
                        </div>
                        <div class="__group">
                            <label for="desc">Description *</label>
                            <textarea id="desc" name="desc" rows="4" class="__textarea -grey"></textarea>
                            <div class="__tip">Share details about your last role, such as what you did day-to-day, or the projects your worked on and the role you played within them. Try to keep as brief as possible, while still covering key areas of your responsibility.</div>
                        </div>
                        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                        <hr class="_hr__grey-light" />
                        <div class="__buttons <?= $cssPrefix; ?>-button-container _margin__top-default _text-align__right">
                            <button type="submit" name="experience" class="__button">Continue to final step</button>
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
    // Convert PHP Arrays to JavaScript
    var citiesByCountry = {
        "Canada": <?php echo json_encode($arrayCitiesCA); ?>,
        "United States": <?php echo json_encode($arrayCitiesUS); ?>,
        "Ireland": <?php echo json_encode($arrayCitiesIE); ?>,
        "United Kingdom": <?php echo json_encode($arrayCitiesGB); ?>
        // Add other countries and their cities when supported
    };

    // Add JavaScript to Handle the Country Selection Change
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

    // Hide the Form When "entry" is Checked
    document.addEventListener('DOMContentLoaded', function() {
        var entryCheckbox = document.getElementById('entry');
        var formElements = document.querySelectorAll('.__group');

        function toggleFormAndRequiredAttributes() {
            formElements.forEach(function(element) {
                if (element.id !== 'entry') {
                    // Toggle display
                    element.style.display = entryCheckbox.checked ? 'none' : '';

                    // Find all input, textarea, and select elements within this group
                    var inputs = element.querySelectorAll('input, textarea, select');

                    // Toggle the required attribute
                    inputs.forEach(function(input) {
                        if (entryCheckbox.checked) {
                            input.removeAttribute('required');
                        } else {
                            input.setAttribute('required', '');
                        }
                    });
                }
            });
        }
        entryCheckbox.addEventListener('change', toggleFormAndRequiredAttributes);
        toggleFormAndRequiredAttributes(); // call on initial load
    });


    // Hide "endmonth" and "endyear" When "current" is Checked
    document.addEventListener('DOMContentLoaded', function() {
        var currentCheckbox = document.getElementById('current');
        var endMonthGroup = document.querySelector('.__group #endmonth').parentNode;
        var endYearGroup = document.querySelector('.__group #endyear').parentNode;

        function toggleEndDateVisibilityAndRequired() {
            var isCurrentChecked = currentCheckbox.checked;

            // Toggle visibility of the groups
            endMonthGroup.style.display = isCurrentChecked ? 'none' : '';
            endYearGroup.style.display = isCurrentChecked ? 'none' : '';

            // Toggle the required attribute for endmonth and endyear
            var endMonthSelect = document.getElementById('endmonth');
            var endYearSelect = document.getElementById('endyear');

            if (isCurrentChecked) {
                endMonthSelect.removeAttribute('required');
                endYearSelect.removeAttribute('required');
            } else {
                endMonthSelect.setAttribute('required', '');
                endYearSelect.setAttribute('required', '');
            }
        }

        currentCheckbox.addEventListener('change', toggleEndDateVisibilityAndRequired);
        toggleEndDateVisibilityAndRequired(); // call on initial load
    });


    // Dynamic "endyear" Based on "startyear"
    document.addEventListener('DOMContentLoaded', function() {
        var startYearSelect = document.getElementById('startyear');
        var endYearSelect = document.getElementById('endyear');

        function updateEndYearOptions() {
            var selectedStartYear = parseInt(startYearSelect.value);
            endYearSelect.innerHTML = ''; // clear existing options

            if (!isNaN(selectedStartYear)) {
                for (var year = selectedStartYear; year <= selectedStartYear + 25; year++) {
                    var option = document.createElement('option');
                    option.value = year;
                    option.textContent = year;
                    endYearSelect.appendChild(option);
                }
            }
        }

        startYearSelect.addEventListener('change', updateEndYearOptions);
    });
</script>