<?php

require_once 'lib_waktu.php';
require_once 'lib_sql.php';
require_once 'lib_config.php';
require_once 'lib_koni.php';

session_start();


function tampilkan_breaking_news($param)
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
		
		$id_berita_breaking=$_SESSION['ID_BREAKING_NEWS'];
		if($id_berita_breaking=="")
		{
			$id_berita_breaking=baca_record_sql("select id from tbl_berita_jenis where judul='Breaking News'","id");
			$_SESSION['ID_BREAKING_NEWS']=$id_berita_breaking;			
		}
		
		$pagebreaking=$_GET[pagebreaking];
		$page=$_SESSION[pagebreaking];
		
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
		$strquery="select * from tbl_breaking_news where status_delete='0' order by waktu Desc";
		//$strquery="select * from tbl_mutasi_master_jurnal_berita where id_berita_jenis='$id_berita_breaking' and status_delete='0' order by waktu Desc";
		$hasilselect=mysql_query($strquery,$link);
		$lines=mysql_num_rows($hasilselect);
		if($page=="")
		{
			$page=0;
		}
		//echo "[$strquery][$lines]";
		$count=1;	
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
			$c=0;							
			$begin=($page-1)*$count;
			$counterloop=0;	
			$no=1;
			if($page>1)
			{
				$no=(($page-1)*$count)+1;
			}
			if($page+1<=$pagecount)
			{
				$_SESSION[pagebreaking]=$page+1;
			}else
			{
				$_SESSION[pagebreaking]=1;
			}
			
			$query=mysql_query("$strquery LIMIT $begin,$count");							
			$ctr=1;
			
			while ($row=mysql_fetch_array($query))	
			{
				$judul=$row[judul];
				$judul=htmlentities($judul);
				?>
		               <?php echo $judul;?>	
				<?php
			}			
		}		
	
}
function tampilkan_list_kontingen($param)
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
		
		$id_emas=baca_record_sql("select id from tbl_mendali_jenis where nama='Emas'","id");
		$id_perak=baca_record_sql("select id from tbl_mendali_jenis where nama='Perak'","id");
		$id_perunggu=baca_record_sql("select id from tbl_mendali_jenis where nama='Perunggu'","id");
					
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

		
		$strquery="select t1.emas as emas, t1.perak as perak, t1.perunggu as perunggu, t1.waktu as waktu, t1.koni_id as koni_id ";
		$strquery=$strquery." ,t2.nama as nama, t2.singkatan as singkatan";
		$strquery=$strquery." from tbl_mendali_kontingen_rekap as t1 inner join tbl_koni as t2 ON t1.koni_id=t2.koni_id";
		$strquery=$strquery." where t1.status_delete='0'";
		$strquery=$strquery." order by t1.emas Desc,t1.perak Desc,t1.perunggu Desc,t2.nama asc";	
			
		$hasilselect=mysql_query($strquery,$link);
		$jum=mysql_num_rows($hasilselect);
		$jum_record=$jum;
		$waktu="";
		$batas=6;
		//echo "[$strquery][$jum]";
		if($jum>0)
		{			
			if($jum>$batas)
			{
				$jum=$batas;
			}
			$ada=false;
			for($i=0;$i<$jum;$i++)
			{
				$row=mysql_fetch_assoc($hasilselect);
				$nama=$row[nama];
				$singkatan=$row[singkatan];
				$asal_daerah_id=$row[koni_id];
				if($asal_daerah_id==$koni_id)
				{
					$ada=true;
					$posisi=$i;
					$nomor=$posisi+1;
				}
				$nama=htmlentities($nama);
				$singkatan=htmlentities($singkatan);
				$jumemas=$row[emas];
				$jumperak=$row[perak];			
				$jumperunggu=$row[perunggu];	
				$buffer[$i][1]=$asal_daerah_id;
				$buffer[$i][2]=$nama;
				$buffer[$i][3]=$jumemas;
				$buffer[$i][4]=$jumperak;
				$buffer[$i][5]=$jumperunggu;		
				$buffer[$i][6]=$i;
				$buffer[$i][7]=$singkatan;		
			}
			if($ada==false)
			{
				$asal_daerah_id=$koni_id;
				$nama=baca_record_sql("select nama from tbl_koni where koni_id='$asal_daerah_id'","nama");
				$nama=htmlentities($nama);
				$singkatan=baca_record_sql("select singkatan from tbl_koni where koni_id='$asal_daerah_id'","singkatan");
				$singkatan=htmlentities($singkatan);				
				$jumemas=baca_record_sql("select perunggu from tbl_mendali_kontingen_rekap where koni_id='$asal_daerah_id'","emas");
				$jumperak=baca_record_sql("select perunggu from tbl_mendali_kontingen_rekap where koni_id='$asal_daerah_id'","perak");			
				$jumperunggu=baca_record_sql("select perunggu from tbl_mendali_kontingen_rekap where koni_id='$asal_daerah_id'","perunggu");
				$buffer[$jum][1]=$asal_daerah_id;
				$buffer[$jum][2]=$nama;
				$buffer[$jum][3]=$jumemas;
				$buffer[$jum][4]=$jumperak;
				$buffer[$jum][5]=$jumperunggu;		
				$buffer[$jum][6]=$jum;
				$buffer[$i][7]=$singkatan;
				$posisi=$jum;
				$nomor=$posisi+1;	
				$jum++;
			}
			
			$nama=$buffer[$posisi][2];
			$jumemas=$buffer[$posisi][3];
			$jumperak=$buffer[$posisi][4];
			$jumperunggu=$buffer[$posisi][5];	
			$asal_daerah_id=$buffer[$posisi][1];	
			$nomor=$buffer[$posisi][6];
			$singkatan=$buffer[$posisi][7];
			
			$waktu=baca_record_sql("select waktu from tbl_mendali_perolehan where asal_daerah_id<>'' and status_delete='0' order by waktu Desc","waktu");
	
			$waktu_update=translate_waktu_2($waktu);
			$waktu_jam=ambil_jam_menit($waktu);
			$nomor++;
			if($nomor==0)
			{
				$nomor=1;
			}
			//echo "Urutan ke : [$nomor] $waktu_update $waktu_jam";
			?>
			<div id="medaliReport">
			
			<?php
			if($jum_record>0)
			{
			?>
				<h1 >
				<b style="margin-left:60px;font-size:15px;color:Green;font-weight:100;">URUTAN KE : <?php echo $nomor;?></b>
				<span style="margin-left:45px;"><?php echo "$waktu_update &nbsp;$waktu_jam";?></span>
				</h1>
			<?php
			}
			?>
			
			    <div class="medaliReport">
			        <div class="iconMedali"></div>
			        <div class="head">
			            <h1>MEDALI PER KONTINGEN</h1>
			      	    <a href="javascript:void(0)" class="iconRefresh" id="refreshDiv">&nbsp;</a>
			        </div>
			        <div class="row bgGrey">
			            <div class="col1"><span>KONTINGEN</span></div>
			            <div class="col2"><small>Emas</small><span class="medaliEmas">&nbsp;</span></div>
			            <div class="col2"><small>Perak</small><span class="medaliPerak">&nbsp;</span></div>
			            <div class="col2"><small>Perunggu</small><span class="medaliPerunggu">&nbsp;</span></div>
			        </div><!-- end .row -->				
			        <div class="row first">
						<div class="col1">
						<span>
						<?php echo $nomor;?>.
						<?php 
						//$nama=$singkatan;
						if(strlen($nama)>11)
						{
							if($singkatan=="")
							{
								$nama="<font style=\"font-size:11px\">$nama</font>";
							}else
							{
								$nama=$singkatan;
							}
						}
						
						echo $nama;
						
						?>
						</span>
						</div>
						<div class="col2"><span><?php echo $jumemas;?></span></div>
						<div class="col2"><span><?php echo $jumperak;?></span></div>
						<div class="col2"><span><?php echo $jumperunggu;?></span></div>
			        </div><!-- end .row -->		
			<?php
			$pos=1;
			//echo "[$strquery][$jum]";
			for($i=0;$i<$jum;$i++)
			{	
				$nama=$buffer[$i][2];
				$jumemas=$buffer[$i][3];
				$jumperak=$buffer[$i][4];
				$jumperunggu=$buffer[$i][5];	
				$asal_daerah_id=$buffer[$i][1];	
				$singkatan=$buffer[$i][7];	
				$nomor=$buffer[$i][6];
				$nomor++;
				if($asal_daerah_id==$koni_id)
				{
				}else
				{
					if($pos<$batas)
					{
						?>
			            <div class="row">
			                <div class="col1"><span><?php echo $nomor;?>. 
						<?php 
						if(strlen($nama)>10)
						{
							$nama=$singkatan;
						}
						echo ucwords(strtolower($nama));
						?>			                
			                </span></div>
			                <div class="col2"><span><?php echo $jumemas;?></span></div>
			                <div class="col2"><span><?php echo $jumperak;?></span></div>
			                <div class="col2"><span><?php echo $jumperunggu;?></span></div>
			            </div><!-- end .row -->					
						<?php
					}else
					{
						$i=$jum;
					}
					$pos++;
				}	
			}	
			
			$strquery="select t1.emas as emas,t1.perak as perak,t1.perunggu as perunggu ";
			$strquery=$strquery." from tbl_mendali_kontingen_rekap as t1 inner join tbl_koni as t2 ON t1.koni_id=t2.koni_id";
			$strquery=$strquery." ";
			$hasilselect=mysql_query($strquery,$link);
			$jum=mysql_num_rows($hasilselect);	
			$hasilselect=mysql_query($strquery,$link);
			$jum=mysql_num_rows($hasilselect);
			
			$waktu="";
			$batas=6;
			$total_emas=0;
			$total_perak=0;
			$total_perunggu=0;
			//echo "[$strquery][$jum]";
			if($jum>0)
			{
				for($i=0;$i<$jum;$i++)
				{
					$row=mysql_fetch_assoc($hasilselect);
					$total_emas=$total_emas + $row[emas];
					$total_perak=$total_perak + $row[perak];
					$total_perunggu=$total_perunggu + $row[perunggu];
				}			
			}		
					
			?>
			<div class="row">
			    <div class="col1">. . . .</div>
			    <div class="col2">. . . .</div>
			    <div class="col2">. . . .</div>
			    <div class="col2">. . . .</div>
			</div><!-- end .row -->					
			        <div class="row bgGrey">
			            <div class="col1"><span>Total (33)</span></div>
			            <div class="col2"><?php echo $total_emas;?></div>
			            <div class="col2"><?php echo $total_perak;?></div>
			            <div class="col2"><?php echo $total_perunggu;?></div>	
			        </div>		
			<?php		
		}else
		{
			?>

			<div id="medaliReport">
			<?php
			if($jum_record>0)
			{
			?>			
				<h1 ><b style="margin-left:60px;font-size:20px;color:Green;font-weight:100;">URUTAN KE : </b></h1>
			<?php
			}
			?>			
			    <div class="medaliReport">
			        <div class="iconMedali"></div>
			        <div class="head">
			            <h1>MEDALI PER KONTINGEN</h1>
			      	    <a href="javascript:void(0)" class="iconRefresh" id="refreshDiv">&nbsp;</a>
			        </div>
			        <div class="row bgGrey">
			            <div class="col1"><span>KONTINGEN</span></div>
			            <div class="col2"><small>Emas</small><span class="medaliEmas"></span></div>
			            <div class="col2"><small>Perak</small><span class="medaliPerak">&nbsp;</span></div>
			            <div class="col2"><small>Perunggu</small><span class="medaliPerunggu">&nbsp;</span></div>
			        </div><!-- end .row -->				
		<?php
		}
		?>
		<div class="entry">
                <div class="logoJakom">
                <p>Powered by: </p>
               	 <img src="../images/logo-jakom.jpg" />
                </div>
      	</div><!-- end .entry --          		
    </div><!-- end .medaliReport -->
</div><!-- end #medaliReport -->	
	<?php

}

function tampilkan_list_medali($currentpage,$current_cabor)
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
	
	$page=$_GET[page];
	

	
?>
                	<li id="dua" >
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <?php 
                            
								GLOBAL $dbusername;
								GLOBAL $dbpassword;
								GLOBAL $hostname;
								GLOBAL $dbname;
								GLOBAL $buffernya;
									
								$password=$dbpassword;
								$username=$dbusername;
								$namadatabase=$dbname;				
							
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
								
								$hasilselect2=mysql_query($strquery,$link);
								
								$page=$_SESSION[next_page];
								if($page=="")
								{
									$page=0;
								}
								$count=6;	
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
									$c=0;							
									$begin=($page-1)*$count;
									$counterloop=0;	
									$no=1;
									if($page>1)
									{
										$no=(($page-1)*$count)+1;
									}
									if($page+1<=$pagecount)
									{
										$_SESSION[next_page]=$page+1;
									}else
									{
										$_SESSION[next_page]=1;
									}
									
									$query=mysql_query("$strquery LIMIT $begin,$count");							
									$ctr=1;
									
									$query2=mysql_query("$strquery LIMIT $begin,$count");
									$row2=mysql_fetch_array($query2);
									
									$cabang_id=$row2[cabang_id];
									$nama=baca_record_sql("select nama from tbl_cabang_olahraga_0 where cabang_id='$cabang_id'","nama");
									$nama=strtoupper($nama);
										$cabang_id_1=$row2[cabang_id];
										$cabang_id_0=$_SESSION[next_cabang_id];
										if($cabang_id_1==$cabang_id_0)
										{
										}else
										{
											$_SESSION[next_cabang_id]=$cabang_id_1;
										}
										$emas=$row2[emas];
										$perak=$row2[perak];
										$perunggu=$row2[perunggu];									
									?>
			                          <tr class="head">
			                            <td style="text-align:left;" class="headdaftarMeadali"><?php echo $nama;?></td>
			                            <td width="15%" class="headdaftarMeadali"><?php echo $emas;?></td>
			                            <td width="15%" class="headdaftarMeadali"><?php echo $perak;?></td>
			                            <td width="15%" class="headdaftarMeadali"><?php echo $perunggu;?></td>
			                          </tr>								
									<?php
									while ($row=mysql_fetch_array($query))	
									{
										$atlet_id=$row[atlet_id];
										$nama_atlet=baca_record_sql("select nama from tbl_master_atlet where no_id='$atlet_id'","nama");
										$cabang_id=$row[cabang_id];
										$nama=baca_record_sql("select nama from tbl_cabang_olahraga_0 where cabang_id='$cabang_id'","nama");

										
										$nama=strtoupper($nama);
										
										//echo "[$nama][$emas][$perak][$perunggu]<br>[$nama_atlet]<br>";
										//echo "[$nama_atlet]<br>";
										$cabang_id_1=$row[cabang_id];
										$cabang_id_0=$_SESSION[next_cabang_id];
										if($cabang_id_1==$cabang_id_0)
										{
										}else
										{
											$_SESSION[next_cabang_id]=$cabang_id_1;
										$emas=$row[emas];
										$perak=$row[perak];
										$perunggu=$row[perunggu];													
											?>
					                          <tr class="head">
					                            <td style="text-align:left;" class="headdaftarMeadali"><?php echo $nama;?></td>
					                            <td width="15%" class="headdaftarMeadali"><?php echo $emas;?></td>
					                            <td width="15%" class="headdaftarMeadali"><?php echo $perak;?></td>
					                            <td width="15%" class="headdaftarMeadali"><?php echo $perunggu;?></td>
					                          </tr>												
											<?php
										}		
										

										$emas=cari_total_mendali("3","Emas",$cabang_id,$atlet_id,$cabang_id);
										$perak=cari_total_mendali("3","Perak",$cabang_id,$atlet_id,$cabang_id);
										$perunggu=cari_total_mendali("3","Perunggu",$cabang_id,$atlet_id,$cabang_id);										
										?>

										<tr class="headdaftarMeadali">
										<td style="text-align:left;" class="headdaftarMeadali">
										<?php echo "$nama_atlet"; ?>
										</td>
			                            <td width="15%" class="headdaftarMeadali"><?php echo $emas;?></td>
			                            <td width="15%" class="headdaftarMeadali"><?php echo $perak;?></td>
			                            <td width="15%" class="headdaftarMeadali"><?php echo $perunggu;?></td>
			                            </tr>										
									<?php
									}
								}		             
                            	 
                            	 ?>                            

                        </tbody>
                        </table>
                    </li>
<?php
}


function tampilkan($data)
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
	
	$jumlahtotal=cari_total_mendali("1",$nama_mendali,$id_induk_cabang,$id_atlet,$cabang_id);
?>
			<div class="totalMedali">
                    <div class="box">
                        <span>TOTAL MEDALI</span>
                        <h1><?php echo cari_total_mendali("1","",$id_induk_cabang,$koni_id,"");?></h1>
                    </div>
                    <div class="box">
                        <span>EMAS</span>
                        <h1><?php echo cari_total_mendali("4","Emas",$id_induk_cabang,$koni_id,"");;?></h1>
                    </div>
                    <div class="box">
                        <span>PERAK</span>
                        <h1><?php echo cari_total_mendali("4","Perak",$id_induk_cabang,$koni_id,"");?></h1>
                    </div>
                    <div class="box last">
                        <span>PERUNGGU</span>
                        <h1><?php echo cari_total_mendali("4","Perunggu",$id_induk_cabang,$koni_id,"");?></h1>
                    </div>
             </div><!-- end .totalMedali -->
<?php
}

?>