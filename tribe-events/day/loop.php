<?php
/**
 * Day View Loop
 * This file sets up the structure for the day loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/loop.php
 *
 * @version 4.6.19
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php

global $more, $post, $wp_query;
$more = false;
$current_timeslot = null;
$private_event_class = '';
$private_event_each_class = '';

?>

<div id="tribe-events-day" class="tribe-events-loop">
	<div class="tribe-events-day-time-slot">

	<?php while ( have_posts() ) : the_post(); ?>
		<?php do_action( 'tribe_events_inside_before_loop' ); ?>
		<?php
		$private_event = ( '' != get_post_meta( $post->ID, 'is_event_private', true ) ) ? get_post_meta( $post->ID, 'is_event_private', true ) : 'no';
		if ( 'yes' == $private_event ) {
			$private_event_class = 'private-event-only';
		}
		?>

		<?php if ( $current_timeslot != $post->timeslot ) :
		$current_timeslot = $post->timeslot;
		if ( 'no' == $private_event ) {
			$private_event_class = '';
		}
		?>
	</div>
	<!-- .tribe-events-day-time-slot -->

	<div class="tribe-events-day-time-slot <?php echo $private_event_class;?>">
		<h2 class="tribe-events-day-time-slot-heading"><?php echo $current_timeslot; ?></h2>
		<?php endif; ?>
		<?php
		if ( 'yes' == $private_event ) {
			$private_event_each_class = 'private-each-event-only';
		}
		?>

		<!-- Event  -->
		<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?> <?php echo $private_event_each_class; ?>">
			<?php
			$event_type = tribe( 'tec.featured_events' )->is_featured( $post->ID ) ? 'featured' : 'event';

			/**
			 * Filters the event type used when selecting a template to render
			 *
			 * @param $event_type
			 */
			$event_type = apply_filters( 'tribe_events_day_view_event_type', $event_type );

			tribe_get_template_part( 'day/single', $event_type );
			?>
		</div>

		<?php do_action( 'tribe_events_inside_after_loop' ); ?>
	<?php endwhile; ?>

	</div>
	<!-- .tribe-events-day-time-slot -->
</div><!-- .tribe-events-loop -->
