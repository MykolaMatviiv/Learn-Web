<?php
/**
 * API Keys View
 */
?>
<div id="buwd-api-keys" class="buwd-page buwd-api-keys">
    <?php foreach ($tabs as $tab_id => $tab) {
        $active_class = $current_tab == $tab_id ? 'buwd-active' : 'buwd-hide'; ?>
        <div class="update-nag wd_topic <?php echo 'tab-'.$tab_id.'-guide' .' '.$active_class; ?>">
            <span class="wd_help_topic">
                <?php echo $user_guide[$tab_id]['title']; ?>
                <a target="_blank" href="<?php echo $user_guide[$tab_id]['url']; ?>" >Read More in User Manual</a>
            </span>
        </div>
    <?php } ?>
    <div class="wd_pro">
        <a target="_blank" href="https://web-dorado.com/wordpress-plugins-bundle.html">
            <img alt="" title="" src="<?php echo BUWD_URL ?>/public/images/banner.png">
        </a>
    </div>
    <div class="buwd-clear"></div>
    <div class="buwd-messages"><?php $this->display_messages(); ?></div>
    <div class="buwd-tabs">
        <?php foreach ($tabs as $tab_id => $tab) {
            $active_class = $current_tab == $tab_id ? 'buwd-active' : '';
            $display = $tab['display'] ? '' : 'style="display:none;"';

            if (isset($_GET['devmode']) && $_GET['devmode'] == 1) {
                $href = wp_nonce_url(network_admin_url('admin.php?page=buwd_api_keys&tab=' . $tab_id . '&devmode=1'), 'edit-api-keys');
            } else {
                $href = wp_nonce_url(network_admin_url('admin.php?page=buwd_api_keys&tab=' . $tab_id), 'edit-api-keys');
            }
            echo '<a href="#" class="buwd-nav-tab ' . $active_class . '" id="tab-' . esc_attr($tab_id) . '" ' . $display . '>' . esc_html($tab['name']) . '</a>';
        } ?>
        <div class="buwd-float-clear"></div>
    </div>
    <div class="buwd-options">
        <form name="buwd-form" id="buwd-form" method="post"
              action="<?php echo esc_attr(network_admin_url('admin-post.php')) ?>">
            <?php wp_nonce_field('nonce_buwd', 'nonce_buwd');
            foreach ($tabs as $tab_id => $tab) {
                $tab_content_active_class = $current_tab == $tab_id ? '' : 'buwd-hide';
                $tab_data = $this->display_tab($tab_id); ?>
                <div class="buwd-tab-option <?php echo $tab_content_active_class; ?>"
                     id="option-<?php echo $tab_id; ?>">
                    <table class="buwd-table" cellpadding="8">
                        <?php
                        echo $tab_data['content']; ?>
                    </table>
                    <div class="buwd-button-panel">
                        <button class="buwd-button button-save" onclick="save_settings('buwd-form'); return false;">
                            <span></span>Save
                        </button>
                    </div>
                </div>
                <?php //call_user_func( $tab['view'] );
            } ?>
            <input type="hidden" id="current_tab" name="current_tab" value="<?php echo $current_tab; ?>">
            <input type="hidden" id="page" name="page" value="buwd_api_keys">
            <input type="hidden" id="action" name="action" value="buwd_save">
        </form>
    </div>
</div>
