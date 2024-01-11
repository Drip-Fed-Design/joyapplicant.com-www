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
                        <h1 class="-banner _tf-paytone-one">Saved Jobs</h1>
                        <p class="_font-size__secondary">Let's search for your next role or career step!</p>
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
                <div class="__job-list _background-colour__secondary-green-light">
                    <?
                    // Output the job listings
                    $jobs = $jobController->getKeywordJob(4, 'product designer');
                    include __DIR__ . '/jobCard.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>