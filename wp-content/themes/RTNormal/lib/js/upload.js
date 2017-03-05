jQuery(document).ready(function($){
    $('.rt-upload').live( 'click', function(e) {
        e.preventDefault();
        var custom_uploader;
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        var parent = $(this).parent().attr('id');
        console.log(parent);
        var val = $(this).parent().find('.rt-value-upload');
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#'+parent+' .rt-value-upload').val(attachment.url);
        });
        //Open the uploader dialog
        custom_uploader.open();
    }); // end upload banner

});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#upload_image_button1').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#upload_image1').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
 
});