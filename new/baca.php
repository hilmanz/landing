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
						$strquery="select * ";
						$strquery=$strquery." from tbl_mendali_rekap ";
						$strquery=$strquery." where status_delete='0' and (emas>'0' or perak>'0' or perunggu>'0')";
						$strquery=$strquery." order by emas Desc, perak Desc, perunggu Desc ";
						
						$strquery="select t1.emas as emas,t1.perak as perak,t1.perunggu as perunggu,t1.cabang_id as cabang_id ";
						$strquery=$strquery." ,t2.atlet_id as atlet_id";
						$strquery=$strquery." from tbl_mendali_rekap as t1 inner join ";
						$strquery=$strquery."(select * from tbl_mendali_atlet_rekap order by tbl_mendali_atlet_rekap.emas Desc, tbl_mendali_atlet_rekap.perak Desc, tbl_mendali_atlet_rekap.perunggu Desc ) as t2 on t1.cabang_id=t2.cabang_id";
						$strquery=$strquery." where t1.status_delete='0' and (t1.emas>'0' or t1.perak>'0' or t1.perunggu>'0')";
						$strquery=$strquery." order by t1.emas Desc, t1.perak Desc, t1.perunggu Desc ";						
						
						$hasilselect=mysql_query($strquery,$link);
						$lines=mysql_num_rows($hasilselect);
						
						
						$count=5;	
						$no=0;
						$pagecount=ceil($lines/$count);
						if($page=="")
						{
							$page=1;
						}		
						if ($page<1) $page=1;
						if ($page>$pagecount) $page=$pagecount;
						$clooping=1;
						if($lines>0)
						{
							$t=$lines;
							if($t>$count)
							{
								$t=$count;
							}							
							$persen=$count/$t;					
							$c=0;							
							$begin=($page-1)*$count;
							$counterloop=0;	
							$no=1;
							if($page>1)
							{
								$no=(($page-1)*$count)+1;
							}
							$query=mysql_query("$strquery LIMIT $begin,$count");							
							$ctr=1;

							while ($row=mysql_fetch_array($query))	
							{
								$atlet_id=$row[atlet_id];
								$nama_atlet=baca_record_sql("select nama from tbl_master_atlet where no_id='$atlet_id'","nama");
								$cabang_id=$row[cabang_id];
								$nama=baca_record_sql("select nama from tbl_cabang_olahraga_0 where cabang_id='$cabang_id'","nama");
								$emas=$row[emas];
								$perak=$row[perak];
								$perunggu=$row[perunggu];
								//echo "[$nama][$emas][$perak][$perunggu]<br>[$nama_atlet]<br>";
								echo "[$nama_atlet]<br>";

							}
						}						
						
											
										
?>