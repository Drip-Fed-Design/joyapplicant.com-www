<? if ($jobs && is_array($jobs)) {
    foreach ($jobs as $job) {

        // Check if role is voluntary
        if ($job['voluntary'] === 1) {
            $formattedSalary = 'Voluntary';
        } else {
            // Format salary
            $formattedSalary = "£" . number_format($job['salary_min'], 0, '.', ',') . " - £" . number_format($job['salary_max'], 0, '.', ',');
        }

        // Format posted closing date
        $currentDate = new DateTime();
        $postClosingDate = new DateTime($job['date_closing']);
        $postClosingDate = $postClosingDate->diff($currentDate);

        // Job status
        $jobStatus = $job['status'];

        // Job type
        $jobType = $formattingController->getValueFromArray($job['type'], $arrayEmploymentType);

        // Job shift
        $jobShift = $formattingController->getValueFromArray($job['shift'], $arrayWorkingShift);

        // Encode job ID to reduce hijacking
        $jobId = base64_encode($job['id']);
?>
        <article class="__entry">
            <? if ($jobStatus === 1) { ?>
                <div class="<?= $cssPrefix; ?>-button-container">
                    <a class="__button -invisible" href="job?jid=<?= $jobId ?>" title="<?= $job['title']; ?>">&nbsp;</a>
                </div>
            <? } else { ?>
                <div class="<?= $cssPrefix; ?>-button-container">
                    <a class="__button -invisible" href="job?jid=<?= $jobId ?>" title="<?= $job['title']; ?>">&nbsp;</a>
                </div>
            <? } ?>
            <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -gap-c-small -align-v-center">
                <div class="__col">
                    <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small -align-v-center">
                        <div class="__avatar" style="background-image: url('<?= $companyDetails[0]['logo']; ?>');"></div>
                        <div class="__details">
                            <h5><?= $job['title']; ?></h5>
                            <? if ($jobStatus === 1) { ?>
                                <div class="<?= $cssPrefix; ?>-grid -column-4 -gap-c-small -align-v-center">
                                    <p class="_font-size__secondary"><?= $formattedSalary; ?></p>
                                    <p class="_font-size__secondary"><?= $jobType; ?></p>
                                    <p class="_font-size__secondary"><?= $jobShift; ?></p>
                                    <p class="_font-size__secondary"><?= $job['postcodezip']; ?>, <?= $job['country']; ?></p>
                                </div>
                            <? } else { ?>
                                <div class="<?= $cssPrefix; ?>-grid -column-3 -gap-c-small -align-v-center">
                                    <p class="_font-size__secondary"><?= $formattedSalary; ?></p>
                                    <p class="_font-size__secondary"><?= $jobType; ?></p>
                                    <p class="_font-size__secondary"><?= $jobShift; ?></p>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
                <? if ($jobStatus === 1) { ?>
                    <div class="__saved _text-align__center">
                        <p class="_font-size__secondary"><i class="_icon -small -alert __r"></i> <strong>Closing in <?= $postClosingDate->days; ?> days</strong></p>
                    </div>
                <? } else { ?>
                    <div class="__saved -draft _text-align__center">
                        <p class="_font-size__secondary"><strong>Draft</strong></p>
                    </div>
                <? } ?>
            </div>
            <hr class="_hr__grey-light" />
        </article>
    <? }
} else { ?>
    <p>No jobs found</p>
<? } ?>