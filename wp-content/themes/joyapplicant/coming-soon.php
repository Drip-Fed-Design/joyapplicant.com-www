<? /* Template Name: Coming Soon */ ?>

<?php
include('config/global.vars.php');
get_header();
?>
</header>
<!-- HEADER - end -->

<!-- BODY - start -->
<main class="<?php echo $globalPrefix; ?>-main-container">

    <div class="<?= $globalPrefix; ?>-grid -column-2 -grid-cs">
        <section class="_background-logo-os"></section>
        <section class="_padding-full__large" style="align-self:center;">
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
            <div class="__copyright">
                <p class="_font-size__secondary">© <?php echo date('Y'); ?> JopApplicant - <a href="/privacy-policy/" title="Open our JoyApplicant Privacy Policy" target="_blank">Privacy</a></p>
            </div>
        </section>
    </div>

</main>
<!-- BODY - end -->

<?php get_footer(); ?>