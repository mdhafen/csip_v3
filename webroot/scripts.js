var maxTab;
function activetab(tab){
    $( "div#cfas > div" ).css("display","none");
    $( "ul#rightpaneltabs > li" ).removeClass("uk-active");
    document.getElementById("accreditation_content").style.display="none";

    document.getElementById(tab+"_tab").className="uk-active";
    document.getElementById(tab+"_content").style.display="block";
}

function addCFATab(csipid,categoryid,courseid,part){
	var lastTAB = maxTab-1;
	tab=maxTab;
	maxTab=maxTab+1;
	part=(part*1.0)+1;
	//alert(maxTab+':'+tab+':'+lastTAB);
	var data = {};
	data['csipid'] = csipid;
	data['courseid'] = courseid;
	data['part'] = part;
	$.ajax({
		url: "/csip_v5/webroot/api/course_add_part.php",
		data: data,
		type: 'post',
		success: function(data) {
			if( $(data).find("state").text() == 'Error' ){
				var messages = "";
				$(data).find("message").each( function(){
					var t_flag = $(this)
					messages = messages +" "+ t_flag.text();
				});
				alert("Error(s): "+ messages);
				//console.log("course_add_part errors "+ messages);
			}	
			else {
				$('<li class="uk-active" id="cfa'+tab+'_tab"><a href="" onclick="activetab(\'cfa'+tab+'\');"><div class="uk-badge uk-badge-warning">GVC '+tab+'</div></a></li>");').insertAfter("#cfa"+lastTAB+'_tab');
				$('<div id="cfa'+tab+'_content" style="display: block">This is CFA'+tab+'</div>').insertAfter("#cfa"+lastTAB+'_content');
				$("#cfa"+tab+"_content").load("cfa_new.php?tab="+tab+"&csipid="+csipid+"&courseid="+courseid+"&part="+part, function(response, status, xhr) {
					if (status == "error") {
						// alert(msg + xhr.status + " " + xhr.statusText);
						console.log(xhr.status + " " + xhr.statusText);
					}
				});
				$("li#addcfa_tab a").attr("onclick","addCFATab('"+csipid+"','"+categoryid+"','"+courseid+"','"+ part +"');");
				activetab('cfa'+tab);
			}
		}
	});
	/*var cfa1 = $("div#cfa1_content").html();
	var data = cfa1.replace("cfa1","cfa"+tab);
	data = data.replace("cfam1","cfam"+tab)
	data = data.replace("int1","int"+tab)
	data = data.replace("le1","le"+tab)
	$("div#cfa"+tab+"_content").html(data);*/
}

function confirmDelete() {
    var r = confirm("Are you sure you want to delete this?");
    if(r == true){
		return true;
	}else{
		return false;
	}
}
