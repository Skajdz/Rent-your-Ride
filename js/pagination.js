$(document).ready(function(){
    $(".pag").click(function(){
        var num = parseInt($(this).data('id'));
        if(!isNaN(num)){
            $.ajax({
                method: "POST",
                url: "php/pagination.php",
                data:{
                    send:"sent",
                    num:num
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
})