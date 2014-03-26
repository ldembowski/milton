jQuery(document).ready(function($) {
   
var closeForm = $("#CloseOrder");    
    
    
    
    closeForm.on("submit", function(e){
                e.preventDefault();
                var idGood = $("#idGood").val();
                
                $.post("lib/Ajax/orders_ctrl.php?find=1", {'idGood':idGood}, function(data){
                    $("#Searchresult").empty().append(data);
                    
                    $(".closeBtn").on("submit", function(e){
                        e.preventDefault();
                            //alert("Id: "+$(this).children("button").val());
                          $.post("lib/Ajax/orders_ctrl.php?update=1", {'idGood':idGood}, function(data){

                                 $("#allIn").load("close_order.php #allIn", function(){
                                   //  $("#Searchresult").empty().append(data);
                                 }); 
                             
                          });
                    });
                  
                });
                
                
    });
    
});

String.prototype.killWhiteSpace = function() {
                        return this.replace(/\s/g, '');
                    };