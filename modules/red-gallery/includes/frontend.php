<?php
/****************************
 * Download trigger for link
 ****************************/
function red_display_download_trigger( $url = '', $download_link_text = 'Download' ) {
	$has_download = $url != '';
	?>

	<?php if ( $has_download ) { ?>

		<a href="<?php echo $url ?>" download>

	<?php } ?>

			<div class="red-download-link">
				<span class="red-download-link__text"><?php echo $download_link_text; ?></span>
				<i class="fas fa-download red-download-link__icon"></i>
			</div>

		<?php if ( $has_download ) { ?>

			</a>

		<?php } ?>

<?php } ?>

<!-- Prints front end HTML -->
<?php if ( 'collage' == $settings->layout ) : ?>
<div class="fl-mosaicflow">
	<div class="fl-mosaicflow-content">
		<?php foreach ( $module->get_photos() as $photo ) : ?>
		<div class="fl-mosaicflow-item">
			<?php

			$url = 'none' == $settings->click_action ? '' : $photo->link;

			if ( 'lightbox' == $settings->click_action && isset( $settings->lightbox_image_size ) ) {
				if ( '' !== $settings->lightbox_image_size ) {
					$size = $settings->lightbox_image_size;
					$data = FLBuilderPhoto::get_attachment_data( $photo->id );
					if ( isset( $data->sizes->{$size} ) ) {
						$url = $data->sizes->{$size}->url;
					}
				}
			}

			FLBuilder::render_module_html('photo', array(
				'crop'         => false,
				'link_target'  => '_self',
				'link_type'    => 'none' == $settings->click_action ? '' : 'url',
				'link_url'     => $url,
				'photo'        => $photo,
				'photo_src'    => $photo->src,
				'show_caption' => $settings->show_captions,
			));

			?>

			<?php red_display_download_trigger( $url, $settings->download_link_text ); ?>

		</div>
		<?php endforeach; ?>
	</div>
	<div class="fl-clear"></div>
</div>
<?php else : ?>
<div class="fl-gallery">
	<?php foreach ( $module->get_photos() as $photo ) : ?>
	<div class="fl-gallery-item">
		<?php

		$url = 'none' == $settings->click_action ? '' : $photo->link;

		if ( 'lightbox' == $settings->click_action && isset( $settings->lightbox_image_size ) ) {
			if ( '' !== $settings->lightbox_image_size ) {
				$size = $settings->lightbox_image_size;
				$data = FLBuilderPhoto::get_attachment_data( $photo->id );
				if ( isset( $data->sizes->{$size} ) ) {
					$url = $data->sizes->{$size}->url;
				}
			}
		}

		FLBuilder::render_module_html('photo', array(
			'crop'         => false,
			'link_target'  => '_self',
			'link_type'    => 'none' == $settings->click_action ? '' : 'url',
			'link_url'     => $url,
			'photo'        => $photo,
			'photo_src'    => $photo->src,
			'show_caption' => $settings->show_captions,
		));

		?>

		<?php red_display_download_trigger(); ?>

	</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>
