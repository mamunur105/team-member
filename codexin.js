jQuery(document).ready(function(){


	var modal = jQuery('#member_bio_data').iziModal({
		width: 860,
		top: 50,
		bottom: 50,
		zindex: 99999,
		transition: 'fadeInDown',

		onOpening: function(modal){
 			// console.log(jQuery(this));
 			var data_id = jQuery(this).context.activeElement.dataset.id;
 			var querydata = {
				action: 'member_data_by_id',
				nonce_code: codexin_script.ajax_nonce,
				member_id:data_id
			};
			// console.log(querydata);
	        modal.startLoading();
	 
	        jQuery.post(codexin_script.ajaxurl,querydata, function(data) {
	           
	           jQuery("#member_bio_data .iziModal-content").html(data);
	 
	            modal.stopLoading();

	        });
	    }
	    

	});
	jQuery(document).on('click', '.open_modal', function (event) {
	    event.preventDefault();
	 //    var data_id = jQuery(this).data('id');
		// var querydata = {
		// 	action: 'member_data_by_id',
		// 	nonce_code: codexin_script.ajax_nonce,
		// 	member_id:data_id
		// };

		// // jQuery("#member_bio_data .iziModal-content").html('');
		// jQuery.ajax({
		// 	// you can also use $.post here
		// 	url: codexin_script.ajaxurl, // AJAX handler
		// 	data: querydata,
		// 	type: 'POST',
		// 	beforeSend: function(xhr) {
				
		// 	},
		// 	success: function(data) {
		// 		if (data) {		
 		// 				jQuery("#member_bio_data .iziModal-content").html(data);
		// 		}
		// 	}
		// });

	    modal.iziModal('open');


	});

});
