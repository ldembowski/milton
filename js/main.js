/********************************************MAIN FORMS***********************************************************/
var goodsInContent = $("#goodsIn");
var goodsInForm = $("#goodsInForm");
var goodsInExtraFields = $("#extraInfo");

$(function(){
    goodsInExtraFields.hide(); 
    
});

$('#inputOption1').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = parseInt(this.value);
        if(valueSelected === 1) {
           goodsInExtraFields.hide(250); 
           $("#inputFieldExtra1").removeAttr("required");
           $("#inputFieldExtra2").removeAttr("required");
        } else if(valueSelected === 2) {
           goodsInExtraFields.show(250);
           $("#inputFieldExtra1").attr("required", "true");
           $("#inputFieldExtra2").attr("required", "t4rue");
        }
});


 goodsInForm.submit(function(e){
     e.preventDefault(); 
     ShowLoadingIcon();
     var idGood = '';
     var Company = $("#inputOption1").val();
     var idCourier = $("#inputOption2").val();
     
     var Field1 = $("#inputField1").val();
     var Field2 = $("#inputField2").val();
     var Field3 = $("#inputField3").val();
     var Field4 = $("#inputField4").val();
     
     var ExField1 = $("#inputFieldExtra1").val();
     var ExField2 = $("#inputFieldExtra2").val();
     
     var dateIn = '';
     var status = 'open';
     
     $.post("lib/Ajax/goodsIn_ctrl.php?add=1", {'idGood':idGood,
                                                'Company': Company,
                                                'Field1':Field1,
                                                'idCourier':idCourier,
                                                'Field2':Field2,
                                                'Field3':Field3, 
                                                'Field4':Field4,
                                                'ExField1':ExField1,
                                                'ExField2':ExField2,
                                                'dateIn': dateIn, 
                                                'status': status
                                                }, 
                                function(data){
                                   var check = data.killWhiteSpace();
                                   if(check == "true") {
                                       //TODO: prepare form...
                                       UpdateFormAndData();
                                   } else {
                                       goodsInContent.prepend(data);
                                   }
                                   HideLoadingIcon();
                                }
                            );

    });  //submit form

    function UpdateFormAndData() {
        $("#inputOption1").val('1');
        goodsInExtraFields.hide(); 
        $("#inputOption2").val('1');
        
        $("#inputField1").val('');
        $("#inputField2").val('');
        $("#inputField3").val('');
        $("#inputField4").val('');
     
        $("#inputFieldExtra1").val('');
        $("#inputFieldExtra2").val('');
        
        $("#todayIn").load("app.php #todayIn");
    }


/********************************************[end] MAIN FORMS [end]***********************************************************/


/********************************************ADMIN SECTION***********************************************************/
var settings = $("#settingsMenu");
var adminmenu = $("#AdminMenu"); 
var form = $("#Form");


adminmenu.hide();


//loading icon ON
function ShowLoadingIcon() {
       $("#loading").fadeIn(200);
   }
//hide loading icon   
function HideLoadingIcon() {
       $("#loading").fadeOut(400);
   }
/****************************************************************************************************************/
//Open top menu
   settings.click(function(e){
       if(adminmenu.is(":visible")) { 
           adminmenu.slideUp();
       } else {
        var mouseX = e.pageX;
        var mouseY = e.pageY;
        adminmenu.slideDown().css("top", mouseY+10).css("left", mouseX-250);
    }
    });
    /****************************************************************************************************************/
//load users table + logic
   $(".editusers").click(function(){
        ShowLoadingIcon();
        settings.click();  
        form.load("lib/Ajax/usersTable.php",
                function(){
                    
                    //show confirm buttn
                    $(".actionIcon").on("click",function(){
                        $(this).parent().children(".confirmDelete").css("visibility", "visible");
                    });
                    //delete user form DB
                    $(".confirmDelete").on("click", function() {
                        var id = $(this).val();
                        var listItem = $(this).parent().parent();
                        ShowLoadingIcon();
                       $.post("lib/Ajax/user_ctrl.php?del=8", {'idUser':id}, 
                                function(data){
                                    var check = data.killWhiteSpace();
                                        if(data && check == "true"){
                                                listItem.slideUp(350, function(){
                                                   $(".errorsMsg").empty().append("<p class=\"text-success\">User deleted</p>");
                                                    HideLoadingIcon(); 
                                                });
                                        } else {
                                            $(".errorsMsg").empty().append(data); 
                                            HideLoadingIcon(); 
                                        }           
                                });
                      
                    });
                    
                    //change user password
                      $(".changePassIcon").on("click", function(){                     
                          $("#ChangePasswordForm").remove();                                
                          var id = $(this).attr("alt");
                          var parent = $(this).parent();
                          $.post("lib/Ajax/user_change_password_form.php",{'idUser':id},
                          function(data){
                              if(data){
                                  parent.prepend(data);            
                                 //submit data  for change password
                                  $("#changePass").on("click", function(e){
                                      e.preventDefault();
                              
                                      var pass1 = $("#inputPassword").val();
                                      var pass2 = $("#inputPasswordConfirm").val();                                     
                                      
                                      $(".changePassErrorsMsg").empty();
                                      if(pass1.length < 5) {
                                            $(".changePassErrorsMsg").append("<p class=\"text-danger\">password - min 5 characters</p>");
                                        }
                                       else if(pass1 != pass2) {
                                            $(".changePassErrorsMsg").append("<p class=\"text-danger\">passwords are not maching...</p>");
                                        }
                                       else {
                                           
                                                if(ChangeUserPassword(id, pass1, pass2)) {       
                                                   
                                                                            $(function(){
                                                                                $(".errorsMsg").empty().append("<p class=\"text-success\">Password changed...</p>");
                                                                            $("#ChangePasswordForm").slideUp(500, function(){
                                                                            $("#ChangePasswordForm").remove();
                                                                            }); // destroy form window
                                                                            });
                                                } else {
                       
                                                    $(".errorsMsg").empty().append("<p class=\"text-success\">bla bla bla..</p>");
                                                }
                                        
                                 
                                       }
                                  })
                                  
                                  //cloase window
                                  $(".emptyForm1").on("click", function(){
                                      $("#ChangePasswordForm").slideUp(500, function(){
                                          $("#ChangePasswordForm").remove();
                                      }); 
                                  });
                              }
                          });
                          
                      });
                    
                    //cloase form btn
                    $(".emptyForm").on("click",
                        function(){
                          CloseForm();
                        });
                    HideLoadingIcon(); 
                });
    });
/****************************************************************************************************************/
    
//load Add New User Form 
   $(".adduser").click(function(){
       ShowLoadingIcon();
        form.load("lib/Ajax/addUserForm.php", function(){
        
        //submiting form    
        $("#addNewUserBtn").on("click", function(e){
            e.preventDefault();

                    var name = $("#inputUserName").val();
                    var pass1 = $("#inputPassword").val();
                    var pass2 = $("#inputPasswordConfirm").val();
                   
                   $("#errors").empty();
                   
                   if(name.length < 5) {
                       $("#errors").append("<p class=\"text-danger\">User name - min 5 characters</p>");
                   }
                   else if(pass1.length < 5) {
                        $("#errors").append("<p class=\"text-danger\">password - min 5 characters</p>");
                    }
                   else if(pass1 != pass2) {
                        $("#errors").append("<p class=\"text-danger\">passwords not maching...</p>");
                    }
                   else {
                       ShowLoadingIcon();
                       $.post("lib/Ajax/user_ctrl.php?add=1", {'name':name, 'pass1':pass1, 'pass2':pass2}, 
                                function(data){
                                    var check = data.killWhiteSpace();
                                        if(data && check == "true"){
                                          $("#errors").empty().append("<p class=\"text-success\">User added successfully</p>");  
                                          $("#AddUserForm").find(':input').each(function() {
                                            $(this).val('');
                                             });
                                          
                                          HideLoadingIcon();  
                                        } else {
                                            $("#errors").empty().append(data); 
                                            HideLoadingIcon(); 
                                        }           
                                });
                   } 
                    
        });    
                
         //close form   
            $(".emptyForm").on("click",
                        function(){
                              form.empty();
                        }).slideDown(250);
                        
                adminmenu.hide(350); //hide menu
                HideLoadingIcon();
        });
                    
    }); //end of loading add new user form
    /****************************************************************************************************************/
    
    //load couriers view
        $(".courier").click(function(){           
                ShowLoadingIcon();
                LoadCourierView();           
         }); //click end
         
         //load view
         function LoadCourierView() {
             form.load("lib/Ajax/couriersView.php", function(){
                       
                        //adding new position
                        $("#CourierForm").on("submit", function(e){
                            e.preventDefault();
                            //actionMake
                            var action = $("#actionMake").val();
                            var Couriername = $("#inputCourierName").val();
                            var Courierinfo = $("#inputExtraInfo").val();
                            var idCourier = $("#idCourier").val();
                            ShowLoadingIcon();
                            $.post("lib/Ajax/courier_ctrl.php?add=1", {'action':action, 'idCourier': idCourier, 'Couriername':Couriername, 'Courierinfo':Courierinfo}, 
                                function(data){
                                   ShowBackResult(data); 
                                }
                            );
                            
                            
                        });
                       
                       //close form   
                        $(".emptyForm").on("click",
                        function(){
                              form.empty();
                        }).slideDown(250);
                       
            /******************manage table*****************************************/     
                 //update table item
                 $(".editCourier").on("click", function(){
                     //courier id form picture
                     var id = $(this).children("img").attr("alt");
                     //courier name directly form table
                     var cn =  $(this).parent().parent().parent().children(".cn").text();  
                     //courier name form table
                     var ci =  $(this).parent().parent().parent().children(".ci").text();  
                     $("#actionMake").val('update');
                     $("#idCourier").val(id);
                     $("#inputCourierName").val(cn);
                     $("#inputExtraInfo").val(ci);
                 });
                 
                 //delete table item
                 $(".deleteCourier").on("click", function(){
                        var id = $(this).children("img").attr("alt");
                        $.post("lib/Ajax/courier_ctrl.php?del=1", {'idCourier': id}, 
                                function(data){
                                   ShowBackResult(data); 
                                }
                            );
                 });
                 
                        adminmenu.hide(350); //hide menu
                        HideLoadingIcon();
                    });
         }
         
         function ShowBackResult(act) {
             var check = act.killWhiteSpace();
                if(check == "true"){
                           $("#inputCourierName").val('');
                           $("#inputExtraInfo").val('');
                           $("#idCourier").val('');
                           $("#actionMake").val('add');
                   $(".Couriererrors").empty().append("<p class=\"text-success\">Couriers list saved...</p>");   
                   $("#CouriersList").load("lib/Ajax/couriersView.php #CouriersList", function(){
                                                                /******************manage table*****************************************/     
                                                               //edit table item
                                                              $(".editCourier").on("click", function(){
                                                              //courier id form picture
                                                              var id = $(this).children("img").attr("alt");
                                                              //courier name directly form table
                                                              var cn =  $(this).parent().parent().parent().children(".cn").text();  
                                                              //courier name form table
                                                              var ci =  $(this).parent().parent().parent().children(".ci").text();  
                                                              $("#actionMake").val('update');
                                                              $("#idCourier").val(id);
                                                              $("#inputCourierName").val(cn);
                                                              $("#inputExtraInfo").val(ci);

                                                          });
                                                          
                                                          //delete table item
                                                            $(".deleteCourier").on("click", function(){
                                                                   var id = $(this).children("img").attr("alt");
                                                                   $.post("lib/Ajax/courier_ctrl.php?del=1", {'idCourier': id}, 
                                                                           function(data){
                                                                              ShowBackResult(data); 
                                                                           }
                                                                       );
                                                            });
                   });
                } else {
                    $(".Couriererrors").empty().append(act);  
                }
                    
             HideLoadingIcon();
         }
         
    /*******************************Courier form***********************************************************************/
    
    
            
    
    
    
    
//empty form content 
   function CloseForm(){
        form.slideDown(250).empty();
    }
    

    function ChangeUserPassword(id, pass1, pass2){
        
          $.post("lib/Ajax/user_ctrl.php?changep=2", {'idUser':id, 'pass1': pass1, 'pass2': pass2 },   //sed post array
                                                        function(res){
                                                            var check = res.killWhiteSpace();
                                                                if(check == "true"){ 
                                                                    return true;
                                                                } else {
                                                                    alert("Saving new password error");
                                                                }           
                                                        });
      
      return true;
    }


  /***********************************HELPERS****************************************************/  
    
 
    
    
    
                    String.prototype.killWhiteSpace = function() {
                        return this.replace(/\s/g, '');
                    };

                    String.prototype.reduceWhiteSpace = function() {
                        return this.replace(/\s+/g, ' ');
                    }; 
                    
                    function is_int(value){ 
                    if((parseFloat(value) == parseInt(value)) && !isNaN(value)){
                        return true;
                    } else { 
                        return false;
                    } 
                    }
