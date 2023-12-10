<?
// Generate a new CSRF token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
?>

<section class="<?= $cssPrefix; ?>-dashboard-container">
    <div class="_width__max">
        <div class="<?= $cssPrefix; ?>-grid -column-1fr-max -gap-c-medium">
            <div class="__copy">
                <?
                // Load the session alert outputs
                require_once __DIR__ . '/messageAlert.php';
                ?>
                <h2>Finally, how would you like to be found?</h2>
                <section class="<?= $cssPrefix; ?>-form-container _margin__top-default">
                    <form action="discovery" method="post" id="discovery-form">
                        <div class="<?= $cssPrefix; ?>-grid -column-2 -gap-c-default">
                            <div class="__group">
                                <label for="visibility">Visibility *</label>
                                <select id="visibility" name="visibility" class="__select -grey" required>
                                    <option value="">Select visibility...</option>
                                    <option value="1">Make my profile public</option>
                                    <option value="0">Hide my profile</option>
                                </select>
                            </div>
                            <div class="__group">
                                <label for="alias">Alias *</label>
                                <input type="text" id="alias" name="alias" class="__input -grey" maxlength="90" placeholder="joyapplicant.com/..." required />
                            </div>
                        </div>
                        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                        <hr class="_hr__grey-light" />
                        <div class="__buttons <?= $cssPrefix; ?>-button-container _margin__top-default _text-align__right">
                            <button type="submit" name="discovery" class="__button">Complete setup</button>
                        </div>
                    </form>
                </section>
            </div>
            <div class="<?= $cssPrefix; ?>-steps-container">
                <div class="__step <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small">
                    <div class="__bullet"></div>
                    <div class="__copy">
                        <p class="__title">About you</p>
                        <p class="__desc">Let's start by learning about you?</p>
                    </div>
                </div>
                <div class="__step <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small">
                    <div class="__bullet"></div>
                    <div class="__copy">
                        <p class="__title">About your company</p>
                        <p class="__desc">Now about your company?</p>
                    </div>
                </div>
                <div class="__step <?= $cssPrefix; ?>-grid -column-max-1fr -gap-c-small">
                    <div class="__bullet -active"></div>
                    <div class="__copy">
                        <p class="__title">Discovery</p>
                        <p class="__desc">How do you want to be found?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    // Hide the Alias when "hide my profile" is selected
    document.addEventListener('DOMContentLoaded', function() {
        var visibilitySelect = document.getElementById('visibility');
        var aliasGroup = document.getElementById('alias').parentNode;

        function toggleAliasVisibilityAndRequired() {
            var isVisibilityZero = visibilitySelect.value === '0';

            // Toggle visibility of the alias group
            aliasGroup.style.display = isVisibilityZero ? 'none' : '';

            // Toggle the required attribute for alias
            var aliasInput = document.getElementById('alias');

            if (isVisibilityZero) {
                aliasInput.removeAttribute('required');
            } else {
                aliasInput.setAttribute('required', '');
            }
        }

        visibilitySelect.addEventListener('change', toggleAliasVisibilityAndRequired);
        toggleAliasVisibilityAndRequired(); // call on initial load
    });
</script>