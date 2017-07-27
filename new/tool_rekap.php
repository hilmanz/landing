<?php

require_once 'lib_waktu.php';
require_once 'lib_sql.php';
require_once 'lib_config.php';
require_once 'lib_koni.php';

//error_reporting(E_ALL);


						GLOBAL $dbusername;
						GLOBAL $dbpassword;
						GLOBAL $hostname;
						GLOBAL $dbname;
						GLOBAL $buffernya;
							
						$password=$dbpassword;
						$username=$dbusername;
						$namadatabase=$dbname;				
					
						if($_SESSION['EVENT_ID']=="")
						{
							$event_id=baca_record_sql("select * from tbl_setting where status='1' and status_delete='0'","id");
							$_SESSION['EVENT_ID']=$event_id;
						}else
						{
							$event_id=$_SESSION['EVENT_ID'];
						}
						GLOBAL $KONI_DAERAH;
						if($_SESSION['KONI_ID']=="")
						{
							$koni_id=baca_record_sql("select * from tbl_koni where nama='$KONI_DAERAH' or singkatan='$KONI_DAERAH' ","koni_id");
							$_SESSION['KONI_ID']=$koni_id;
						}else
						{
							$koni_id=$_SESSION['KONI_ID'];
						}						
					

						$id_emas=baca_record_sql("select id from tbl_mendali_jenis where nama='Emas'","id");
						$id_perak=baca_record_sql("select id from tbl_mendali_jenis where nama='Perak'","id");
						$id_perunggu=baca_record_sql("select id from tbl_mendali_jenis where nama='Perunggu'","id");
											
						
						$link=$DbConn=mysql_pconnect($hostname,$username,$password);
						if (! $link)
							die("Couldn't connect to MySQL");
						mysql_select_db($namadatabase , $link)
						or die("Couldn't open $namadatabase : ".mysql_error());
						$strquery="select * from tbl_cabang_olahraga_0 where status='1' and status_delete='0' order by nama asc";	
						$hasilselect=mysql_query($strquery,$link);
						$jum=mysql_num_rows($hasilselect);
						for($i=0;$i<$jum;$i++)
						{
							$row=mysql_fetch_assoc($hasilselect);
							$cabang_id=$row[cabang_id];
							$emas=cari_total_mendali("2","Emas",$cabang_id,$id_atlet,$cabang_id);
							$perak=cari_total_mendali("2","Perak",$cabang_id,$id_atlet,$cabang_id);
							$perunggu=cari_total_mendali("2","Perunggu",$cabang_id,$id_atlet,$cabang_id);
							
							$j=cari_jumlah_record_sql("select nama from tbl_mendali_rekap where event_id='$event_id' and koni_id='$koni_id' and status_delete='0' and cabang_id='$cabang_id'");
							if($j=="0")
							{
								$id=gen_id("");
								$sql="insert into tbl_mendali_rekap (id,cabang_id,event_id,koni_id,emas,perak,perunggu)values(";
								$sql=$sql."'$id','$cabang_id','$event_id','$koni_id','$emas','$perak','$perunggu'";
								$sql=$sql.")";
								sql_execute($sql);
							}else
							{
								$sql="update tbl_mendali_rekap set ";
								$sql=$sql."emas='$emas',perak='$perak',perunggu='$perunggu'";
								$sql=$sql." where cabang_id='$cabang_id' and event_id='$event_id' and koni_id='$koni_id'";
								sql_execute($sql);								
							}
						}
							

			
										
?>