<?php
/**
 * The template for displaying Programmes.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Venet
 */

?>

<?php get_header(); ?>
	<!-- For Image Carosuel -->
	<div class="row">
		<div class="col-xs-12"> 
			<div id="myCarousel" class="carousel slide custom-prgrm-slider" data-ride="carousel">
				<!-- Indicators -->
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
			
					<?php if ( $image_carousels = get_field( 'image_carousel' ) ) : ?>
						<?php
						$hide_class = '';
						if ( 1 == count( $image_carousels ) ) {
							$hide_class = 'hidden-arrow';
						}
						?>
						<?php foreach ( $image_carousels as $key => $image_carousel ) : ?>
							<?php if ( ! empty( $image_carousel['image'] ) ) : ?>
								<?php
								$class = '';
								if ( 0 == $key ) {
									$class = 'active';
								}
								?>
								<div class="item <?php echo $class; ?>">
									<img src="<?php echo $image_carousel['image']['url']; ?>" alt="<?php echo $image_carousel['image']['alt']; ?>" />
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<!-- Left and right controls -->
				<a class="left carousel-control <?php echo $hide_class; ?>" href="#myCarousel" data-slide="prev">
					<span class="glyphicon glyphicon-menu-left"></span>
					<span class="sr-only"><?php esc_attr_e( 'Previous', 'venet' ); ?></span>
				</a>
				<a class="right carousel-control <?php echo $hide_class; ?>" href="#myCarousel" data-slide="next">
				  	<span class="glyphicon glyphicon-menu-right"></span>
				  	<span class="sr-only"><?php esc_attr_e( 'Next', 'venet' ); ?></span>
				</a>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2">
				<p class="push h60"></p>
				<?php if ( $standfirst = get_field( 'standfirst_text' ) ) : ?>
					<div class="component standfirst">
						<?php echo $standfirst; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="push-sf"></div> <!-- for sticky footer -->
</div><!-- .wrapper -->

<?php get_footer(); ?>
