$( document ).ready( function ()
{
  $( '.select2' ).select2();
  $( "#datepicker" ).datepicker( {
    format: "yyyy",
    viewMode: "years",
          minViewMode: "years",
    autoclose: true
        });   
  
  $( ".deletedriver" ).click( function ()
  {
    var driverid = $( this ).attr( 'id' );
    swal( {
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this driver details!",
      icon: "warning",
      buttons: true,
          dangerMode: true,
    } )
      .then( ( willDelete ) =>
      {
        if ( willDelete )
        {
          $.ajax(
                  {
              type: "POST",
              url: carma.config.deletedriver,
              data: { "driverid": driverid },
              success: function ( result )
                    {
                if ( result )
                {
                  window.location.reload( true );
                  swal( " Driver has been deleted!", {
                                  icon: "success",
                  } );
                }
              }
            }
                );
        } else
        {
          swal( "Your driver is safe!" );
        }
          });
  } );
  $( ".deletecar" ).click( function ()
  {
    var carid = $( this ).attr( 'id' );
    swal( {
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this car details!",
      icon: "warning",
      buttons: true,
          dangerMode: true,
    } )
      .then( ( willDelete ) =>
      {
        if ( willDelete )
        {
          $.ajax(
                  {
              type: "POST",
              url: carma.config.deletecar,
              data: { "carid": carid },
              success: function ( result )
              {
                if ( result )
                            {
                              window.location.reload(true);
                               
                  swal( " Car details has been deleted!", {
                                  icon: "success",
                  } );
                }
              }
            }
                );
        } else
        {
          swal( "Your car is safe!" );
            }
      } );
  } );
  $( "#btnadddamageattribue" ).click( function ()
  {
    var damage = $( '#damageattribute' ).val();
    var damagetype = $( '#drpdamagetype' ).find( "option:selected" ).val();
    if ( damage == "" )
    {
      swal( "Please Enter Damage Attribute!", {
          icon: "error",
      } );
      }
    else
    {
      $.ajax(
          {
          type: "POST",
          url: carma.config.addattribute,
          data: { "damage": damage, "damagetype": damagetype },
          success: function ( result )
            {
            if ( result )
            {
              swal( " New Attribute has been Added!", {
                        icon: "success",
              } );
                  }
            else
            {
              swal( " Something went wrong!", {
                      icon: "error",
              } );
            }
          }
        }
      );
      }
  } );
  var emailid;
  $( "#idsendmail" ).click( function ()
  {
      emailid=$("#txtemail").val();
    if ( emailid == "" )
    {
      swal( "Please Enter Mail ID!", {
          icon: "error",
      } );
      }
    else
    {
      $.ajax(
          {
          type: "POST",
          url: carma.config.sendmail,
          data: { "emailid": emailid },
          success: function ( result )
            {
            if ( result )
            {
              swal( " Check Your Mail For OTP!", {
                        icon: "success",
              } );
              $( "#verification" ).attr( "hidden", false );
                  }
            else
            {
              swal( " Something went wrong!", {
                      icon: "error",
              } );
            }
          }
        }
      );
      }
  } );
  $( "#idverifyotp" ).click( function ()
  {
    var otp = $( "#verificationcode" ).val();
    if ( otp == "" )
    {
      swal( "Please Enter OTP!", {
          icon: "error",
      } );
      }
    else
    {
      $.ajax(
          {
          type: "POST",
          url: carma.config.verify,
          data: { "otp": otp },
          success: function ( result )
            {
            if ( result )
            {
              swal( " OTP IS VERIFIED !", {
                        icon: "success",
              } );
              $( "#resetpass" ).attr( "hidden", false );
              $( "#btnupdatepassword" ).attr( "disabled", false );
                  }
            else
            {
              swal( " Invalid OTP!", {
                      icon: "error",
              } );
            }
          }
        }
      );
    }
    } );
  $( "#updatemail" ).click( function ()
  { 
    var id = $( "#txtid" ).val();
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var email = $( "#email" ).val();
    if(regex.test(email)){
      $.ajax(
       {
          type: "POST",
          url: carma.config.update_email,
          data: { "id": id, "email": email },
              success:function(result){ 
              
                if ( result == 1 )
                  {
                      
                  swal( " Your Mail ID IS UPDATED!", {
                    icon: "success",
                  } );
                }
                  else
                  {
                    
                  swal( " SOMETHING WENT WRONG!", {
                    icon: "error",
                        });
                    
                }
              }
        }
      );
    }
    else
    {
      swal( " Please enter valid  email!", {
        icon: "error",
                        });
    }
    
  } );
  // Delete car manager details.
  $( ".deletecarmngr" ).click( function ()
  {
    var carmanagrid = $( this ).attr( 'id' );
    // alert(carmanagrid);
    swal( {
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this car manager details!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    } )
      .then( ( willDelete ) =>
      {
        if ( willDelete )
        {
          $.ajax( {
            type: "POST",
            url: carma.config.deletecarmngr,
            data: {
              "user_id": carmanagrid
            },
            success: function ( result )
            {
              if ( result )
              {
                window.location.reload( true );
                swal( " Car manager details has been deleted!", {
                  icon: "success",
                } );
              }
            }
          } );
        } else
        {
          swal( "Your car manager is safe!" );
        }
      } );
  } );
    $("#btnupdatepassword").click(function(){
      var pass = $( "#resetpassword" ).val();
      var repass = $( "#reresetpassword" ).val();
      if ( pass.length < 8 )
      {
        swal( " Minimum 8 Size Is Required For Password!", {
          icon: "error",
        } );
      }
      else if ( pass == repass )
      {
        $.ajax(
          {
            type: "POST",
            url: carma.config.updatepassword,
            data: { "emailid": emailid, "pass": repass },
            success: function ( result )
            {
              if ( result )
              {
                swal( " Password is updated!", {
                  icon: "success",
                } );
                  }
              else
              {
                swal( " SomeThing Went Wrong!", {
                      icon: "error",
                } );
              }
            }
          }
      );
      }
      else{
        swal(" Password Does Not Match!", {
          icon: "error",
        } );
      }
    } );
  $( '#checkexpiry' ).click( function ()
  {
    if ( $( this ).is( ":checked" ) )
    {
     
      $( '#expirydate' ).attr("hidden",false);
    }
    else if ( $( this ).is( ":not(:checked)" ) )
    {
      $( '#expirydate' ).attr( "hidden", true );
    }
  });
  $( '.chat_list' ).click( function ()
  {
    if ( $( '.chat_list' ).hasClass( 'active_chat' ) )
    {
      $( ".chat_list" ).removeClass( "active_chat" );
    }
    $( this ).addClass( "active_chat" );
    var user_id = $( this ).attr( 'id' );
    $.ajax(
      {
        type: "POST",
        url: carma.config.getchat,
        data: { "user_id": user_id },
        success: function ( result )
        {
          if ( result )
          {
           
            $( '.msg_history' ).html( result );
           
            $( '.fa-bell[id=' + user_id + ']' ).attr( 'hidden', true );
            
          }
          else
          {
            swal( " SomeThing Went Wrong!", {
              icon: "error",
                   
            } );
          }
        }
      }
    );
  } );
});