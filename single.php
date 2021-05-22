<?php
/**
 * The template for displaying all posts.
 *
 * This is the template that displays all posts by default.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Venet
 */
?>

	<?php get_header(); ?>	
	
	<?php if ( has_post_thumbnail ( ) ) : ?> 
		<div class="component fullWidthImage">
		  	<figure>
	        	<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute() ?>"/>
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
      		<div class="col-xs-12">
            
            <p class="push h60"></p>

            <div class="component title">
            	<h1><?php the_title(); ?></h1>
            </div>

      		</div>
      	</div>

        <div class="row">
          	<?php while( have_posts() ) : the_post(); ?> 
          		<div class="col-xs-12 col-sm-8 col-sm-offset-2">
          			<?php the_content(); ?>	
	            
        		</div>
    		  	<div class="col-xs-12 col-sm-8 col-sm-offset-2">
          			<?php comments_template(); ?>
        		</div>
        	<?php endwhile; ?>
    	</div>
	</div>

  	<div class="push-sf"></div> <!-- for sticky footer -->
</div><!-- .wrapper -->

<?php get_footer(); ?>	