(function ($){

  $(document).ready( function(){

    // Store titles
    var videoTitles =  $(".related-youtube-videos-block .views-field-title .field-content");  
    
    // If one or more videos exist on the page, create select to choose which one to display
    if( videoTitles.length > 1 ){

      // If javascript is enabled, set CSS for using select to navigate through videos
      $(".related-youtube-videos-block .views-field-field-youtube-video").css({display: 'none'});
      if (!$('body').hasClass('front')) {
        $(".related-youtube-videos-block").css({height: '405px', display: "block"});
      }
      // Object to store video elements using key of title
      var videos = {};
      
      // Create select object
      var videoSelect = document.createElement('select');
      videoSelect.id = 'youtube-video-selector';
      
      // Create label for select
      var videoLabel = document.createElement('label');
      videoLabel.id = 'youtube-video-selector-label';
      videoLabel.setAttribute("for", "youtube-video-selector")
      videoLabel.appendChild(document.createTextNode('Select Video'));
          
      // Fill the videos object & build the select options
      $(videoTitles).each( function(index, element){
        var title = $(element).text();
        videos[title] = $(element).parent().prev();
        $(videoSelect).append("<option value='" + title + "' >" + title + "</option>");
      });
  
      // Add select & label to page
      $(".related-youtube-videos-block").append(videoSelect);
      $(".related-youtube-videos-block").append(videoLabel);
  
      // Onn function to select correct video on select change
      $(videoSelect).change(function(){
        $(".views-field-field-youtube-video").css({display: 'none'});
        $(videos[$(videoSelect).val()]).fadeIn();
      });
  
      // Trigger initial video to be displayed on page load
      $(videoSelect).trigger('change');
      
    }

  });

}(jQuery));