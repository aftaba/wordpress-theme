<?php
/**
 * Tickets Email Template
 * The template for the email with the purchased tickets when using ticketing plugins (Like WooTickets)
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/tickets/email.php
 *
 * This file is being included in events/lib/tickets/Tickets.php
 *  in the function generate_tickets_email_content. That function has a $tickets
 *  array with elements that have this fields:
 *        $tickets[] = array( 'event_id',
 *                              'ticket_name'
 *                              'holder_name'
 *                              'order_id'
 *                              'ticket_id'
 *                              'security_code')
 *
 * @package TribeEventsCalendar
 * @version 4.4.3
 *
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title><?php esc_html_e( 'Your tickets', 'venet' ); ?></title>
	<meta name="viewport" content="width=device-width" />
	<style type="text/css">
		h1, h2, h3, h4, h5, h6 {
			color : #0a0a0e;
		}

		a, img {
			border  : 0;
			outline : 0;
		}

		#outlook a {
			padding : 0;
		}

		.ReadMsgBody, .ExternalClass {
			width : 100%
		}

		.yshortcuts, a .yshortcuts, a .yshortcuts:hover, a .yshortcuts:active, a .yshortcuts:focus {
			background-color : transparent !important;
			border           : none !important;
			color            : inherit !important;
		}

		body {
			background  : #ffffff;
			min-height  : 1000px;
			font-family : sans-serif;
			font-size   : 14px;
		}

		.appleLinks a {
			color           : #006caa;
			text-decoration : underline;
		}

		@media only screen and (max-width: 480px) {
			body, table, td, p, a, li, blockquote {
				-webkit-text-size-adjust : none !important;
			}

			body {
				width     : 100% !important;
				min-width : 100% !important;
			}

			body[yahoo] h2 {
				line-height : 120% !important;
				font-size   : 28px !important;
				margin      : 15px 0 10px 0 !important;
			}

			table.content,
			table.wrapper,
			table.inner-wrapper {
				width : 100% !important;
			}

			table.ticket-content {
				width   : 90% !important;
				padding : 20px 0 !important;
			}

			table.ticket-details {
				position       : relative;
				padding-bottom : 100px !important;
			}

			table.ticket-break {
				width : 100% !important;
			}

			td.wrapper {
				width : 100% !important;
			}

			td.ticket-content {
				width : 100% !important;
			}

			td.ticket-image img {
				max-width : 100% !important;
				width     : 100% !important;
				height    : auto !important;
			}

			td.ticket-details {
				width         : 33% !important;
				padding-right : 10px !important;
				border-top    : 1px solid #ddd !important;
			}

			td.ticket-details h6 {
				margin-top : 20px !important;
			}

			td.ticket-details.new-row {
				width      : 50% !important;
				height     : 80px !important;
				border-top : 0 !important;
				position   : absolute !important;
				bottom     : 0 !important;
				display    : block !important;
			}

			td.ticket-details.new-left-row {
				left : 0 !important;
			}

			td.ticket-details.new-right-row {
				right : 0 !important;
			}

			table.ticket-venue {
				position       : relative !important;
				width          : 100% !important;
				padding-bottom : 150px !important;
			}

			td.ticket-venue,
			td.ticket-organizer,
			td.ticket-qr {
				width      : 100% !important;
				border-top : 1px solid #ddd !important;
			}

			td.ticket-venue h6,
			td.ticket-organizer h6 {
				margin-top : 20px !important;
			}

			td.ticket-qr {
				text-align : left !important
			}

			td.ticket-qr img {
				float      : none !important;
				margin-top : 20px !important
			}

			td.ticket-organizer,
			td.ticket-qr {
				position : absolute;
				display  : block;
				left     : 0;
				bottom   : 0;
			}

			td.ticket-organizer {
				bottom : 0px;
				height : 100px !important;
			}

			td.ticket-venue-child {
				width : 50% !important;
			}

			table.venue-details {
				position : relative !important;
				width    : 100% !important;
			}

			a[href^="tel"], a[href^="sms"] {
				text-decoration : none;
				color           : black;
				pointer-events  : none;
				cursor          : default;
			}

			.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
				text-decoration : default;
				color           : #006caa !important;
				pointer-events  : auto;
				cursor          : default;
			}
		}

		@media only screen and (max-width: 320px) {
			td.ticket-venue h6,
			td.ticket-organizer h6,
			td.ticket-details h6 {
				font-size : 12px !important;
			}
		}

		@media print {
			.ticket-break {
				page-break-before : always !important;
			}
		}

		<?php do_action( 'tribe_tickets_ticket_email_styles' );?>

	</style>
</head>
<body yahoo="fix" alink="#006caa" link="#006caa" text="#000000" bgcolor="#ffffff" style="width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0 auto; padding:20px 0 0 0; background:#ffffff; min-height:1000px;">
	<div style="margin:0; padding:0; width:100% !important; font-family: 'Helvetica Neue', Helvetica, sans-serif; font-size:14px; line-height:145%; text-align:left;">
		<center>
			<?php
			do_action( 'tribe_tickets_ticket_email_top' );

			$count = 0;
			$break = '';
			foreach ( $tickets as $ticket ) {
				$count ++;

				if ( $count == 2 ) {
					$break = 'page-break-before: always !important;';
				}

				$event      = get_post( $ticket['event_id'] );
				$header_id  = Tribe__Tickets__Tickets_Handler::instance()->get_header_image_id( $ticket['event_id'] );
				$header_img = false;
				if ( ! empty( $header_id ) ) {
					$header_img = wp_get_attachment_image_src( $header_id, 'full' );
				}

				$venue_label = '';
				$venue_name = null;

				if ( function_exists( 'tribe_get_venue_id' ) ) {
					$venue_id = tribe_get_venue_id( $event->ID );
					if ( ! empty( $venue_id ) ) {
						$venue = get_post( $venue_id );
					}

					$venue_label = tribe_get_venue_label_singular();

					$venue_name = $venue_phone = $venue_address = $venue_city = $venue_web = '';
					if ( ! empty( $venue ) ) {
						$venue_name    = $venue->post_title;
						$venue_phone   = get_post_meta( $venue_id, '_VenuePhone', true );
						$venue_address = get_post_meta( $venue_id, '_VenueAddress', true );
						$venue_city    = get_post_meta( $venue_id, '_VenueCity', true );
						$venue_state   = get_post_meta( $venue_id, '_VenueStateProvince', true );
						if ( empty( $venue_state ) ) {
							$venue_state = get_post_meta( $venue_id, '_VenueState', true );
						}
						if ( empty( $venue_state ) ) {
							$venue_state = get_post_meta( $venue_id, '_VenueProvince', true );
						}
						$venue_zip     = get_post_meta( $venue_id, '_VenueZip', true );
						$venue_web     = get_post_meta( $venue_id, '_VenueURL', true );
					}

					// $venue_address_style: make sure no double-quotes in the content
					$venue_address_style = "display:block; margin:0; font-family: 'Helvetica Neue', Helvetica, sans-serif; font-size:13px;";

					$venue_map_url = '';

					if ( true === tribe_show_google_map_link( $event->ID ) ) {
						$venue_map_url = esc_url( tribe_get_map_link( $venue_id ) );
					}

					if ( empty( $venue_map_url ) ) {
						$venue_address_tag = 'span';
					} else {
						$venue_address_tag = 'a';
						$venue_address_style .= ' color:#006caa !important; text-decoration:underline;';
					}

				}

				$start_date = null;

				/**
				 * Filters whether or not the event start date should be included in the ticket email
				 *
				 * @var boolean Include start date? Defaults to false
				 * @var int Event ID
				 */
				$include_start_date = apply_filters( 'event_tickets_email_include_start_date', false, $event->ID );

				if ( $include_start_date && function_exists( 'tribe_get_start_date' ) ) {
					$start_date = tribe_get_start_date( $event, true );
				}

				if ( function_exists( 'tribe_get_organizer_ids' ) ) {
					$organizers = tribe_get_organizer_ids( $event->ID );
				}

				$event_link = function_exists( 'tribe_get_event_link' ) ? tribe_get_event_link( $event->ID ) : get_post_permalink( $event->ID );

				?>
				<table class="content" align="center" width="620" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="margin:0 auto; padding:0;<?php echo $break; ?>">
					<tr>
						<td align="center" valign="top" class="wrapper" width="620">
							<table class="inner-wrapper" border="0" cellpadding="0" cellspacing="0" width="620" bgcolor="#f7f7f7" style="margin:0 auto !important; width:620px; padding:0;">
								<tr>
									<td valign="top" class="ticket-content" align="left" width="580" border="0" cellpadding="20" cellspacing="0" style="padding:20px; background:#f7f7f7;">
										<?php
										if ( ! empty( $header_img ) ) {
											$header_width = esc_attr( $header_img[1] );
											if ( $header_width > 580 ) {
												$header_width = 580;
											}
											?>
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td class="ticket-image" valign="top" align="left" width="100%" style="padding-bottom:15px !important;">
														<img src="<?php echo esc_attr( $header_img[0] ); ?>" width="<?php echo esc_attr( $header_width ); ?>" alt="<?php echo __( $event->post_title ); ?>" style="border:0; outline:none; height:auto; max-width:100%; display:block;" />
													</td>
												</tr>
											</table>
											<?php
										}
										?>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
											<tr>
												<td valign="top" align="center" width="100%" style="padding: 0 !important; margin:0 !important;">
													<h2 style="color:#0a0a0e; margin:0 0 10px 0 !important; font-family: 'Helvetica Neue', Helvetica, sans-serif; font-style:normal; font-weight:700; font-size:28px; letter-spacing:normal; text-align:left;line-height: 100%;">
														<a style="color:#0a0a0e !important" href="<?php echo esc_url( $event_link ); ?>"><?php echo __( $event->post_title ); ?></a>
													</h2>
													<?php if ( ! empty( $start_date ) ): ?>
														<h4 style="color:#0a0a0e; margin:0 !important; font-family: 'Helvetica Neue', Helvetica, sans-serif; font-style:normal; font-weight:700; font-size:15px; letter-spacing:normal; text-align:left;line-height: 100%;">
															<span style="color:#0a0a0e !important"><?php echo __( $start_date ); ?></span>
														</h4>
													<?php endif; ?>
												</td>
											</tr>
										</table>
										<table class="whiteSpace" border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td valign="top" align="left" width="100%" height="30" style="height:30px; background:#f7f7f7; padding: 0 !important; margin:0 !important;">
													<div style="margin:0; height:30px;"></div>
												</td>
											</tr>
										</table>
										<table class="ticket-details" border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
											<tr>
												<td class="ticket-details" valign="top" align="left" width="100" style="padding: 0; width:100px; margin:0 !important;">
													<h6 style="color:#909090 !important; margin:0 0 10px 0; font-family: 'Helvetica Neue', Helvetica, sans-serif; text-transform:uppercase; font-size:13px; font-weight:700 !important;"><?php esc_html_e( 'Ticket #', 'venet' ); ?></h6>
													<span style="color:#0a0a0e !important; font-family: 'Helvetica Neue', Helvetica, sans-serif; font-size:15px;"><?php echo $ticket['ticket_id']; ?></span>
												</td>
												<td class="ticket-details" valign="top" align="left" width="120" style="padding: 0; width:120px; margin:0 !important;">
													<h6 style="color:#909090 !important; margin:0 0 10px 0; font-family: 'Helvetica Neue', Helvetica, sans-serif; text-transform:uppercase; font-size:13px; font-weight:700 !important;"><?php esc_html_e( 'Ticket Type', 'venet' ); ?></h6>
													<span style="color:#0a0a0e !important; font-family: 'Helvetica Neue', Helvetica, sans-serif; font-size:15px;"><?php esc_html_e( $ticket['ticket_name'], 'venet' );?></span>
												</td>
												<td class="ticket-details" valign="top" align="left" width="120" style="padding: 0 !important; width:120px; margin:0 !important;">
													<h6 style="color:#909090 !important; margin:0 0 10px 0; font-family: 'Helvetica Neue', Helvetica, sans-serif; text-transform:uppercase; font-size:13px; font-weight:700 !important;"><?php esc_html_e( 'Purchaser', 'venet' ); ?></h6>
													<span style="color:#0a0a0e !important; font-family: 'Helvetica Neue', Helvetica, sans-serif; font-size:15px;"><?php echo __( $ticket['holder_name'] ); ?></span>
												</td>
												<td class="ticket-details new-row new-left-row" valign="top" align="left" width="120" style="padding: 0; width:120px; margin:0 !important;">
													<h6 style="color:#909090 !important; margin:0 0 10px 0; font-family: 'Helvetica Neue', Helvetica, sans-serif; text-transform:uppercase; font-size:13px; font-weight:700 !important;"><?php esc_html_e( 'Security Code', 'venet' ); ?></h6>
													<span style="color:#0a0a0e !important; font-family: 'Helvetica Neue', Helvetica, sans-serif; font-size:15px;"><?php echo __( $ticket['security_code'] ); ?></span>
												</td>
											</tr>
										</table>
										<table class="whiteSpace" border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td valign="top" align="left" width="100%" height="30" style="height:30px; background:#f7f7f7; padding: 0 !important; margin:0 !important;">
													<div style="margin:0; height:30px;"></div>
												</td>
											</tr>
										</table>
										<?php
										if ( $venue_name || ! empty( $organizers ) ) {
											?>
											<table class="ticket-venue" border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
												<tr>
													<?php
													if ( $venue_name ) {
														?>
														<td class="ticket-venue" valign="top" align="left" width="300" style="padding: 0 !important; width:300px; margin:0 !important;">
															<h6 style="color:#909090 !important; margin:0 0 4px 0; font-family: 'Helvetica Neue', Helvetica, sans-serif; text-transform:uppercase; font-size:13px; font-weight:700 !important;"><?php echo __( $venue_label ); ?></h6>
															<table class="venue-details" border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
																<tr>
																	<td class="ticket-venue-child" valign="top" align="left" width="130" style="padding: 0 10px 0 0 !important; width:130px; margin:0 !important;">
																		<span style="color:#0a0a0e !important; font-family: 'Helvetica Neue', Helvetica, sans-serif; font-size:13px; display:block; margin-bottom:5px;"><?php __( $venue_name ); ?></span>
																		<<?php echo $venue_address_tag; ?> style="<?php echo __( $venue_address_style ); ?>" <?php if ( 'a' === $venue_address_tag ) { printf( 'href="%s"', $venue_map_url ); } ?>>
																			<?php echo __( $venue_address ); ?><br />
																			<?php
																				if ( $venue_city && ( $venue_state || $venue_zip ) ) :
																					printf( '%s, %s %s', $venue_city, $venue_state, $venue_zip );
																				else:
																					echo __( $venue_city );
																				endif;
																			?>
																		</<?php echo __( $venue_address_tag ); ?>>
																	</td>
																	<td class="ticket-venue-child" valign="top" align="left" width="100" style="padding: 0 !important; width:140px; margin:0 !important;">
																		<span style="color:#0a0a0e !important; font-family: 'Helvetica Neue', Helvetica, sans-serif; font-size:13px; display:block; margin-bottom:5px;"><?php echo $venue_phone; ?></span>
																		<?php if ( ! empty( $venue_web ) ): ?>
																			<a href="<?php echo esc_url( $venue_web ) ?>" style="color:#006caa !important; display:block; margin:0; font-family: 'Helvetica Neue', Helvetica, sans-serif; font-size:13px; text-decoration:underline;"><?php echo $venue_web; ?></a>
																		<?php endif ?>
																	</td>
																</tr>
															</table>
														</td>
														<?php
													}//end if

													if ( ! empty( $organizers ) ) {
														?>
														<td class="ticket-organizer" valign="top" align="left" width="140" style="padding: 0 !important; width:140px; margin:0 !important;">
															<h6 style="color:#909090 !important; margin:0 0 4px 0; font-family: 'Helvetica Neue', Helvetica, sans-serif; text-transform:uppercase; font-size:13px; font-weight:700 !important;"><?php echo tribe_get_organizer_label( count( $organizers ) < 2 ); ?></h6>
															<?php foreach ( $organizers as $organizer_id ) { ?>
																<span
																	style="color:#0a0a0e !important; font-family: 'Helvetica Neue', Helvetica, sans-serif; font-size:15px; display:block; padding-bottom:5px;"><?php echo tribe_get_organizer( $organizer_id ); ?></span>
															<?php } ?>
														</td>
														<?php
													}//end if
													?>
												</tr>
											</table>
											<?php
										}//end if
										?>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
											<tr>
												<td class="ticket-footer" valign="top" align="left" width="100%" style="padding: 0 !important; width:100%; margin:0 !important;">
													<a href="<?php echo esc_url( home_url() ); ?>" style="color:#006caa !important; display:block; margin-top:20px; font-family: 'Helvetica Neue', Helvetica, sans-serif; font-size:13px; text-decoration:underline;"><?php echo home_url(); ?></a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<?php do_action( 'tribe_tickets_ticket_email_ticket_bottom', $ticket ); ?>
							<table class="whiteSpace" border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td valign="top" align="left" width="100%" height="100" style="height:100px; background:#ffffff; padding: 0 !important; margin:0 !important;">
										<div style="margin:0; height:100px;"></div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<?php
			}//end foreach

			do_action( 'tribe_tickets_ticket_email_bottom' );
			?>
		</center>
	</div>
</body>
</html>
