jQuery(document).ready(function($){
    var mediaUploader;
    $('.upload_image_button').click(function(e) {
      var tipo = $( this ).attr('rel');
      e.preventDefault();
        if (mediaUploader) {
        mediaUploader.open();
        return;
      }
      mediaUploader = wp.media.frames.file_frame = wp.media({
        title: 'Choose Image',
        button: {
        text: 'Choose Image'
      }, multiple: false });
      mediaUploader.on('select', function() {
        var attachment = mediaUploader.state().get('selection').first().toJSON();
        $('#' + tipo).val(attachment.url);
      });
      mediaUploader.open();
    });
  });