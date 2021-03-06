<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de-de">
<head>
	<meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/> 
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/> 
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/datatables.min.js"></script>  
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $.get('update.txt', function(data) { document.getElementById("update").innerHTML="Aktualisiert: "+data });
            var table = $('#tabelle').DataTable( {
                "processing": true,
                "serverSide": false,
                "ajax": "devices.json",
                "order": [[ 2, "asc" ]],
                "columns": [
                    { data: "" , title: "PM"},
                    { data: "id" },
                    { data: "DeviceName", title: "Name" },
                    { data: "short_name", title: "Benutzer" },
                    { data: "SerialNumber", title: "Seriennummer" },
                    { data: "OSVersion" , title: "OS #"},
                    { data: "last_checkin_time", title: "gesehen" },
                    { data: "is_dep_device" , title: "DEP"},
                    { data: "IsSupervised" , title: "betreut"}
                ],
                "columnDefs": [ 
					{ targets: 0, data: null, defaultContent: "<button>=></button>", width: "30px", orderable: false},
					{ targets: [1], visible: false},
					{ targets: 5, data: "OSVersion",render: function ( data, type, row, meta ) {
							if (data.substr(0, data.indexOf(".")) === "11") { return "<font color='green'>"+data+"</font>";} 
										  else { return "<font color='red'>"+data+"</font>";}}} ,
					{ targets: 6, data: "last_checkin_time",render: function ( data, type, row, meta ) {
							var mydate = new Date(data);
							var today = new Date();
							var formattedDate = data.substr(0, data.lastIndexOf(":")).replace("T"," ", -1);
							if ((today - mydate) < 1000*60*60*24+7) { return "<font color='green'>"+formattedDate+"</font>";} 
										  else { return "<font color='red'>"+formattedDate+"</font>";} }},
					{ targets: 7, data: "is_dep_device",render: function ( data, type, row, meta ) {
							if (data === true) { return "<font color='green'>Ja</font>";} 
										  else { return "<font color='red'>Nein</font>";}}} ,
					{ targets: 8, data: "IsSupervised",render: function ( data, type, row, meta ) {
							if (data === true) { return "<font color='green'>Ja</font>";} 
										  else { return "<font color='red'>Nein</font>";}}}
					]
            } );
            
            $('#tabelle tbody').on( 'click', 'button', function () {
                    var data = table.row( $(this).parents('tr') ).data();
                    var win = window.open("https://boehm.gl/profilemanager/#/device/"+data.id+"/", '_blank');
                    win.focus();
                } );

        } );

    </script>
</head>
<body>
<div style="margin-top: margin: 0px; width: 100%; top: 50%; height: 42px; background-color: black; position: relative">
	<div style="margin-top: 0px; left: 70px; height: 32px; ">
		<img src="images/PM.png" style="position: absolute; left: 10px; top: 5px; width: 32px; height: 32px; ">
	</div>
	<div style="position: absolute; left: 50px; top: 10px; width: 50%; height: 32px; font-size: 19px; color: #ddd;">Profilmanager Übersichtsliste</div>
	<div id="update"  style="position: absolute; right: 200px; top: 15px; width: 300px; height: 32px; font-size: 14px; color: #ddd;"></div>
<div id="user"  style="position: absolute; right: 10px; top: 15px; width: 190px; height: 32px; font-size: 14px; color: #ddd;">Angemeldet: <?php echo $_SERVER['REMOTE_USER'];?></div>	
</div>
<div class="col-sm-12" style="margin-top: 10px;">
<table id="tabelle" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">        
	<thead><tr></tr></thead>
     </table>
</div>
</body>
</html>

