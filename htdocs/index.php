<!DOCTYPE html>
<html>
	<head>
	<?php include 'head.php';?>
	</head>
	<body>
		<?php include 'menu.php'; ?>

        <div class="uk-container uk-container-center uk-animation-fade">
<br>

            <span class="uk-align-right"><img src="http://schools.washk12.org/enterprise/wp-content/uploads/sites/23/2014/01/grey_wcsd_logo-e1395268854370.png"></span>
            <form class="uk-form">
               <h2>
                   <select type="text" class="uk-form-large">
            <option>Select One...</option>
            <option>2014-2015</option>
            <option>2015-2016</option>
        </select>
                   Plan for 
        <select type="text" class="uk-form-large">
            <option>Select One...</option>
            <option>Arrowhead Elementary</option>
            <option>Tonaquint Intermediate</option>
            <option>Desert Hills Middle</option>
            <option>Dixie High</option>
        </select>
    </form>
                 <hr>
    </h2>         
            <div class="uk-grid" uk-grid-divider data-uk-grid-match>
                <div class="uk-width-medium-3-10">
                    <?php include 'leftpanel.php'; ?>
                    <?php include 'dates.php'; ?>
				</div>
				<div class="uk-width-medium-7-10"> 
                    
                    <?php include 'information.php'; ?>
                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>

	</body>
</html>

