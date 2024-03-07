<?

use JoyApplicant\Controller\CompanyController;
use JoyApplicant\Controller\JobController;
use JoyApplicant\Controller\OnboardController;
use JoyApplicant\Controller\FormattingController;

$dbConnection = require_once __DIR__ . '/../../config/global.db.php';
$jobController = new JobController($dbConnection);
$companyController = new CompanyController($dbConnection);
$formattingController = new FormattingController();

// Get job id from URL
$jobId = base64_decode($_GET['jid']);

// Define user and company id
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company_id'];

// Fetch nessasary company details
$companyDetails = $companyController->companyDetails($userId);

// Set company variables
$companyIdTest = $companyDetails[0]['id'];
$companyName = $companyDetails[0]['name'];
$companyLogo = $companyDetails[0]['logo'];
$companyAbout = $companyDetails[0]['about'];
$companyCulture = $companyDetails[0]['culture'];
$companyPostcode = $companyDetails[0]['postcodezip'];
$companyCountry = $companyDetails[0]['country'];
$companyCategory = $companyDetails[0]['category'];
$companyEstablished = $companyDetails[0]['established'];
$companyEmployees = $companyDetails[0]['employees'];

// Encode job ID to reduce hijacking
$companyIdEncode = base64_encode($companyId);

// Fetch nessasary job details
$jobDetails = $jobController->getCompanyJobById($companyId, $jobId);

// Set job variables
$jobStatus = $jobDetails[0]['status'];
$jobTitle = $jobDetails[0]['title'];
$jobVoluntary = $jobDetails[0]['voluntary'];
$salaryMin = $jobDetails[0]['salary_min'];
$salaryMax = $jobDetails[0]['salary_max'];
$jobType = $jobDetails[0]['type'];
$jobShift = $jobDetails[0]['shift'];
$jobPostCode = $jobDetails[0]['postcodezip'];
$jobCountry = $jobDetails[0]['country'];
$jobDateCreated = $jobDetails[0]['created_at'];
$jobDateOpening = $jobDetails[0]['date_opening'];
$jobDateClosing = $jobDetails[0]['date_closing'];

$jobWhy = $jobDetails[0]['why'];
$jobRequirements = $jobDetails[0]['requirements'];
$jobDuties = $jobDetails[0]['duties'];
$jobBenefits = $jobDetails[0]['benefits'];
$jobTeaser = $jobDetails[0]['teaser'];

$jobKeywords = $jobDetails[0]['keywords'];

// Job type and shift formatting
$jobType = $formattingController->getValueFromArray($jobType, $arrayEmploymentType);
$jobShift = $formattingController->getValueFromArray($jobShift, $arrayWorkingShift);

// Data formatting
// Check if role is voluntary, format salary
if ($jobVoluntary === 1) {
    $jobSalary = 'Voluntary';
} else {
    $jobSalary = "£" . number_format($salaryMin, 0, '.', ',') . " - £" . number_format($salaryMax, 0, '.', ',');
}

// Format posted date
$currentDate = new DateTime();
$jobDateOpening = new DateTime($jobDateOpening);
$interval = $jobDateOpening->diff($currentDate);

// Format post closing date
$jobDateClosing = new DateTime($jobDateClosing);
$jobDateClosing = $jobDateClosing->diff($currentDate);
?>

<section class="<?= $cssPrefix; ?>-job-container">
    <div class="_width__max">
        <?
        // Load the session alert outputs
        require_once __DIR__ . '/messageAlert.php';
        ?>
        <div class="<?= $cssPrefix; ?>-grid -column-jobview -gap-c-default">

            <div class="__job-details">
                <div class="__back -top">
                    <a href="#" class="__location _font-size__secondary"><i class="_icon -small -chev-l -o"></i>Back to active jobs</a>
                </div>
                <!-- Job toolbar - START -->
                <div class="__toolbar">
                    <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -gap-c-small -align-v-center">
                        <? if ($jobStatus === 1) { ?>
                            <h2>Job is live</h2>
                        <? } else { ?>
                            <div class="__details">
                                <h2>Job is draft</h2>
                                <p class="__posted _font-size__secondary"><?= "Created on " . date('l, M j, Y @ g:ia', strtotime($jobDateCreated)); ?></p>
                            </div>

                            <div class="__buttons <?= $cssPrefix; ?>-button-container">
                                <a href="edit?jid=<?= $_GET['jid']; ?>" title="edit job" class="__button">Edit job</a>
                            </div>
                        <? }  ?>
                    </div>
                </div>
                <!-- Job toolbar - END -->
                <!-- Job details - START -->
                <article class="__entry">
                    <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -gap-c-small -align-v-center">
                        <div class="__col">
                            <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small -align-v-center">
                                <div class="__details">
                                    <h1><?= $jobTitle; ?></h1>
                                    <div class="<?= $cssPrefix; ?>-pill-container">
                                        <span class="__pill -small"><?= $jobSalary; ?></span>
                                        <span class="__pill -small"><?= $jobType; ?></span>
                                        <span class="__pill -small"><?= $jobShift; ?></span>
                                    </div>
                                </div>
                                <div class="__loc _text-align__right">
                                    <p class="__location _font-size__secondary"><i class="_icon -location"></i> <?= $jobPostCode; ?>, <?= $jobCountry; ?></p>
                                    <? if ($jobStatus === 1) { ?>
                                        <? if ($interval->days >= 1) { ?>
                                            <p class="__posted _font-size__secondary"><?= "Posted " . $interval->days . " days ago"; ?></p>
                                        <? } else if ($interval->days <= 0) { ?>
                                            <p class="__posted _font-size__secondary"><?= "Recently posted"; ?></p>
                                        <? } ?>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <!-- <article class="__teaser">
                    <div class="__copy">
                        <?= $jobTeaser; ?>
                    </div>
                </article> -->
                <article class="__why">
                    <h4>Why We're Hiring</h4>
                    <div class="__copy">
                        <?= $jobWhy; ?>
                    </div>
                </article>
                <article class="__requirements">
                    <h4>What you'll need</h4>
                    <div class="__copy">
                        <?= $jobRequirements; ?>
                    </div>
                </article>
                <article class="__duties">
                    <h4>Your day-to-day expectations</h4>
                    <div class="__copy">
                        <?= $jobDuties; ?>
                    </div>
                </article>
                <article class="__benefits">
                    <h4>Your benefits</h4>
                    <div class="__copy">
                        <?= $jobBenefits; ?>
                    </div>
                </article>
                <article class="__keywords">
                    <h4>Keywords & Tags</h4>
                    <div class="<?= $cssPrefix; ?>-pill-container">
                        <span class="__pill -small"><?= $jobSalary; ?></span>
                        <span class="__pill -small"><?= $jobType; ?></span>
                        <span class="__pill -small"><?= $jobShift; ?></span>
                        <span class="__pill -small">Closing in <?= $jobDateClosing->days; ?> days</span>
                    </div>
                    <?= $jobKeywords; ?>
                </article>
                <!-- Job details - END -->
            </div>

            <!-- Company details - START -->
            <div class="__company-details">
                <? if ($companyId === $companyIdTest) { ?>
                    <div class="__edit">
                        <a href="#" class="__location _font-size__secondary"><i class="_icon -small -settings -o"></i>Edit company profile</a>
                    </div>
                <? } ?>
                <h5>About our company</h5>
                <div class="__rating">
                    <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small -align-v-center">
                        <div class="_icon -logo" style="background-image: url('<?= $companyLogo; ?>');"></div>
                        <div class="__details">
                            <h4><?= $companyName; ?></h4>
                            <!-- Rating here -->
                        </div>
                    </div>
                </div>
                <div class="__about">
                    <h5>About Us</h5>
                    <p><?= $companyAbout ?></p>
                </div>
                <div class="__culture">
                    <h5>Out Culture</h5>
                    <p><?= $companyCulture ?></p>
                </div>
                <div class="__facts">
                    <p class="__location _font-size__secondary"><i class="_icon -small -location -o"></i> <?= $companyPostcode ?>, <?= $companyCountry; ?></p>
                    <p class="__location _font-size__secondary"><i class="_icon -small -company -o"></i> <?= $companyCategory; ?></p>
                    <p class="__location _font-size__secondary"><i class="_icon -small -calendar -o"></i> Established in <?= date('Y', strtotime($companyEstablished)) ?></p>
                    <p class="__location _font-size__secondary"><i class="_icon -small -people -o"></i> <?= $companyEmployees; ?> Employees</p>
                </div>
                <div class="__buttons <?= $cssPrefix; ?>-button-container">
                    <a href="company?cid=<?= $companyIdEncode; ?>" title="Visit <?= $companyName; ?> company profile and jobs" class="__button -black">Visit company profile</a>
                </div>
            </div>
            <!-- Company details - END -->

            <div class="__back -bottom">
                <a href="#" class="__location _font-size__secondary"><i class="_icon -small -chev-l -o"></i>Back to active jobs</a>
            </div>
        </div>

    </div>
    </div>
</section>