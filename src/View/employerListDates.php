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
                <h2>Finally, let's set some dates.</h2>
                <section class="<?= $cssPrefix; ?>-form-container _margin__top-default">
                    <form action="dates" method="post" id="dates-form">
                        <h4>When do you want to start listing the job?</h4>
                        <div class="__form-section">
                            <div class="<?= $cssPrefix; ?>-grid -column-2 -gap-c-default">
                                <div class="__group">
                                    <label for="opening">Opening date *</label>
                                    <input type="date" id="opening" name="opening" class="__input -grey" placeholder="DD/MM/YYYY" required />
                                    <div class="__tip">When the job posting goes live on JoyApplicant.</div>
                                </div>
                                <div class="__group">
                                    <label for="closing">Closing date *</label>
                                    <input type="date" id="closing" name="closing" class="__input -grey" placeholder="DD/MM/YYYY" required />
                                    <div class="__tip">When the job postings deadline for applications.</div>
                                </div>
                            </div>
                        </div>
                        <h4>What are your expected hire dates?</h4>
                        <div class="__form-section">
                            <div class="<?= $cssPrefix; ?>-grid -column-2 -gap-c-default">
                                <div class="__group">
                                    <label for="interview">We're expecting to start interview from *</label>
                                    <input type="date" id="interview" name="interview" class="__input -grey" placeholder="DD/MMM/YYYY..." required />
                                    <div class="__tip">Approx. date when candidate interviews will start.</div>
                                </div>
                                <div class="__group">
                                    <label for="target">We're targeting to have our candidate by *</label>
                                    <input type="date" id="target" name="target" class="__input -grey" placeholder="DD/MMM/YYYY..." required />
                                    <div class="__tip">The date we're expecting to have an offer put to the final candidate, or their starting date.</div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                        <input type="hidden" name="jobsession" value="<?= $_SESSION['job_session']; ?>">
                        <input type="hidden" name="status" value="1">
                        <hr class="_hr__grey-light" />
                        <div class="__buttons <?= $cssPrefix; ?>-button-container _margin__top-default _text-align__right">
                            <button type="submit" name="dates" class="__button">Complete and publish</button>
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
                    <div class="__bullet"></div>
                    <div class="__copy">
                        <p class="__title">Requirements</p>
                        <p class="__desc">Outline what's needed from a candidate.</p>
                    </div>
                </div>
                <div class="__step <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small">
                    <div class="__bullet -active"></div>
                    <div class="__copy">
                        <p class="__title">Key Dates</p>
                        <p class="__desc">Finally, set date for job listing and onboarding.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>