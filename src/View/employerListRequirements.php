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
                <h2>Requirements from the candidates</h2>
                <section class="<?= $cssPrefix; ?>-form-container _margin__top-default">
                    <form action="company" method="post" id="company-form">
                        <div class="__form-section">
                            <div class="__group">
                                <div class="<?= $cssPrefix; ?>-grid -column-5 -gap-c-default">
                                    <label for="name">Minimum of</label>
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
                                    <label>in</label>
                                    <div class="<?= $cssPrefix; ?>-pill-container">
                                        <span class="__pill">Administrative Skills</span>
                                    </div>
                                    <label>experience</label>
                                </div>
                            </div>
                        </div>

                        <div class="<?= $cssPrefix; ?>-pill-container">
                            <span class="__pill">Education</span>
                            <span class="__pill">Interview Availability</span>
                            <span class="__pill">Experience</span>
                            <span class="__pill">Location</span>
                            <span class="__pill">Driving License</span>
                            <span class="__pill">Language</span>
                            <span class="__pill">Work Authorisation</span>
                            <span class="__pill">Background Check</span>
                            <span class="__pill">Willingness to Travel</span>
                            <span class="__pill">Relocation</span>
                            <span class="__pill">Working Days</span>
                            <span class="__pill">Start Date</span>
                            <span class="__pill">Security Clearance</span>
                            <span class="__pill">Share References</span>
                            <span class="__pill">Software Experience</span>
                            <span class="__pill">Service Experience</span>
                        </div>

                        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                        <hr class="_hr__grey-light" />
                        <div class="__buttons <?= $cssPrefix; ?>-button-container _margin__top-default _text-align__right">
                            <button type="submit" name="company" class="__button -outline -grey _margin__right-micro">skip</button>
                            <button type="submit" name="company" class="__button">Continue to final step</button>
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
                    <div class="__bullet"></div>
                    <div class="__copy">
                        <p class="__title">Job details</p>
                        <p class="__desc">Explain the detail of salary and job roles.</p>
                    </div>
                </div>
                <div class="__step <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small">
                    <div class="__bullet -active"></div>
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