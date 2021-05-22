// File for handling custom events

jQuery( document).ready( function() {

	// Add tickets to cart on clicking the payment button
	jQuery('#add_to_cart').on( 'click', function(e){
		e.preventDefault();
		// if button is disabled then donot proceed
		if ( jQuery(this).hasClass( 'inactive' ) ) {
			return false;
		}

		var currency_symbol = jQuery('form#venet-tickets').data('currency');
	    var total_stock = jQuery('form#venet-tickets').data('total-stock');

		var tickets = {};
		var ticket_count = 0;
		// Fetches details for each tickets and storing as JSON 
	    jQuery( '.ticket-quantity' ).each(function( key, value ){
	      	ticket_count += parseInt( jQuery(this).val() );
	      	tickets[ jQuery(this).attr('data-ticket-id') ] = jQuery(this).val();
	    });

	    if ( ticket_count == 0 ) {
	    	html = '<div class="woocommerce-error">Please add tickets before procedding</div>';
    		jQuery( '#notices' ).html( html );
			return false;
	    }
		if ( ticket_count > total_stock ) {
			html = '<div class="woocommerce-error">Total Stock Exceed</div>';
    		jQuery( '#notices' ).html( html );
			return false;	
		}

		// Send ticket data to add it to cart 
		jQuery.ajax({
	        url: add_to_cart_ticket.admin_url,
	        data: {
	            action: 'add_to_cart',
	            tickets : tickets,
	            nonce: add_to_cart_ticket.nonce,
	        },
	        type: 'POST',
	        dataType : 'json',
	        success: function( response ) {

	        	if ( "error" == response.type ) {
	        		// If ticket is not added to cart
	        		html = '<div class="woocommerce-error">'+response.message+'</div>';
	        		jQuery( '#notices' ).html( html );
	        	} else {
	        		// If ticket is successfully added to cart
	        		location.href = add_to_cart_ticket.cart_url;
	        	}
		    }
		});
	});

	// redirecting on change of language
	jQuery('#language-switcher').change(function() {
		url = location.href.split("?")[0];
    	window.location.replace( url+'/?lang='+jQuery(this).val() );
	});

	// Updating the price on changing the guest number from event page
	jQuery( '.ticket-quantity' ).change(function() {
		var price_total = 0;
		var guest_total = 0;
	    var currency_symbol = jQuery('form#venet-tickets').data('currency');
	    var total_stock = jQuery('form#venet-tickets').data('total-stock');

	    jQuery( '.ticket-quantity' ).each(function(){
	      	price = jQuery(this).data('ticket-price'); // get price
	      	guest = jQuery(this).val(); // get quantity
	      	guest_total += parseInt( guest );
	      	price_total += guest * price;
	    });

	    if ( guest_total > 0 ) {
	    	jQuery('#add_to_cart').removeClass('inactive');
	    } else {
	    	jQuery('#add_to_cart').addClass('inactive');
	    }
	    // check if stock is less than 6 then show that amount drop down.
	    jQuery( '#price-total').text( currency_symbol + price_total );
	});

	// For Press Template on click of "More News"
	jQuery('#more-news').click( function( events ) {
		events.preventDefault();

		paged = jQuery('#more-news').attr('data-paged');
		posts = jQuery('#more-news').attr('data-posts');
		
		jQuery('#more-news').hide();
		jQuery('#ajax-loader').show();
		// AJAX call for loading the next set.
		jQuery.ajax({
			url : wc_add_to_cart_params['ajax_url'],
			type : 'post',
			dataType : 'json',
			data : {
				action : 'load_news_post',
				paged : paged,
				posts : posts
			},
			success : function( response ) {
				jQuery('#ajax-loader').hide();
				jQuery('#more-news').attr('data-paged', response.paged );
				jQuery('#more-news').attr('data-posts', response.posts );
				jQuery('.component.posts .row').append( response.html );
				if ( response.show_more ) {
					jQuery('#more-news').show();
				} else {
					jQuery('#more-news').hide();
				}
			}
		});
	});
});