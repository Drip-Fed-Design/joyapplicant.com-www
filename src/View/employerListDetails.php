<?
require_once __DIR__ . '/../../config/global.static.php';

// Generate a new CSRF token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
?>
<script src="https://cdn.tiny.cloud/1/25ymu4ev55v3yckntpymc5t22vwl94mj9sxq6211m0no6zqv/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.-tinymce',
        skin: 'borderless', // 'naked'
        icons: 'small',
        menubar: false,
        statusbar: false,
        plugins: 'link lists tinymcespellchecker',
        toolbar: 'bold italic bullist | link | spellcheckdialog | removeformat',
        height: 250
    });
</script>
<section class="<?= $cssPrefix; ?>-dashboard-container">
    <div class="_width__max">
        <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -gap-c-medium">
            <div class="__copy">
                <?
                // Load the session alert outputs
                require_once __DIR__ . '/messageAlert.php';
                ?>
                <h2>Next, tell us about the job details</h2>
                <section class="<?= $cssPrefix; ?>-form-container _margin__top-default">
                    <form action="details" method="post" id="details-form">
                        <h4>What is the salary range candidates can expect?</h4>
                        <div class="__form-section">
                            <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-default _padding__bottom-small">
                                <input type="checkbox" id="volunteer" name="volunteer" class="__input -grey" value="1" />
                                <label for="volunteer">This is a volunteer role, therefore has no salary association.</label>
                            </div>
                            <div class="__group -salary-volunteer">
                                <label for="name">Salary range *</label>
                                <div class="<?= $cssPrefix; ?>-grid -column-4 -gap-c-default -align-v-center">

                                    <select id="currency" name="currency" class="__select -grey" required>
                                        <option value="">Select...</option>
                                        <optgroup label="Most Selected">
                                            <?
                                            foreach ($arraySalaryCurrencyPopular as $key => $value) {
                                                echo '<option value="' . $key . '">' . $value . '</option>';
                                            }
                                            ?>
                                        </optgroup>
                                        <optgroup label="All">
                                            <?
                                            foreach ($arraySalaryCurrency as $key => $value) {
                                                echo '<option value="' . $key . '">' . $value . '</option>';
                                            }
                                            ?>
                                        </optgroup>
                                    </select>

                                    <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -gap-c-default -align-v-center">
                                        <input type="text" id="salarymin" name="salarymin" class="__input -grey -salary-format" placeholder="30,250" required />
                                        <div class="__group">
                                            <label>to</label>
                                        </div>
                                    </div>
                                    <input type="text" id="salarymax" name="salarymax" class="__input -grey -salary-format" placeholder="34,500" required />
                                    <select id="term" name="term" class="__select -grey" required>
                                        <?
                                        foreach ($arraySalaryTerms as $key => $value) {
                                            echo '<option value="' . $key . '">' . $value . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h4>Description and Teaser</h4>
                        <div class="__form-section">
                            <div class="__group">
                                <label for="teaser">Describe the role in 160 characters or less *</label>
                                <textarea type="teaser" id="teaser" name="teaser" class="__input -grey" placeholder="Describe the role in 160 or less..." maxlength="160" required></textarea>
                                <div class="__tip">Role teaser for listing and search in 160 characters.</div>
                            </div>
                        </div>
                        <h4>Expand on the role and reasons behind the hire?</h4>
                        <div class="__form-section">
                            <div class="__group">
                                <label for="why">Why are you hiring *</label>
                                <textarea type="why" id="why" name="why" class="__input -grey -tinymce" placeholder="Why are you hiring..."></textarea>
                                <div class="__tip">Explanation of the need for this role.</div>
                            </div>
                            <div class="__group">
                                <label for="duties">Duties of the role *</label>
                                <textarea type="duties" id="duties" name="duties" class="__input -grey -tinymce" placeholder="Why are you hiring..."></textarea>
                                <div class="__tip">General tasks to be performed.</div>
                            </div>
                            <div class="__group">
                                <label for="benefits">Benefits *</label>
                                <textarea type="benefits" id="benefits" name="benefits" class="__input -grey -tinymce" placeholder="What are benefits and perks..."></textarea>
                                <div class="__tip">Benefits of the role or available by company.</div>
                            </div>
                        </div>
                        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                        <input type="hidden" name="jobsession" value="<?= $_SESSION['job_session']; ?>">
                        <hr class="_hr__grey-light" />
                        <div class="__buttons <?= $cssPrefix; ?>-button-container _margin__top-default _text-align__right">
                            <button type="submit" name="details" class="__button">Continue</button>
                        </div>
                    </form>
                </section>
            </div>
            <div class="<?= $cssPrefix; ?>-steps-container">
                <div class="__step <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small">
                    <div class="__bullet"></div>
                    <div class="__copy">
                        <p class="__title">Getting started</p>
                        <p class="__desc">Let's start with the basic job details.</p>
                    </div>
                </div>
                <div class="__step <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small">
                    <div class="__bullet -active"></div>
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
    // Hide the Form When "volunteer" is Checked
    document.addEventListener('DOMContentLoaded', function() {
        var volunteerCheckbox = document.getElementById('volunteer');
        var salaryElements = document.querySelectorAll('.-salary-volunteer');


        function toggleFormAndRequiredAttributes() {
            salaryElements.forEach(function(element) {
                if (element.id !== 'volunteer') {
                    // Toggle display
                    element.style.display = volunteerCheckbox.checked ? 'none' : '';

                    // Find all input, textarea, and select elements within this group
                    var inputs = element.querySelectorAll('input, textarea, select');

                    // Toggle the required attribute
                    inputs.forEach(function(input) {
                        if (volunteerCheckbox.checked) {
                            input.removeAttribute('required');
                        } else {
                            input.setAttribute('required', '');
                        }
                    });
                }
            });
        }
        volunteerCheckbox.addEventListener('change', toggleFormAndRequiredAttributes);
        toggleFormAndRequiredAttributes(); // call on initial load
    });


    // Select all elements with the class '-salary-format'
    const inputs = document.querySelectorAll('.-salary-format');

    inputs.forEach(function(input) {
        input.addEventListener('input', function(e) {
            // Remove any characters that are not digits
            let value = e.target.value.replace(/[^\d]/g, '');

            // Convert to a number then back to a string to remove leading zeros
            value = Number(value).toString();

            // Add thousand separators
            let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            // Update the input field with the formatted value
            e.target.value = formattedValue ? formattedValue : '';
        });
    });
</script>