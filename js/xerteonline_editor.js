function xerte_save(file_data,file_data_length,update,wpnonce,template_id){
	
	jQuery(document).ready(function($) {

		var data = {
			action: 'xerte_save',
			file_data: file_data,
			file_data_length: file_data_length,
			file_update: update,
			wpnonce:wpnonce,
			template_id:template_id
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			if(response==""){
				window.open("../?p=" + template_id + "&preview=true")
			}else{
				alert(response);
			}
		});
	});
	

}

// <![CDATA[  
jQuery.noConflict();
jQuery(document).ready(function(){
	jQuery('#publish').click(function(){
		var publishConfirmPublish = confirm('Have you "Play"ed or "Publish"ed your Xerte Content ?\n\n Press \'OK\' to publish. Press \'cancel\' to go back and continue editing.');
		if(publishConfirmPublish){
			return true;
		}
		else{
			return false;
		}
	});
	jQuery('#save-post').click(function(){
		var savepostConfirmPublish = confirm('Have you "Play"ed or "Publish"ed your Xerte Content ?\n\n Press \'OK\' to publish. Press \'cancel\' to go back and continue editing.');
		if(savepostConfirmPublish){
			return true;
		}
		else{
			return false;
		}
	});
	jQuery('#update').click(function(){
		var updateConfirmPublish = confirm('Have you "Play"ed or "Publish"ed your Xerte Content ?\n\n Press \'OK\' to publish. Press \'cancel\' to go back and continue editing.');
		if(updateConfirmPublish){
			return true;
		}
		else{
			return false;
		}
	});
	jQuery('#post-preview').click(function(){
		var postConfirmPublish = confirm('Have you "Play"ed or "Publish"ed your Xerte Content ?\n\n Press \'OK\' to publish. Press \'cancel\' to go back and continue editing.');
		if(postConfirmPublish){
			return true;
		}
		else{
			return false;
		}
	});
});
// ]]>

