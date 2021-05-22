<?php
/**
 * Template Name: Programmes Template
 *
 * This is the template that displays Programmes.
 *
 * @link https://codex.wordpress.org/Theme_Development#Custom_Page_Templates
 * @package Venet
 */

$args = array(
	'post_type' => 'programme',
	'orderby'   => 'date',
	'order'     => 'DESC',
);
$query = new WP_Query( $args );
$programmes = $query->posts;
$stories = get_field( 'stories', $programmes[0]->ID );

?>
<?php get_header(); ?>
	<section class="tabs-section">  
	  <div class="container">
			<ul class="nav nav-tabs">
			  	<li class="active">
			  		<a data-toggle="tab" class="text-uppercase" href="#home"><?php esc_attr_e( 'Current Events', 'venet' ); ?></a>
			  	</li>
			  	<li>
			  		<a data-toggle="tab" class="text-uppercase" href="#menu1"><?php esc_attr_e( 'Archives', 'venet' ); ?></a>
			  	</li>
			</ul>
			<div class="tab-content d-inline-block">
				<div id="home" class="tab-pane fade in active">
					
					<!--First big Slider code here-->
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<!-- Wrapper for slides -->
						<div class="carousel-inner">
							<?php if ( $image_carousels = get_field( 'image_carousel', $programmes[0]->ID ) ) : ?>
								<?php
								$hide_class = '';
								if ( 1 == count( $image_carousels ) ) {
									$hide_class = 'hidden-arrow';
								}
								?>
								<?php foreach ( $image_carousels as $key => $image_carousel ) : ?>
									<?php if ( ! empty( $image_carousel['image'] ) ) : ?>
										<?php
										$class = '';
										if ( 0 == $key ) {
											$class = 'active';
										}
										?>
										<div class="item <?php echo $class; ?>">
											<img src="<?php echo $image_carousel['image']['url']; ?>" alt="<?php echo $image_carousel['image']['alt']; ?>" />
										</div>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
						<!-- Left and right controls -->
						<a class="left carousel-control <?php echo $hide_class; ?>" href="#myCarousel" data-slide="prev">
							<span class="glyphicon glyphicon-menu-left"></span>
							<span class="sr-only"><?php esc_attr_e( 'Previous', 'venet' ); ?></span>
						</a>
						<a class="right carousel-control <?php echo $hide_class; ?>" href="#myCarousel" data-slide="next">
						  	<span class="glyphicon glyphicon-menu-right"></span>
						  	<span class="sr-only"><?php esc_attr_e( 'Next', 'venet' ); ?></span>
						</a>
					</div>
					<p class="push h60"></p>
					
					<?php if ( $standfirst = get_field( 'standfirst_text', $programmes[0]->ID ) ) : ?>
						<?php echo $standfirst; ?>
					<?php endif; ?>
					
					<!--First big Slider code here-->
					
					
					<?php if ( $stories = get_field( 'stories', $programmes[0]->ID ) ) : ?>
						<div class="row bottom-content">
							<?php foreach ( $stories as $story_key => $story ) : ?>
								<div class="col-md-4 common-slide-css col-sm-6 col-xs-12">
									<?php if ( $image_carousels = get_field( 'image_carousel', $story['story']->ID ) ) : ?>
										<?php
										$hide_class = '';
										if ( 1 == count( $image_carousels ) ) {
											$hide_class = 'hidden-arrow';
										}
										?>
										<div id="myCarousel-<?php echo $story['story']->ID; ?>" class="carousel slide" data-ride="carousel">
											<!-- Indicators -->
											<!-- Wrapper for slides -->
											<div class="carousel-inner">
												<?php foreach ( $image_carousels as $key => $image_carousel ) : ?>
													<?php if ( ! empty( $image_carousel['image'] ) ) : ?>
														<?php
														$class = '';
														if ( 0 == $key ) {
															$class = 'active';
														}
														$image = wp_get_attachment_image_src( $image_carousel['image'], 'full' );
														?>
														<div class="item <?php echo $class; ?>">
															<img src="<?php echo esc_url( $image[0] ); ?>" alt="" />
														</div>
													<?php endif; ?>
												<?php endforeach; ?>
											</div>
							
											<!-- Left and right controls -->
											<a class="left carousel-control <?php echo $hide_class; ?>" href="#myCarousel-<?php echo $story['story']->ID; ?>" data-slide="prev">
											  <span class="glyphicon glyphicon-menu-left"></span>
											  <span class="sr-only"><?php esc_attr_e( 'Previous', 'venet' ); ?></span>
											</a>
											<a class="right carousel-control <?php echo $hide_class; ?>" href="#myCarousel-<?php echo $story['story']->ID; ?>" data-slide="next">
											  <span class="glyphicon glyphicon-menu-right"></span>
											  <span class="sr-only"><?php esc_attr_e( 'Next', 'venet' ); ?></span>
											</a>
										</div>
									<?php endif; ?>
									<div class="inner-caption">
						  				<h4 class="font-weight-bold text-uppercase"><?php echo $story['story']->post_title; ?></h4>
						  				<p class="date-range"><?php echo get_field( 'date_range', $story['story']->ID ); ?></p>
										<p class="location"><em><?php echo get_field( 'location', $story['story']->ID ); ?></em></p>
						  				<a class="text-uppercase" href="<?php echo get_permalink($story['story']->ID); ?>"><?php esc_attr_e( 'Find out more', 'venet' ); ?></a>
					  				</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

				</div>
				<div id="menu1" class="tab-pane fade">
					<?php if ( $query->post_count > 1 ) : ?>
						<?php foreach ( $programmes as $key => $programme ) : ?>
							<?php if ( 0 != $key ) : ?>
								<div class="col-md-4 common-slide-css col-sm-6 col-xs-12 common-slide-css">
									<?php if ( $image_carousels = get_field( 'image_carousel', $programme->ID ) ) : ?>
										<?php
										$hide_class = '';
										if ( 1 == count( $image_carousels ) ) {
											$hide_class = 'hidden-arrow';
										}
										?>
										<div id="myCarousel-<?php echo $programme->ID; ?>" class="carousel slide" data-ride="carousel">
											<!-- Indicators -->
											<!-- Wrapper for slides -->
											<div class="carousel-inner">
												<?php foreach ( $image_carousels as $key => $image_carousel ) : ?>
													<?php if ( ! empty( $image_carousel['image'] ) ) : ?>
														<?php
														$class = '';
														if ( 0 == $key ) {
															$class = 'active';
														}
														?>
														<div class="item <?php echo $class; ?>">
															<img src="<?php echo $image_carousel['image']['url']; ?>" alt="<?php echo $image_carousel['image']['alt']; ?>" />
														</div>
													<?php endif; ?>
												<?php endforeach; ?>
											</div>
							
											<!-- Left and right controls -->
											<a class="left carousel-control <?php echo $hide_class; ?>" href="#myCarousel-<?php echo $programme->ID; ?>" data-slide="prev">
											  <span class="glyphicon glyphicon-menu-left"></span>
											  <span class="sr-only"><?php esc_attr_e( 'Previous', 'venet' ); ?></span>
											</a>
											<a class="right carousel-control <?php echo $hide_class; ?>" href="#myCarousel-<?php echo $programme->ID; ?>" data-slide="next">
											  <span class="glyphicon glyphicon-menu-right"></span>
											  <span class="sr-only"><?php esc_attr_e( 'Next', 'venet' ); ?></span>
											</a>
										</div>
									<?php endif; ?>
									
									<div class="inner-caption">
										<h4 class="font-weight-bold text-uppercase prog-mobile-only"><?php echo $programme->post_title; ?></h4>
										<div class=" tooltiptitle not-prog-mobile-only">
											<h4 class="font-weight-bold text-uppercase">
											<?php
											$pro_title = ( 30 < strlen( $programme->post_title ) ) ? substr( $programme->post_title, 0, 30 ) . ' ...' : $programme->post_title;
											echo $pro_title;
											?>
											</h4>
											<span class="tooltiptitletext"><?php echo $programme->post_title; ?></span>
										</div>
										<p class="date-range"><?php echo get_field( 'date_range', $programme->ID ); ?></p>
										<p class="location prog-mobile-only"><em><?php echo get_field( 'location', $programme->ID ); ?></em></p>
										<p class="location tooltiplocation not-prog-mobile-only">
											<em>
												<?php
												$pro_loc = ( 50 < strlen( get_field( 'location', $programme->ID ) ) ) ? substr( get_field( 'location', $programme->ID ), 0, 48 ) . ' ...' : get_field( 'location', $programme->ID );
												echo $pro_loc;
												?>
											</em>
											<span class="tooltiplocationtext"><?php echo get_field( 'location', $programme->ID ); ?></span>
										</p>
										<br />
										<a class="text-uppercase" href="<?php echo get_permalink( $programme->ID ); ?>"><?php esc_attr_e( 'Find out more', 'venet' ); ?></a>
								  	</div>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php else : ?>
						<p id="no-event-present"><?php esc_attr_e( 'No past events present.', 'venet' ); ?></p>
					<?php endif; ?>
				</div>
	  		</div>
	  	</div>      
	</section>
	<div class="push-sf"></div> <!-- for sticky footer -->
</div><!-- .wrapper -->
<?php get_footer(); ?>
