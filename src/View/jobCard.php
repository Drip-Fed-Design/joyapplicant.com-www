<section class="<?= $cssPrefix; ?>-jobs-container _padding__top-large _padding__bottom-large">
    <div class="_width__max">
        <div class="<?= $cssPrefix; ?>-grid -column-1fr-max _padding__rl-large -align-v-center">
            <h3>Do any of these roles catch your eye?</h3>
            <? if ((!isset($userType)) && ($userType !== 'applicant')) { ?>
                <div class="__buttons <?= $cssPrefix; ?>-button-container">
                    <a href="login" title="Sign in to personalise your job and career search experience" class="__button -outline -icon"><i class="_icon -small -secure __p"></i> Sign in to personalise</a>
                </div>
            <? } ?>
        </div>
        <div class="__jobs-board _margin__top-default _padding__rl-large">
            <? if ($jobs && is_array($jobs)) {
                foreach ($jobs as $job) {

                    $jobVoluntary = $job['voluntary'];
                    $salaryMin = $job['salary_min'];
                    $salaryMax = $job['salary_max'];

                    // Check if role is voluntary, format salary
                    if ($jobVoluntary === 1) {
                        $jobSalary = 'Voluntary';
                    } else {
                        $jobSalary = "£" . number_format($salaryMin, 0, '.', ',') . " - £" . number_format($salaryMax, 0, '.', ',');
                    }

                    // Job type and shift formatting
                    $jobType = $formattingController->getValueFromArray($job['type'], $arrayEmploymentType);
                    $jobShift = $formattingController->getValueFromArray($job['shift'], $arrayWorkingShift);

                    // Format posted date
                    $currentDate = new DateTime();
                    $postDate = new DateTime($job['date_opening']);
                    $interval = $postDate->diff($currentDate);
            ?>
                    <article class="__entry _margin__bottom-default">
                        <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -align-v-center -gap-c-small">
                            <div class="_icon -logo" style="background-image: url('<?= $job['logo']; ?>');"></div>
                            <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -gap-c-small">
                                <div class="__detail">
                                    <h4><?= $job['title']; ?></h4>
                                    <div class="<?= $cssPrefix; ?>-pill-container">
                                        <a href="#" class="__pill -small"><?= $job['name']; ?></a>
                                        <a href="#" class="__pill -small"><?= $jobSalary; ?></a>
                                        <a href="#" class="__pill -small"><?= $jobType; ?></a>
                                        <a href="#" class="__pill -small"><?= $jobShift; ?></a>
                                    </div>
                                </div>
                                <div class="__loc _text-align__right">
                                    <p class="__location _font-size__secondary"><i class="_icon -location"></i> <?= $job['postcodezip']; ?>, <?= $job['country']; ?></p>
                                    <? if ($interval->days >= 1) { ?>
                                        <p class="__posted _font-size__secondary"><?= "Posted " . $interval->days . " days ago"; ?></p>
                                    <? } else if ($interval->days <= 0) { ?>
                                        <p class="__posted _font-size__secondary"><?= "Recently posted"; ?></p>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                        <div class="__teaser">
                            <?= $job['teaser']; ?>
                        </div>
                    </article>
                <? }
            } else { ?>
                <p>No jobs found</p>
            <? } ?>
        </div>
        <div class="__buttons <?= $cssPrefix; ?>-button-container _text-align__center _margin__top-default">
            <a href="search" title="search jobs and careers" class="__button -purple">Show more roles</a>
        </div>
    </div>
</section>