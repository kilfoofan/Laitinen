//Tämä tiedosto sisältää kaikki javaScript-koodit käyttäjien hallintaa varten
//This file contains all javaScript for handling users

$(document).ready(function() {
  var data, call, url, whereTo;
  var userExists = 1;

  $(
    "#registerDialog, #uInfoDialog, #aInfoDialog, #userDevicesDialog, #adminGetDevicesDialog, #adminDevicesDialog, #adminEditDevicesDialog"
  ).dialog({
    autoOpen: false,
    width: 400,
    modal: true
  });
  //loginia varten, piilotetaan login kentät ja näytetään login tiedot
  //For login, hides logged in fields.

  $("#loggedUser").hide();
  $("#loggedAdmin").hide();
  $("#userinformation").hide();
  $("#adminDevices").hide();
  $("#uDevicesView").hide();
  $("#loginButton").click(function(e) {
    e.preventDefault();
    var sqlData =
      "uname=" +
      $("#usernameLog").val() +
      "&password=" +
      $("#passwordLog").val();
    //data = JSON.stringify(data);
    sqlData += "&save=true";
    var call = "GET";
    var url = "getUser.php";
    var whereTo = "login";
    sqlCall(sqlData, call, url, whereTo);
  });
  //logout
  $("#logoutButtonU, #logoutButtonA").click(function(e) {
    e.preventDefault();
    $("#userDevicesTable").html("");
    $("#adminDevicesTable").html("");
    $("#uDevicesView").hide();
    $("#usernameLog").val("");
    $("#passwordLog").val("");
    $("#login").show();
    $("#infoname, #infoaddress, #infousername, #infopassword, #infophone").val(
      ""
    );
    $("#loggedUser, #loggedAdmin").hide();
  });
  //login jatkuu, tässä tarkastetaan, että onko tietokannassa käyttäjää
  //login continues, here it is checked if the user exists in the database
  function login(response) {
    console.log("return: " + response);
    response = JSON.parse(response);
    //console.log("donessa:" + response[0].name);
    if (response.length > 0) {
      if (response[0].isAdmin == 0) {
        $("#login").hide();
        setUserInfo(response);
        $("#loggedUser").show();
      } else {
        $("#login").hide();
        setUserInfo(response);
        $("#loggedAdmin").show();
      }
    } else {
      alert("Username and/or password is incorrect!");
    }
  }

  //Loginia varten loppuu
  //End of login

  //rekisteröintiä varten
  //for registration
  $("#register").click(function(e) {
    e.preventDefault();
    $("#registerDialog").dialog("open");
  });
  $("#cancelButton").click(function(e) {
    e.preventDefault();
    $("#name, #address, #uname, #password1, #password2, #phone").val("");
    $("#registerDialog").dialog("close");
  });

  $("#regButton").click(function(e) {
    e.preventDefault();
    //Tarkistetaan, että kaikki arvot ovat syötetty.
    //Checks if all the fields are filled
    if (
      $("#name").val() != "" &&
      $("#address").val() != "" &&
      $("#uname").val() != "" &&
      $("#password1").val() != "" &&
      $("#password2").val() != "" &&
      $("#phone").val() != ""
    ) {
      console.log("onnistui");
      checkUser($("#uname").val(), 1); //tarkistetaan onko uusi käyttis. Checks if the username exists already
    } else {
      alert("All fields are required");
    }
  });
  //tarkistetaan, että löytyykö käyttäjänimi jo tietokannasta
  //funktiota käytetään kaksi kertaa. Ensimmäisellä kerralla etsitään tietokannasta käyttäjänimi
  //toisella kerralla tarkistetaan, että tuleeko tietokannasta tulosta.
  //Checks if the username already exists
  //Function is run twice. The first run triggers the database query. The 2nd run checks if a the query gives a result
  function checkUser(check, times) {
    if (times == 1) {
      console.log(check);
      var sqlData = "uname=" + check;
      var call = "GET";
      var url = "checkUser.php";
      var whereTo = "check";
      sqlCall(sqlData, call, url, whereTo);
    } else {
      if (check.length == 0) {
        if ($("#password1").val() == $("#password2").val()) {
          var sqlData = {
            name: $("#name").val(),
            address: $("#address").val(),
            uname: $("#uname").val(),
            password: $("#password1").val(),
            phone: $("#phone").val()
          };
          var call = "POST";
          var url = "insertUser.php";
          var whereTo = "register";
          console.log("checkUser:n rekisteri: " + sqlData);
          sqlCall(sqlData, call, url, whereTo);
          console.log("salasanat ovat samat");
        } else {
          alert("Passwords don't match!");
        }
      } else {
        alert("Username is already reserved");
      }
    }
  }

  function register(response) {
    console.log("registerissä ollaan");
    //$("#ilmotus").innerHTML = "<p>rekisteröinti onnistui</p>";
    console.log("rekisteröinti");
    $("#name, #address, #uname, #password1, #password2, #phone").val("");
    $("#registerDialog").dialog("close");
  }
  //rekisteröintiä varten loppuu
  //end of registration

  //tietojen päivitystä varten
  //updating user information
  $("#uInfoButton, #aInfoButton").click(function(e) {
    e.preventDefault();
    setUserUInfo();
    $("#uInfoDialog").dialog("open");
  });

  $("#uinfocancelButton").click(function(e) {
    e.preventDefault();
    $("#uInfoDialog").dialog("close");
  });
  $("#uinfoUButton").click(function(e) {
    e.preventDefault();
    if ($("#uinfopassword1").val() == $("#uinfopassword2").val()) {
      var sqlData = "";
      if ($("#uinfoname").val() != "") {
        sqlData += "name=" + $("#uinfoname").val();
      } else {
        sqlData += "name=''";
      }
      if ($("#uinfoaddress").val() != "") {
        sqlData += "&address=" + $("#uinfoaddress").val();
      } else {
        sqlData += "address=''";
      }
      if ($("#uinfouname").val() != "") {
        sqlData += "&uname=" + $("#uinfouname").val();
      } else {
        sqlData += "uname=''";
      }
      if ($("#uinfopassword1").val() != "") {
        sqlData += "&password=" + $("#uinfopassword1").val();
      } else {
        sqlData += "password=''";
      }
      if ($("#uinfophone").val() != "") {
        sqlData += "&phone=" + $("#uinfophone").val();
      } else {
        sqlData += "phone=''";
      }
      sqlData += "&save=true";
      var call = "GET";
      var url = "updateUser.php";
      var whereTo = "update";
      // console.log("checkUser:n rekisteri: " + sqlData);
      sqlCall(sqlData, call, url, whereTo);
    } else {
      alert("Passwords don't match!");
    }
  });

  function UpdatedUser(response) {
    setUserInfo2(response);
  }
  //päivitys päättyy
  //end of update

  //Admin alkaa
  //Admin control begins
  $("#aDeviceButton").click(function(e) {
    e.preventDefault();
    $("#adminDevices").show();
  });

  $("#aDeviceButton").click(function(e) {
    e.preventDefault();
    getCategories(1, null);
    getOwners(1, null);
    $("#adminGetDevicesDialog").dialog("open");
  });

  $("#aCancelDevButton").click(function(e) {
    e.preventDefault();
    $("#adminDevicesDialog").dialog("close");
  });

  $("#aGetDevButton").click(function(e) {
    e.preventDefault();
    $("#aDevicesTable").html("");
    var sqlData = "";
    if ($("#aGetdevicename").val() != "") {
      sqlData += "name=" + $("#aGetdevicename").val();
    } /*else {
      sqlData += "name=''";
    }*/
    if ($("#aGetdevicemodel").val() != "") {
      sqlData += "&model=" + $("#aGetdevicemodel").val();
    } /*else {
      sqlData += "&model=''";
    }*/
    if ($("#aGetdevicemake").val() != "") {
      sqlData += "&make=" + $("#aGetdevicemake").val();
    } /*else {
      sqlData += "&make=''";
    }*/
    /*if ($("#udevicedescription").val() != "") {
      sqlData += "&description=" + $("#udevicedescription").val();
    } else {
      sqlData += "&description=''";
    }*/
    if ($("#aGetdevicelocation").val() != "") {
      sqlData += "&location=" + $("#aGetdevicelocation").val();
    } /*else {
      sqlData += "&location=''";
    }*/
    if ($("#aGetdevicecategory").val() != "") {
      sqlData += "&category=" + $("#aGetdevicecategory").val();
    } /*else {
      sqlData += "&category=''";
    }*/
    if ($("#aGetdeviceowner").val() != "") {
      sqlData += "&owner=" + $("#aGetdeviceowner").val();
    } /*else {
      sqlData += "&owner=''";
    }*/
    if ($("#aGetdeviceserial").val() != "") {
      sqlData += "&serial=" + $("#aGetdeviceserial").val();
    } /*else {
      sqlData += "&serial=''";
    }*/
    sqlData += "&save=true";
    var call = "GET";
    var url = "getDevice.php";
    var whereTo = "aGetDevices";
    sqlCall(sqlData, call, url, whereTo);
  });

  $("#aGetCancelDevButton").click(function(e) {
    e.preventDefault();
    $("#adminGetDevicesDialog").dialog("close");
  });

  $("#addDeviceButton").click(function(e) {
    e.preventDefault();
    getCategories(1, null);
    getOwners(1, null);
    $("#adminDevicesDialog").dialog("open");
  });

  $("#aAddDevButton").click(function(e) {
    e.preventDefault();

    if (
      $("#adevicename").val() != "" &&
      $("#adevicemodel").val() != "" &&
      $("#adevicemake").val() != "" &&
      $("#adevicedescription").val() != "" &&
      $("#adevicelocation").val() != "" &&
      $("#adeviceowner").val() != "" &&
      $("#adevicecategory").val() != "" &&
      $("#adeviceserial").val() != ""
    ) {
      console.log("onnistui");
      checkDevice($("#adeviceserial").val(), 1); //tarkistetaan onko uusi laite. Checks if the device exists already
    } else {
      alert("All fields are required");
    }
  });

  function checkDevice(check, times) {
    if (times == 1) {
      console.log(check);
      var sqlData = "serial=" + check;
      var call = "GET";
      var url = "checkDevice.php";
      var whereTo = "checkDevice";
      sqlCall(sqlData, call, url, whereTo);
    } else {
      if (check.length == 0) {
        var sqlData = {
          name: $("#adevicename").val(),
          model: $("#adevicemodel").val(),
          make: $("#adevicemake").val(),
          description: $("#adevicedescription").val(),
          location: $("#adevicelocation").val(),
          owner: $("#adeviceowner").val(),
          category: $("#adevicecategory").val(),
          serial: $("#adeviceserial").val()
        };
        var call = "POST";
        var url = "insertDevice.php";
        var whereTo = "addDevice";
        console.log("checkUser:n rekisteri: " + sqlData);
        sqlCall(sqlData, call, url, whereTo);
      } else {
        alert("Device already exists");
      }
    }
  }
  function addDevice(deviceData) {
    $(
      "#adevicename, #adevicemodel, #adevicemake, #adevicedescription, #adevicelocation, #adeviceowner, #adevicecategory, #adeviceserial"
    ).val("");
    $("#adminDevicesDialog").dialog("close");
  }
  $(document).on("click", "button.remove", function(e) {
    var sqlData = "id=" + e.target.id;
    var call = "GET";
    var url = "deleteDevice.php";
    var whereTo = null;
    sqlCall(sqlData, call, url, whereTo);
    var table = document.getElementById("adminDevicesTable");
    table.deleteRow(parseInt(e.target.name) + 1);
  });

  $(document).on("click", "button.edit", function(e) {
    $(
      "#aEditdevicename, #aEditdevicemodel, #aEditdevicemake, #aEditdevicedescription, #aEditdevicelocation, #aEditdeviceserial"
    ).val("");
    getCategories(1, null);
    getOwners(1, null);
    setEditFields(e.target.id, 1);
    $("#adminEditDevicesDialog").dialog("open");
  });

  function setEditFields(deviceData, times) {
    if (times == 1) {
      var sqlData = "id=" + deviceData;
      var call = "GET";
      var url = "getDevice";
      var whereTo = "editFields";
      sqlData += "&save=true";
      sqlCall(sqlData, call, url, whereTo);
    } else {
      $("#aEditdeviceID").val(deviceData[0].ID);
      $("#aEditdevicename").val(deviceData[0].name);
      $("#aEditdevicemodel").val(deviceData[0].model);
      $("#aEditdevicemake").val(deviceData[0].make);
      $("#aEditdevicedescription").val(deviceData[0].description);
      $("#aEditdevicelocation").val(deviceData[0].location);
      $("#aEditdeviceowner").val(deviceData[0].owner);
      $("#aEditdevicecategory").val(deviceData[0].category);
      $("#aEditdeviceserial").val(deviceData[0].serial);
    }
  }

  function UpdatedDev(response) {
    $("#adminEditDevicesDialog").dialog("close");
  }

  $("#aEditDevButton").click(function(e) {
    e.preventDefault();
    var sqlData = "id=" + $("#aEditdeviceID").val();
    if ($("#aEditdevicename").val() != "") {
      sqlData += "&name=" + $("#aEditdevicename").val();
    } else {
      sqlData += "&name=''";
    }
    if ($("#aEditdevicemodel").val() != "") {
      sqlData += "&model=" + $("#aEditdevicemodel").val();
    } else {
      sqlData += "&model=''";
    }
    if ($("#aEditdevicemodel").val() != "") {
      sqlData += "&make=" + $("#aEditdevicemake").val();
    } else {
      sqlData += "&make=''";
    }
    if ($("#aEditdevicedescription").val() != "") {
      sqlData += "&description=" + $("#aEditdevicedescription").val();
    } else {
      sqlData += "&description=''";
    }
    if ($("#aEditdevicelocation").val() != "") {
      sqlData += "&location=" + $("#aEditdevicelocation").val();
    } else {
      sqlData += "&location=''";
    }
    if ($("#aEditdeviceowner").val() != "") {
      sqlData += "&owner=" + $("#aEditdeviceowner").val();
    } else {
      sqlData += "&owner=''";
    }
    if ($("#aEditdevicecategory").val() != "") {
      sqlData += "&category=" + $("#aEditdevicecategory").val();
    } else {
      sqlData += "&category=''";
    }
    if ($("#aEditdeviceserial").val() != "") {
      sqlData += "&serial=" + $("#aEditdeviceserial").val();
    } else {
      sqlData += "&serial=''";
    }
    sqlData += "&save=true";
    var call = "GET";
    var url = "updateDevice.php";
    var whereTo = "updateDev";
    // console.log("checkUser:n rekisteri: " + sqlData);
    sqlCall(sqlData, call, url, whereTo);
  });

  function adminShowDevices(devicedata) {
    $("#adminDevicesTable").html("");
    if (devicedata.length != 0) {
      var table = document.getElementById("adminDevicesTable");
      var row = table.insertRow(0);
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      var cell4 = row.insertCell(3);
      var cell5 = row.insertCell(4);
      var cell6 = row.insertCell(5);
      var cell7 = row.insertCell(6);
      var cell8 = row.insertCell(7);
      var cell9 = row.insertCell(8);
      var cell10 = row.insertCell(9);
      var cell11 = row.insertCell(10);
      cell1.innerHTML = "Name";
      cell2.innerHTML = "Model";
      cell3.innerHTML = "Make";
      cell4.innerHTML = "Description";
      cell5.innerHTML = "Owner";
      cell6.innerHTML = "Location";
      cell7.innerHTML = "Category";
      cell8.innerHTML = "Serial";
      cell9.innerHTML = "Reservations";
      for (var i = 0; i < devicedata.length; i++) {
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);
        var cell9 = row.insertCell(8);
        var cell10 = row.insertCell(9);
        var cell11 = row.insertCell(10);
        cell1.innerHTML = devicedata[i].name;
        cell2.innerHTML = devicedata[i].model;
        cell3.innerHTML = devicedata[i].make;
        cell4.innerHTML = devicedata[i].description;
        cell5.innerHTML = devicedata[i].owner;
        cell6.innerHTML = devicedata[i].location;
        cell7.innerHTML = devicedata[i].category;
        cell8.innerHTML = devicedata[i].serial;
        cell9.innerHTML = devicedata[i].Reservations;
        if (devicedata[i].isReserved == 0 || devicedata[i].isOnLoad == 0) {
          cell10.innerHTML =
            "<button " +
            'id="' +
            devicedata[i].ID +
            '" class="remove" name="' +
            i +
            '">Remove</button>';
        } else {
          cell10.innerHTML =
            "<button " +
            'id="' +
            devicedata[i].ID +
            '" class="remove" name="' +
            i +
            '" disabled>Remove</button>';
        }
        cell11.innerHTML =
          "<button " +
          'id="' +
          devicedata[i].ID +
          '" class="edit">Edit</button>';
        //var testi = "<button " +'id="' + data[i].avain + '">testi</button>';
        //cell9.innerHTML = "<button " +'id="' + data[i].avain + '" class="poista(' + data[i].avain + "," + i + ')">poista</button>';
      }
      $("#adminGetDevicesDialog").dialog("close");
      $("#aDevicesView").show();
      $(
        "#aGetDevicename, #aGetDevicemodel, #aGetDevicemake, #aGetDevicecategory, #aGetDeviceowner, #aGetDevicelocation, #aGetDeviceserial"
      ).val("");
    }
  }

  //admin päättyy
  //Admin control ends

  //User alkaa
  //User control begins
  $("#uDeviceButton").click(function(e) {
    e.preventDefault();
    ugetCategories(1, null);
    ugetOwners(1, null);
    $("#userDevicesDialog").dialog("open");
  });

  $("#uCancelDevButton").click(function(e) {
    e.preventDefault();
    $("#userDevicesDialog").dialog("close");
  });

  $("#uGetDevButton").click(function(e) {
    e.preventDefault();
    $("#userDevicesTable").html("");
    var sqlData = "";
    if ($("#udevicename").val() != "") {
      sqlData += "name=" + $("#udevicename").val();
    } /*else {
      sqlData += "name=''";
    }*/
    if ($("#udevicemodel").val() != "") {
      sqlData += "&model=" + $("#udevicemodel").val();
    } /*else {
      sqlData += "&model=''";
    }*/
    if ($("#udevicemake").val() != "") {
      sqlData += "&make=" + $("#udevicemake").val();
    } /*else {
      sqlData += "&make=''";
    }*/
    /*if ($("#udevicedescription").val() != "") {
      sqlData += "&description=" + $("#udevicedescription").val();
    } else {
      sqlData += "&description=''";
    }*/
    if ($("#udevicelocation").val() != "") {
      sqlData += "&location=" + $("#udevicelocation").val();
    } /*else {
      sqlData += "&location=''";
    }*/
    if ($("#udevicecategory").val() != "") {
      sqlData += "&category=" + $("#udevicecategory").val();
    } /*else {
      sqlData += "&category=''";
    }*/
    if ($("#udeviceowner").val() != "") {
      sqlData += "&owner=" + $("#udeviceowner").val();
    } /*else {
      sqlData += "&owner=''";
    }*/
    if ($("#udeviceserial").val() != "") {
      sqlData += "&serial=" + $("#udeviceserial").val();
    } /*else {
      sqlData += "&serial=''";
    }*/
    sqlData += "&save=true";
    var call = "GET";
    var url = "getDevice.php";
    var whereTo = "uGetDevices";
    sqlCall(sqlData, call, url, whereTo);
  });

  function userShowDevices(devicedata) {
    $("#userDevicesTable").html("");
    if (devicedata.length != 0) {
      var table = document.getElementById("userDevicesTable");
      var row = table.insertRow(0);
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      var cell4 = row.insertCell(3);
      var cell5 = row.insertCell(4);
      var cell6 = row.insertCell(5);
      var cell7 = row.insertCell(6);
      var cell8 = row.insertCell(7);
      var cell9 = row.insertCell(8);
      cell1.innerHTML = "Name";
      cell2.innerHTML = "Model";
      cell3.innerHTML = "Make";
      cell4.innerHTML = "Description";
      cell5.innerHTML = "Owner";
      cell6.innerHTML = "Location";
      cell7.innerHTML = "Category";
      cell8.innerHTML = "Serial";
      for (var i = 0; i < devicedata.length; i++) {
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);
        var cell9 = row.insertCell(8);
        cell1.innerHTML = devicedata[i].name;
        cell2.innerHTML = devicedata[i].model;
        cell3.innerHTML = devicedata[i].make;
        cell4.innerHTML = devicedata[i].description;
        cell5.innerHTML = devicedata[i].owner;
        cell6.innerHTML = devicedata[i].location;
        cell7.innerHTML = devicedata[i].category;
        cell8.innerHTML = devicedata[i].serial;
        cell9.innerHTML = "<button>Reserve</button";
        //var testi = "<button " +'id="' + data[i].avain + '">testi</button>';
      }
      $("#userDevicesDialog").dialog("close");
      $("#uDevicesView").show();
      $(
        "#uGetDevicename, #uGetDevicemodel, #uGetDevicemake, #uGetDevicecategory, #uGetDeviceowner, #uGetDevicelocation, #uGetDeviceserial"
      ).val("");
    }
  }
  //User päättyy
  //User control ends

  //apufunktioita
  //helper functions
  function sqlCall(sqlData, call, url, whereTo) {
    console.log("sqlCall-funktiossa: " + sqlData);
    $.ajax({
      type: call,
      url: url,
      data: sqlData,
      success: function(res) {
        //console.log("onnistui: " + res);
      }
    })
      .done(function(data, status, jqXHR) {
        //console.log("sqlCall: " + data);
        if (whereTo == "login") {
          login(data);
        }
        if (whereTo == "register") {
          register(data);
        }
        if (whereTo == "check") {
          data = JSON.parse(data);
          checkUser(data, 0);
        }
        if (whereTo == "update") {
          //data = JSON.parse(data);
          UpdatedUser(data);
        }
        if (whereTo == "checkDevice") {
          data = JSON.parse(data);
          checkDevice(data, 0);
        }
        if (whereTo == "addDevice") {
          addDevice(data);
        }
        if (whereTo == "getCategories") {
          data = JSON.parse(data);
          getCategories(0, data);
        }
        if (whereTo == "getOwners") {
          data = JSON.parse(data);
          getOwners(0, data);
        }
        if (whereTo == "ugetCategories") {
          data = JSON.parse(data);
          ugetCategories(0, data);
        }
        if (whereTo == "ugetOwners") {
          data = JSON.parse(data);
          ugetOwners(0, data);
        }
        if (whereTo == "uGetDevices") {
          data = JSON.parse(data);
          userShowDevices(data);
        }
        if (whereTo == "aGetDevices") {
          data = JSON.parse(data);
          adminShowDevices(data);
        }
        if (whereTo == "editFields") {
          data = JSON.parse(data);
          setEditFields(data, 0);
        }
        if (whereTo == "updateDev") {
          //data = JSON.parse(data);
          UpdatedDev(data);
        }
      })
      .fail(function(jqXHR, textStatus, errorThrown) {
        console.log("failessa");
      });
  }

  function getCategories(times, deviceData) {
    if (times == 1) {
      var sqlData = { name: "name" };
      var call = "GET";
      var url = "getCategories.php";
      var whereTo = "getCategories";
      sqlCall(sqlData, call, url, whereTo);
    } else {
      var categories = '<select id="adevicecategory">';
      for (var i = 0; i < deviceData.length; i++) {
        categories =
          categories +
          '<option value="' +
          deviceData[i].shortname +
          '">' +
          deviceData[i].name +
          "</option>";
      }
      var categories2 = '<select id="aGetdevicecategory">';
      categories2 = categories2 + '<option value="">All</option>';
      for (var i = 0; i < deviceData.length; i++) {
        categories2 =
          categories2 +
          '<option value="' +
          deviceData[i].shortname +
          '">' +
          deviceData[i].name +
          "</option>";
      }
      categories3 = categories3 + "</select>";
      var categories3 = '<select id="aEditdevicecategory">';
      for (var i = 0; i < deviceData.length; i++) {
        categories3 =
          categories3 +
          '<option value="' +
          deviceData[i].shortname +
          '">' +
          deviceData[i].name +
          "</option>";
      }
      categories3 = categories3 + "</select>";
      $("#aTempCat").html(categories);
      $("#aGetTempCat").html(categories2);
      $("#aEditTempCat").html(categories3);
    }
  }

  function ugetCategories(times, deviceData) {
    if (times == 1) {
      //var sqlData = { name: "name" };
      var call = "GET";
      var url = "getCategories.php";
      var whereTo = "ugetCategories";
      var sqlData = "&save=true";
      sqlCall(sqlData, call, url, whereTo);
    } else {
      var categories = '<select id="udevicecategory">';
      categories = categories + '<option value="">All</option>';
      for (var i = 0; i < deviceData.length; i++) {
        categories =
          categories +
          '<option value="' +
          deviceData[i].shortname +
          '">' +
          deviceData[i].name +
          "</option>";
      }
      categories = categories + "</select>";

      $("#uTempCat").html(categories);
    }
  }

  function getOwners(times, ownerData) {
    if (times == 1) {
      //var sqlData = { name: "name" };
      var call = "GET";
      var url = "getOwners.php";
      var whereTo = "getOwners";
      var sqlData = "&save=true";
      sqlCall(sqlData, call, url, whereTo);
    } else {
      var owners = '<select id="adeviceowner">';
      for (var i = 0; i < ownerData.length; i++) {
        owners =
          owners +
          '<option value="' +
          ownerData[i].shortname +
          '">' +
          ownerData[i].name +
          "</option>";
      }
      var owners2 = '<select id="aGetdeviceowner">';
      owners2 += '<option value="">Any</option>';
      for (var i = 0; i < ownerData.length; i++) {
        owners2 =
          owners2 +
          '<option value="' +
          ownerData[i].shortname +
          '">' +
          ownerData[i].name +
          "</option>";
      }
      var owners3 = '<select id="aEditdeviceowner">';
      for (var i = 0; i < ownerData.length; i++) {
        owners3 =
          owners3 +
          '<option value="' +
          ownerData[i].shortname +
          '">' +
          ownerData[i].name +
          "</option>";
      }
      owners = owners + "</select>";
      owners2 = owners2 + "</select>";
      owners3 = owners3 + "</select>";

      $("#aTempOwner").html(owners);
      $("#aGetTempOwner").html(owners2);
      $("#aEditTempOwner").html(owners3);
    }
  }
  function ugetOwners(times, ownerData) {
    if (times == 1) {
      //var sqlData = { name: "name" };
      var call = "GET";
      var url = "getOwners.php";
      var whereTo = "ugetOwners";
      var sqlData = "&save=true";
      sqlCall(sqlData, call, url, whereTo);
    } else {
      var owners = '<select id="udeviceowner">';
      owners += '<option value="">Any</option>';
      for (var i = 0; i < ownerData.length; i++) {
        owners =
          owners +
          '<option value="' +
          ownerData[i].shortname +
          '">' +
          ownerData[i].name +
          "</option>";
      }
      owners = owners + "</select>";

      $("#uTempOwner").html(owners);
    }
  }

  function setUserInfo(userdata) {
    $("#infoname").val(userdata[0].name);
    $("#infoaddress").val(userdata[0].address);
    $("#infousername").val(userdata[0].username);
    $("#infopassword").val(userdata[0].password);
    $("#infophone").val(userdata[0].phone);
  }
  function setUserInfo2(userdata) {
    userdata = JSON.parse(userdata);
    $("#infoname").val(userdata[0].name);
    $("#infoaddress").val(userdata[0].address);
    $("#infousername").val(userdata[0].username);
    $("#infopassword").val(userdata[0].password);
    $("#infophone").val(userdata[0].phone);
  }
  function setUserUInfo() {
    userdata = getUserInfo();
    $("#uinfoname").val(userdata.name);
    $("#uinfoaddress").val(userdata.address);
    $("#uinfouname").val(userdata.username);
    $("#uinfopassword1").val(userdata.password);
    $("#uinfopassword2").val(userdata.password);
    $("#uinfophone").val(userdata.phone);
  }
  function getUserInfo() {
    var userdata = {
      name: $("#infoname").val(),
      address: $("#infoaddress").val(),
      username: $("#infousername").val(),
      password: $("#infopassword").val(),
      phone: $("#infophone").val()
    };
    return userdata;
  }
});
