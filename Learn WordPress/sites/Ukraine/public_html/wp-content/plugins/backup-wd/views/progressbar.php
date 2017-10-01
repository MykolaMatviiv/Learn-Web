<?php
/**
 * Created by PhpStorm.
 * User: Araqel
 * Date: 07/07/2017
 * Time: 6:00 PM
 */
?>
    <div class="buwd-progressbar-container buwd-hide">

        <div class="buwd-progressbar">
        </div>
        <div class="buwd-progress-messages">
            <div class="buwd-progress-message buwd-progressbar-element"></div>
            <div class="buwd-progress-log  buwd-progressbar-element"></div>
            <div class="buwd-progress-stop-message  buwd-progressbar-element"></div>
        </div>
        <div class=" buwd-progressbar-element buwd-progress-stop">
            <a class="buwd_stop_job  buwd-button buwd-hide"
               onclick="buwd_run_action( '<?php echo wp_nonce_url(network_admin_url("admin.php") . '?page=buwd_jobs&action=abort_job') ?>');return false"
               href="<?php echo wp_nonce_url(network_admin_url("admin.php") . '?page=buwd_jobs&action=abort_job') ?>"
               href="">Stop
                Job</a>
        </div>
    </div>

    <!--onclick="buwd_run_action( '<?php //echo  wp_nonce_url(network_admin_url("admin.php") . '?page=buwd_jobs&action=abort_job' )?>')"-->

<?php if (get_site_option('buwd_job_running') == 1) :

    ?>
    <script>
        jQuery(document).ready(function() {
            jQuery('.buwd_stop_job').removeClass('buwd-hide');
            jQuery('.buwd-progressbar-container').removeClass('buwd-hide');
            jQuery.ajax({
                type: 'GET',
                url: '<?php echo admin_url('admin-ajax.php') ?>',
                data: {
                    action: 'buwd_success_message'
                }
            });

            jQuery(function () {
                bar1 = jQuery('.buwd-progressbar').progressbarManager({
                    totalValue: 100,
                    animate: true,
                    stripe: true,
                    id: 'buwd_progress',
                    onComplete: function () {
                        jQuery('#buwd_progress div').text('Success!!').addClass('progress-bar-success').removeClass('progress-bar-striped');
                        jQuery('.buwd_stop_job').addClass('buwd-hide');
                    }
                });
            });


            buwd_run_job = function () {
                jQuery.ajax({
                    type: 'GET',
                    url: '<?php echo admin_url('admin-ajax.php') ?>',
                    data: {
                        action: 'buwd_progress'
                    },
                    success: function (data) {
                        progress_data = jQuery.parseJSON(data);
                        bar1.setValue(progress_data.progress);


                        jQuery('.buwd-progress-message').html(progress_data.current_step);
                        jQuery('.buwd-progress-log').html(progress_data.log);

                        if (progress_data.error && progress_data.end) {
                            /*  jQuery('.buwd-progress-log').addClass('buwd-progress-error');
                             jQuery('#buwd_progress div').text('ERROR!!').addClass('progress-bar-danger')*/
                        }

                        if (progress_data.stop) {
                            location.reload();
                        }
                        setTimeout(function () {
                            buwd_run_job();
                        }, 500)

                    }

                })
            };

            buwd_run_job();
        });

    </script>
<?php endif; ?>