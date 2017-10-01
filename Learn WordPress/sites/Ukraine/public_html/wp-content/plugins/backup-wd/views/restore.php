<?php
/**
 * Restore View
 */
?>
<div id="buwd-restore" class="buwd-page buwd-restore">
    <div class="update-nag wd_topic">
          <span class="wd_help_topic">
              This section allows you to restore a backup.
              <a target="_blank" href="https://web-dorado.com/wordpress-backupwd-guide/restore.html">Read More in User Manual</a>
        </span>
    </div>
    <div class="wd_pro">
        <a target="_blank" href="https://web-dorado.com/wordpress-plugins-bundle.html">
            <img alt="" title="" src="<?php echo BUWD_URL ?>/public/images/banner.png">
        </a>
    </div>
    <div class="buwd-messages"><?php $this->display_messages(); ?></div>
    <div class="buwd-options">
        <form name="buwd-form" id="buwd-form" enctype="multipart/form-data" method="post"
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
                    <input type="submit" id="save" name="save" class="buwd-button" value="Restore"/>
                </div>
                <?php //call_user_func( $tab['view'] );
            } ?>
            <input type="hidden" id="current_tab" name="current_tab" value="<?php echo $current_tab; ?>">
            <input type="hidden" id="page" name="page" value="buwd_restore">
            <input type="hidden" id="action" name="action" value="buwd_save">
        </form>
    </div>
</div>
