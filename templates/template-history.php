<?php 
/**
 * Template Name: History Template
 *
 * This is the template that displays History pages.
 *
 * @link https://codex.wordpress.org/Theme_Development#Custom_Page_Templates
 * @package Venet
 */
?>
<?php get_header(); ?>	
	<div class="container">
	  	<div class="row">
	  		<div class="col-xs-12 col-sm-8 col-sm-offset-2">
		        <p class="push h60"></p>
		        <div class="component title">
		        	<h1><?php the_title(); ?></h1>
		        </div>
		        <?php if ( $standfirst = get_field( 'standfirst' ) ): ?>
			        <div class="component standfirst">
			        	<?php echo $standfirst; ?>
			        </div>
			    <?php endif; ?>
			    <?php if ( $topcopy = get_field( 'top_bodycopy' ) ): ?>
			        <div class="component bodycopy">
			        	<?php echo $topcopy ?>
			        </div> 
		        <?php endif; ?>  
	  		</div>
	  	</div>
	</div>
	<?php if ( has_post_thumbnail ( ) ) : ?> 
		<div class="component fullWidthImage">
			<figure>
				<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" />
			</figure>

			<?php $post_thumbnail_id = get_post_thumbnail_id(); ?>
      		<?php $attachment = get_post( $post_thumbnail_id ); ?>
      		<?php $caption = $attachment->post_excerpt; ?>
	      		
	      	<?php if ( $caption ) : ?>
				<div class="container">
					<figcaption>
						<?php esc_attr_e( $caption, 'venet' ); ?>
					</figcaption>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2">
				<?php if ( $bottomcopy = get_field( 'bottom_bodycopy' ) ): ?>
					<div class="component bodycopy">
						<?php echo $bottomcopy ?>
					</div> 
				<?php endif; ?>  
			</div>
		</div>
	</div>
	<div class="push-sf"></div> <!-- for sticky footer -->
</div><!-- .wrapper -->
<?php get_footer(); ?>	
		
