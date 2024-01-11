<?
// Get URL path
$u = $_SERVER['REQUEST_URI'];
?>
<div class="__user-nav">
    <div class="__areas">
        <ul>
            <li><a href="dashboard" title="#" <? if (strpos($u, 'dashboard') !== false) {
                                                    echo 'class="-active"';
                                                } ?>><i class="_icon -small -dashboard"></i> Dashboard</a></li>
            <li><a href="search" title="search jobs" <? if (strpos($u, 'search') !== false) {
                                                            echo 'class="-active"';
                                                        } ?>><i class="_icon -small -search"></i> Search Jobs</a></li>
            <li><a href="messages" title="#" <? if (strpos($u, 'messages') !== false) {
                                                    echo 'class="-active"';
                                                } ?>><i class="_icon -small -message"></i> Messages</a></li>
            <li><a href="calendar" title="#" <? if (strpos($u, 'calendar') !== false) {
                                                    echo 'class="-active"';
                                                } ?>><i class="_icon -small -calendar"></i> Calendar</a></li>
            <li><a href="applied" title="#" <? if (strpos($u, 'applied') !== false) {
                                                echo 'class="-active"';
                                            } ?>><i class="_icon -small -tick"></i> Applied</a></li>
            <li><a href="feedback" title="#" <? if (strpos($u, 'feedback') !== false) {
                                                    echo 'class="-active"';
                                                } ?>><i class="_icon -small -review"></i> Feedback</a></li>
        </ul>
    </div>
    <hr class="_hr__white-default" />
    <div class="__user">
        <ul>
            <li><a href="profile" title="#" <? if (strpos($u, 'profile') !== false) {
                                                echo 'class="-active"';
                                            } ?>><i class="_icon -small -people"></i> Profile</a></li>
            <li><a href="settings" title="#" <? if (strpos($u, 'settings') !== false) {
                                                    echo 'class="-active"';
                                                } ?>><i class="_icon -small -settings"></i> Settings</a></li>
            <li><a href="https://help.joyapplicant.com/" title="#" target="_blank"><i class="_icon -small -help"></i> Help</a></li>
            <li><a href="logout" title="log out"><i class="_icon -small -secure"></i> Log Out</a></li>
        </ul>
    </div>
</div>