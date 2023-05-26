$(document).ready(function(){
    //onclick signup hide login and show register
    $("#signup").click(function(){
        $("#first").slideUp("slow",function(){
            $("#second").slideDown("slow");

        });
    });
    //onclick signin hide register and show login
    $("#signin").click(function(){
        $("#second").slideUp("slow",function(){
            $("#first").slideDown("slow"); 

        });
    });
});