<?php
/**
 * Template Name: Visit Template
 *
 * This is the template that displays Visit-Event Pages.
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
		<?php if ( function_exists( 'tribe_is_upcoming' ) ) : ?>
			<?php if ( ! tribe_is_upcoming() && ! tribe_is_month() && ! tribe_is_day() ) : ?>
				<div class="row">
					<div class="col-xs-12">
						<?php while ( have_posts() ) : the_post(); ?>

							<?php if ( $standfirst = get_field( 'standfirst_text' ) ) : ?>
								<div class="component standfirst">
									<?php  echo $standfirst; ?>
								</div>
							<?php endif; ?>

							<div class="component bodycopy">
								<?php the_content(); ?>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>

<?php get_footer(); ?>
