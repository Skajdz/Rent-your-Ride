$(document).ready(function(){
    $(".delete").click(function(){
        var idRe = parseInt($(this).val());
        if(!isNaN(idRe)){
            $.ajax({
                    method: "POST",
                    url: "php/admin/actions.php",
                    data:{
                        data:"delete",
                        idRe:idRe
                    },
                    success:function(data){
                        location.reload();
                    },
                    error:function(jqXHR,status, exception){
                        console.log(jqXHR.status);
                    }
                
            })
        }

    })
    $(".ckA").click(function(){
        var idRe = parseInt($(this).val());
        if(!isNaN(idRe)){
            $.ajax({
                method: "POST",
                    url: "php/admin/actions.php",
                    data:{
                        data:"approve",
                        idRe:idRe
                    },
                    success:function(data){
                        location.reload();
                    },
                    error:function(jqXHR,status, exception){
                        console.log(jqXHR.status);
                    }
            })
        }
    })
    $(".cancel").click(function(){
        var idRe = parseInt($(this).val());
        if(!isNaN(idRe)){
            $.ajax({
                method: "POST",
                    url: "php/admin/actions.php",
                    data:{
                        data:"cancel",
                        idRe:idRe
                    },
                    success:function(data){
                        location.reload();
                    },
                    error:function(jqXHR,status, exception){
                        console.log(jqXHR.status);
                    }
            })
        }
    })
    $("#submitUU").click(function(e){
        e.preventDefault();
        var email = $("#emailUU").val();
        var lastName = $("#idName").val();
        var pass = $("#passUU").val();
        var rLastName = /^[A-Z][a-z]{2,13}$/;
        var rEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var errors = [];
        
        if(!rEmail.test(email)){
            errors.push("Email is not in good format");
            $("#emailUU").css("border-color", "red");
        }
        else $("#emailUU").css("border-color", "green");

        if(!rLastName.test(lastName)){
            errors.push("Name is not in good format");
            $("#idName").css("border-color", "red");
        }else $("#idName").css("border-color", "green");

        if(pass.length <6){
            errors.push("The password must have at least 6 characters");
            $("#passUU").css("border-color", "red");
        }else $("#passUU").css("border-color", "green");

        if(errors.length == 0){
            $.ajax({
                method: "POST",
                    url: "php/admin/actions.php",
                    data:{
                        data:"insertAdmin",
                        lastName:lastName,
                        pass:pass,
                        email:email
                    },
                    success:function(data){
                        location.reload();
                    },
                    error:function(jqXHR,status, exception){
                        console.log(jqXHR.status);
                        if(jqXHR.status == 200){
                            location.reload();
                        }
                    }
            })
        }
    })
    $("#addR").submit(function(e){
        
        var name =$("#ride-name").val();
        var price = $("#ride-price").val();
        var bonusP = $("#bp").val();
        var bonusPP = $("#bpPrice").val();
        var percent = $("#percent").val();
        var description = $("#textA").val();
        var picture = $("#main").val();
        var pictures = $("#pictures").val();
        var errors = [];
        var dicountU = $("#dicountU").val();
        var rPercent = /^[5-8]$/;
        
        var rPrice = /^[0-9]+$/;
        if(picture==''){
            errors.push("Chose a picture!");
            $("#main").css("border-color","red");
        }
        else{
            $("#main").css("border-color","green");
        }
        if(pictures==''){
            errors.push("Chose a picture!");
            $("#pictures").css("border-color","red");
        }
        else{
            $("#pictures").css("border-color","green");
        }
        if(name.length<6){
            errors.push("Name is not valid");
            $("#ride-name").css("border-color","red");
        }
        else{
            $("#ride-name").css("border-color","green");
        }
        if(bonusP.length<6){
            errors.push("Bonus package");
            $("#bp").css("border-color","red");
        }
        else{
            $("#bp").css("border-color","green");
        }
        if(description.length<15){
            errors.push("Bonus package");
            $("#textA").css("border-color","red");
        }
        else{
            $("#textA").css("border-color","green");
        }
        if(!rPrice.test(bonusPP)){
            errors.push("Price is not valid");
            $("#bpPrice").css("border-color","red");
        }
        else{
            $("#bpPrice").css("border-color","green");
        }
        if(!rPrice.test(price)){
            errors.push("Price is not valid");
            $("#ride-price").css("border-color","red");
        }
        else{
            $("#ride-price").css("border-color","green");
        }
        if(!rPercent.test(percent)){
            errors.push("Bad Percent");
            $("#percent").css("border-color","red");
        }
        else{
            $("#percent").css("border-color","green");
        }
        
        
        if(errors.length==0){
            //alert("nema gresaka");
            return true;
        }
        else{
            return false;
        }
    });
    $(".deleteP").click(function(e){
        e.preventDefault();
        var idS = parseInt($(this).data("id"));
        if(!isNaN(idS)){
            $.ajax({
                method: "POST",
                url: "php/admin/actions.php",
                data:{
                    data:"deleteP",
                    idS:idS
                },
                success:function(data){
                    location.reload();
                },
                error:function(jqXHR,status, exception){
                    console.log(jqXHR.status);
                }
            })
        }
    })
    $("#updateR").submit(function(e){
        
        var name =$("#nameU").val();
        var price = $("priceU").val();
        var bonusP = $("#bpU").val();
        var bonusPP = $("#bpPU").val();
        var percent = $("#percentU").val();
        var description = $("#textU").val();
        var picture = $("#mainU").val();
        var pictures = $("#picturesU").val();
        var errors = [];
        var dicountU = $("#dicountU").val();
        var rPercent = /^[5-8]$/;
        var counter = 0;
        var rPrice = /^[0-9]+$/;
        if(picture){
            counter++;
            if(picture==''){
                errors.push("Chose a picture!");
                $("#main").css("border-color","red");
            }
            else{
                $("#main").css("border-color","green");
            }
        }

        if(pictures){
            counter++;
            if(pictures==''){
                errors.push("Chose a picture!");
                $("#pictures").css("border-color","red");
            }
            else{
                $("#pictures").css("border-color","green");
            }
        }

        if(name){
            counter++;
            if(name.length<6){
                errors.push("Name is not valid");
                $("#ride-name").css("border-color","red");
            }
            else{
                $("#ride-name").css("border-color","green");
            }
        }
        
        if(bonusP){
            counter++;
            if(bonusP.length<6){
                errors.push("Bonus package");
                $("#bp").css("border-color","red");
            }
            else{
                $("#bp").css("border-color","green");
            }
        }

        if(description){
            counter++;
            if(description.length<15){
                errors.push("Bonus package");
                $("#textA").css("border-color","red");
            }
            else{
                $("#textA").css("border-color","green");
            }
        }
        
        if(bonusPP){
            counter++;
            if(!rPrice.test(bonusPP)){
                errors.push("Price is not valid");
                $("#bpPrice").css("border-color","red");
            }
            else{
                $("#bpPrice").css("border-color","green");
            }
        }

        if(price){
            counter++;
            if(!rPrice.test(price)){
                errors.push("Price is not valid");
                $("#ride-price").css("border-color","red");
            }
            else{
                $("#ride-price").css("border-color","green");
            }
        }

        if(percent){
            counter++;
            if(!rPercent.test(percent)){
                errors.push("Bad Percent");
                $("#percent").css("border-color","red");
            }
            else{
                $("#percent").css("border-color","green");
            }
        }
        
        if(dicountU){
            counter++;
            if(!rPrice.test(dicountU)){
                errors.push("Discount price is not valid");
                $("#dicountU").css("border-color","red");
            }
            else{
                $("#dicountU").css("border-color","green");
            }
        }
        
        if(errors.length==0 && counter != 0 ){
            
            return true;
        }
        else{
            return false
        }
    });
})