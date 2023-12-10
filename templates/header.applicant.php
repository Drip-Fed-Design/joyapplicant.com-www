<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Ensure a joyful experience when applying for jobs & careers</title>
    <meta name="description" content="Ensuring that YOU, the applicant, have a joyful experience while applying for a new job or career step. It matters!" />

    <link rel="stylesheet" href="<?= $_ENV['DOMAIN_URL'] . 'public/css/joyapplicant.min.css' ?>" />
</head>

<body id="<?= $cssPrefix; ?>-body-container">

    <header class="<?= $cssPrefix; ?>-navigation-container">
        <div class="_width__max">
            <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -align-v-center -gap-c-default">
                <div class="__logo">
                    <img src="/public/img/brand/joyapplicant-brand-logo-full.svg" width="240" height="32.24" alt="JoyApplicant">
                </div>
                <nav class="__main">
                    <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -gap-c-small -align-v-center">
                        <div class="__buttons <?= $cssPrefix; ?>-button-container _text-align__right">
                            <a href="dashboard" title="#" class="__button -purple _margin__right-micro">Dashboard</a>
                            <a href="search" title="#" class="__button -black">Search for jobs</a>
                        </div>
                        <div class="__user">
                            <div class="__mugshot"></div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>