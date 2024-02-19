<?
require_once __DIR__ . '/../../config/global.static.php';

// Generate a new CSRF token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

// Fetch job opening date from session
$jobOpeningDate = new DateTimeImmutable($_SESSION['job_opening_date']);
?>

<section class="<?= $cssPrefix; ?>-dashboard-container">
    <div class="_width__max">
        <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -gap-c-medium">
            <div class="__copy">
                <?
                // Load the session alert outputs
                require_once __DIR__ . '/messageAlert.php';
                ?>
                <h2>Congratulations, but WAIT!</h2>
                <div class="<?= $cssPrefix; ?>-alert-container -notice" role="alert">
                    <p>Your job is currently saved as a draft. This means it won't be available for applicants to apply until you give the go-ahead.</p>
                </div>
                <section class="<?= $cssPrefix; ?>-form-container _margin__top-default">
                    <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-medium">
                        <div class="__buttons <?= $cssPrefix; ?>-button-container _margin__top-default _text-align__right">
                            <a href="/" title="Keep post as a draft" class="__button -outline -grey">Keep as draft</a>
                        </div>
                        <form action="publish" method="post" id="publish-form">
                            <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                            <input type="hidden" name="jobsession" value="<?= $_SESSION['job_session']; ?>">
                            <input type="hidden" name="status" value="1">
                            <div class="__buttons <?= $cssPrefix; ?>-button-container _margin__top-default _text-align__left">
                                <button type="submit" name="publish" class="__button">Publish on <?= $jobOpeningDate->format('jS F Y') ?></button>
                            </div>
                        </form>
                    </div>
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