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
                    <a href="<?= $_ENV['DOMAIN_URL']; ?>" title="Ensuring that YOU, the applicant, have a joyful experience while applying for a new job or career step. It matters!">
                        <img src="/public/img/brand/joyapplicant-brand-logo-full.svg" width="240" height="32.24" alt="JoyApplicant">
                    </a>
                </div>
                <nav class="__main">
                    <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -align-v-center">
                        <div class="__default">
                            <ul>
                                <li><a href="#" title="#">Job Search</a></li>
                                <li><a href="#" title="#">Companies</a></li>
                                <li><a href="#" title="#">Why JobApplicant</a></li>
                                <li>
                                    <a href="#" title="#">More</a>
                                    <ul class="__sub">
                                        <li><a href="#" title="#">Option One</a></li>
                                        <li><a href="#" title="#">Option Two</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="__buttons <?= $cssPrefix; ?>-button-container">
                            <a href="register" title="Register to experience 0% job applicant frustration" class="__button -purple _margin__right-micro">Register</a>
                            <a href="login" title="Log in to access your JoyApplicant account" class="__button -black">Sign In</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>