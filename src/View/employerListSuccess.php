<?
require_once __DIR__ . '/../../config/global.static.php';
?>

<section class="<?= $cssPrefix; ?>-dashboard-container">
    <div class="_width__max">
        <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -gap-c-medium">
            <div class="__copy">
                <?
                // Load the session alert outputs
                require_once __DIR__ . '/messageAlert.php';
                ?>
                <h2>Congratulations!</h2>
                <p><?= $_SESSION['job_session']; ?></p>
            </div>
            <div class="<?= $cssPrefix; ?>-steps-container">
                <p>hello world</p>
            </div>
        </div>
    </div>
</section>