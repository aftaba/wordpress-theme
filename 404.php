<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Venet
 */
?>
	<?php get_header(); ?>

	<div class="container">
      	
      	<div class="row">
      		<div class="col-xs-12">
            <p class="push h60"></p>
            <div class="component title">
            	<h1><?php esc_html_e( '404 Not Found', 'venet' ); ?> </h1>
            </div>
      		</div>
      	</div>

        <div class="row">
          	<div class="col-xs-12 text-center">

	            <div class="component standfirst">
	            	<p><?php esc_html_e( 'Oops! That page can’t be found.', 'venet' ); ?></p>
	            </div>
	            <div class="component bodycopy">
	            	<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'venet' ); ?></p>
	            </div>
	            <div class="component bodycopy">
	            	<p>	
	            		<a href="<?php echo site_url(); ?>">
	            			<?php esc_html_e( 'Click Here to go to Home Page', 'venet' ); ?>
	            		</a>
	            	</p>
	            </div>
	        </div>
	    </div>
	</div>

	<?php get_footer();
