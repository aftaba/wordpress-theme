<?php
/**
 * Template Name: Press Template
 *
 * This is the template that displays Press pages.
 *
 * @link https://codex.wordpress.org/Theme_Development#Custom_Page_Templates
 * @package Venet
 */
?>
<?php get_header(); ?>	
	<div class="container">
		<div class="row">
			<div class="col-xs-12">

				<p class="push h60"></p>

				<div class="component title">
					<h1><?php the_title(); ?></h1>
				</div>  
			</div>
		</div>
	

			<div class="row">
				<div class="col-xs-12">

					<div class="component download">

						<div class="row">
							
							<?php while ( have_rows( 'download_box' ) ) : the_row(); ?>
								<div class="col-xs-12 col-sm-4">    
									<div class="item">
										<figure>
											<?php if ( get_sub_field( 'image' ) ) : ?>
											<?php
												$image_id = get_sub_field( 'image' );
												$image_obj = wp_get_attachment_image_src( $image_id, 'full' );
											?>
											<img src="<?php echo esc_url( $image_obj[0] ) ?>" />
											<?php endif; ?>
										</figure>
										<div class="title">
											<?php the_sub_field( 'title' ); ?>
										</div>
										<p>
											<?php the_sub_field( 'sub_title' ); ?>
										</p>
										
										<?php if ( false !== strpos( get_sub_field( 'pdf_file' ), '.pdf' ) ) : ?>
											<?php $file_download_url = site_url() . '/download-pdf/?file=' . get_sub_field( 'pdf_file' ); ?>
											<a href="<?php echo $file_download_url; ?>">
												<i class="fa fa-cloud-download"></i>
												<?php
												if ( 'en' == qtranxf_getLanguage() ) {
													esc_html_e( 'Download PDF', 'venet' );
												} elseif ( 'fr' == qtranxf_getLanguage() ) {
													esc_html_e( 'Télécharger le PDF', 'venet' );
												}
												?>
											</a> 
										<?php endif; ?>
									</div>
								</div>
							<?php endwhile; ?>

						</div>
					</div>
				</div>
			</div>
		</div>

	<div class="push-sf"></div> <!-- for sticky footer -->
</div><!-- .wrapper -->
<?php get_footer(); ?>
