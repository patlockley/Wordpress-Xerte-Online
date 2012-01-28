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

