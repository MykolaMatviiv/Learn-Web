<div class="wrap buwd" id="buwd-jobs">
    <div class="update-nag wd_topic">
          <span class="wd_help_topic">
              This section allows you to view jobs and create a new one.
              <a target="_blank" href="https://web-dorado.com/wordpress-backupwd-guide/creating-new-job.html">Read More in User Manual</a>
        </span>
    </div>
    <div class="wd_pro">
        <a target="_blank" href="https://web-dorado.com/wordpress-plugins-bundle.html">
            <img alt="" title="" src="<?php echo BUWD_URL ?>/public/images/banner.png">
        </a>
    </div>
    <div class="buwd-clear"></div>
    <div class="buwd-messages"><?php $this->display_messages(); ?></div>
    <h1>Jobs
        <?php if (current_user_can('buwd_job_edit')) : ?>
            <a href="<?php echo network_admin_url('admin.php') . '?page=buwd_editjob'; ?>"
               class="buwd-button">
                Add New Job
            </a>
        <?php endif; ?>
    </h1>

    <form method="post" action="" id="buwd_form">
        <input type="hidden" name="page" value="<?php echo esc_attr($_REQUEST['page']); ?>"/>
        <input id="page" name="page" type="hidden" value="buwd_jobs">
        <p class="search-box">
            <label class="screen-reader-text" for="search_job-search-input">Search job:</label>
            <input type="search" id="search_job-search-input" name="s"
                   value="<?php echo esc_attr(isset($_REQUEST['s']) ? $_REQUEST['s'] : ''); ?>"
                   placeholder="Search job">
            <span class="icon-search"></span>
        </p>
        <?php //echo $this->search_box( 'Search job', 'search_job' ); ?>
        <?php echo $this->display(); ?>


    </form>

</div>
<div id="buwd_overlay" class="buwd_overlay"></div>
