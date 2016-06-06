$(document).ready(function() {
			
          jQuery("span[tooltip]").mouseenter(function (e) {            
            var posMouse = this.offsetLeft; 
            var textTooltip = jQuery(this).attr("tooltip"); 
			
            if (textTooltip.length > 0) {
                 jQuery(this).append('<div class="tooltip"><div class="top_tp"></div><div class="content_tp">' + textTooltip + '</div><div class="bottom_tp"></div></div>');
			
               
				jQuery("span > div.tooltip").css("top","50px");
				jQuery("span > div.tooltip").css("left", "" + posMouse -20+ "px");
				
                jQuery("span > div.tooltip").fadeIn(300);
            }
        });
      
});