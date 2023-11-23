<?
// Generate a new CSRF token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
?>

<article class="__entry _margin__bottom-default">
    <div class="<?= $cssPrefix; ?>-grid -column-max-1fr -align-v-center -gap-c-small">
        <div class="__logo"></div>
        <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -gap-c-small">
            <div class="__detail">
                <h4>Quality Team Coordinator</h4>
                <div class="<?= $cssPrefix; ?>-pill-container">
                    <a href="#" class="__pill -small">RAC</a>
                    <a href="#" class="__pill -small">£57,400</a>
                    <a href="#" class="__pill -small">Full-Time</a>
                    <a href="#" class="__pill -small">Permanent</a>
                </div>
            </div>
            <div class="__loc _text-align__right">
                <p class="__location"><i class="_icon -location"></i> Mayfair, London</p>
                <p class="__posted _font-size__secondary">Posted 4 days ago</p>
            </div>
        </div>
    </div>
    <div class="__teaser">
        <ul>
            <li>Responsible for ideate and designing user-centric products, ensuring aesthetics and functionality align.</li>
            <li>Collaborate with cross-functional teams to refine and iterate on design solutions.</li>
            <li>Integrate, monitor, and understand user feedback and research into design decisions.</li>
        </ul>
    </div>
</article>