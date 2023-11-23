<section class="<?= $cssPrefix; ?>-jobs-container _padding__top-large _padding__bottom-large">
    <div class="_width__max">
        <div class="<?= $cssPrefix; ?>-grid -column-1fr-max _padding__rl-large -align-v-center">
            <h3>Do any of these roles catch your eye?</h3>
            <div class="__buttons <?= $cssPrefix; ?>-button-container">
                <a href="login" title="Sign in to personalise your job and career search experience" class="__button -outline -icon"><i class="_icon -small -secure __p"></i> Sign in to personalise</a>
            </div>
        </div>
        <div class="__jobs-board _margin__top-default _padding__rl-large">
            <?
            // Load the HTML for job listing
            require __DIR__ . '/../src/View/jobListing.php';
            require __DIR__ . '/../src/View/jobListing.php';
            ?>
        </div>
        <div class="__buttons <?= $cssPrefix; ?>-button-container _text-align__center _margin__top-default">
            <a href="search" title="search jobs and careers" class="__button -purple">Show more roles</a>
        </div>
    </div>
</section>