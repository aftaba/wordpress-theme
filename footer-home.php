<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Venet
 */

?>

<div class="push h120"></div>

	<div class="component share">
		<span><?php esc_html_e( 'Share this page', 'venet' ); ?></span>
		
		<ul>
			<li class="fb">
				<a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" 
					onclick="javascript:window.open( this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600' ); 
					return false;">
					<i class="fa fa-facebook"></i>
				</a>
			</li>
			<li class="tw">
				<a href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>"
					onclick="javascript:window.open( this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600' );
					return false;">
					<i class="fa fa-twitter"></i>
				</a>
			</li>
			<li class="gp">
				<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>"
					onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
					return false;">
					<i class="fa fa-google-plus"></i>
				</a>
			</li>
			<li class="pi">
				<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
					echo $url; ?>">
					<i class="fa fa-pinterest" onclick="javascript:window.open( 'http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); echo $url; ?>', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
					return false;" ></i>
				</a>
			</li>
		</ul>
	</div>

	<div id="grid-overlay">
		<div class="container">
			<div class="row">
				<div class="col-xs-1 col-sm-1 col-md-1"><span></span></div>
				<div class="col-xs-1 col-sm-1 col-md-1"><span></span></div>
				<div class="col-xs-1 col-sm-1 col-md-1"><span></span></div>
				<div class="col-xs-1 col-sm-1 col-md-1"><span></span></div>
				<div class="col-xs-1 col-sm-1 col-md-1"><span></span></div>
				<div class="col-xs-1 col-sm-1 col-md-1"><span></span></div>
				<div class="col-xs-1 col-sm-1 col-md-1"><span></span></div>
				<div class="col-xs-1 col-sm-1 col-md-1"><span></span></div>
				<div class="col-xs-1 col-sm-1 col-md-1"><span></span></div>
				<div class="col-xs-1 col-sm-1 col-md-1"><span></span></div>
				<div class="col-xs-1 col-sm-1 col-md-1"><span></span></div>
				<div class="col-xs-1 col-sm-1 col-md-1"><span></span></div>
			</div>
		</div>
	</div>

	<?php wp_footer(); ?>
	</body>
</html>
