
var settings = $("#settingsMenu");
var adminmenu = $("#AdminMenu"); 
var form = $("#Form");


adminmenu.hide();

//Open menu
    settings.click(function(e){
       if(adminmenu.is(":visible")) { 
           adminmenu.hide(800);
       } else {
        var mouseX = e.pageX;
        var mouseY = e.pageY;
        adminmenu.slideDown().css("top", mouseY+10).css("left", mouseX-250);
    }
    });
    
    
  //Close form  
    
    
    
    $(".adduser").click(function(){
       // 00000000000000alert("laduje");
        form.load("lib/Ajax/addUserForm.php", function(){
            $(".emptyForm").on("click",
                        function(){
                              form.empty();
                        }).slideDown(250);
                adminmenu.hide(350);   
        });
                    
    });
    
    
