function activetab(tab){
    document.getElementById("cfa1_content").style.display="none";
    document.getElementById("accreditation_content").style.display="none";
	document.getElementById(tab+"_tab").className="uk-active";    
    document.getElementById(tab+"_content").style.display="block";

}
