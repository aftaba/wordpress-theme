<?php 
/**
 * Template Name: Gallery Template
 *
 * This is the template that displays Gallery.
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

                <p class="push h60"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12"> 
                <div class="component gallery">
                    <div class="camera_wrap">
                        <?php while( have_rows( 'image_carousel' ) ): the_row(); ?>
                            <?php if ( get_sub_field( 'image' ) ) : ?>
                                <?php 
                                    $image_id = get_sub_field( 'image' );
                                    $full_obj = wp_get_attachment_image_src( $image_id, 'full' );
                                    $thumb_obj = wp_get_attachment_image_src( $image_id, 'thumbnail' );
                                ?>
                                <div data-thumb="<?php echo esc_url( $thumb_obj[0] ); ?>" data-src="<?php echo esc_url( $full_obj[0] ); ?>"></div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="push-sf"></div> <!-- for sticky footer -->
</div><!-- .wrapper -->
<?php get_footer(); ?>	