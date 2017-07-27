<?php


	require_once 'lib_waktu.php';
	require_once 'lib_sql.php';
	require_once 'lib_config.php';
	require_once 'lib_koni.php';
	require_once 'lib_monitor.php';
	
	//error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name = "viewport" content = "width=device-width, maximum-scale = 1, minimum-scale=1" />
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="apple-touch-icon" href="img/favicon.png">
<link type="text/css" href="css/konilanding.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="js/jquery.innerfade.js"></script>

<script src="js/jcarousellite_1.0.1c4.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
			setInterval(function() {
			        $('#totalMedali').load('xml_head_total_medali.php?',function () { 
			        });
			 }, 3000); 	
			setInterval(function() {
			        $('#list_medali').load('xml_head_list_medali.php?',function () { 
			        });			        
			 }, 5000); 		
			setInterval(function() {
			        $('#list_kontingen').load('xml_kontingen.php?',function () {
			        });			        
			 }, 3000); 	
			setInterval(function() {
			        $('#breakingnews').load('xml_breaking_news.php?',function () { 
			        });			        
			 }, 10000); 				 	
});
</script>


<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<script src="js/respond.min.js"></script>
<![endif]-->
<title>Situs Online Resmi - PON RIAU XVIII - KONI DKI Jakarta</title>
</head>

<body>
<div id="main">
    <div id="header">
        <div id="logo"></div>
        <h1>PEROLEHAN MEDALI KONTINGEN DKI JAKARTA - PON RIAU XVIII</h1>
    </div>
	<div id="body">
    	<div id="left">
        	<div class="bgTitle">
            </div><!-- end .bgTitle -->
            <div id="totalMedali">
				<?php
				$hasil=tampilkan($data);
				?>            </div><!-- end #totalMedali -->
            <div id="daftarMeadali">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="heads">
                    <thead>
                      <tr>
                        <th style="text-align:left;"><h4>Cabang Olahraga / Atlet</h4></th>
                        <th width="15%"><h4>Emas</h4></th>
                        <th width="15%"><h4>Perak</h4></th>
                        <th width="15%"><h4>Perunggu</h4></th>
                      </tr>
                    </thead>
                </table>
                <div id="list_medali" style="height:300px;">
	                		<?php 
	                		$hasil=tampilkan_list_medali($param);
	                		?>
                </div>                
            </div>
        </div><!-- end #left -->
        <div id="right">
        	<div class="content">
        		<div id="list_kontingen">
            	<?php 
            	$hasil=tampilkan_list_kontingen($param);
            	?>
            	</div>
            </div><!-- end .content -->
        </div><!-- end #right -->
    </div><!-- end #body -->
</div><!-- end #main -->
    <div id="newsTicker">
    	<div class="newsTicker" id="breakingnews">
			<?php 
			$hasil=tampilkan_breaking_news($param);
			$_SESSION[pagebreaking]=2;
			?>
		 </div><!-- end .newsTicker -->
    </div><!-- end #newsTicker -->
</body>
</html>