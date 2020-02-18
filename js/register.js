$(document).ready(function(){
    $("#regSubmit").click(function(e){
        e.preventDefault();
        var email = $("#emailReg").val();
        var firstName = $("#firstNameReg").val();
        var lastName = $("#lastNameReg").val();
        var pass = $("#passwordReg").val();
        var passC = $("#passwordCReg").val();
        var phoneN = $("#phoneReg").val(); 
        var driverL = $("#driversC").val();
        var rEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var rFirstName = /^[A-Z][a-z]{2,13}$/;
        var rLastName = /^[A-Z][a-z]{2,13}$/;
        var rPhone = /^(0|\+381)6[0-9][0-9]{6,8}$/;
        var rDriverL = /^000[0-9]{6}$/;
        var errors = [];

        if(!rEmail.test(email)){
            errors.push("Email is not valid");
            $("#emailReg").css("border-color", "red");
        }
        else $("#emailReg").css("border-color", "green");
        
        if(!rFirstName.test(firstName)){
            errors.push("First name is not valid");
            $("#firstNameReg").css("border-color", "red");
        }
        else $("#firstNameReg").css("border-color", "green");
        
        if(!rLastName.test(lastName)){
            errors.push("Last name is not valid");
            $("#lastNameReg").css("border-color", "red");
        }
        else $("#lastNameReg").css("border-color", "green");
        
        if(!rPhone.test(phoneN)){
            errors.push("Your phone number is not valid");
            $("#phoneReg").css("border-color", "red");
        }
        else $("#phoneReg").css("border-color", "green");

        if(!rDriverL.test(driverL)){
            errors.push("Your driver's licence  is not valid");
            $("#driversC").css("border-color", "red");
        }
        else $("#driversC").css("border-color", "green");

        if(pass != passC || pass.length < 6){
            errors.push("Password is not in valid format");
            $("#passwordReg").css("border-color", "red");
            $("#passwordCReg").css("border-color", "red");
        }
        else{
            $("#passwordReg").css("border-color", "green");
            $("#passwordCReg").css("border-color", "green");
        }

        if(errors.length == 0){
            $.ajax({
                method: "POST",
                url: "php/registration.php",
                data:{
                    reg : "done",
                    firstName : firstName,
                    lastName : lastName,
                    pass : pass,
                    phoneN : phoneN,
                    driverL : driverL,
                    email :email,
                },
                success:function(data){
                    location.reload();
                },
                error:function(jqXHR,status, exception){
                    location.reload();
                    }
            });
        }

        
        

    });
});