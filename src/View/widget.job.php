<? if ($jobs && is_array($jobs)) {
    foreach ($jobs as $job) {

        // Check if role is voluntary
        if ($job['voluntary'] === 1) {
            $formattedSalary = 'Voluntary';
        } else {
            // Format salary
            $formattedSalary = "£" . number_format($job['salary_min'], 0, '.', ',') . " - £" . number_format($job['salary_max'], 0, '.', ',');
        }

        // Format posted date
        $postDate = new DateTime($job['date_opening']);
        $currentDate = new DateTime();
        $interval = $postDate->diff($currentDate);

        $jobStatus = $job['status'];

        // Encode job ID to reduce hijacking
        $jobId = base64_encode($job['id']);
?>
        <article class="__entry">
            <? if ($jobStatus === 1) { ?>
                <a class="#" href="job?jid=<?= $jobId ?>" title="#">link</a>
            <? } else { ?>
                <a class="-draft" href="job" title="#">link</a>
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
                                    <p class="_font-size__secondary"><?= $job['type']; ?></p>
                                    <p class="_font-size__secondary"><?= $job['shift']; ?></p>
                                    <p class="_font-size__secondary"><?= $job['postcodezip']; ?>, <?= $job['country']; ?></p>
                                </div>
                            <? } else { ?>
                                <div class="<?= $cssPrefix; ?>-grid -column-3 -gap-c-small -align-v-center">
                                    <p class="_font-size__secondary"><?= $formattedSalary; ?></p>
                                    <p class="_font-size__secondary"><?= $job['type']; ?></p>
                                    <p class="_font-size__secondary"><?= $job['shift']; ?></p>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
                <? if ($jobStatus === 1) { ?>
                    <div class="__saved _text-align__center">
                        <p class="_font-size__secondary"><i class="_icon -small -alert __r"></i> <strong>Closing in 15 days</strong></p>
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