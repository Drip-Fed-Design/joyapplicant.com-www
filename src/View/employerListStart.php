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
                <h2>Getting started</h2>
                <p>We'll keep questions to a minimum, but just enough to provide you with the best candidates.</p>
                <section class="<?= $cssPrefix; ?>-form-container _margin__top-default">
                    <form action="company" method="post" id="company-form">
                        <div class="__form-section">
                            <div class="<?= $cssPrefix; ?>-grid -column-2 -gap-c-default">
                                <div class="__group">
                                    <label for="title">Job Title *</label>
                                    <input type="text" id="title" name="title" class="__input -grey" placeholder="Job title..." required />
                                    <div class="__tip">The specific title of the job.</div>
                                </div>
                                <div class="__group">
                                    <label for="type">Employment Type *</label>
                                    <select id="type" name="type" class="__select -grey" required>
                                        <option value="">Select...</option>
                                        <?
                                        sort($arrayEmploymentType);
                                        foreach ($arrayEmploymentType as $c) {
                                            echo '<option value="' . $c . '">' . $c . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <div class="__tip">Full-time, part-time, contract, etc</div>
                                </div>
                                <div class="__group">
                                    <label for="category">Job Category *</label>
                                    <select id="categorySelect" name="category" class="__select -grey" required>
                                        <option value="">Select...</option>
                                        <?php
                                        foreach ($arrayJobCategory as $key => $value) {
                                            echo '<option value="' . $key . '">' . $value . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <div class="__tip">Broad classification (e.g. IT, Healthcare).</div>
                                </div>
                                <div class="__group">
                                    <label for="role">Job Role *</label>
                                    <select id="roleSelect" name="role" class="__select -grey" required>
                                        <option value="">Select...</option>
                                    </select>
                                    <div class="__tip">More specific industry role (e.g. Software Development, Nursing).</div>
                                </div>
                            </div>
                        </div>
                        <h4>Where is the job located?</h4>
                        <div class="__form-section">
                            <div class="__group">
                                <label for="conditions">Working Conditions *</label>
                                <select id="conditions" name="conditions" class="__select -grey" required>
                                    <option value="">Select...</option>
                                    <?
                                    sort($arrayWorkingConditions);
                                    foreach ($arrayWorkingConditions as $c) {
                                        echo '<option value="' . $c . '">' . $c . '</option>';
                                    }
                                    ?>
                                </select>
                                <div class="__tip">On-side, traveling, global, remote, hybrid, etc</div>
                            </div>
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
                                    <div class="__tip">This is the City you're currently living within or near by.</div>
                                </div>
                                <div class="__group">
                                    <label for="postcodezip">Postcode / Zip Code *</label>
                                    <input type="text" id="postcodezip" name="postcodezip" class="__input -grey" placeholder="Postcode / Zip Code..." required />
                                    <div class="__tip">This postal or zip code of the role location.</div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                        <hr class="_hr__grey-light" />
                        <div class="__buttons <?= $cssPrefix; ?>-button-container _margin__top-default _text-align__right">
                            <button type="submit" name="company" class="__button">Continue</button>
                        </div>
                    </form>
                </section>
            </div>
            <div class="<?= $cssPrefix; ?>-steps-container">
                <div class="__step <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small">
                    <div class="__bullet -active"></div>
                    <div class="__copy">
                        <p class="__title">Getting started</p>
                        <p class="__desc">Let's start with the basic job details.</p>
                    </div>
                </div>
                <div class="__step <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small">
                    <div class="__bullet"></div>
                    <div class="__copy">
                        <p class="__title">Job details</p>
                        <p class="__desc">Explain the detail of salary and job roles.</p>
                    </div>
                </div>
                <div class="__step <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small">
                    <div class="__bullet"></div>
                    <div class="__copy">
                        <p class="__title">Requirements</p>
                        <p class="__desc">Outline what's needed from a candidate.</p>
                    </div>
                </div>
                <div class="__step <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small">
                    <div class="__bullet"></div>
                    <div class="__copy">
                        <p class="__title">Key Dates</p>
                        <p class="__desc">Finally, set date for job listing and onboarding.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    var jobRoles = <?php echo json_encode($arrayJobRole); ?>;
</script>

<!-- JavaScript code for handling the select change event -->
<script type="text/javascript">
    document.getElementById('categorySelect').addEventListener('change', function() {
        var category = this.value;
        var roles = jobRoles[category];
        var roleSelect = document.getElementById('roleSelect');

        roleSelect.innerHTML = ''; // Clear existing options
        for (var key in roles) {
            var opt = document.createElement('option');
            opt.value = key;
            opt.innerHTML = roles[key];
            roleSelect.appendChild(opt);
        }
    });
</script>