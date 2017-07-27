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
 
	$('#page_effect_breaking').fadeIn(1000); //3000
 	$('#page_effect_breaking').delay(8000).fadeOut(1000); //6000   3000
});
 
</script>
<body>
 
<div id="page_effect_breaking" style="display:none;">
<?php
	tampilkan_breaking_news($param);
?>
</div>
</body>