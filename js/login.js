$(document).ready(function(){
    
    $("#loginBtn").click(function(e){
        
        e.preventDefault();
        var email = $("#email").val();
        var pass = $("#password").val();
        var rEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var rPass = /^[\S]{6,}$/;
        var greske = [];
        if(!rEmail.test(email)){
            greske.push("Nije ispravno unet email");
            $("#email").css("border-color","red");
        }
        if(!rPass.test(pass)){
            greske.push("Sifra nije ispravna");
            $("#password").css("border-color","red");
        }
        if(greske.length == 0){
            $.ajax({
                method: "POST",
                url: "php/login.php",
                data:{
                    send:"sent",
                    email:email,
                    pass:pass
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