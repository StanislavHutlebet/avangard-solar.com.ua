<?php 
	$fields_option = get_fields('option');
	$fields = get_fields(PAGE_ID_HOME);
	$lang = pll_current_language();

?>


   	<footer class="main-footer " data-page="<?php the_title(); ?>">
		<div class="wrapper">
			<div class="main-footer-flex">
				<div class="main-footer-col main-footer-col--1">
					<a href="<?php echo get_home_url();?>" class="main-footer-logo" aria-label="Logo">
						<?php 
						if ( !empty( $fields_option['header_footer'] ) ) {
							echo wp_get_attachment_image( 
								$fields_option['header_footer'], 
								'full', 
								false, 
								[
									'class' => '',
									'width' => '325',
									'height' => '96',
									'alt' => 'Логотип компанії'
								]
							);
						}
						?>
					</a>
					<?php 
						if ( !empty($fields['footer_text_after_logo']) ) {
					?>
					<div class="main-footer-text">
						<?php echo $fields['footer_text_after_logo']; ?>
					</div>
					<?php 
						}
					?>
					<div class="main-footer-soc-list">
						<?php 
                            if ( !empty($fields_option['link_instagram']) ) {
                        ?>
                            <a href="<?php echo $fields_option['link_instagram']; ?>" class="social-link-instagram-white" target="_blank" aria-label="Instagram"></a>
                        <?php 
                            }
                            if ( !empty($fields_option['link_facebook']) ) {
                        ?>
                            <a href="<?php echo $fields_option['link_facebook']; ?>" class="social-link-facebook-white" target="_blank" aria-label="Facebook"></a>
                        <?php 
                            }
							if ( !empty($fields_option['link_tiktok']) ) {
                        ?>
                            <a href="<?php echo $fields_option['link_tiktok']; ?>" class="social-link-tiktok-white" target="_blank" aria-label="Telegram"></a>
                        <?php 
                            }
							if ( !empty($fields_option['link_youtube']) ) {
					?>
						<a href="<?php echo $fields_option['link_youtube']; ?>" class="social-link-youtube-white " target="_blank" aria-label="Telegram"></a>
					<?php 
						}
						
                        ?>
					</div>
					<?php 
						if ( !empty($fields['footer_sub_title']) ) {
					?>
					<div class="main-footer-sub-title">
						<?php echo $fields['footer_sub_title']; ?>
					</div>
					<?php 
						}
					?>
					<div class="main-footer-menu">
						<?php 
						if(!empty($fields['footer_block_helps_add_links'])) {
							foreach($fields['footer_block_helps_add_links'] as $row) {
								?>
						<a href="<?php 
								if ( !empty($row['footer_block_helps_add_links_link']) ) {
									echo $row['footer_block_helps_add_links_link']; 
								}
							?>"><?php 
								if ( !empty($row['footer_block_helps_add_links_text']) ) {
									echo $row['footer_block_helps_add_links_text']; 
								}
							?></a>
						<?php
							}
						}
						?>
					</div>
				</div>
				<div class="main-footer-col main-footer-col--2">
					<?php 
						if ( !empty($fields['footer_title_before_form']) ) {
					?>
						<div class="main-footer-col-2-title">
							<?php echo $fields['footer_title_before_form']; ?>
						</div>
					<?php 
						}
					?>
					
					<div class="main-footer-form">
						<?php 
							if ( !empty($fields['footer_form_shortcode']) ) {
						 		echo do_shortcode($fields['footer_form_shortcode']);
							}
						?>
					</div>
				</div>
				<div class="main-footer-col main-footer-col--3">
					<div class="main-footer-col-item">
						<div class="main-footer-col-item-icon main-footer-col-item-icon-1"></div>
						<div class="main-footer-col-item-content">
							<?php 
								if ( !empty($fields['footer_title_addres']) ) {
							?>
							<div class="main-footer-col-item-title">
								<?php echo $fields['footer_title_addres']; ?>
							</div>
							<?php 
								}
								if ( !empty($fields['footer_title_addres_value']) ) {
							?>
							<div class="main-footer-col-item-value">
								<?php echo $fields['footer_title_addres_value']; ?>
							</div>
							<?php 
								}
							?>
						</div>
					</div>
					<div class="main-footer-col-item">
						<div class="main-footer-col-item-icon main-footer-col-item-icon-2"></div>
						<div class="main-footer-col-item-content">
							<?php 
								if ( !empty($fields['footer_title_phone']) ) {
							?>
							<div class="main-footer-col-item-title">
								<?php echo $fields['footer_title_phone']; ?>
							</div>
							<?php 
								}
							?>
							<div class="main-footer-col-item-value">
								<?php 
									if ( !empty($fields_option['phone_visual']) && !empty($fields_option['phone_call']) ) {
								?>
									<a href="tel:<?php echo $fields_option['phone_call']; ?>">
										<?php echo $fields_option['phone_visual']; ?>
									</a>
								<?php 
									}
								?>
							</div>
						</div>
					</div>
					<div class="main-footer-col-item">
						<div class="main-footer-col-item-icon main-footer-col-item-icon-3"></div>
						<div class="main-footer-col-item-content">
							<?php 
								if ( !empty($fields['footer_title_mail']) ) {
							?>
							<div class="main-footer-col-item-title">
								<?php echo $fields['footer_title_mail']; ?>
							</div>
							<?php 
								}
							?>
							<div class="main-footer-col-item-value">
								<?php 
									if ( !empty($fields['footer_title_mail_value']) ) {
								?>
								<a href="mailto:<?php echo $fields['footer_title_mail_value']; ?>">
									<?php echo $fields['footer_title_mail_value']; ?>
								</a>
								<?php 
									}
								?>
							</div>
						</div>
					</div>
					<div class="main-footer-col-item">
						<div class="main-footer-col-item-icon main-footer-col-item-icon-4"></div>
						<div class="main-footer-col-item-content">
							<?php 
								if ( !empty($fields['footer_title_work_time']) ) {
							?>
							<div class="main-footer-col-item-title">
								<?php echo $fields['footer_title_work_time']; ?>
							</div>
							<?php 
								}
								if ( !empty($fields['footer_title_work_time_value']) ) {
							?>
							<div class="main-footer-col-item-value">
								<?php echo $fields['footer_title_work_time_value']; ?>
							</div>
							<?php 
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="main-footer-link">
				<?php 
				if(!empty($fields['footer_bottom_links_add'])) {
					foreach($fields['footer_bottom_links_add'] as $row) {
						if ( !empty($row['footer_bottom_links_add_text']) && !empty($row['footer_bottom_links_add_link']) ) {
				?>
							<a href="<?php echo $row['footer_bottom_links_add_link']; ?>">
								<?php echo $row['footer_bottom_links_add_text']; ?>
							</a>
					<?php 
						}
					}
				}
				?>
			</div>
		</div>
   	</footer>

		</main>
		<?php wp_footer();?>


		<div class="modal-wrapper">
			<div class="modal-item" data-modal="call-back">
				<div class="modal-item-btn-close"></div>
				<?php 
					if ( !empty($fields['modal_call_back_title']) ) {
				?>
				<div class="modal-item-title">
					<span><?php echo $fields['modal_call_back_title']; ?></span>
				</div>
				<?php 
					}
				?>
				<div class="modal-item-form">
					<?php 
						if ( !empty($fields['modal_call_back_shortcode']) ) {
					 		echo do_shortcode($fields['modal_call_back_shortcode']);
						}
					?>
				</div>
			</div>
		</div>
    

	<div class="btn-go-top"></div>


	<?php 
		if($lang == 'uk'){
	?>
	<script>
		document.addEventListener('wpcf7mailsent', function (event) {
			window.location.href = '/thanks/';
		}, false);
	</script>
	<?php 
		}else {
	?>
	<script>
		document.addEventListener('wpcf7mailsent', function (event) {
			window.location.href = '/ru/thanks-page/';
		}, false);
	</script>
	<?php
		}
	?>

	</body>
</html>