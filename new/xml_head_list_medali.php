<?php

require_once 'lib_waktu.php';
require_once 'lib_sql.php';
require_once 'lib_config.php';
require_once 'lib_koni.php';
require_once 'lib_monitor.php';



?>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
 
$(document).ready(function(){
 
	$('#page_effect').fadeIn(1000); //3000

 	$('#page_effect').delay(3000).fadeOut(1000); //6000   3000
});
 
</script>
<body>
 
<div id="page_effect" style="display:none;">
	<?php
	$hasil=tampilkan_list_medali($currentpage,$current_cabor);
	?>
</div>