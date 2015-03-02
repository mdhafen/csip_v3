<!-- Tabs Begin -->
<div class="uk-panel uk-panel-box-secondary">
	
    <form class="uk-form">
    <h4><strong>Selected Course:</strong> 
        <select type="text" class="uk-form-large">
            <option>Select One...</option>
            <option>Mathematics</option>
            <option>Science</option>
        </select>
    </form>
    </h4>
<br>
	<ul class="uk-tab" data-uk-tab>
        <li class="uk-active" id="cfa1_tab"><a href="" onclick="activetab('cfa1');"><div class="uk-badge uk-badge-success">GVC 1</div></a></li>
        <li class="" id="cfa2_tab"><a href="" onclick="activetab('cfa2');"><div class="uk-badge uk-badge-success">GVC 2</div></a></li>
        <li class="" id="cfa3_tab"><a href="" onclick="activetab('cfa3');"><div class="uk-badge uk-badge-warning">GVC 3</div></a></li>
        <li class="" id="cfa4_tab"><a href="" onclick="activetab('cfa4');"><div class="uk-badge uk-badge-warning">GVC 4</div></a></li>
        <li class="" id="cfa5_tab"><a href="" onclick="activetab('cfa5');"><div class="uk-badge uk-badge-danger">GVC 5</div></a></li>
        <li class="" id="cfa6_tab"><a href="" onclick="activetab('cfa6');"><div class="uk-badge uk-badge-danger">GVC 6</div></a></li>
        <li class="" id="cfa6_tab"><a href="" onclick="activetab('cfa6');"><i class="uk-icon-plus"></i>
        <li class="" id="accreditation_tab"><a href="" onclick="activetab('accreditation');"><div class="uk-badge uk-badge-primary">Accreditation</div></a></li>            
</a></li>

	</ul>
	<!-- Tabs End -->
	


    
    <!-- Load pages based on tab selected -->
    
    <div id="cfa1_content" style="display: block;">
	   <?php include 'cfa1.php';?>
    </div>

	<div id="accreditation_content" style="display: none;">
	   <?php include 'accreditation.php';?>
    </div>
</div>
