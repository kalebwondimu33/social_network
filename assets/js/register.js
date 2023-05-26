$(document).ready(function(){
    //onclick signup hide login and show register
    $("#signup").click(function(event){
        event.preventDefault();
        $("#first").slideUp("slow",function(){
            $("#second").slideDown("slow");
        });
        

        });
    //onclick signin hide register and show login
    $("#signin").click(function(event){
        event.preventDefault();
        $("#second").slideUp("slow",function(){
            $("#first").slideDown("slow");
        });
         

    });
});