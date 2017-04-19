<!DOCTYPE html>
<html>
	<head>
	<?php include 'head.php';?>
	</head>
	<body>
		<nav class="uk-navbar">
			<div class="uk-container uk-container-center">
				<a href="<?= $data['_config']['base_url'] ?>index.php" class="uk-navbar-brand">Digital CSIP <font size="1pt">v. 8.0.bse</font></a>
				<div class="uk-navbar-flip">
					<a href="#mainmenu-id" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas="{target:'#mainmenu-id'}"></a>
				</div>
			</div>
		</nav>
		<br>

        <div class="uk-container uk-container-center uk-animation-fade">

<?php if ( !empty($data['INSTALL_USER_EXTERNAL']) ) { ?><div class="uk-alert uk-alert-warning"><div><h2>External Users is set.<br>Information on locations, users, and courses will be pulled from an external source.<br>This page will help align that information with any that is already in CSIP.</h2></div></div><?php } ?>

<?php if ( !empty($data['ERROR']) ) { ?>
<div class="uk-alert uk-alert-danger">
<?php if ( !empty($data['INSTALL_CREATETABLES_CANT_READ']) ) { ?><div>The database hasn&apos;t been setup.  This program will now attempt to create the necessary tables for you.<br>Can&apos;t read the sql files.  You will have to do it yourself.</div><?php } ?>
<?php if ( !empty($data['INSTALL_CREATETABLES_FAILED']) ) { ?><div>The database hasn&apos;t been setup.  This program will now attempt to create the necessary tables for you.<br>There was an error.  You will have to check on the state of the database and tables yourself.<br>Error message: <?= $data['INSTALL_CREATETABLES_FAILED'] ?></div><?php } ?>

<?php if ( !empty($data['INSTALL_ALREADY_ADDED_ADMIN']) ) { ?><div>There are already users for managing the program.  This program won&apos;t create more for you.</div><?php } ?>

<?php if ( !empty($data['INSTALL_PASS_NOMATCH']) ) { ?><div>Passwords don&apos;t match.</div><?php } ?>
<?php if ( !empty($data['INSTALL_USERNAME_USED']) ) { ?><div>That username is already in use.</div><?php } ?>
<?php if ( !empty($data['INSTALL_ADD_USER_FAILED']) ) { ?><div>Creating the specified user in the database failed.</div><?php } ?>
</div>
<?php } ?>

<?php if ( !empty($data['INSTALL_DONE']) ) { ?><div class="uk-alert uk-alert-success"><a href="index.php">Installation is complete.  Please login to add users.</a></div><?php } ?>

	<div class="uk-container-center">
	<div class="uk-panel uk-panel-box">
		<h3>Please review information already in CSIP and in the External source.</h3>
		<p>Drag and drop items to manage the links between CSIP and the External Source.</p>
		<div id="data_set"><?= $data['data_set'] ?></div>
		<form class="uk-form" method="post" action="install.php">
			<input type="hidden" name="step" value="<?= empty($data['step']) ? '1' : $data['step']+1 ?>">
<?php if ( !empty($data['checks_passed']) ) { ?>
			<input type="hidden" name="checks_passed" value="1">
<?php } ?>
			<fieldset class="uk-form-horizontal uk-grid">
				<div class="uk-width-1-2 uk-panel uk-panel-box uk-scrollable-text" id="PreSyncCSIPSide">
<?php
$count = 1;
$link_count = 1;
$f_val = $data['value_field'];
$f_lab = $data['label_field'];
foreach ( $data['left'] as $element ) {
?>
					<div class="uk-nbfc uk-overflow-container uk-panel-box uk-padding-remove uk-margin-small">
					<label class="uk-form-label" for="external<?= $count ?>"><?= !empty($element['label']) ? $element['label'] : $element[$f_lab] ?></label>
					<div class="uk-form-controls" ondragover="drag_allowdrop(event)" ondrop="drag_dropped(event)">
						<input type="hidden" id="element<?= $count ?>" name="elements[]" value="<?= $element[ $f_val ] ?>">
<?php
    if ($data['data_set'] == 'Courses' || empty($element['externalid']) ) {
 ?>
						<input type="text" id="external<?= $count ?>" name="externals[]" placeholder="external id" value="">
<?php
    } else {
 ?>
						<input type="hidden" id="external<?= $count ?>" name="externals[]" placeholder="external id" value="<?= $element['externalid'] ?>">
<?php
    }

    if ( !empty($element['externalid']) && !empty($data['right'][ $element['externalid'] ]) ) {
        $ex_label = $data['right'][ $element['externalid'] ][ $f_lab ];
        unset( $data['right'][ $element['externalid'] ] );
?>
						<a href="#" id="link<?= $link_count ?>" dragable="true" ondragstart="drag_start(event)" class="uk-button" data-csip-link-value="<?= $element['externalid'] ?>"><?= $ex_label ?></a>
<?php
        $link_count++;
    }
    if ( !empty($element['externalids']) ) {
        foreach ( $element['externalids'] as $ext_id ) {
			$ex_label = $data['right'][ $ext_id ][ $f_lab ];
			unset( $data['right'][ $ext_id ] );
?>
						<a href="#"  id="link<?= $link_count ?>" dragable="true" ondragstart="drag_start(event)" class="uk-button" data-csip-link-value="<?= $ext_id ?>"><?= $ex_label ?></a>
						<input type="hidden" name="<?= $element[ $f_val ] ?>_externals[]" placeholder="external id" value="<?= $ext_id ?>">
<?php
            $link_count++;
        }
    }
 ?>
					</div>
					</div>
<?php
    $count++;
}
?>
				</div>
				<div class="uk-width-1-2 uk-panel uk-panel-box uk-scrollable-text" id="PreSyncExternalSide" ondragover="drag_allowdrop(event)" ondrop="drag_dropped(event)" style="max_height:100%;min_height:30%">
<?php
unset($left);
foreach ( $data['right'] as $element ) {
?>

					<a href="#" id="link<?= $link_count ?>" dragable="true" ondragstart="drag_start(event)" class="uk-button" data-csip-link-value="<?= $element['externalid'] ?>"><?= $element[ $f_lab ] ?></a>
<?php
    $link_count++;
}
unset($right);
?>
				</div>
			</fieldset>
			<div class="uk-text-center uk-margin uk-form-controls">
				<input class="uk-button uk-button-success" type="submit" value="Submit Links">
			</div>
		</form>
	</div>
	</div>

</div>
<?php
include 'footer.php';
?>
    <script>
function drag_start(event) {
    if ( 'originalEvent' in event ) {
        event.dataTransfer = event.originalEvent.dataTransfer;
    }

    event.dataTransfer.setData( "element_id", event.target.id );

    var parent = event.target;
    while ( (parent = parent.parentElement) && !( parent.id == 'PreSyncCSIPSide' || parent.id == 'PreSyncExternalSide' ) );

    if ( parent ) {
        event.dataTransfer.setData( "source", parent.id );
    }
}

function drag_dropped(event) {
    event.preventDefault();
    event.stopPropagation();
    if ( 'originalEvent' in event ) {
        event.dataTransfer = event.originalEvent.dataTransfer;
    }
    var target = event.target;
    if ( target.tagName.toLowerCase() != 'div' ) {
        while ( (target = target.parentElement) && (target.tagName.toLowerCase() != 'div') );
        if ( !target ) { return; }
    }
    var element_id = event.dataTransfer.getData("element_id");
    var element = document.getElementById(element_id);
    var ex_id = element.getAttribute("data-csip-link-value");
    if ( target == element.parentElement ) {
        return;
    }

    var old_parent_id = event.dataTransfer.getData("source");
    if ( old_parent_id && old_parent_id == 'PreSyncCSIPSide' ) {
        var inp_list = document.querySelectorAll('div#PreSyncCSIPSide input[type=hidden]');
        for ( var i = 0; i < inp_list.length; i++ ) {
            var inp = inp_list[i];
            if ( inp.name == 'externals[]' && inp.value == ex_id ) {
                inp.type = "text";
                inp.value = "";
            }
            if ( inp.name.match(/_externals\[\]$/) && inp.value == ex_id ) {
                inp.parentNode.removeChild( inp );
            }
        }
    }

    if ( target.parentElement.parentElement.id == 'PreSyncCSIPSide' ) {
        var e_data_set = document.querySelector("div#data_set");
        var data_set = e_data_set.textContent || e_data_set.innerText;
        if ( data_set != 'Courses' ) {
            var inp = target.querySelector("input[type=text]");
            inp.type = "hidden";
            inp.value = ex_id;
        }
        else {
            var h_inputs = target.querySelectorAll("input[type=hidden]");
            var course_id;
            for ( var i = 0; i < h_inputs.length; i++ ) {
                var inp = h_inputs[i];
                if ( inp.name == 'elements[]' ) {
                    course_id = inp.value;
                }
            }
            $( target ).append("<input type='hidden' value='"+ ex_id +"' name='"+ course_id +"_externals[]'>");
        }
        target.appendChild(element);
    }
    else if ( target.id == 'PreSyncExternalSide' ) {
        var appended = 0;
        for ( var i = 0; i < target.children.length; i++ ) {
            if ( target.children[i].innerHTML > element.innerHTML ) {
                target.insertBefore( element, target.children[i] );
                appended = 1;
                break;
            }
        }
        if ( !appended ) {
            target.appendChild(element);
        }
    }
}

function drag_allowdrop(event) {
    event.preventDefault();
    event.stopPropagation();
}
    </script>
	</body>
</html>
