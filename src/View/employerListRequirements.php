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
                    <form action="requirements" method="post" id="requirements-form">

                        <div class="__form-section">
                            <div class="__group">
                                <label for="requires">Candidate requirements *</label>
                                <textarea rows="8" type="requires" id="requires" name="requires" class="__input -grey" placeholder="What requirements should the candidate have..." required></textarea>
                                <div class="__tip">Try to be clear with the requirements you need from your candidates.</div>
                            </div>
                        </div>

                        <!--                         
                        <? foreach ($arrayWorkingRequirements as $k => $v) { ?>
                            <div class="__form-section" id="<?= $k; ?>-row" style="display: block;">
                                <div class="__group">

                                    <? if ($v['outputType'] === 'int') { ?>
                                        <div class="<?= $cssPrefix; ?>-grid -column-max-max-max -gap-c-default">
                                            <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-default -align-v-center">
                                                <label for="<?= $k; ?>"><?= $v['outputIntro']; ?></label>
                                                <select id="<?= $k; ?>" name="<?= $k; ?>" class="__select -grey">
                                                    <?
                                                    sort($arrayPeriodYears);
                                                    foreach ($arrayPeriodYears as $c) {
                                                        echo '<option value="' . $c . '">' . $c . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="<?= $cssPrefix; ?>-grid -column-max-max-max -gap-c-default -align-v-center">
                                                <label for="<?= $k; ?>"><?= $v['outputMid']; ?></label>
                                                <div class="<?= $cssPrefix; ?>-pill-container">
                                                    <span class="__pill"><?= $v['outputSubject']; ?></span>
                                                </div>
                                                <label for="<?= $k; ?>"><?= $v['outputOutro']; ?></label>
                                            </div>
                                            <a href="#" class="close-row" data-target="#<?= $k; ?>-row"><span class="_icon -close"></span> </a>
                                        </div>

                                    <? } else if ($v['outputType'] === 'custom') { ?>
                                        <div class="<?= $cssPrefix; ?>-grid -column-max-max-max -gap-c-default">
                                            <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-default -align-v-center">
                                                <label for="<?= $k; ?>"><?= $v['outputIntro']; ?></label>
                                                <select id="<?= $k; ?>" name="<?= $k; ?>" class="__select -grey">
                                                    <?
                                                    foreach ($v['outputOptions'] as $kk => $vv) {
                                                        echo '<option value="' . $kk . '">' . $vv . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="<?= $cssPrefix; ?>-grid -column-max-max-max -gap-c-default -align-v-center">
                                                <label for="<?= $k; ?>"><?= $v['outputMid']; ?></label>
                                                <div class="<?= $cssPrefix; ?>-pill-container">
                                                    <span class="__pill"><?= $v['outputSubject']; ?></span>
                                                </div>
                                                <label for="<?= $k; ?>"><?= $v['outputOutro']; ?></label>
                                            </div>
                                            <a href="#" class="close-row" data-target="#<?= $k; ?>-row"><span class="_icon -close"></span> </a>
                                        </div>
                                    <? } ?>

                                </div>
                            </div>
                        <? } ?>
                        <div class="<?= $cssPrefix; ?>-pill-container">
                            <? foreach ($arrayWorkingRequirements as $k => $v) { ?>
                                <span class="__pill _req-action" data-target="#<?= $k; ?>-row">+ <?= $v['outputSubject']; ?></span>
                            <? } ?>
                        </div> -->
                        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                        <input type="hidden" name="jobsession" value="<?= $_SESSION['job_session']; ?>">
                        <hr class="_hr__grey-light" />
                        <div class="__buttons <?= $cssPrefix; ?>-button-container _margin__top-default _text-align__right">
                            <button type="submit" name="skip" class="__button -outline -grey _margin__right-micro">skip</button>
                            <button type="submit" name="requirements" class="__button">Continue to final step</button>
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
<script>
    document.querySelectorAll('._req-action').forEach(function(button) {
        button.addEventListener('click', function() {
            var targetSelector = button.getAttribute('data-target');
            var targetElement = document.querySelector(targetSelector);
            // Hide the button
            button.style.display = 'none'; // If you want to use the 'hidden' class here, make sure it's defined in your CSS
            // Show the targeted row and set inputs as required
            targetElement.style.display = 'block'; // Replace this with targetElement.classList.add('active'); if using class-based toggling
            targetElement.querySelectorAll('select').forEach(function(input) {
                input.required = true;
            });
        });
    });
    document.querySelectorAll('.close-row').forEach(function(button) {
        button.addEventListener('click', function() {
            var targetSelector = button.getAttribute('data-target');
            var targetElement = document.querySelector(targetSelector);
            // Hide the row and unset inputs as required
            targetElement.style.display = 'none'; // Replace this with targetElement.classList.remove('active'); if using class-based toggling
            targetElement.querySelectorAll('select').forEach(function(input) {
                input.required = false;
            });
            // Find the button that corresponds to this row and show it again
            document.querySelector(`._req-action[data-target="${targetSelector}"]`).style.display = 'inline-block'; // If you want to use the 'hidden' class here, make sure it's defined in your CSS
        });
    });
</script>