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
                <h2>Next, tell us about the job details</h2>
                <section class="<?= $cssPrefix; ?>-form-container _margin__top-default">
                    <form action="details" method="post" id="details-form">
                        <h4>What is the salary range candidates can expect?</h4>
                        <div class="__form-section">
                            <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-default _padding__bottom-small">
                                <input type="checkbox" id="entry" name="entry" class="__input -grey" value="1" />
                                <label for="entry">This is a volunteer role, therefore has no salary association.</label>
                            </div>
                            <div class="__group">
                                <label for="name">Salary range *</label>
                                <div class="<?= $cssPrefix; ?>-grid -column-3 -gap-c-default -align-v-center">
                                    <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -gap-c-default -align-v-center">
                                        <input type="text" id="salarymin" name="salarymin" class="__input -grey" placeholder="£30,000.00" required />
                                        <div class="__group">
                                            <label>to</label>
                                        </div>
                                    </div>
                                    <input type="text" id="salarymax" name="salarymax" class="__input -grey" placeholder="£34,999.00" required />
                                    <select id="term" name="term" class="__select -grey" required>
                                        <?
                                        foreach ($arraySalaryTerms as $c) {
                                            echo '<option value="' . $c . '">' . $c . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h4>Expand on the role and reasons behind the hire?</h4>
                        <div class="__form-section">
                            <div class="__group">
                                <label for="why">Why are you hiring *</label>
                                <textarea type="why" id="why" name="why" class="__input -grey" placeholder="Why are you hiring..." required></textarea>
                                <div class="__tip">Explanation of the need for this role.</div>
                            </div>
                            <div class="__group">
                                <label for="duties">Duties of the role *</label>
                                <textarea type="duties" id="duties" name="duties" class="__input -grey" placeholder="Why are you hiring..." required></textarea>
                                <div class="__tip">General tasks to be performed.</div>
                            </div>
                            <div class="__group">
                                <label for="responsibilities">Responsibilities *</label>
                                <textarea type="responsibilities" id="responsibilities" name="responsibilities" class="__input -grey" placeholder="Responsibilities..." required></textarea>
                                <div class="__tip">Key responsibilities and expectations.</div>
                            </div>
                        </div>
                        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
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