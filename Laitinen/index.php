<?php
//    require 'getUser.php';
//    require 'laitinenConn.php';
?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8" />
    <title>Laitinen</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/Redmond/jquery-ui.css"> <!--themes:n jälkeen teeman nimi-->
    <style>
        .navbar-collapse {
            justify-content: flex-start;
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.10.2.js" type="text/javascript"></script> <!--näiden järjestyksellä on väliä-->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> <!--näiden järjestyksellä on väliä, huom versiot-->
    <script src="user.js"></script> <!--index.php sivun javascriptit-->

</head>
<body>
    <!--navigointi palkki-->
    <nav id="navigation" class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2ff;">
    <div id="programName"><p>Laitinen Device Service</p></div>
        <div id="login" class="container-fluid pt-2">
            <form id="loginForm" name="loginForm" class="form-inline" action="" method="GET">
                <input class="form-control mr-sm-2" type="text" id="usernameLog" name="uname" placeholder="Username" aria-label="Username">
                <input class="form-control mr-sm-2" type="password" id="passwordLog" name="password" placeholder="Password" aria-label="Password">
                <button class="btn btn-outline-success my-2 my-sm-0" name="loginButton" id="loginButton" type="submit">Login</button>
                <button id="register" class="btn btn-outline-success my-2 my-sm-0">Register</button>
            </form>
        </div>

        <div id="loggedUser" class="container-fluid pt-2">
            <p id="user">
                User
            </p>
            <form id="logoutU" class="form-inline" action="">
                <button class="btn btn-outline-success my-2 my-sm-1" name="uDeviceButton" id="uDeviceButton">Devices</button>
                <button class="btn btn-outline-success my-2 my-sm-1" name="uInfoButton" id="uInfoButton">User Information</button>
                <button class="btn btn-outline-success my-2 my-sm-1" type="submit" id="logoutButtonU">Logout</button>
            </form>
        </div>

        <div id="loggedAdmin" class="container-fluid pt-2">
            <p id="admin">
                Admin
            </p>
            <form id="logoutA" class="form-inline" action="">
                <button id="addDeviceButton" class="btn btn-outline-success my-2 my-sm-0">Add Device</button>
                <button id="aDeviceButton" class="btn btn-outline-success my-2 my-sm-0">Get Devices</button>
                <button class="btn btn-outline-success my-2 my-sm-0" name="aInfoButton" id="aInfoButton">User Information</button>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="logoutButtonA">Logout</button>
            </form>
        </div>
    </nav>
    <!--Navigointipalkki päättyy-->
    <!--Pääalue alkaa-->
    <div id="mainArea">
        <!--
        <div id="adminDevices">
            <form id="adminDeviceButtons" action="">
                <button id="addDevice" class="btn btn-outline-success my-2 my-sm-0">Add Device</button>
            </form>
        </div>
    -->
        <div id="userDevices">
        </div>
    <!--Dialogs-->
    <!--User registration dialogs-->
        <div id="registerDialog" style="background-color: #e3f2ff;">
            <form id="regForm" action="" method="POST">
            <table>
                <tr>            
                <td><label for="name">Name</label></td>
                <td><input id="name" type="text" name="name"></td>
                </tr><tr> 
                <td><label for="address">Address</label></td>
                <td><input id="address" type="text" name="address"></td>
                </tr><tr>
                <td><label for="username">Username</label></td>
                <td><input id="uname" type="text" name="uname"></td>
                </tr><tr>
                <td><label for="password1">Password</label></td>
                <td><input id="password1" type="password" name="password1"></td>
                </tr><tr>
                <td><label for="password2">Retype Password</label></td>
                <td><input id="password2" type="password" name="password2"></td>
                </tr><tr>
                <td><label for="phone">Phone</label></td>
                <td><input id="phone" type="number" name="phone"></td>
                </tr>
                <tr>
                <td><button name="save" id="regButton" class="btn btn-outline-success my-2 my-sm-0">Register</button></td>
                <td><button name="cancel" id="cancelButton" class="btn btn-outline-success my-2 my-sm-0">Cancel</button></td>
                </tr>
            </table>
            </form>
        </div>
        <!--User information dialog-->
        <div id="uInfoDialog" style="background-color: #e3f2ff;">
            <form id="uInfoForm" action="" method="POST">
            <table>
                <tr>            
                <td><label for="uinfoname">Name</label></td>
                <td><input id="uinfoname" type="text" name="uinfoname"></td>
                </tr><tr> 
                <td><label for="uinfoaddress">Address</label></td>
                <td><input id="uinfoaddress" type="text" name="uinfoaddress"></td>
                </tr><tr>
                <td><label for="uinfousername">Username</label></td>
                <td><input id="uinfouname" type="text" name="uinfouname" disabled></td>
                </tr><tr>
                <td><label for="uinfopassword1">Password</label></td>
                <td><input id="uinfopassword1" type="password" name="uinfopassword1"></td>
                </tr><tr>
                <td><label for="uinfopassword2">Retype Password</label></td>
                <td><input id="uinfopassword2" type="password" name="uinfopassword2"></td>
                </tr><tr>
                <td><label for="uinfophone">Phone</label></td>
                <td><input id="uinfophone" type="number" name="uinfophone"></td>
                </tr>
                <tr>
                <td><button name="save" id="uinfoUButton" class="btn btn-outline-success my-2 my-sm-0">Update</button></td>
                <td><button name="cancel" id="uinfocancelButton" class="btn btn-outline-success my-2 my-sm-0">Cancel</button></td>
                </tr>
            </table>
            </form>
        </div>
        <!--User devices get dialog-->
        <div id="userDevicesDialog">
            <form id="userDevicesForm" action="">
            <table>
                <tr>            
                <td><label for="udevicename">Name</label></td>
                <td><input id="udevicename" type="text" name="name"></td>
                </tr><tr> 
                <td><label for="udevicemodel">Model</label></td>
                <td><input id="udevicemodel" type="text" name="model"></td>
                </tr><tr>
                <td><label for="udevicemake">Make</label></td>
                <td><input id="udevicemake" type="text" name="make"></td>
                <!--
                </tr><tr>
                <td><label for="devicedescription">Description</label></td>
                <td><textarea rows="4" cols="22" id="devicedescription" name="description" form="userDeviceForm"></textarea></td>
                <td><input id="devicedescription" type="text" name="uinfopassword1"></td>-->
                </tr><tr>
                <td><label for="udevicelocation">Location</label></td>
                <td><input id="udevicelocation" type="text" name="location"></td>
                </tr><tr>
                <td><label for="udeviceowner">Owner</label></td>
                <td><p id="uTempOwner"></p></td>
                <!--<td><input id="udeviceowner" type="text" name="owner"></td>-->
                </tr><tr>
                <td><label for="udevicecategory">Category</label></td>
                <td><p id="uTempCat"></p></td>
                <!--<td><input id="udevicecategory" type="text" name="category"></td>-->
                </tr><tr>
                <td><label for="udeviceserial">Serialnumber</label></td>
                <td><input id="udeviceserial" type="number" name="serial"></td>
                </tr>
                <tr>
                <td><button name="save" id="uGetDevButton" class="btn btn-outline-success my-2 my-sm-0">Search</button></td>
                <td><button name="cancel" id="uCancelDevButton" class="btn btn-outline-success my-2 my-sm-0">Cancel</button></td>
                </tr>
            </table>
            </form>
        </div>
        <!--admin devices get dialog-->
        <div id="adminGetDevicesDialog">
            <form id="adminGetDevicesForm" action="">
            <table>
                <tr>            
                <td><label for="aGetdevicename">Name</label></td>
                <td><input id="aGetdevicename" type="text" name="name"></td>
                </tr><tr> 
                <td><label for="aGetdevicemodel">Model</label></td>
                <td><input id="aGetdevicemodel" type="text" name="model"></td>
                </tr><tr>
                <td><label for="aGetdevicemake">Make</label></td>
                <td><input id="aGetdevicemake" type="text" name="make"></td>
                <!--
                </tr><tr>
                <td><label for="devicedescription">Description</label></td>
                <td><textarea rows="4" cols="22" id="devicedescription" name="description" form="userDeviceForm"></textarea></td>
                <td><input id="devicedescription" type="text" name="uinfopassword1"></td>-->
                </tr><tr>
                <td><label for="aGetdevicelocation">Location</label></td>
                <td><input id="aGetdevicelocation" type="text" name="location"></td>
                </tr><tr>                
                <td><label for="aGetdeviceowner">Owner</label></td>
                <td><p id="aGetTempOwner"></p>
                <!--<td><input id="adeviceowner" name="owner"></td>-->
                </tr><tr>
                <td><label for="aGetdevicecategory">Category</label></td>
                <td><p id="aGetTempCat"></p>
                <!--<td><input id="adevicecategory" type="text" name="category"></td>-->
                </tr><tr>
                <td><label for="aGetdeviceserial">Serialnumber</label></td>
                <td><input id="aGetdeviceserial" type="number" name="serial"></td>
                </tr>
                <tr>
                <td><button name="save" id="aGetDevButton" class="btn btn-outline-success my-2 my-sm-0">Search</button></td>
                <td><button name="cancel" id="aGetCancelDevButton" class="btn btn-outline-success my-2 my-sm-0">Cancel</button></td>
                </tr>
            </table>
            </form>
        </div>
        <!--admin devices add dialog-->
        <div id="adminDevicesDialog">
            <form id="adminDevicesForm" action="">
            <table>
                <tr>            
                <td><label for="adevicename">Name</label></td>
                <td><input id="adevicename" type="text" name="name"></td>
                </tr><tr> 
                <td><label for="adevicemodel">Model</label></td>
                <td><input id="adevicemodel" type="text" name="model"></td>
                </tr><tr>
                <td><label for="adevicemake">Make</label></td>
                <td><input id="adevicemake" type="text" name="make"></td>
                </tr><tr>
                <td><label for="adevicedescription">Description</label></td>
                <td><textarea rows="4" cols="19" id="adevicedescription" name="description" form="userDeviceForm"></textarea></td>
                <!--<td><input id="devicedescription" type="text" name="uinfopassword1"></td>-->
                </tr><tr>
                <td><label for="adevicelocation">Location</label></td>
                <td><input id="adevicelocation" type="text" name="location"></td>
                </tr><tr>
                <td><label for="adeviceowner">Owner</label></td>
                <td><p id="aTempOwner"></p>
                <!--<td><input id="adeviceowner" name="owner"></td>-->
                </tr><tr>
                <td><label for="adevicecategory">Category</label></td>
                <td><p id="aTempCat"></p>
                <!--<td><input id="adevicecategory" type="text" name="category"></td>-->
                </tr><tr>
                <td><label for="adeviceserial">Serialnumber</label></td>
                <td><input id="adeviceserial" type="number" name="serial"></td>
                </tr>
                <tr>
                <td><button name="save" id="aAddDevButton" class="btn btn-outline-success my-2 my-sm-0">Add</button></td>
                <td><button name="cancel" id="aCancelDevButton" class="btn btn-outline-success my-2 my-sm-0">Cancel</button></td>
                </tr>
            </table>
            </form>
        </div>
        <!--admin devices edit dialog-->
        <div id="adminEditDevicesDialog">
            <form id="adminEditDevicesForm" action="">
            <table>
                <input id="aEditdeviceID" type="hidden">
                <tr>            
                <td><label for="aEditdevicename">Name</label></td>
                <td><input id="aEditdevicename" type="text" name="name"></td>
                </tr><tr> 
                <td><label for="aEditdevicemodel">Model</label></td>
                <td><input id="aEditdevicemodel" type="text" name="model"></td>
                </tr><tr>
                <td><label for="aEditdevicemake">Make</label></td>
                <td><input id="aEditdevicemake" type="text" name="make"></td>
                </tr><tr>
                <td><label for="aEditdevicedescription">Description</label></td>
                <td><textarea rows="4" cols="19" id="aEditdevicedescription" name="description" form="userDeviceForm"></textarea></td>
                <!--<td><input id="devicedescription" type="text" name="uinfopassword1"></td>-->
                </tr><tr>
                <td><label for="aEditdevicelocation">Location</label></td>
                <td><input id="aEditdevicelocation" type="text" name="location"></td>
                </tr><tr>
                <td><label for="aEditdeviceowner">Owner</label></td>
                <td><p id="aEditTempOwner"></p>
                <!--<td><input id="adeviceowner" name="owner"></td>-->
                </tr><tr>
                <td><label for="aEditdevicecategory">Category</label></td>
                <td><p id="aEditTempCat"></p>
                <!--<td><input id="adevicecategory" type="text" name="category"></td>-->
                </tr><tr>
                <td><label for="aEditdeviceserial">Serialnumber</label></td>
                <td><input id="aEditdeviceserial" type="number" name="serial"></td>
                </tr>
                <tr>
                <td><button name="save" id="aEditDevButton" class="btn btn-outline-success my-2 my-sm-0">Edit</button></td>
                <td><button name="cancel" id="aEditCancelDevButton" class="btn btn-outline-success my-2 my-sm-0">Cancel</button></td>
                </tr>
            </table>
            </form>
        </div>
        <!--Dialogs end-->
        <div id="ilmotus"></div>
        <div id="uDevicesView">
        <table id="userDevicesTable" border=true></table>
        </div>

        <div id="aDevicesView">
        <table id="adminDevicesTable" border=true></table>
        </div>
    </div>
    <!--Pääalue loppuu-->
    <!--tietojen tallennus-->
    <div id="userinformation">
        <form id="information">
            <input type="text" id="infoname">
            <input type="text" id="infoaddress">
            <input type="text" id="infopassword">
            <input type="text" id="infousername">
            <input type="number" id="infophone">
    </form> 
    </div>
</body>
</html>