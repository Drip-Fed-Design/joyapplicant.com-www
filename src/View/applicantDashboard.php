<?

use JoyApplicant\Controller\JobController;
use JoyApplicant\Controller\OnboardController;

$dbConnection = require_once __DIR__ . '/../../config/global.db.php';
$jobController = new JobController($dbConnection);
$onboardController = new OnboardController($dbConnection);

// Check user onboarding
$userId = $_SESSION['user_id'];
$onboardController->checkOnboarding($userId);
?>

<section class="<?= $cssPrefix; ?>-dashboard-container">
    <div class="_width__max">
        <?
        // Load the session alert outputs
        require_once __DIR__ . '/messageAlert.php';
        ?>
        <div class="<?= $cssPrefix; ?>-grid -column-dashboard -gap-c-default">
            <? require __DIR__ . '/applicantMenu.php'; ?>
            <div class="__dashboard">
                <div class="<?= $cssPrefix; ?>-grid -column-2 -gap-c-default -align-v-center">
                    <div class="__heading">
                        <h1 class="-banner _tf-paytone-one">Dashboard</h1>
                        <p class="_font-size__secondary">Let's take a look at how things are stacking up.</p>
                    </div>
                    <div class="<?= $cssPrefix; ?>-search-container">
                        <section class="<?= $cssPrefix; ?>-form-container">
                            <form action="search" method="post" id="search-form" class="_background-colour__grey-light">
                                <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -align-v-center">
                                    <div class="__group">
                                        <input type="search" id="search" name="search" class="__input -inset" placeholder="Find your next dream role..." required />
                                    </div>
                                    <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                                    <div class="__buttons <?= $cssPrefix; ?>-button-container">
                                        <button type="submit" name="search" class="__button -inset">Search</button>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
                <div class="<?= $cssPrefix; ?>-grid -column-2 -gap-c-small -gap-r-small">
                    <div class="__widget">
                        <h4>Upcoming Interviews</h4>
                        <div class="<?= $cssPrefix; ?>-chart-container">
                            <? require __DIR__ . '/../../templates/widget.event.php'; ?>
                            <hr class="_hr__grey-light" />
                            <? require __DIR__ . '/../../templates/widget.event.php'; ?>
                            <hr class="_hr__grey-light" />
                            <? require __DIR__ . '/../../templates/widget.event.php'; ?>
                        </div>
                        <div class="__buttons <?= $cssPrefix; ?>-button-container">
                            <a href="calendar" title="#" class="__button -plain -orange">View all events <i class="_icon -small -chev-r __o"></i></a>
                        </div>
                    </div>
                    <div class="__widget">
                        <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small -align-v-center">
                            <h4>Jobs Applied</h4>
                            <p class="_font-size__secondary _text-align__right">Showing 3 or 14 applied jobs</p>
                        </div>
                        <div class="<?= $cssPrefix; ?>-chart-container">
                            <? require __DIR__ . '/../../templates/widget.applied.php'; ?>
                            <hr class="_hr__grey-light" />
                            <? require __DIR__ . '/../../templates/widget.applied.php'; ?>
                            <hr class="_hr__grey-light" />
                            <? require __DIR__ . '/../../templates/widget.applied.php'; ?>
                        </div>
                        <div class="__buttons <?= $cssPrefix; ?>-button-container">
                            <a href="applied" title="#" class="__button -plain -orange">View all applied jobs <i class="_icon -small -chev-r __o"></i></a>
                        </div>
                    </div>
                    <div class="__widget">
                        <h4>Jobs Status</h4>
                        <div class="<?= $cssPrefix; ?>-chart-container">
                            chart here
                        </div>
                        <div class="__buttons <?= $cssPrefix; ?>-button-container">
                            <a href="applied" title="#" class="__button -plain -orange">View all jobs applied <i class="_icon -small -chev-r __o"></i></a>
                        </div>
                    </div>
                    <div class="__widget">
                        <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small -align-v-center">
                            <h4>Saved Jobs</h4>
                            <p class="_font-size__secondary _text-align__right">Showing 3 or 19 saved jobs</p>
                        </div>
                        <div class="<?= $cssPrefix; ?>-chart-container">
                            <? require __DIR__ . '/../../templates/widget.saved.php'; ?>
                            <hr class="_hr__grey-light" />
                            <? require __DIR__ . '/../../templates/widget.saved.php'; ?>
                            <hr class="_hr__grey-light" />
                            <? require __DIR__ . '/../../templates/widget.saved.php'; ?>
                        </div>
                        <div class="__buttons <?= $cssPrefix; ?>-button-container">
                            <a href="saved" title="#" class="__button -plain -orange">View all saved jobs <i class="_icon -small -chev-r __o"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="__job-list _background-colour__secondary-green-light">
    <?
    // Output the job listings
    $jobs = $jobController->getKeywordJob(4, 'product designer');
    include __DIR__ . '/jobCard.php';
    ?>
</div>