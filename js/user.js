$(document).ready(function(){
    $("#link-change").click(function(e){
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
    
        if (target.length) {
      
            event.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top -100
            }, 1500);
        }
    });
    $("#cInfo").click(function(e){
        e.preventDefault();
        var email = $("#emailU").val();
        var firstName = $("#firstNameU").val();
        var lastName = $("#lastNameU").val();
        var phoneN = $("#pNU").val();
        var newP = $("#passU").val();
        var cNewP = $("#cPassU").val();
        var rFirstName = /^[A-Z][a-z]{2,13}$/;
        var rLastName = /^[A-Z][a-z]{2,13}$/;
        var rEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var rPN = /^(0|\+381)6[0-9][0-9]{6,8}$/;
        var errors = [];
        
        if(!rFirstName.test(firstName)){
            errors.push("First name is not valid");
            $("#firstNameU").css("border-color","red");
        }
        else $("#firstNameU").css("border-color","green");
        if(!rLastName.test(lastName)){
            errors.push("Last name is not valid");
            $("#lastNameU").css("border-color","red");
        }
        else $("#lastNameU").css("border-color","green");
        if(!rPN.test(phoneN)){
            errors.push("Phone number is not valid");
            $("#pNU").css("border-color","red");
        }
        else $("#pNU").css("border-color","green");
        if(!rEmail.test(email)){
            errors.push("Last name is not valid");
            $("#emailU").css("border-color","red");
        }
        else $("#emailU").css("border-color","green");
        if(newP != "" || cNewP != "" ){
            if(newP != cNewP || newP.length<6){
                errors.push("The password is not valid");
                $("#passU").css("border-color","red");
                $("#cPassU").css("border-color","red");
            }
            else{
                $("#passU").css("border-color","green");
                $("#cPassU").css("border-color","green");
            }
    
        }
        
        if(errors.length == 0){
            $.ajax({
                method: "POST",
                url: "php/user_update.php",
                data:{
                    data : "sent",
                    firstName : firstName,
                    lastName : lastName,
                    idK : $("#userIdHidden").val(),
                    phoneN : phoneN,
                    email : email,
                    newP : newP
                },
                success:function(data){
                    $('html, body').animate({
                        scrollTop: $("#header").offset().top
                    }, 1500, function(){
                        location.reload();
                    });
                   console.log(data);
                },
                error:function(jqXHR,status, exception){
                    console.log(jqXHR.status);
                    if(jqXHR.status == 200){
                    $('html, body').animate({
                        scrollTop: $("#header").offset().top
                    }, 1500, function(){
                        location.reload();
                    });
                    }
                }
            });
        }
        
    })

});