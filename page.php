<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Venet
 */

?>

<?php get_header(); ?>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="component fullWidthImage">
            <figure>
                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>"/>
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
                <?php if ( function_exists( 'tribe_is_upcoming' ) ) : ?>
                    <?php if ( tribe_is_upcoming() || tribe_is_month() || tribe_is_day() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php the_content(); ?>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <div class="component title">
                            <h1><?php the_title(); ?></h1>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
        <?php if ( function_exists( 'tribe_is_upcoming' ) ) : ?>
            <?php if ( ! tribe_is_upcoming() && ! tribe_is_month() && ! tribe_is_day() ) : ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
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
    <div class="push-sf"></div> <!-- for sticky footer -->
</div><!-- .wrapper -->

<?php get_footer(); ?>
