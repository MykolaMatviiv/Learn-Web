<?php
/**
 * Template Name: Contact Template
 *
 * Displays the contact page template.
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
get_header();
$city_store_settings = city_store_get_theme_options(); ?>
	<div class="contact-page">
		<div id="primary">
			<main id="main">
			<?php
			if( have_posts() ) {
				while( have_posts() ) {
					the_post();
					if('' != get_the_content()) : ?>
								<?php the_content(); ?>
					<?php endif; ?>
			<?php } } ?>
			</main> <!-- end #main -->
		</div><!-- #primary -->

		<div id="secondary">
			<div class="widget city-store-contact">
			<?php
					$contact_address = $city_store_settings['city_store_contact_address'];
					$contact_phone = $city_store_settings['city_store_contact_phone'];
					$contact_skype = $city_store_settings['city_store_contact_skype'];
					$contact_email = $city_store_settings['city_store_contact_email'];

					if ($contact_address || $contact_phone || $contact_skype || $contact_email){ ?>

							<?php }
								if ($contact_address){ ?>
									<div class="city-store-contact-info">
										<div class="contact-content-wrap">
											<div class="contact-icon">
												<i class="fa fa-map-marker" aria-hidden="true"></i>
											</div>
											<div class="contact-content">
												<h3><?php echo esc_html__('Address', 'city-store'); ?></h3>
												<span><?php echo esc_html($contact_address);?></span>
											</div>
										</div>
									</div>

						<?php	}
								if ($contact_phone){ ?>
									<div class="city-store-contact-info">
										<div class="contact-content-wrap">
											<div class="contact-icon">
												<i class="fa fa-phone" aria-hidden="true"></i>
											</div>
											<div class="contact-content">
												<h3><?php echo esc_html__('Phone', 'city-store'); ?></h3>
												<span><a href="tel:<?php echo esc_url($contact_phone);?>"><?php echo esc_html($contact_phone);?></a></span>
											</div>
										</div>
									</div>

						<?php	}
								if ($contact_skype){ ?>
									<div class="city-store-contact-info">
										<div class="contact-content-wrap">
											<div class="contact-icon">
												<i class="fa fa-skype" aria-hidden="true"></i>
											</div>
											<div class="contact-content">
												<h3><?php echo esc_html__('Skype', 'city-store'); ?></h3>
												<span><a href="callto:<?php echo esc_url($contact_skype);?>"><?php echo esc_html($contact_skype);?></a></span>
											</div>
										</div>
									</div>

						<?php	}
								if ($contact_email){ ?>
									<div class="city-store-contact-info">
										<div class="contact-content-wrap">
											<div class="contact-icon">
												<i class="fa fa-envelope-o" aria-hidden="true"></i>
											</div>
											<div class="contact-content">
												<h3><?php echo esc_html__('Mail', 'city-store'); ?></h3>
												<span><a href="mailto:<?php echo esc_url(antispambot($contact_email));?>"><?php echo esc_html($contact_email);?></a></span>
											</div>
										</div>
									</div>

						<?php	} ?>
					</div>
		</div> <!-- #secondary -->
	</div>
<?php get_footer(); ?>
