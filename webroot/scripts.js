function activetab(tab){
    var cfas = document.getElementById("cfas")
    for ( i = 0; i < cfas.childNodes.length; i++ ) {
        cfas.childNodes[i].style.display="none";
    }
    document.getElementById("accreditation_content").style.display="none";
	document.getElementById(tab+"_tab").className="uk-active";    
    document.getElementById(tab+"_content").style.display="block";

}
