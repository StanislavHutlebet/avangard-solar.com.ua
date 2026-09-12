<?php 
    $fields = get_fields(get_the_ID());
    $fields_option = get_fields('option');
?>
<div class="seb-8 section">
    <div class="wrapper">
        <div class="seb-8-flex">
            <div class="seb-8-left">
                <?php 
                    if ( !empty($fields['faq_title']) ) {
                ?>
                <h2 class="seb-8-title">
                    <?php echo $fields['faq_title']; ?>
                </h2>
                <?php 
                    }
                    if ( !empty($fields['faq_text']) ) {
                ?>
                <div class="seb-8-text-after-title">
                    <?php echo $fields['faq_text']; ?>
                </div>
                <?php 
                    }
                    if ( !empty($fields['faq_btn_text']) ) {
                ?>
                <a href="#call-back" class="main-btn">
                    <?php echo $fields['faq_btn_text']; ?>
                </a>
                <?php 
                    }
                ?>
            </div>
            <div class="seb-8-right" itemscope itemtype="https://schema.org/FAQPage">
				<?php 
				if (!empty($fields['faq_add'])) {
					foreach ($fields['faq_add'] as $key => $row) {
						?>
						<div class="seb-8-right-item <?php echo $key === 0 ? 'active' : ''; ?>"
							 itemscope
							 itemprop="mainEntity"
							 itemtype="https://schema.org/Question">

							<div class="seb-8-right-item-title">
								<?php if (!empty($row['faq_add_title'])) : ?>
									<h3 class="seb-8-right-item-title-text" itemprop="name">
										<?php echo esc_html($row['faq_add_title']); ?>
									</h3>
								<?php endif; ?>

								<div class="seb-8-right-item-btn"></div>
							</div>

							<?php if (!empty($row['faq_add_text'])) : ?>
								<div class="seb-8-right-item-text"
									 itemscope
									 itemprop="acceptedAnswer"
									 itemtype="https://schema.org/Answer">
									<div itemprop="text">
										<?php echo wp_kses_post($row['faq_add_text']); ?>
									</div>
								</div>
							<?php endif; ?>

						</div>
						<?php
					}
				}
				?>
			</div>
        </div>
    </div>
</div>