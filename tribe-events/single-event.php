<?php
/**
 * This is the template that displays Visit-Event pages.
 *
 * @package Venet
 */
?>
<?php get_header();
$event_id = get_the_ID();
$is_event_private = ( '' != get_post_meta( $event_id, 'is_event_private', true ) ) ? get_post_meta( $event_id, 'is_event_private', true ) : 'no';
$is_visible = true;

if ( 'yes' == $is_event_private ) {
	$private_str = ( isset( $_GET['privatelink'] ) ) ? $_GET['privatelink'] : '';
	$comp_str = 'id_' . $event_id;
	if ( $comp_str == $private_str ) {
		$is_visible = true;
	} else {
		$is_visible = false;
	}
}
?>  
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<p class="push h60"></p>
				
				<div class="component title">
				   <h1><?php the_field( 'standfirst_title', 'options' ); ?></h1>
				</div>
				
				<?php if ( $standfirst = get_field( 'standfirst_content', 'options' ) ) : ?>
					<div class="component standfirst">
						<?php echo $standfirst; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 text-center">
				<div class="component button">
					<a href="<?php esc_url( the_field( 'another_event_link', 'options' ) ); ?>"><?php the_field( 'another_event_button_text', 'options' ); ?></a>
				</div>
			</div>

			<?php if ( $is_visible ) : ?>

				<div class="col-xs-12 col-sm-8 col-sm-offset-2">
					<div class="component event">
						<h2><?php the_title(); ?></h2>
						<?php echo tribe_events_event_schedule_details( get_the_ID(), '<h3>', '</h3>' ); ?>
						<div class="component bodycopy">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; ?>
						</div>
						<div class="notices" id="notices">
							<span></span>
						</div>
						<?php
							// Get ticket id i.e Woocomerece product ID to dislay the ticket detail
							// Get an array of ticket objects for the current event. Only for Global Stock
							$currency_symbol = get_woocommerce_currency_symbol( get_option( 'woocommerce_currency' ) );
							$is_there_any_product = false ; // to show add to cart button based on avaibility
						?>
							
						<?php if ( ! tribe_is_past_event( $event_id ) ) : ?>
								
							<?php if ( class_exists( 'Tribe__Tickets_Plus__Commerce__EDD__Main' ) ) :
								$tickets = Tribe__Tickets_Plus__Commerce__EDD__Main::get_instance()->get_all_event_tickets( $event_id );

								if ( empty( $tickets ) ) {
									$total_stock = 0;
									$message = 'No tickets are created for this event';
								} else {
									$total_stock = $tickets[0]->stock();
									if ( 0 === $total_stock ) {
										$message = 'No tickets left';
									}
								}
							?>

								<?php if ( $total_stock > 0 ) : ?>
									
									<form data-currency="<?php echo $currency_symbol; ?>" id="venet-tickets" data-total-stock="<?php echo $total_stock; ?>">
										<?php global $woocomerece; ?>
										
										<?php foreach ( $tickets as $ticket ) : ?>   
											<?php if ( class_exists( 'WC_Product_Simple' ) ) {
												$product = new WC_Product_Simple( $ticket->ID );
											} else {
												$product = new WC_Product( $ticket->ID );
											}

											?>
											
											<?php if ( $ticket->date_in_range( current_time( 'timestamp' ) ) ) : ?>
												<?php $is_there_any_product = true ; // to show add to cart button ?>
												<div class="row">
													<div class="number">
														<div class="col-xs-12 col-sm-5">
															<label><?php esc_html_e( $ticket->name, 'venet' ); ?></label>
														</div>
														<div class="col-xs-12 col-sm-5">
															<input type="number" value="0" class="ticket-quantity" name="quantity" min="0" max="<?php echo $total_stock;?>" data-ticket-id="<?php echo $ticket->ID; ?>" data-ticket-price="<?php echo $ticket->price; ?>" />
														</div>
														<div class="col-xs-12 col-sm-2">
															<p class="number">
																<span>
																<?php echo $currency_symbol . $ticket->price; ?>
																</span>
															</p>
														</div>
													</div>
												</div>
											<?php endif; // date range?>
										<?php endforeach; ?>
										
										<?php if ( $is_there_any_product ) : ?>
											<div class="row">
												<div class="number">
													  <div class="col-xs-12 col-sm-5">
															<label><?php esc_html_e( 'Slots available', 'venet' ); ?></label>
													  </div>
													  <div class="col-xs-12 col-sm-7">
															<p class="number"><span><?php echo $total_stock; ?></span></p>
													  </div>
												</div>
											</div>

											<p class="push h20"></p>
											<div class="row">
												<div class="col-xs-12 col-sm-5">
													  <label><?php esc_html_e( 'Total', 'venet' ); ?></label>
												</div>
												<div class="col-xs-12 col-sm-7">
													<p class="total" id="price-total">
														<?php echo $currency_symbol . '0' ; ?>
													</p>
												</div>
											</div>
											<?php endif; ?>

									</form>

									<?php if ( $is_there_any_product ) : ?>
										<div class="component button">
											<a href="#" id="add_to_cart" class="inactive">
												<?php if ( qtranxf_getLanguage() == 'en' ) : ?>
													<?php esc_html_e( 'Add to Cart' , 'venet' ); ?>
												<?php else : ?>
													<?php esc_html_e( 'Ajouter au panier', 'venet' ); ?>
												<?php endif; ?>
											</a>
											</a>
										</div>
									<?php else : ?>
										<?php esc_html_e( 'No more tickets are sold on this date', 'venet' ); ?>
									<?php endif; ?>

								<?php else : // if there are no tickets created ?>
									<?php esc_html_e( $message, 'venet' ); ?>
								<?php endif; ?>
							<?php endif; // class_exist?>
						<?php else : // if it is past event  ?>
							<?php esc_html_e( 'This event is a past event', 'venet' ); ?>
						<?php endif; ?>


					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="push-sf"></div> <!-- for sticky footer -->
</div><!-- .wrapper -->
<?php get_footer();
