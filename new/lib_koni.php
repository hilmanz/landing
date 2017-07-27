<?php

require_once 'lib_waktu.php';
require_once 'lib_sql.php';
require_once 'lib_config.php';

GLOBAL $id_jenis_unik;
GLOBAL $id_jenis_termuda;
GLOBAL $id_jenis_tertua;

	//if($id_jenis_unik=="")
	//{
		$id_jenis_unik=baca_record_sql("select id from tbl_berita_jenis where ucase(judul)='BINTANG TERUNIK'","id");
		$id_jenis_termuda=baca_record_sql("select id from tbl_berita_jenis where ucase(judul)='BINTANG TERMUDA'","id");
		$id_jenis_tertua=baca_record_sql("select id from tbl_berita_jenis where ucase(judul)='BINTANG TERTUA'","id");
		$id_jenis_arena=baca_record_sql("select id from tbl_berita_jenis where ucase(judul)='BINTANG ARENA'","id");
		
	//}

function cari_total_mendali($pil,$nama_mendali,$id_induk_cabang,$id_atlet,$cabang_id)
{
	GLOBAL $KONI_DAERAH;
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
	
	if($pil=="1")
	{
		if($nama_mendali=="")
		{
			$sql="select * from tbl_mendali_perolehan where event_id='$event_id' and asal_daerah_id='$koni_id' and status_delete='0'";
		}else
		{
			//$nama_mendali=strtoupper($nama_mendali);
			$id_mendali=baca_record_sql("select id from tbl_mendali_jenis where ucase(nama)='$nama_mendali'","id");
			$sql="select * from tbl_mendali_perolehan where id_mendali='$id_mendali' and event_id='$event_id' and asal_daerah_id='$koni_id' and status_delete='0'";
		}
	}
	if($pil=="2")
	{
		if($nama_mendali=="")
		{
			$sql="select * from tbl_mendali_perolehan where cabang_id='$id_induk_cabang' and event_id='$event_id' and asal_daerah_id='$koni_id' and status_delete='0'";
		}else
		{
			//$nama_mendali=strtoupper($nama_mendali);
			$id_mendali=baca_record_sql("select id from tbl_mendali_jenis where ucase(nama)='$nama_mendali'","id");
			$sql="select * from tbl_mendali_perolehan where cabang_id='$id_induk_cabang' and  id_mendali='$id_mendali' and event_id='$event_id' and asal_daerah_id='$koni_id' and status_delete='0'";
		}
	}
	if($pil=="3")
	{
		if($nama_mendali=="")
		{
			$sql="select * from tbl_mendali_perolehan where cabang_id='$id_induk_cabang' and event_id='$event_id' and asal_daerah_id='$koni_id' and status_delete='0' and atlet_id='$id_atlet'";
		}else
		{
			//$nama_mendali=strtoupper($nama_mendali);
			$id_mendali=baca_record_sql("select id from tbl_mendali_jenis where ucase(nama)='$nama_mendali'","id");
			$sql="select * from tbl_mendali_perolehan where cabang_id='$id_induk_cabang' and atlet_id='$id_atlet' and  id_mendali='$id_mendali' and event_id='$event_id' and asal_daerah_id='$koni_id' and status_delete='0'";
		}
	}		
	if($pil=="4")
	{
		if($nama_mendali=="")
		{
			$sql="select * from tbl_mendali_perolehan where event_id='$event_id' and asal_daerah_id='$id_atlet' and status_delete='0' ";
		}else
		{
			//$nama_mendali=strtoupper($nama_mendali);
			$id_mendali=baca_record_sql("select id from tbl_mendali_jenis where ucase(nama)='$nama_mendali'","id");
			$sql="select * from tbl_mendali_perolehan where asal_daerah_id='$id_atlet' and  id_mendali='$id_mendali' and event_id='$event_id' and status_delete='0'";
		}
	}		
	if($pil=="5")
	{
		if($nama_mendali=="")
		{
			$sql="select * from tbl_mendali_perolehan where cabang_id='$id_induk_cabang' and  event_id='$event_id' and asal_daerah_id='$id_atlet' and status_delete='0' ";
		}else
		{
			//$nama_mendali=strtoupper($nama_mendali);
			$id_mendali=baca_record_sql("select id from tbl_mendali_jenis where ucase(nama)='$nama_mendali'","id");
			$sql="select * from tbl_mendali_perolehan where cabang_id='$id_induk_cabang' and asal_daerah_id='$id_atlet' and  id_mendali='$id_mendali' and event_id='$event_id' and status_delete='0'";
			//echo "[$sql]";
		}
	}		
	$jumlah=cari_jumlah_record_sql($sql);
	return $jumlah;
}

function cari_total_mendali_waktu($nama_mendali,$id_atlet,$id_induk_cabang,$waktu)
{
	GLOBAL $KONI_DAERAH;
	
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
	

	$tanggal=ambil_tanggal($waktu);
	$bulan=ambil_bulan($waktu);

	$id_mendali=baca_record_sql("select id from tbl_mendali_jenis where ucase(nama)='$nama_mendali'","id");
	//$sql="select * from tbl_mendali_perolehan where waktu_hasil='$waktu' and asal_daerah_id='$id_atlet' and  id_mendali='$id_mendali' and event_id='$event_id' and status_delete='0'";
	$sql="select * from tbl_mendali_perolehan where day(waktu_hasil)='$tanggal' and month(waktu_hasil)='$bulan' and cabang_id='$id_induk_cabang' and asal_daerah_id='$id_atlet' and  id_mendali='$id_mendali' and event_id='$event_id' and status_delete='0'";
	
	$sql="select distinct tbl_pertandingan_jadwal.waktu_1 from tbl_mendali_perolehan,tbl_pertandingan_jadwal where day(tbl_pertandingan_jadwal.waktu_1)='$tanggal' and month(tbl_pertandingan_jadwal.waktu_1)='$bulan' and tbl_mendali_perolehan.cabang_id='$id_induk_cabang' and tbl_mendali_perolehan.asal_daerah_id='$id_atlet' and  tbl_mendali_perolehan.id_mendali='$id_mendali' and tbl_mendali_perolehan.event_id='$event_id' and tbl_mendali_perolehan.status_delete='0'";
	
	//echo "[$sql]<r>";	
	$jumlah=cari_jumlah_record_sql($sql);
	return $jumlah;
}

function cari_total_mendali_jenis_waktu($nama_mendali,$id_induk_cabang,$waktu)
{
	GLOBAL $KONI_DAERAH;
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
	$tanggal=ambil_tanggal($waktu);
	$bulan=ambil_bulan($waktu);
	
	$id_mendali=baca_record_sql("select id from tbl_mendali_jenis where ucase(nama)='$nama_mendali'","id");
	//$sql="select * from tbl_mendali_perolehan where day(waktu_hasil)='$tanggal' and month(waktu_hasil)='$bulan' and cabang_id='$id_induk_cabang' and asal_daerah_id='$id_atlet' and  id_mendali='$id_mendali' and event_id='$event_id' and status_delete='0'";
	
	$sql="select tbl_mendali_perolehan.waktu_hasil from tbl_mendali_perolehan where";
	$sql=$sql." day(tbl_mendali_perolehan.waktu_hasil)='$tanggal' and month(tbl_mendali_perolehan.waktu_hasil)='$bulan'";
	$sql=$sql." and tbl_mendali_perolehan.cabang_id='$id_induk_cabang' and tbl_mendali_perolehan.asal_daerah_id='$koni_id'";
	if($nama_mendali=="")
	{
	}else
	{
		$sql=$sql." and  tbl_mendali_perolehan.id_mendali='$id_mendali'";
	}
	$sql=$sql." and tbl_mendali_perolehan.event_id='$event_id' and tbl_mendali_perolehan.status_delete='0'";
	$jumlah=cari_jumlah_record_sql($sql);
	
	return $jumlah;
}



function konten_view($jenis,$id,$table,$nama_field_id,$nama_field_hits)
{

	Global $dbhost;
	Global $dbusername;
	Global $dbpassword;
	Global $dbname;
	
	$hostname=$dbhost;
	$username=$dbusername;
	$password=$dbpassword;
	$namadatabase=$dbname;
	
	$isi=0;
	$link=$DbConn=mysql_pconnect($hostname,$username,$password);
	if (! $link)
		die("Couldn't connect to MySQL");
	mysql_select_db($namadatabase , $link)
	or die("Couldn't open $namadatabase : ".mysql_error());	
	$strquery="select $nama_field_hits from $table where $nama_field_id='$id'";			
		
	$hasilselect=mysql_query($strquery,$link);
	$jum=mysql_num_rows($hasilselect); 	
	
	if($jum>0)
	{
		$row=mysql_fetch_assoc($hasilselect);
		$isi=$row[$nama_field_hits];
		if(is_numeric($isi))
		{
			$isi++;
			$sql="update $table set $nama_field_hits='$isi' where $nama_field_id='$id'";
			sql_execute($sql);
		}
	}
	return $isi;
}


function front_news_inset($jenis)
{	
	switch($jenis)
	{
		case "sejarah"		:
							$classback="labelOrange";
							$href=$jenis;
							$caption="SEJARAH KONI DKI";
							$id_jenis=baca_record_sql("select id from tbl_info where ucase(id)='SEJARAH'","id");
							$strquery="select * from tbl_mutasi_master_jurnal_berita where id_berita_jenis='$id_jenis' and cek_approve='1' order by waktu_berita Desc";							
							break;	
							
		case "bintang arena":
							$classback="labelGreen";
							$href=$jenis;
							$caption="BINTANG ARENA";
							$id_jenis_arena=baca_record_sql("select id from tbl_berita_jenis where ucase(judul)='BINTANG ARENA'","id");
							$isi=baca_record_sql("select isi from tbl_berita_jenis where ucase(judul)='BINTANG ARENA'","isi");
							//$href=$id_jenis_arena;
							$strquery="select * from tbl_mutasi_master_jurnal_berita where id_berita_jenis='$id_jenis_arena' and cek_approve='1' order by waktu_berita Desc";							
							break;
		case "serba-serbi":	
							$classback="labelBlue";		
							GLOBAL $id_jenis_unik;
							GLOBAL $id_jenis_termuda;
							GLOBAL $id_jenis_tertua;
							
							//if($id_jenis_unik=="")
							//{
								$id_jenis_unik=baca_record_sql("select id from tbl_berita_jenis where ucase(judul)='BINTANG TERUNIK'","id");
								$id_jenis_termuda=baca_record_sql("select id from tbl_berita_jenis where ucase(judul)='BINTANG TERMUDA'","id");
								$id_jenis_tertua=baca_record_sql("select id from tbl_berita_jenis where ucase(judul)='BINTANG TERTUA'","id");
							//}
							$strquery="select * from tbl_mutasi_master_jurnal_berita where (id_berita_jenis='$id_jenis_unik' or id_berita_jenis='$id_jenis_tertua' or id_berita_jenis='$id_jenis_termuda') and cek_approve='1' order by waktu_berita Desc";			
							$href=$jenis;
							break;	
		case "termuda":
							$classback="labelGreen";
							$href=$jenis;
							$caption="BINTANG TERMUDA LAINNYA";
							$strquery="select * from tbl_mutasi_master_jurnal_berita where id_berita_jenis='$id_jenis_termuda' and cek_approve='1' order by waktu_berita Desc";							
							break;		
		case "tertua":
							$classback="labelBlue";
							$href=$jenis;
							$caption="BINTANG TERTUA LAINNYA";
							$strquery="select * from tbl_mutasi_master_jurnal_berita where id_berita_jenis='$id_jenis_tertua' and cek_approve='1' order by waktu_berita Desc";							
							break;			
		case "terunik":
							$classback="labelOrange";
							$href=$jenis;
							$caption="BINTANG TERUNIK LAINNYA";
							$strquery="select * from tbl_mutasi_master_jurnal_berita where id_berita_jenis='$id_jenis_terunik' and cek_approve='1' order by waktu_berita Desc";							
							break;																						
						
	}
		
	Global $dbhost;
	Global $dbusername;
	Global $dbpassword;
	Global $dbname;
	
	$hostname=$dbhost;
	$username=$dbusername;
	$password=$dbpassword;
	$namadatabase=$dbname;
	
	$isi=0;
	$link=$DbConn=mysql_pconnect($hostname,$username,$password);
	if (! $link)
		die("Couldn't connect to MySQL");
	mysql_select_db($namadatabase , $link)
	or die("Couldn't open $namadatabase : ".mysql_error());	
		
	$hasilselect=mysql_query($strquery,$link);
	$jum=mysql_num_rows($hasilselect); 	
	
	$isi=htmlentities();
	
	//echo "[$strquery][$jum]<br>";
	if($jum>0)
	{
		$row=mysql_fetch_assoc($hasilselect);
		$flag=$row[flag];
		$id_atlet=$row[id_atlet];
		$id_berita_jenis=$row[id_berita_jenis];
		$caption=strtoupper(baca_record_sql("select judul from tbl_berita_jenis where id='$id_berita_jenis'","judul"));
		$rekor="0";
		if($flag=="rekor")
		{
			$rekor="1";
		}
		$tag=$row[tag];		
		$no_id_mutasi=$row[no_id_mutasi];
		$judul=htmlentities($row[judul]);		
		$judul=str_replace("\n","<p>",$judul);
		if($id_atlet!=="")
		{
			$nama_atlet=htmlentities(baca_record_sql("select nama from tbl_master_atlet where no_id='$id_atlet'","nama"));
			if($judul!=="")
			{
				$judul=$nama_atlet."<br>".$judul;
			}else
			{
				$judul=$nama_atlet;
			}
		}
		
		//echo "[$id_atlet]";
		
		$isi=htmlentities($row[isi]);		
		$isi=str_replace("\n","<p>",$isi);
		
			$file=$row[file];
			//echo "[$file]";
			if(!$file=="")
			{
				$icon="files/tb_$file";
			}else
			{
				$icon="files/dumm.jpg";
			}	
					
	}	
	$class_rekor="";
	
	if($caption=="")
	{
		$caption="SERBA-SERBI";
	}
	?>
        <div class="boxNews">
            <?php
            if($icon!=="")
            {
            
            ?>       
                <?php 
                if($jum>0)
                {
                ?>                
	            <a href="index.php?menu=berita-detail&p=berita&id=<?php echo $no_id_mutasi;?>" class="thumbs">
					<img src="<?php echo $icon;?>" width="321" height="250" />
	            </a>
	            <?php
	             }else
	             {
	             	?>
	             	<a class="thumbs"></a>
	             	<?php
	             }
	            ?>	            
            <?php
            }
            ?>
            <div class="caption">
                <h1>
                <?php 
                if($jum>0)
                {
                ?>                
                <a href="index.php?menu=berita-detail&p=berita&id=<?php echo $no_id_mutasi;?>">   
                <?php
                }
                ?>                              
                <?php echo $judul;?>
                <?php 
                if($jum>0)
                {
                ?>                  
                </a>
                <?php
                }
                ?>                
                </h1>
            </div>
            <div class="<?php echo $classback;?>">
                <h1>
                <?php 
                if($jum>0)
                {
                ?>
                	<a href="index.php?menu=berita-detail&p=berita&id=<?php echo $no_id_mutasi;?>">
                <?php
                }
                ?>
                	<?php echo $caption;?>
                <?php 
                if($jum>0)
                {
                ?>                
                	</a>
                <?php
                }
                ?>                
                </h1>
                <?php 
                if($jum>0)
                {
                ?>                 
                	<a href="index.php?menu=berita-detail&p=berita&id=<?php echo $no_id_mutasi;?>" class="arrowDetail">&nbsp;</a>
                <?php
                }
                ?>                
            </div>
            <?php
				if($rekor=="1")
				{
					?>
		            	<div class="labels rekor">&nbsp;</div>					
					<?php					
				}    
				if($tag=="1")
				{
					?>
		            	<div class="labels update">&nbsp;</div>					
					<?php					
				} 				        
            ?>

        </div><!-- end .boxNews -->	
	<?php
}

function select_option_id_value_jadwal($sqlnya,$nama_field,$id_field,$pilihan_select,$isi_terpilih)
{ 	

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
	$strquery=$sqlnya;		
	$hasilselect=mysql_query($strquery,$link);
	$jum=mysql_num_rows($hasilselect);
	if($jum>0)
	{	
		if($pilihan_select=="1")
		{

			echo "<option value=\"\"";
			if($isi_field=="")
			{ 
				//echo " selected ";
			} 
			echo ">- - pilih - - </option>";
		}
		for($i=0;$i<$jum;$i++)
		{
			$row=mysql_fetch_assoc($hasilselect);
			$isi_field=htmlentities($row[$nama_field]);
			$isi_field=str_replace("'","\'",$isi_field);
			$isi_field=str_replace("\\","\'",$isi_field);
			$isi_field=str_replace("''","'",$isi_field);
			$isi_field_id=$row[$id_field];			
			if($i==0)
			{
				$isi_awal=$isi_field_id;
			}
	
			$cabang_id=baca_record_sql("select cabang_id,id,nama from tbl_pertandingan_nomor where status_delete='0' and id='$isi_field_id'","cabang_id");;
			$olahraga_level=substr($cabang_id,0,1);		
			$olahraga_id=substr($cabang_id,2);
			
			$id_kriteria_0=baca_record_sql("select id_kriteria_0 from tbl_cabang_olahraga_$olahraga_level where cabang_id='$olahraga_id'","id_kriteria_0");
			$nama_kriteria_0=baca_record_sql("select singkatan from tbl_kriteria_0 where id='$id_kriteria_0'","singkatan");
									
			$id_kriteria_1=baca_record_sql("select id_kriteria_1 from tbl_cabang_olahraga_$olahraga_level where cabang_id='$olahraga_id'","id_kriteria_1");
			$nama_kriteria_1=baca_record_sql("select singkatan from tbl_kriteria_1 where id='$id_kriteria_1'","singkatan");
			
			$isi_field=$isi_field." [ ".$nama_kriteria_0." ] [ ".$nama_kriteria_1." ]";		
			$isi_field=str_replace("signplus","+",$isi_field);
												
			echo "<option "; 
			if($isi_field_id==$isi_terpilih)
			{
				$c1=substr($isi_field_id,strlen($isi_field_id)-1,1).substr($isi_field_id,strlen($isi_field_id)-2,1);
				$c2=substr($isi_terpilih,strlen($isi_terpilih)-1,1).substr($isi_terpilih,strlen($isi_terpilih)-2,1);
				//echo "[$c1][$c2] ";
				if($c1==$c2)
				{
					echo " selected";
				}
			}
			echo " value=\"$isi_field_id\"  >";
			echo "$isi_field" ;

			echo "</option>";
		}
	}
	else
	{
		$bufferhasilselect=-1;
	}
	//mysql_close($link);

	return $isi_awal;
}


?>