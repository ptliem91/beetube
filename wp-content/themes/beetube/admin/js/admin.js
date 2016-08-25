window.jtheme = window.jtheme || {};

(function($) {

/* Custom Media Uploader
var _custom_media = true, _orig_send_attachment = wp.media.editor.send.attachment;

$('.jtheme-upload-button').on('click', function(e) {
	e.preventDefault();
	
	var button = $(this),
		text = $(this).siblings('.jtheme-upload-text'),
		preview = $(this).siblings('.jtheme-upload-preview');
		
	_custom_media = true;
	wp.media.editor.send.attachment = function(props, attachment){
		if ( _custom_media ) {
			text.val(attachment.url);
			preview.html('<img src="'+attachment.url+'" />');
		} else {
			return _orig_send_attachment.apply( this, [props, attachment] );
		};
	}
	wp.media.editor.open(button);
	return false;
});

$('.add_media').on('click', function(){
	_custom_media = false;
}); */

jtheme.admin = {
	init: function(){
		var $this = this;
		
		$this.uploadMedia();
		$this.removeMedia();
		$this.toggleAll();
		$this.resetAll();
		$this.colorPicker();
		$this.sectionToggle();
		
		// Sortable List
		if($().sortable) {
			$('.jtheme-panel .sortable-list').sortable({
				cursor: 'move'
			});
		}
	},
	
	/* Custom Media Uploader */
	uploadMedia: function(){
		/* Custom Media Uploader, No Sidebar */
		var file_frame;
		var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
 
		$('.jtheme-panel').on('click', '.jtheme-upload-button', function(e){
			e.preventDefault();
	
			var $el = $(this),
				$post_id = $(this).data('post_id');
				text = $(this).siblings('.jtheme-upload-text'),
				preview = $(this).siblings('.jtheme-upload-preview');
	
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				// Set the post ID to what we want
				if($post_id)
					file_frame.uploader.uploader.param( 'post_id', $post_id );
				// Open frame
				file_frame.open();
				return;
			} else {
				// Set the wp.media post id so the uploader grabs the ID we want when initialised
				if($post_id)
					wp.media.model.settings.post.id = $post_id;
			}
 
			// Create the media frame.
			file_frame = wp.media.file_frame = wp.media({
				title: $el.data( 'choose' ),
				/* Tell the modal to show only images.
				library: {
					type: ['image']
				},*/
				button: {
					// Set the text of the button.
					text: $el.data('update'),
				},
				editing:   true,
				multiple: false
			});
 
			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
				// console.log(attachment);
				if(file_frame.options.multiple) {
					var selected = [];
					var selection = file_frame.state().get('selection');
					selection.map(function(attachment) {
						attachment = attachment.toJSON();
						selected.push(attachment.url);
						// Do something else with attachment object
					});
					
					// console.log(selected.join(' '));
				} else {
					/* We set multiple to false so only get one image from the uploader*/
					attachment = file_frame.state().get('selection').first().toJSON();
	  
					text.val(attachment.url);
					preview.html('<img src="'+attachment.url+'" />');
				}
				
				// Restore the main post ID
				if($post_id)
					wp.media.model.settings.post.id = wp_media_post_id;
			});
 
			// Finally, open the modal
			file_frame.open();
		});
  
		// Restore the main ID when the add media button is pressed
		//$('a.add_media').on('click', function() {
			//wp.media.model.settings.post.id = wp_media_post_id;
		//});
	},
	
	removeMedia: function() {
		$('.jtheme-panel').on('click', ' .jtheme-remove-button', function(e){
			e.preventDefault();
			preview = $(this).siblings('.jtheme-upload-preview');
			text = $(this).siblings('.jtheme-upload-text');
			text.val('');
			preview.empty();
		});
	},
	
	// Toggle all postbox
	toggleAll: function() {
		$(".jtheme-panel .toggel-all").on('click', function(){
			if($(".postbox").hasClass("closed")) {
				$(".postbox").removeClass("closed");
			} else {
				$(".postbox").addClass("closed");
			};
			postboxes.save_state(pagenow);
				
			return false;
		});
	},
	
	// Reset all to defaults
	resetAll: function(){
		$('.jtheme-panel .reset').click(function(){
			if (confirm("Are you sure you want to reset to default options?")) { 
				return true;
			} else { 
				return false; 
			}
		});	
	},
	
	// Color Picker
	colorPicker: function() {
		$('.jtheme-panel .jtheme-color-handle').each(function(){
			current_color = $(this).next('.jtheme-color-input').attr('value');
			$(this).css('backgroundColor', current_color);
			var c = $(this).ColorPicker({
				color: $(this).next('.jtheme-color-input').attr('value'),
				onChange: function (hsb, hex, rgb, el) {
					$(c).css('backgroundColor', '#' + hex);
					$(c).next('.jtheme-color-input').attr('value', '#' + hex);
				}
			});
		});
	},
	
	// Section Toggle
	sectionToggle: function(){
		$('.jtheme-panel').on('click', '.handler .up', function(){
			var currentItem = $(this).parents('li'),
				prevItem = currentItem.prev('li');
				
			prevItem.before(currentItem);
		});
	
		$('.jtheme-panel').on('click', '.handler .down', function(){
			var currentItem = $(this).parents('li'),
				nextItem = currentItem.next('li');
			
			nextItem.after(currentItem);
		});
	
		$('.jtheme-panel').on('click', '.section-handlediv, .section-hndle', function(){
			$(this).parents('.section-box').find('.section-inside').toggle();
		});
	}
};

var beetubeAdmin = function(){
	/* Color Scheme */
	$('#jtheme-color-scheme').change(function(){
			if($(this).val() == 'custom') {
				$('.in-color-scheme').parents('tr').show();
			} else {
				$('.in-color-scheme').parents('tr').hide();
			}
		}).change();
	
	/* Pattern Change */
	$('#jtheme-preset-bgpat').change(function(){
		var pat = $(this).val();
		if(pat != '')
			$('.jtheme-preset-bgpat-preivew').css('background', 'url('+pat+')');
	}).change();

	/* Logo Type */
	$('#jtheme-logo-type').change(function(){
		if($(this).val() == 'text') {
			$('#jtheme-logo').parents('tr').hide();
		} else {
			$('#jtheme-logo').parents('tr').show();
		}
	}).change();
};
	
$(document).ready(function($) {
	jtheme.admin.init();
	beetubeAdmin();
});


})(jQuery);