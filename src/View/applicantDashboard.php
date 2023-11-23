<?
// Generate a new CSRF token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
?>


<section class="<?= $cssPrefix; ?>-dashboard-container">
    <div class="_width__max">
        <div class="<?= $cssPrefix; ?>-grid -column-dashboard -gap-c-default _margin__top-default _margin__bottom-default">
            <div class="__user-nav">
                <div class="__areas">
                    <ul>
                        <li><a href="#" title="#"><i class="_icon -small -dashboard"></i> Dashboard</a></li>
                        <li><a href="search" title="search jobs"><i class="_icon -small -search"></i> Search Jobs</a></li>
                        <li><a href="#" title="#"><i class="_icon -small -message"></i> Messages</a></li>
                        <li><a href="#" title="#"><i class="_icon -small -calendar"></i> Calendar</a></li>
                        <li><a href="#" title="#"><i class="_icon -small -tick"></i> Applications</a></li>
                        <li><a href="#" title="#"><i class="_icon -small -review"></i> Feedback</a></li>
                    </ul>
                </div>
                <hr class="_hr__grey-light" />
                <div class="__user">
                    <ul>
                        <li><a href="#" title="#"><i class="_icon -small -people"></i> Profile</a></li>
                        <li><a href="#" title="#"><i class="_icon -small -settings"></i> Settings</a></li>
                        <li><a href="#" title="#"><i class="_icon -small -help"></i> Help & Support</a></li>
                        <li><a href="logout" title="log out"><i class="_icon -small -secure"></i> Log Out</a></li>
                    </ul>
                </div>
            </div>
            <div class="__dashboard">
                <?
                // Load the session alert outputs
                require_once __DIR__ . '/messageAlert.php';
                ?>
                <div class="<?= $cssPrefix; ?>-grid -column-2 -gap-c-default -align-v-center">
                    <div class="__heading">
                        <h1 class="-banner _tf-paytone-one">Dashboard</h1>
                        <p class="_font-size__secondary">Let's take a look at how things are stacking up.</p>
                    </div>
                    <div class="<?= $cssPrefix; ?>-search-container">
                        <section class="<?= $cssPrefix; ?>-form-container">
                            <form action="search" method="post" id="search-form" class="_background-colour__grey-light">
                                <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -align-v-center">
                                    <div class="__group">
                                        <input type="search" id="search" name="search" class="__input -inset" placeholder="Find your next dream role..." required />
                                    </div>
                                    <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                                    <div class="__buttons <?= $cssPrefix; ?>-button-container">
                                        <button type="submit" name="search" class="__button -inset">Search</button>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
                <div class="<?= $cssPrefix; ?>-grid -column-2 -gap-c-small -gap-r-small -align-v-center">
                    <div class="__widget">
                        <h4>Upcoming Interviews</h4>
                        <div class="<?= $cssPrefix; ?>-chart-container">
                            chart here
                        </div>
                        <div class="__buttons <?= $cssPrefix; ?>-button-container">
                            <a href="#" title="#" class="__button -plain -orange">View all events <i class="_icon -small -chev-r __o"></i></a>
                        </div>
                    </div>
                    <div class="__widget">
                        <h4>Jobs Applied</h4>
                        <div class="<?= $cssPrefix; ?>-chart-container">
                            chart here
                        </div>
                        <div class="__buttons <?= $cssPrefix; ?>-button-container">
                            <a href="#" title="#" class="__button -plain -orange">View all applied jobs <i class="_icon -small -chev-r __o"></i></a>
                        </div>
                    </div>
                    <div class="__widget">
                        <h4>Jobs Status</h4>
                        <div class="<?= $cssPrefix; ?>-chart-container">
                            chart here
                        </div>
                        <div class="__buttons <?= $cssPrefix; ?>-button-container">
                            <a href="#" title="#" class="__button -plain -orange">View all jobs applied <i class="_icon -small -chev-r __o"></i></a>
                        </div>
                    </div>
                    <div class="__widget">
                        <h4>Saved Jobs</h4>
                        <div class="<?= $cssPrefix; ?>-chart-container">
                            chart here
                        </div>
                        <div class="__buttons <?= $cssPrefix; ?>-button-container">
                            <a href="#" title="#" class="__button -plain -orange">View all saved jobs <i class="_icon -small -chev-r __o"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>