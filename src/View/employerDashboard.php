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
            <div class="__user-nav">
                <div class="__areas">
                    <ul>
                        <li><a href="#" title="#"><i class="_icon -small -dashboard"></i> Dashboard</a></li>
                        <li><a href="search" title="search jobs"><i class="_icon -small -search"></i> Search Jobs</a></li>
                        <li><a href="#" title="#"><i class="_icon -small -message"></i> Messages</a></li>
                        <li><a href="#" title="#"><i class="_icon -small -calendar"></i> Calendar</a></li>
                        <li><a href="#" title="#"><i class="_icon -small -tick"></i> Applications</a></li>
                        <li><a href="#" title="#"><i class="_icon -small -review"></i> Feedback</a></li>
                    </ul>
                </div>
                <hr class="_hr__white-default" />
                <div class="__user">
                    <ul>
                        <li><a href="#" title="#"><i class="_icon -small -people"></i> Profile</a></li>
                        <li><a href="#" title="#"><i class="_icon -small -settings"></i> Settings</a></li>
                        <li><a href="#" title="#"><i class="_icon -small -help"></i> Help & Support</a></li>
                        <li><a href="logout" title="log out"><i class="_icon -small -secure"></i> Log Out</a></li>
                    </ul>
                </div>
            </div>
            <div class="__dashboard">
                <div class="__heading">
                    <h1 class="-banner _tf-paytone-one">Dashboard</h1>
                    <p class="_font-size__secondary">Let's take a look at how things are stacking up.</p>
                </div>
                <div class="__widget _margin__bottom-small">
                    <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small -align-v-center">
                        <h4>Live Jobs</h4>
                        <p class="_font-size__secondary _text-align__right">Showing 3 or 5 saved jobs</p>
                    </div>
                    <div class="<?= $cssPrefix; ?>-chart-container">
                        <? require __DIR__ . '/../../templates/widget.event.php'; ?>
                        <hr class="_hr__grey-light" />
                        <? require __DIR__ . '/../../templates/widget.event.php'; ?>
                        <hr class="_hr__grey-light" />
                        <? require __DIR__ . '/../../templates/widget.event.php'; ?>
                    </div>
                    <div class="__buttons <?= $cssPrefix; ?>-button-container">
                        <a href="#" title="#" class="__button -plain -orange">View all events <i class="_icon -small -chev-r __o"></i></a>
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
                            <a href="#" title="#" class="__button -plain -orange">View all events <i class="_icon -small -chev-r __o"></i></a>
                        </div>
                    </div>
                    <div class="__widget">
                        <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small -align-v-center">
                            <h4>Draft Jobs</h4>
                            <p class="_font-size__secondary _text-align__right">Showing 3 or 5 saved jobs</p>
                        </div>
                        <div class="<?= $cssPrefix; ?>-chart-container">
                            <? require __DIR__ . '/../../templates/widget.saved.php'; ?>
                            <hr class="_hr__grey-light" />
                            <? require __DIR__ . '/../../templates/widget.saved.php'; ?>
                            <hr class="_hr__grey-light" />
                            <? require __DIR__ . '/../../templates/widget.saved.php'; ?>
                        </div>
                        <div class="__buttons <?= $cssPrefix; ?>-button-container">
                            <a href="#" title="#" class="__button -plain -orange">View all draft jobs <i class="_icon -small -chev-r __o"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>