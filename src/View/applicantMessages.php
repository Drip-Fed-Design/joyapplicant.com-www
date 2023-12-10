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
                <div class="__heading">
                    <h1 class="-banner _tf-paytone-one">Messages</h1>
                    <p class="_font-size__secondary">Let's keep communication in positive motion!</p>
                </div>
                <div class="__job-list _background-colour__secondary-green-light">
                    <br /><br /><br /><br /><br /><br />
                    <p>Messages</p>
                    <br /><br /><br /><br /><br /><br />
                </div>
            </div>
        </div>
    </div>
</section>