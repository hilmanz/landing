<?php

require_once 'lib_waktu.php';
require_once 'lib_sql.php';
require_once 'lib_config.php';
require_once 'lib_koni.php';

	if($_SESSION['EVENT_ID']=="")
	{
		$event_id=baca_record_sql("select * from tbl_setting where status='1' and status_delete='0'","id");
		$_SESSION['EVENT_ID']=$event_id;
	}else
	{
		$event_id=$_SESSION['EVENT_ID'];
	}

	if($_SESSION['KONI_ID']=="")
	{
		$koni_id=baca_record_sql("select * from tbl_koni where nama='$KONI_DAERAH' or singkatan='$KONI_DAERAH' ","koni_id");
		$_SESSION['KONI_ID']=$koni_id;
	}else
	{
		$koni_id=$_SESSION['KONI_ID'];
	}
	
	Global $dbhost;
	Global $dbusername;
	Global $dbpassword;
	Global $dbname;	

	$hostname=$dbhost;
	$username=$dbusername;
	$password=$dbpassword;
	$namadatabase=$dbname;

	$link=$DbConn=mysql_pconnect($hostname,$username,$password);
	if (! $link)
		die("Couldn't connect to MySQL");
	mysql_select_db($namadatabase , $link)
	or die("Couldn't open $namadatabase : ".mysql_error());
	$strquery="select waktu from tbl_mendali_perolehan where asal_daerah_id<>'' and waktu<>'0000-00-00 00:00:00' and status_delete='0' order by waktu asc";	
	$hasilselect=mysql_query($strquery,$link);
	$jum=mysql_num_rows($hasilselect);
	$waktu="";
	if($jum>0)
	{			
		$row=mysql_fetch_assoc($hasilselect);
		$waktu=$row[waktu];
		$waktu=translate_waktu_6($waktu);
	}	
?>



<div id="medaliReport">
    <div class="medaliReport">
        <div class="iconMedali"></div>
        <span class="latesUpdate"><?php if($waktu!=="") { echo $waktu; }?></span>
        <div class="head">
            <h1>PEROLEHAN MEDALI</h1>
      	    <a href="javascript:void(0)" class="iconRefresh" id="refreshDiv">&nbsp;</a>
        </div>
        <div class="row bgOrange">
            <div class="col1"><span>SEMUA <br /> KONTINGEN</span></div>
            <div class="col2"><span class="medaliEmas">&nbsp;</span><small>Emas</small></div>
            <div class="col2"><span class="medaliPerak">&nbsp;</span><small>Perak</small></div>
            <div class="col2"><span class="medaliPerunggu">&nbsp;</span><small>Perunggu</small></div>
        </div><!-- end .row -->
        <div class="row first">
        	<?php
        	$koni_nama=baca_record_sql("select nama from tbl_koni where koni_id='$koni_id'","nama");
        	?>
            <div class="col1"><span><?php echo $koni_nama;?></span></div>
            <div class="col2"><span><?php  echo cari_total_mendali("4","Emas",$id_induk_cabang,$koni_id,"");?></span></div>
            <div class="col2"><span><?php  echo cari_total_mendali("4","Perak",$id_induk_cabang,$koni_id,"");?></span></div>
            <div class="col2"><span><?php  echo cari_total_mendali("4","Perunggu",$id_induk_cabang,$koni_id,"");?></span></div>
        </div><!-- end .row -->
        <div class="scrollbar wide1 tall1">
        <?php
						Global $dbhost;
						Global $dbusername;
						Global $dbpassword;
						Global $dbname;	
										
						$hostname=$dbhost;
						$username=$dbusername;
						$password=$dbpassword;
						$namadatabase=$dbname;
										
						$waktu_minim="2012-09-01";				
						$link=$DbConn=mysql_pconnect($hostname,$username,$password);
						if (! $link)
							die("Couldn't connect to MySQL");
						mysql_select_db($namadatabase , $link)
						or die("Couldn't open $namadatabase : ".mysql_error());
						$strquery="select tbl_koni.koni_id as koni_id,tbl_koni.nama as nama  from tbl_koni where tbl_koni.koni_id<>'$koni_id' and tbl_koni.status_delete='0' order by tbl_koni.nama asc";	
						$hasilselect=mysql_query($strquery,$link);
						$jum=mysql_num_rows($hasilselect);   
						
						for($c=0;$c<$jum;$c++)
						{	
							$row=mysql_fetch_assoc($hasilselect);
							$nama=$row[nama];	
							$nama=filter_read($nama);
							$id_prov=$row[koni_id];	
							?>
					            <div class="row">
					                <div class="col1"><span><?php echo $nama;?></span></div>
					                <div class="col2"><span><?php  echo cari_total_mendali("4","Emas",$id_induk_cabang,$id_prov,"");?></span></div>
					                <div class="col2"><span><?php  echo cari_total_mendali("4","Perak",$id_induk_cabang,$id_prov,"");?></span></div>
					                <div class="col2"><span><?php  echo cari_total_mendali("4","Perunggu",$id_induk_cabang,$id_prov,"");?></span></div>
					            </div><!-- end .row -->							
							<?php
						}        
        ?>

        </div><!-- end .scrollbar -->
    </div><!-- end .medaliReport -->
</div><!-- end #medaliReport -->