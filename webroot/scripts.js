function addCFATab(csipid,categoryid,courseid,part,label,last){
	var lastTAB = last;
	if ( ! lastTAB ) { lastTAB = part; }
	part=(part*1.0)+1;
	var data = {};
	data['csipid'] = csipid;
	data['courseid'] = courseid;
	data['part'] = part;
	$.ajax({
		url: "api/course_add_part.php",
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
			}	
			else {
				$('<li id="cfa'+part+'_tab"><a href=""><div class="uk-badge uk-badge-warning">GVC '+label+'</div></a></li>");').insertAfter("#cfa"+lastTAB+'_tab');
				$('<div id="cfa'+part+'_content">This is CFA'+part+'</div>').insertAfter("#cfa"+lastTAB+'_content');
				$("#cfa"+part+"_content").load("cfa_new.php?tab="+label+"&csipid="+csipid+"&courseid="+courseid+"&part="+part, function(response, status, xhr) {
					if (status == "error") {
						console.log(xhr.status + " " + xhr.statusText);
					}
				});
				$("li#addcfa_tab a").attr("onclick","addCFATab('"+csipid+"','"+categoryid+"','"+courseid+"','"+ part +"','"+ ( (label*1.0)+1 ) +"','"+ part +"');");
				var cfa_tabs = $.UIkit.switcher('#rightpaneltabs',{connect:'#cfas'});
				cfa_tabs.init();
				$("#cfa"+part+"_tab").trigger('click');
			}
		}
	});
}

function confirmDelete() {
    var r = confirm("Are you sure you want to delete this?");
    if(r == true){
		return true;
	}else{
		return false;
	}
}
