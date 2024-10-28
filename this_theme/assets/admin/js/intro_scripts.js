jQuery(function($) {
  startUp();
  introFormButtonsGroupCollapse();
  introFormSocailsCollapse();

  $(document).on('widget-added widget-updated', function() {
    startUp();
    introFormButtonsGroupCollapse();
    introFormSocailsCollapse();
  });

  function uploadImage(){
    $('.upload_image_button').off('click').on('click', function(e) {
      e.preventDefault();
      var button = $(this);
      var custom_uploader = wp.media({
          title: 'Insert image',
          library: { type: 'image' },
          button: { text: 'Use this image' },
          multiple: false
      }).on('select', function() {
          var attachment = custom_uploader.state().get('selection').first().toJSON();
          button.prev().val(attachment.url);
          button.prev().trigger('change');
          custom_uploader.close();
      }).open();
      startUp();
    });
  }

  function onAddSocial() {
    $('.add-social').off('click').on('click', function (e) {
      e.preventDefault();
      let index = parseInt($(this).data('socials-count'));
      index++;
      $(this).data('socials-count', index);
      const fieldName = $(this).data('field-name');
      const containerClass = $(this).data('container-class');
      const newSocial = `
        <div class="social-item">
          <input required class="widefat" type="text" name="${fieldName}[${index}][name]" placeholder="Name" />
          <input required class="widefat" type="text" name="${fieldName}[${index}][link]" placeholder="Link" />
          <input required class="widefat" type="text" name="${fieldName}[${index}][svg]" placeholder="Svg" />
          <button class="remove-social button-link button-link-delete">Remove</button>
        </div>
      `;
      $(`.${containerClass}`).prepend(newSocial);
      startUp();
    });
  }

  function onRemoveSocial() {
    $('.remove-social').off('click').on('click', function (e){
      e.preventDefault();
      $(this).closest('.social-item').remove();
    });
  }

  function startUp() {
    uploadImage();
    onAddSocial();
    onRemoveSocial();
  }
  function introFormButtonsGroupCollapse() {
    $('.intro-form-buttons-collapse-toggle').on('click', function(e) {
          e.preventDefault();
          // Toggle the content visibility
          $(this).closest('.intro-form-buttons').find('.intro-form-buttons-collapse-content').slideToggle(); 
          // Toggle the active class
          $(this).toggleClass('active');
          // Change button text between + and -
          $(this).find('span').text($(this).hasClass('active') ? '-' : '+');
      });
  }
  function introFormSocailsCollapse() {
    $('.intro-form-socials-collapse-toggle').on('click', function(e) {
          e.preventDefault();
          // Toggle the content visibility
          $(this).closest('.intro-form-socials').find('.intro-form-socials-container').slideToggle(); 
          // Toggle the active class
          $(this).toggleClass('active');
          // Change button text between + and -
          $(this).find('span').text($(this).hasClass('active') ? '-' : '+');
      });
  }
});
