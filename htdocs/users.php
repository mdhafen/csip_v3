<!DOCTYPE html>
<html>
	<head>
	<?php include 'head.php';?>
	</head>
	<body>
		<?php include 'menu.php'; ?>
        
        <div class="uk-container uk-container-center uk-animation-fade">
            <br>
<div class="uk-panel uk-panel-box uk-panel-box-primary">
            <h3>Add New User</h3>
<table width="100%">
    <tr>    
        <td><form class="uk-form uk-form-width-small"><input type="text" placeholder="First Name"></form></td>
        <td><form class="uk-form uk-form-width-small"><input type="text" placeholder="Last Name"></form></td>
        <td><form class="uk-form uk-form-width-small"><input type="text" placeholder="User Name"></form></td>
        <td><form class="uk-form uk-form-width-small"><input type="password" placeholder="Password"></form></td>
        <td><form class="uk-form uk-form-width-small"><input type="password" placeholder="Password"></form></td>
        <td>
            <form class="uk-form">
            <select class="uk-form">
                <option>Role Selection</option>
                <option>...</option>
            </select>
            </form>
        </td>
        <td>
            <button class="uk-button" data-uk-modal="{target:'#location'}">Set Location</button>

        </td>
        
        <td>
            <button class="uk-button uk-button-success" type="button">Add</button>
        </td>
    </tr>
</table>
    </div>
              <br><br>
          <h2>User Management</h2>
        Total Users: 2
<table class="uk-table uk-table-striped">
    <tr>
        <th>Real Name</th>
        <th>User Name</th>
        <th>Password</th>
        <th>Roll</th>
        <th>Location</th>
        <th></th> 
    </tr>
    <tr>    
        <td>Bob Sonju</td>
        <td>bsebob</td>
        <td><form class="uk-form uk-form-width-small"><input type="password" placeholder=""></form></td>
                <td>
            <form class="uk-form">
            <select class="uk-form">
                <option>Role Selection</option>
                <option>...</option>
            </select>
            </form>
        </td>
        <td><button class="uk-button" data-uk-modal="{target:'#location'}">Change Location</button>
</td>
        
        <td>
            <button class="uk-button uk-align-right uk-button-success" type="button">Update</button>
            &nbsp;
            <button class="uk-button  uk-align-right uk-button-danger" type="button">Delete</button>
        </td>
    </tr>
    <tr>    
        <td>Bob Sonju</td>
        <td>bsebob</td>
        <td><form class="uk-form uk-form-width-small"><input type="password" placeholder=""></form></td>
                <td>
            <form class="uk-form">
            <select class="uk-form">
                <option>Role Selection</option>
                <option>...</option>
            </select>
            </form>
        </td>
        <td><button class="uk-button" data-uk-modal="{target:'#location'}">Change Location</button>
</td>
        
        <td>
            <button class="uk-button uk-align-right uk-button-success" type="button">Update</button>
            &nbsp;
            <button class="uk-button  uk-align-right uk-button-danger" type="button">Delete</button>
        </td>
    </tr>
</table>
<br>


<!-- This is the modal -->
<div id="location" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        <h3>Set Location</h3>
        <hr>
        <strong>Please select all that apply to this user.</strong><br><br>
        <form class="uk-form">
            <div class="uk-grid">
    <div class="uk-width-1-3"><input type="checkbox" id=""> <label for="">Location 1</label></div>
    <div class="uk-width-1-3"><input type="checkbox" id=""> <label for="">Location 4</label></div>
    <div class="uk-width-1-3"><input type="checkbox" id=""> <label for="">Location 7</label></div>
    <div class="uk-width-1-3"><input type="checkbox" id=""> <label for="">Location 2</label></div>
    <div class="uk-width-1-3"><input type="checkbox" id=""> <label for="">Location 5</label></div>
    <div class="uk-width-1-3"><input type="checkbox" id=""> <label for="">Location 8</label></div>
    <div class="uk-width-1-3"><input type="checkbox" id=""> <label for="">Location 3</label></div>
    <div class="uk-width-1-3"><input type="checkbox" id=""> <label for="">Location 6</label></div>
            </div>
            <hr>
        <button class="uk-button  uk-align-right uk-button-success" type="button">Save</button>
    <br><br>

        </form>
    </div>
</div>
            
            
            
            
            
            <?php include 'footer.php'; ?>
        </div>

	</body>
</html>

