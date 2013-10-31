/*------------------------------------------------------------------------
# BuzzComi - June 30, 2013
# ------------------------------------------------------------------------
# Designed & code by MegaDrupal
# Websites:  http://www.megadrupal.com -  Email: info@megadrupal.com
--------------------------------------------------------------------------*/

jQuery(function(){
	var minWidth = 481;
	/* Auto resize function
	---------------------------------------------------------- */
	function autofit() {
		
		sectionHeight = $(window).height() - $('header').outerHeight() - $('footer').outerHeight() - $('.md-block-bottom').outerHeight() - 1; // min height = 500
		sliderHeight = $('.cycle-slideshow').outerHeight();
		if (sectionHeight < 500) sectionHeight = 500
		if (sectionHeight > 1050)	sectionHeight = 1050
		$('.md-mainimg, .cycle-slideshow').height(sectionHeight);
		//$('.cycle-slideshow').css({'margin-top': -100});

		// responsive
		if ($(window).width() < minWidth) {
			marginLeft = ($('#countdown_dashboard').width() - 177)/2;
			$('.weeks_dash').css({'margin-left':marginLeft })
		} else {
			$('.weeks_dash').css({'margin-left': 0 })
		}
	}
	
	$(window).resize(function() {
		autofit();
	});

  $(document).ready(function() {
	autofit();
	/* Start Countdown
	---------------------------------------------------------- */
    $('#countdown_dashboard').countDown({
      targetDate: {
        'day': 		29,
        'month': 	12,
        'year': 	2013,
        'hour': 	22,
        'min': 		0,
        'sec': 		0
      }
    });
	
	/* Call Cycle slider
	---------------------------------------------------------- */
	$('#cycle-slideshow').cycle();
	
	
	/* Close button 
	---------------------------------------------------------- */
    $(".btn-close").click(function() {
      var $active = $(this).parent().parent().parent();
      $active.css('opacity', 1).stop(true, true).slideUp(600).animate({ opacity: 0 }, {queue: false, duration: 600});
      $("#md-btn-group a.md-button.active").removeClass("active");
      $("#md-content-center").show().animate({top: '-=8%', opacity: 1}, {duration: 600});
			autofit()
			return false;
    });
		
	/* Button group
	---------------------------------------------------------- */
    $("#md-btn-group a.md-button").click(function() {
      if(!$(this).hasClass("active")) {
        var $active = $("#md-btn-group a.active"),
          $self = $(this),
          id = $self.attr("href");
        if($active.size() > 0) {
          var activeid = $active.attr("href");
          $(".md-block-bottom .md-dialog:visible").css('opacity', 1).stop(true, true).slideUp(600).animate({ opacity: 0 }, {queue: false, duration: 600});
          $active.removeClass("active");
          $(id).css('opacity', 0).stop(true, true).slideDown(600).animate({opacity: 1}, { queue: false, duration: 600 });
          $self.addClass("active");
        } else {
          $("#md-content-center").animate({top: '+=8%', opacity: 0}, {duration: 600, complete: function() {$("#md-content-center").hide();}});
          $(id).css('opacity', 0).slideDown().animate({opacity: 1}, { queue: false, duration: 600});
          $self.addClass("active");
        }
      }
      return false;
    });
		
	/* Contact form: Ajax & Validate
	---------------------------------------------------------- */	
    if($("#contact-form").length > 0){
      // Validate the contact form
      $('#contact-form').validate({
        // Add requirements to each of the fields
        rules: {
          name: {
            required: true,
            minlength: 2
          },
          email: {
            required: true,
            email: true
          },
          message: {
            required: true,
            minlength: 10
          }
        },

        // Specify what error messages to display
        // when the user does something horrid
        messages: {
          name: {
            required: "Please enter your name.",
            minlength: $.format("At least {0} characters required.")
          },
          email: {
            required: "Please enter your email.",
            email: "Please enter a valid email."
          },
          message: {
            required: "Please enter a message.",
            minlength: $.format("At least {0} characters required.")
          }
        },

        // Use Ajax to send everything to processForm.php
        submitHandler: function(form) {
          $("#submit-contact").html("Sending...");
          $(form).ajaxSubmit({
            success: function(responseText, statusText, xhr, $form) {
              $("#contact-content").slideUp(600, function() {
				$("#contact-content").html(responseText).slideDown(600);
			  });
            }
          });
          return false;
        }
      });
    }
	
	/* Notify form: Ajax & Validate
	---------------------------------------------------------- */
	
    if($("#mc-embedded-subscribe-form").length > 0){
      $('#mc-embedded-subscribe-form').validate({
        // Add requirements to each of the fields
        rules: {
          email: {
            required: true,
            email: true
          }
        },
        messages: {
          email: {
            required: "Please enter your email.",
            email: "Please enter a valid email."
          }
        }
      });
    }

    if($("#md-subscribe-form").length > 0){
      // Validate the contact form
      $('#md-subscribe-form').validate({
        // Add requirements to each of the fields
        rules: {
          email: {
            required: true,
            email: true
          }
        },

        // Specify what error messages to display
        // when the user does something horrid
        messages: {
          email: {
            required: "Please enter your email.",
            email: "Please enter a valid email."
          }
        },

        // Use Ajax to send everything to processForm.php
        submitHandler: function(form) {
          $("#md-subscribe").val("Sending...");
          $(form).ajaxSubmit({
            success: function(responseText, statusText, xhr, $form) {
              $("#notify-content").slideUp(600, function() {
                $("#notify-content").html(responseText).slideDown(600);
              });
            }
          });
          return false;
        }
      });
    }
  });
});