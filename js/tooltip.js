$(document).ready(function() {
			
          $(".holiday span").mouseenter(function (e) {            
            var posMouse = this.offsetLeft; 
            var textTooltip = $(this).attr("tooltip"); 
			
            if (textTooltip.length > 0) {
                 $(this).append('<div class="tooltip"><div class="top_tp"></div><div class="content_tp">' + textTooltip + '</div><div class="bottom_tp"></div></div>');
			
               
				$("span > div.tooltip").css("top","50px");
				$("span > div.tooltip").css("left", "" + posMouse -20+ "px");
				
                $("span > div.tooltip").fadeIn(300);
            }
        });
      
});