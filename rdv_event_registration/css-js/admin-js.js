jQuery( document ).ready(function() {
		
	var sourceImageWidth = jQuery(".source_image").width();
	jQuery( "input:hidden[name=length]" ).val(sourceImageWidth);

	var sourceImageHeight = jQuery(".source_image").height();
	jQuery( "input:hidden[name=height]" ).val(sourceImageHeight);				
		
	var firstNameY = (jQuery( "input:hidden[name=firstNameY]" ).val()/100) * sourceImageHeight;								
	jQuery( "#firstName" ).css({ "top": firstNameY+"px" });
	
	var lastNameY = (jQuery( "input:hidden[name=lastNameY]" ).val()/100) * sourceImageHeight;								
	jQuery( "#lastName" ).css({ "top": lastNameY+"px" });
	
	var maleY = (jQuery( "input:hidden[name=maleY]" ).val()/100) * sourceImageHeight;								
	jQuery( "#male" ).css({ "top": maleY+"px" });
	
	var femaleY = (jQuery( "input:hidden[name=femaleY]" ).val()/100) * sourceImageHeight;								
	jQuery( "#female" ).css({ "top": femaleY+"px" });
	
	var dateY = (jQuery( "input:hidden[name=dateY]" ).val()/100) * sourceImageHeight;								
	jQuery( "#date" ).css({ "top": dateY+"px" });
	
	var emailY = (jQuery( "input:hidden[name=emailY]" ).val()/100) * sourceImageHeight;								
	jQuery( "#email" ).css({ "top": emailY+"px" });
	
	var phoneY = (jQuery( "input:hidden[name=phoneY]" ).val()/100) * sourceImageHeight;								
	jQuery( "#phone" ).css({ "top": phoneY+"px" });
	
	var addressY = (jQuery( "input:hidden[name=addressY]" ).val()/100) * sourceImageHeight;								
	jQuery( "#address" ).css({ "top": addressY+"px" });
	
	var cityY = (jQuery( "input:hidden[name=cityY]" ).val()/100) * sourceImageHeight;								
	jQuery( "#city" ).css({ "top": cityY+"px" });
	
	var stateY = (jQuery( "input:hidden[name=stateY]" ).val()/100) * sourceImageHeight;								
	jQuery( "#state" ).css({ "top": stateY+"px" });
	
	var zipCodeY = (jQuery( "input:hidden[name=zipCodeY]" ).val()/100) * sourceImageHeight;								
	jQuery( "#zipCode" ).css({ "top": zipCodeY+"px" });							

	jQuery( ".set_box" ).draggable({ 
		containment: "parent",
		cursor: "move",
		drag: function(event, iu){

			which_set = jQuery(this).attr('id');
			
		},		
		stop: function(event, ui){
			
			var offset = jQuery(this).position();
            var xPos = offset.left;
            var yPos = offset.top;
   			
			jQuery.post(
				home_url + '/wp-admin/admin-ajax.php', {	
					
					action: 'getXY',
					
						data: { x: xPos,  y: yPos, length: sourceImageWidth, height: sourceImageHeight, item: which_set }
				
					
				}, function(data){	
					
					jQuery("#" + which_set + "Pos").html(data);
				
			});					
			
		}	

	}); 		
		
});