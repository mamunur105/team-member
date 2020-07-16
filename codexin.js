jQuery(document).ready(function(){


	var modal = jQuery('#member_bio_data').iziModal({
		width: 860,
		top: 50,
		bottom: 50,
		zindex: 99999,
		transition: 'fadeInDown',
		onOpening: function(modal){
	        modal.startLoading();  
	    },
	    onOpened: function(modal){
	    	modal.stopLoading();
	    }
	});
	jQuery(document).on('click', '.open_modal', function (event) {
	    event.preventDefault();
	    var data_id = jQuery(this).data('id');
		var querydata = {
			action: 'member_data_by_id',
			nonce_code: codexin_script.ajax_nonce,
			member_id:data_id
		};
		// jQuery("#member_bio_data .iziModal-content").html('');
		jQuery.ajax({
			// you can also use $.post here
			url: codexin_script.ajaxurl, // AJAX handler
			data: querydata,
			type: 'POST',
			beforeSend: function(xhr) {
				
			},
			success: function(data) {
				if (data) {		
					// jQuery("#member_bio_data .iziModal-content").html('');
					jQuery("#member_bio_data .iziModal-content").html(data);
					modal.iziModal('open');
				}
			}
		});

	});

});
