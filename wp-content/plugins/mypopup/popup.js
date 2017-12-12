const $ = jQuery;

$(document).ready(function(){


   
         
             if($('.simple-popup').length > 1){
         
             var $popups = $("#popups");
         
         
             $all_popups = $(".simple-popup");
             $current_popups =$all_popups.first();
         
             $all_popups.hide();
             $current_popups.show();
         
             setInterval(function(){ 
         
                         $current_popups.fadeOut(500, function(){
                         
                             $current_popups= $current_popups.next();
         
                             if ( $current_popups.length < 1 ){
                                 $current_popups = $all_popups.first();
                             }
                             $current_popups.fadeIn(500);
                         
                         });
                     }, 2000);
         
             }
         
        






})