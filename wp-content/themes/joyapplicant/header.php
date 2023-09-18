<?php include('config/global.vars.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="viewport-fit=cover, width=device-width, height=device-height, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=yes" />
    <meta charset="<?php bloginfo('charset'); ?>">

    <?php if (get_field('page_title')) { ?>
        <title><?php echo get_field('page_title'); ?></title>
    <?php } ?>
    <?php if (get_field('page_description')) { ?>
        <meta name="description" content="<?php echo get_field('page_description'); ?>" />
    <?php } ?>

    <?php wp_head(); ?>

    <!-- Schema Data -->
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "JoyApplicant",
            "description": "Imagine a job and careers platform that gives YOU, the applicant, the best job or career application experience possible. That is our mission at JoyApplicant: prioritise the applicant while they apply for a new job or the next step in their career. It matters!",
            "logo": "https://www.joyapplicant.com/",
            "url": "https://www.joyapplicant.com/",
            "address": {
                "@type": "PostalAddress",
                "addressCountry": "United Kingdom"
            }
        }
    </script>
</head>

<body>
    <div id="<?php echo $globalPrefix; ?>-body-container" class="<?php echo $pageClass; ?>">