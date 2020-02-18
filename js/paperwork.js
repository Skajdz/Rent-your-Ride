$(document).ready(function(){
    var timeError = [];
    $("#dateP").change(function(){
        
        var date = $(this).val();
        if(date != ""){
            $("#dateR").attr("readonly", false); 
        }
        else{ 
            $("#dateR").attr("readonly", true); 
        }
        if(date != ""){
            var pDate = date.split("T");
            var pDates = pDate[0].split("-");
            var pTime = pDate[1].split(":");
            pDate = new Date(pDates[0], pDates[1], pDates[2], pTime[0], pTime[1], 0, 0);
            var date = new Date();
            var year = date.getFullYear();
            var month = ("0" + (date.getMonth()+1)).slice(-2);
            var day = date.getDate();
            var hour = date.getHours();
            var minute = date.getMinutes();
            var tDate = new Date(year, month, day, hour, minute, 0 , 0);
            if((pDate.getTime())-tDate.getTime()<86400000){
                $(this).css("border-color","red");
                $("#dateR").attr("readonly", true);
                timeError.push(1);
            }
            else{   
                $(this).css("border-color","green");
                    timeError = jQuery.grep(timeError, function(value) {
                    return value != 1;
                  });
            }
        }else{
            $(this).css("border-color","red");
            
        }
    });
    var totalPrice=0;
    $("#dateR").change(function(){
        
        var rDate = $(this).val().split("T");
        var rDates = rDate[0].split("-");
        var rTime = rDate[1].split(":");
        rDate = new Date(rDates[0], rDates[1], rDates[2], rTime[0], rTime[1], 0, 0);
        
        var pDate = $("#dateP").val().split("T");
        var pDates = pDate[0].split("-");
        var pTime = pDate[1].split(":");
        pDate = new Date(pDates[0], pDates[1], pDates[2], pTime[0], pTime[1], 0, 0);
        if((rDate.getTime())-pDate.getTime()<86400000){
            $(this).css("border-color","red");
            timeError.push(2);
        }
        else{   
            $(this).css("border-color","green");
                timeError = jQuery.grep(timeError, function(value) {
                return value != 2;
              });
            
        }
        var days = Math.ceil((rDate.getTime() - pDate.getTime())/1000/60/60/24);
       
        console.log(days);
        var totalPrice;
        price = $("#hiddenPrice").val();
        
        if($("#hiddenDiscount").val() != ""){
            price = $("#hiddenDiscount").val();
        }
        var percent = (price * $("#hiddenPercent").val())/100;
        if(days==1){
            totalPrice = price * days;
           
        }
        else if(2 <= days && days<= 5){
            totalPrice = Math.round(price - percent) * days;
            
            
        }
        else if(6 <= days && days <= 10){
            totalPrice = Math.round(price - (percent * 2)) * days;
            
            
        }else if(11 <= days && days <= 20){
            totalPrice = Math.round(price - ( percent * 3)) * days;
           
            
        }
        else if(days > 20){
            totalPrice = Math.round(price - (percent * 4)) * days;
           
            
        }
        
        $("#totalP").text(totalPrice);       
    });
    $("#bPC").change(function(){
        totalPrice = parseInt($("#totalP").text()||0);
        if($(this).prop("checked"))
        totalPrice += parseInt($("#hiddenBpPrice").val());
        else{
            totalPrice -= parseInt($("#hiddenBpPrice").val());
        }

        $("#totalP").text(totalPrice);
    });
    $("#paperworkBtn").click(function(e){
        e.preventDefault();
        var totalPrice = parseInt($("#totalP").text()|0);
        var bpP = null;
        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
        var email = $("#Email").val();
        var dL = $("#driversLicence").val();
        var pN = $("#phoneNumber").val();
        var adress = $("#adress").val();
        var rDate = $("#dateR").val();
        var pDate = $("#dateP").val();
        var rFirstName = /^[A-Z][a-z]{2,13}$/;
        var rLastName = /^[A-Z][a-z]{2,13}$/;
        var rEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var rDL = /^000[0-9]{6}$/;
        var rPN = /^(0|\+381)6[0-9][0-9]{6,8}$/;
        var rAdress = /^[A-ZŠĐČĆŽ][a-zšđčćž]{2,20}([\s]?([A-ZŠĐČĆŽ]?[a-zšđčćž]{2,12})?)+[\s]?[0-9]+[A-ZŠĐČĆŽa-zšđčćž]?$/;
        errors = [];
        if(!rEmail.test(email)){
            errors.push("Nije ispravno unet email");
            $("#Email").css("border-color","red");
            console.log(email)
        }
        else{
            $("#Email").css("border-color","green");
        }
        if(!rFirstName.test(firstName)){
            $("#firstName").css("border-color","red");
            errors.push("Firstname");
        }
        else{
            $("#firstName").css("border-color","green");
        }
        if(!rLastName.test(lastName)){
            $("#lastName").css("border-color","red");
            errors.push("Lastname");
        }
        else{
            $("#lastName").css("border-color","green");
        }
       
        if(!rDL.test(dL)){
            $("#driversLicence").css("border-color","red");
            errors.push("Driver's Licence");
        }
        else{
            $("#driversLicence").css("border-color","green");
        }
        if(!rPN.test(pN)){
            $("#phoneNumber").css("border-color","red");
            errors.push("PhoneNumber");
        }
        else{
            $("#phoneNumber").css("border-color","green");
        }
        if(!rAdress.test(adress)){
            $("#adress").css("border-color","red");
            errors.push("Pickup/Return adress");
        }
        else{
            $("#adress").css("border-color","green");
        }
        if($("#dateP").val() == ""){
            $("#dateP").css("border-color","red");
            errors.push("Pickup date bad input");
        }
        if($("#dateR").val() == ""){
            $("#dateR").css("border-color","red");
            errors.push("Return date bad input");
        }
        if($("#tos").prop("checked") == false){
            errors.push("Terms of service");
            $("#text").text("This must be checked to proceed. ");
            $("#text").css("color","red");
        }
        else{
            $("#text").text("");
        }
        if($("#bPC").prop("checked") == true){
            bpP = 1;
        }

        if(errors.length == 0 && timeError.length == 0){
            $.ajax({
                method: "POST",
                url: "php/paperwork.php",
                data:{
                    paperwork : "done",
                    adress : adress,
                    bpP : bpP,
                    idR : $("#hiddenidR").val(),
                    rDate : rDate,
                    pDate : pDate,
                    idK : $("#userId").val(),
                    totalPrice : totalPrice
                },
                success:function(data){
                    window.location = "index.php?page=user";
                },
                error:function(jqXHR,status, exception){
                    console.log(jqXHR);
                }
            });
        }
        else {console.log(errors+","+timeError);
            console.log("greska");
        }
        
    });
    
});