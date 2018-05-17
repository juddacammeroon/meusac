/*
Theme Name:         MEUSAC
Theme URI:          http://themefortress.com/reverie/
Description:        Reverie is a versatile HTML5 responsive WordPress framework based on ZURB's Foundation.
Version:            5.5.3
Author:             Paul
*/

/* -------------------------------------------------- 
	This script will not be loaded by default.
-------------------------------------------------- */



jQuery(document).ready(function(){
	if(jQuery('.unbold-first').length) {
		jQuery(".unbold-first").html(function(){
		  var text= jQuery(this).text().trim().split(" ");
		  var first = text.shift();
		  return (text.length > 0 ? "<span style='font-weight:normal !important'>"+ first + "</span> " : first) + text.join(" ");
		});
	}

	if(jQuery('#team_section').length) {
		jQuery('#team_section a').on('click',function(){
			jQuery('#team_section li').removeClass('active');
			jQuery(this).parent('li').addClass('active');

			var filter = jQuery(this).parent('li').attr('id');
			jQuery('.team-block').hide();
			jQuery('.team-block.'+filter).show();

			if(jQuery('#drop').length && jQuery(window).width() <= 768) {
				var title = jQuery(this).html();
				jQuery('nav.responsive .toggle').html(title +'<i class="fa fa-caret-down"></i>');
				jQuery('nav.responsive .toggle').trigger('click');
			}

		})
	}

	jQuery("nav.responsive .toggle").on('click',function() {
		if(document.getElementById('drop').checked && jQuery(window).width() <= 768) {
		    jQuery('nav.responsive ul').css( "display", "none");
		    jQuery('nav.responsive .toggle i').attr('class','fa fa-caret-down');
		} else {
		    jQuery('nav.responsive ul').css( "display", "block");
		    jQuery('nav.responsive .toggle i').attr('class','fa fa-caret-up');
		}
	});

	function checkIfResize(){
		if(jQuery('#drop').length && jQuery(window).width() <= 768) {
			// if(jQuery('nav.responsive ul.first-ul').css( "display") == 'none') {
			jQuery('nav.responsive ul').css( "display", "none");
			jQuery('nav.responsive .toggle i').attr('class','fa fa-caret-down');
			// } else {
			// 	jQuery('nav.responsive ul:not(.first-ul)').css( "display", "block");
			// 	jQuery('nav.responsive .toggle i').attr('class','fa fa-caret-up');
			// }
		}else if(jQuery(window).width() > 768){
			jQuery('nav.responsive ul').css( "display", "inline-flex");
		}else if(jQuery(window).width() <= 768){
			jQuery('nav.responsive ul').css( "display", "block");
		}
	}

	jQuery( window ).resize(function() {
	  	checkIfResize();
	});

	checkIfResize();




	if(jQuery('#events-and-activity-section').length) {
		jQuery(".vc_tta-title-text").html(function(){
		  var text= jQuery(this).text().trim().split(" ");
		  var first = text.shift();
		  return (text.length > 0 ? "<span style='font-weight:normal !important'>"+ first + "</span>" : first) + text.join("");
		});
	}

	// jQuery('.latest-section').addClass('hide');
	if(jQuery('.latest-section').length){
		var activeTab = jQuery('.events-tabs .vc_tta-tab.vc_active > a').attr('href');
		if(window.location.hash) {
		  activeTab = window.location.hash;
		}

		activeTab = activeTab.replace("#", "");
		jQuery('.latest-section.'+activeTab).removeClass('hide');

		jQuery('.events-tabs .vc_tta-tab a').on('click',function(){
			jQuery('.latest-section').addClass('hide');
			var activeTab = jQuery(this).attr('href');
			activeTab = activeTab.replace("#", "");
			jQuery('.latest-section.'+activeTab).removeClass('hide');		
		});

		jQuery('.events-tabs .vc_tta-panel-title > a').on('click',function(){
			jQuery('.latest-section').addClass('hide');
			var activeTab = jQuery(this).attr('href');
			activeTab = activeTab.replace("#", "");
			jQuery('.latest-section.'+activeTab).removeClass('hide');		
		})
	}

	if (jQuery('#global-prev-button').length > 0)
	{
		if (document.referrer == "")
		{

		}
		else
		{
			jQuery('#global-prev-button').css('display', 'inline-block');
		}
	}
});


