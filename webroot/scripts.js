function activetab(tab){
    $( "div#cfas > div" ).css("display","none");
    $( "ul#rightpaneltabs > li" ).removeClass("uk-active");
    document.getElementById("accreditation_content").style.display="none";

    document.getElementById(tab+"_tab").className="uk-active";
    document.getElementById(tab+"_content").style.display="block";
}
