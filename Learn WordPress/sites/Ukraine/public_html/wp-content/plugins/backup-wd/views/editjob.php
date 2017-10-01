<div class="buwd buwd-page buwd-job" id="buwd-job">
    <div class="update-nag wd_topic">
          <span class="wd_help_topic">
              <?php echo $user_guide['title']; ?>
              <a target="_blank" href="<?php echo $user_guide['url']; ?>">Read More in User Manual</a>
        </span>
    </div>
    <div class="wd_pro">
        <a target="_blank" href="https://web-dorado.com/wordpress-plugins-bundle.html">
            <img alt="" title="" src="<?php echo BUWD_URL ?>/public/images/banner.png">
        </a>
    </div>
    <div class="buwd-clear"></div>
    <div class="buwd-messages"><?php $this->display_messages(); ?></div>
    <h2>Job: <?php echo $job_title; ?></h2>
    <div class="buwd-job-container">
        <div class="buwd-vertical-tabs">
            <?php foreach ($tabs as $tab_id => $tab) {
                $active_class = $current_tab == $tab_id ? 'buwd-active' : '';
                $display = $tab['display'] ? '' : 'style="display:none;"';
                echo '<div class="buwd-nav-tab ' . $active_class . '" id="tab-' . esc_attr($tab_id) . '" ' . $display . ' ><span></span>' . esc_html($tab['name']) . '</div>';
            } ?>
        </div>
        <div class="buwd-options">
            <?php
            foreach ($tabs as $tab_id => $tab) {
                if ($current_tab == $tab_id) {
                    if (isset($tab['messages'])) {
                        echo '<div class="buwd-messages">';
                        call_user_func($tab['messages']);
                        echo '</div>';
                    }
                }
            }
            ?>
            <form name="buwd-form" id="buwd-form" method="post"
                  action="<?php echo esc_attr(network_admin_url('admin-post.php')) ?>">
                <?php wp_nonce_field('nonce_buwd', 'nonce_buwd');
                foreach ($tabs as $tab_id => $tab) {
                    if ($current_tab == $tab_id) {
                        call_user_func($tab['view']);
                    }
                }
                ?>
                <input type="hidden" id="job_id" name="job_id" value="<?php echo $job_id; ?>">
                <input type="hidden" id="current_tab" name="current_tab" value="<?php echo $current_tab; ?>">
                <input type="hidden" id="tab" name="tab" value="">
                <input type="hidden" id="page" name="page" value="buwd_editjob">
                <input type="hidden" id="action" name="action" value="buwd_save">
        </div>
    </div>
</div>
<div id="buwd_overlay" class="buwd_overlay"></div>
