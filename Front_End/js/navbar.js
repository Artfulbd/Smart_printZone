/*Navbar Starts*/
$(document).ready(function() {
    $(window).scroll(function() {
        if($(this).scrollTop() < $("#green").height()){
            $(".navbar").removeClass("bg-dark");
        }
        else{
            $(".navbar").addClass("bg-dark");
        }
    });
});

/*Nav Bar Starts*/

/*Load_Page starts*/


/*Load Page ENDS*/