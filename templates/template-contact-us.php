<?php
/**
 * Template Name: Contact Us
 *
 * This is the template that displays all of the Contact Us Page
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
				
				<?php if ( $standfirst = get_field( 'standfirst_text' ) ) : ?>
					<div class="component standfirst">
						<?php echo $standfirst; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div class="component contact">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-6">
				<?php if ( $google_map = get_field( 'google_map_embedded_code' ) ) : ?>
					<?php echo $google_map; ?>
				<?php endif; ?>
			</div>
			<div class="col-xs-6 address">
				<?php if ( $contact_address = get_field( 'contact_address' ) ) : ?>
					<?php echo $contact_address; ?>
				<?php endif; ?>
			</div>
		</div>

	</div>
	
	<div class="push-sf"></div> <!-- for sticky footer -->
</div><!-- .wrapper -->

<?php get_footer(); ?>