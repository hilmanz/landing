<?php
require_once 'lib_waktu.php';
require_once 'lib_config.php';


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
	
function list_default($id_pengguna_distribusi)
{
	$hasil=false;
	if($id_pengguna_distribusi=="654546784356563535")
	{
		$hasil=true;
	}
	if($id_pengguna_distribusi=="762423453453453")
	{
		$hasil=true;
	}
	if($id_pengguna_distribusi=="4564565464564564564564")
	{
		$hasil=true;
	}	
	return $hasil;				
}

function sql_hapus($namadatabasenya,$namatablenya,$fieldnya,$nilainya)
{

	Global $dbhost;
	Global $dbusername;
	Global $dbpassword;
	Global $dbname;
	
	$hostname=$dbhost;
	$username=$dbusername;
	$password=$dbpassword;
	$namadatabase=$dbname;
	
	$namadatabase=$namadatabasenya;
	$namatabelnya=$namatablenya;
	$link=$DbConn=mysql_pconnect($hostname,$username,$password);
	if (!$link)
	die("Couldn't connect to MySQL");
	mysql_select_db($namadatabase , $link)
	or die("Couldn't open $namadatabase: ".mysql_error());	

	$strquery="delete from $namatabelnya where $fieldnya='$nilainya'";
	//echo $strquery;
	$hasilselect=mysql_query ($strquery,$link)or die(mysql_error());
	//mysql_close($link);	
}
function sql_execute($sqlnya)
{

	Global $dbhost;
	Global $dbusername;
	Global $dbpassword;
	Global $dbname;
	
	$hostname=$dbhost;
	$username=$dbusername;
	$password=$dbpassword;
	$namadatabase=$dbname;
	
	$namadatabase=$dbname;
	$namatabelnya=$namatablenya;
	$link=$DbConn=mysql_pconnect($hostname,$username,$password);
	if (!$link)
	die("Couldn't connect to MySQL");
	mysql_select_db($namadatabase , $link)
	or die("Couldn't open $namadatabase: ".mysql_error());	

	$strquery=$sqlnya;
	//echo $strquery;
	$hasilselect=mysql_query ($strquery,$link)or die(mysql_error());
	//mysql_close($link);	
}
function insert_record($namatabelnya,$sqlfield,$sqlnilai)
{ 	

	Global $dbhost;
	Global $dbusername;
	Global $dbpassword;
	Global $dbname;
	
	$hostname=$dbhost;
	$username=$dbusername;
	$password=$dbpassword;
	$namadatabase=$dbname;
	
	$hasil=false;
	
	$link=$DbConn=mysql_pconnect($hostname,$username,$password);
	if (! $link)
		die("Couldn't connect to MySQL");
	mysql_select_db($namadatabase , $link)
	or die("Couldn't open $namadatabase: ".mysql_error());
	$strquery="insert into $namatabelnya ($sqlfield) ";
	$strquery=$strquery . " values ($sqlnilai)";

	$hasilselect=mysql_query ($strquery,$link)or die(mysql_error());
}

function cari_jumlah_record_sql($sqlnya)
{ 	

	Global $dbhost;
	Global $dbusername;
	Global $dbpassword;
	Global $dbname;
	
	$hostname=$dbhost;
	$username=$dbusername;
	$password=$dbpassword;
	$namadatabase=$dbname;
	
	//echo "[$namadatabase][]";
	
	
	$hasil=false;	
	$linkbaca_record=$DbConnbaca_record=mysql_pconnect($hostname,$username,$password);
	if (! $linkbaca_record)
		die("Couldn't connect to MySQL");
	mysql_select_db($namadatabase, $linkbaca_record)
	or die("Couldn't open $namadatabase : ".mysql_error());
	
	$strquerybaca_record=$sqlnya;	
	//echo "cari_jumlah_record_sql = $sqlnya <br>";
	
	$strquerybaca_record=filter_sql($strquerybaca_record);
	//echo $strquerybaca_record;
	$hasilselectbaca_record=mysql_query($strquerybaca_record,$linkbaca_record);
	$jumbaca_record=mysql_num_rows($hasilselectbaca_record);
	if($jumbaca_record>0)
	{	
		$rowbaca_record=mysql_fetch_assoc($hasilselectbaca_record);
		//echo "cari jumlah record > 0";
		//$bufferhasilselectbaca_record=$rowbaca_record[$fieldyangdiambil];
	}
	else
	{
		//$rowbaca_record=mysql_fetch_assoc($hasilselectbaca_record);
		$bufferhasilselectbaca_record="";
		//echo "cari jumlah record <> $jumbaca_record";
	}
	//mysql_close($linkbaca_record);
	return $jumbaca_record;
}
function baca_record_sql($sqlnya,$fieldyangdiambil)
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
	if(strpos($strquery,"from tbl")>0)
	{
		//echo $strquery;
		$hasilselect=mysql_query($strquery,$link);
		$jum=mysql_num_rows($hasilselect);
		
		//echo "field baca record sql[$strquery][$fieldyangdiambil] = [ $bufferhasilselect ]<br>";
	
		if($jum>0)
		{	
			$row=mysql_fetch_assoc($hasilselect);
			$bufferhasilselect=$row[$fieldyangdiambil];
			//echo "field baca record sql = [ $bufferhasilselect ]<br>";
		}
		else
		{
			//echo "field baca record sql = jum<0<br>";
	
			$bufferhasilselect="";
		}
	}
	//mysql_close($link);

	return $bufferhasilselect;
}
function baca_display_record_sql($sqlnya,$fieldyangdiambil)
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
	//echo $strquery;
	$hasilselect=mysql_query($strquery,$link);
	$jum=mysql_num_rows($hasilselect);
	if($jum>0)
	{	
		
		for($c=0;$c<$jum;$c++)
		{
			$row=mysql_fetch_assoc($hasilselect);
			$bufferhasilselect=$row[$fieldyangdiambil];
			echo $bufferhasilselect."<br>";
		}
	}
	else
	{
		$bufferhasilselect="";
	}
	//mysql_close($link);

	return $bufferhasilselect;
}

function baca_record_sql_seek_pos($sqlnya,$position,$fieldyangdiambil)
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
	//echo $strquery;
	$hasilselect=mysql_query($strquery,$link);
	$jum=mysql_num_rows($hasilselect);
	if($jum>0)
	{	
		$row=mysql_fetch_assoc($hasilselect);
		for($c=0;$c<$position;$c++)
		{
			$bufferhasilselect=$row[$fieldyangdiambil];
		}
	}
	else
	{
		$bufferhasilselect="";
	}
	//mysql_close($link);

	return $bufferhasilselect;
}
function form_cari_total_page($nama_table,$per_jumlah)
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
	$strquery="select * from $nama_table ";	
	$strquery=filter_sql($strquery);
	
	//echo "strquery = ".$strquery;
	
	$hasilselect=mysql_query($strquery,$link);
	$lines=mysql_num_rows($hasilselect);
	
	$strnya="SELECT count(*) from $nama_table";
	$strnya=filter_sql($strnya);
	
	$lines=mysql_result(mysql_query($strnya),0);
	$count=$per_jumlah;	
	$pagecount=ceil($lines/$count);
	if($page=="")
	{
		$page=1;
	}		
	if ($page<1) $page=1;
	if ($page>$pagecount) $page=$pagecount;
	$clooping=1;	
	if($lines==0)
	{
			//data tidak ada
	}
	return $pagecount;	
}
function baca_urutan_display_kolom($buffernya,$id_display_privalage,$id_pengguna,$id_kelompok_display)
{ 	

	Global $dbhost;
	Global $dbusername;
	Global $dbpassword;
	Global $dbname;
	
	GLOBAL $buffernya;
	
	$buffernya[0][0]="";
	
	$hostname=$dbhost;
	$username=$dbusername;
	$password=$dbpassword;
	$namadatabase=$dbname;
	
	$hasil=false;	
	
	$ket="";
	if($id_display_privalage=="")
	{
	}else
	{
		$ket="id_display_privalage='$id_display_privalage'";
	}

	if($id_pengguna=="")
	{
	}else
	{
		if($ket=="")
		{
			$ket="id_pengguna='$id_pengguna'";
		}else
		{
			$ket=$ket.",id_pengguna='$id_pengguna'";
		}
	}
	
	if($id_kelompok_display=="")
	{
	}else
	{
		if($ket=="")
		{
			$ket="id_kelompok_display='$id_kelompok_display'";
		}else
		{
			$ket=$ket." and id_kelompok_display='$id_kelompok_display'";
		}
	}
	
	if($ket=="")
	{	
	}else
	{
		$ket=" where ".$ket;
	}
	$link=$DbConn=mysql_pconnect($hostname,$username,$password);
	if (! $link)
		die("Couldn't connect to MySQL");
	mysql_select_db($namadatabase , $link)
	or die("Couldn't open $namadatabase : ".mysql_error());
	$strquery="select * from tbl_display_coloum $ket order by urutan asc ";	
	
	//echo "strquery baca urutan  $strquery";	
	$hasilselect=mysql_query($strquery,$link);
	$jum=mysql_num_rows($hasilselect);

	if($jum>0)
	{			
		for($i=0;$i<$jum;$i++)
		{
			$row=mysql_fetch_assoc($hasilselect);
			$buffernya[$i][0]=$row["nama_kolom"];
			$buffernya[$i][1]=$row["format_display"];
			$buffernya[$i][2]=$row["penamaan"];
			$buffernya[$i][3]=$row["nama_table"];
			$buffernya[$i][4]=$row["nama_field_id"];
			$buffernya[$i][5]=$row["lebar"];
		}
	}
	else
	{
		$bufferhasilselect=-1;
	}
	mysql_close($link);
	
	return $jum;
}


function gen_id($param)
{
	$waktu=ambil_waktu('1');
	$hasil='';
	
	$p1=rand(0,9);
	$p2=rand(0,9);
	$p3=rand(0,9);
	$p4=rand(0,9);
	$p5=rand(0,9);
	$p6=rand(0,9);
	$p7=rand(0,9);
	$p8=rand(0,9);
	$p9=rand(0,9);
	$p10=rand(0,9);
	
	$hasil=$waktu.$p1.$p2.$p3.$p4.$p5.$p6.$p7.$p8.$p9.$p10;
	
	$p1=rand(0,9);
	$p2=rand(0,9);
	$p3=rand(0,9);
	$p4=rand(0,9);
	$p5=rand(0,9);
	$p6=rand(0,9);
	$p7=rand(0,9);
	$p8=rand(0,9);
	$p9=rand(0,9);
	$p10=rand(0,9);
		
	$hasil=$hasil.$p1.$p2.$p3.$p4.$p5.$p6.$p7.$p8.$p9.$p10;
		
	$p1=rand(0,9);
	$p2=rand(0,9);
	$p3=rand(0,9);
	$p4=rand(0,9);
	$p5=rand(0,9);
	$p6=rand(0,9);
	$p7=rand(0,9);
	$p8=rand(0,9);
	$p9=rand(0,9);
	$p10=rand(0,9);
	$hasil=$hasil.$p1.$p2.$p3.$p4.$p5.$p6.$p7.$p8.$p9.$p10;

	return $hasil;
}

function select_option($sqlnya,$nama_field,$pilihan_select,$isi_terpilih)
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
	//echo $strquery;
	$hasilselect=mysql_query($strquery,$link);
	$jum=mysql_num_rows($hasilselect);
	if($jum>0)
	{	
		if($pilihan_select=="1")
		{
			?>
			<option value="" <?php if($isi_field==""){ echo " selected";}?> >- - pilih - -</option>
			<?php
		}
		for($i=0;$i<$jum;$i++)
		{
			$row=mysql_fetch_assoc($hasilselect);
			$isi_field=htmlentities($row[$nama_field]);
			?>
			<option value="<?php echo $isi_field;?>" <?php if($isi_field==$isi_terpilih){ echo " selected";}?> ><?php echo $isi_field;?></option>
			<?php
		}
	}
	else
	{
		$bufferhasilselect=-1;
	}
	//mysql_close($link);

	//return $bufferhasilselect;
}
function select_option_id_value_java($sqlnya,$nama_field,$id_field,$pilihan_select,$isi_terpilih)
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

			$isi="<option value=\"\"";
			if($isi_field=="")
			{ 
				//echo " selected ";
			} 
			$isi=$isi.">- - pilih - - </option>";
		}
		$opt="";
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


			$opt=$opt."<option "; 
			if($isi_field_id==$isi_terpilih)
			{
				$c1=substr($isi_field_id,strlen($isi_field_id)-1,1).substr($isi_field_id,strlen($isi_field_id)-2,1);
				$c2=substr($isi_terpilih,strlen($isi_terpilih)-1,1).substr($isi_terpilih,strlen($isi_terpilih)-2,1);
				//echo "[$c1][$c2] ";
				if($c1==$c2)
				{
					$opt=$opt." selected";
				}
			}
			$opt=$opt." value=$isi_field_id  >";
			$opt=$opt."$isi_field" ;
			$opt=$opt."</option>";
		}
	}
	else
	{
		$bufferhasilselect=-1;
	}
	//mysql_close($link);
	$isi=$isi.$opt;
	return $isi;
}

function select_option_id_value($sqlnya,$nama_field,$id_field,$pilihan_select,$isi_terpilih)
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

			if(!$isi_field=="")
			{
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
	}
	else
	{
		$bufferhasilselect=-1;
	}
	//mysql_close($link);

	return $isi_awal;
}

function select_option_id_value_nomor($sqlnya,$nama_field,$id_field,$pilihan_select,$isi_terpilih)
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
			$cabang_id=$row[cabang_id];	
			$olahraga_level=substr($cabang_id,0,1);		
			$olahraga_id=substr($cabang_id,2);
			
									$id_top=cari_top_level($olahraga_level,$olahraga_id);
									$nama_top=baca_record_sql("select nama from tbl_cabang_olahraga_0 where cabang_id='$id_top'","nama");	
									
									$id_kriteria_0=baca_record_sql("select id_kriteria_0 from tbl_cabang_olahraga_$olahraga_level where cabang_id='$olahraga_id'","id_kriteria_0");
									$nama_kriteria_0=baca_record_sql("select nama from tbl_kriteria_0 where id='$id_kriteria_0'","nama");
									
									$id_kriteria_1=baca_record_sql("select id_kriteria_1 from tbl_cabang_olahraga_$olahraga_level where cabang_id='$olahraga_id'","id_kriteria_1");
									$nama_kriteria_1=baca_record_sql("select nama from tbl_kriteria_1 where id='$id_kriteria_1'","nama");
									
									if($isi_field==$nama_kriteria_0)
									{
									}else
									{
										$nama=$isi_field." ".$nama_kriteria_0;
									}
									
									$isi_field=$nama_top." ".$isi_field." ".$nama_kriteria_1;			
													
			if($i==0)
			{
				$isi_awal=$isi_field_id;
			}


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

function select_option_search_option($sqlnya,$nama_field,$nama_field_penamaan,$isi_terpilih)
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
	//echo "sqlnya option search $sqlnya [$nama_field]";
	$hasilselect=mysql_query($strquery,$link);
	$jum=mysql_num_rows($hasilselect);
	
	//echo "jumlah $jum";
	if($jum>0)
	{	
		if($pilihan_select=="1")
		{
			?>
			<option value="" <?php if($isi_field==""){ echo " selected";}?> >- - pilih - -</option>
			<?php
		}
		for($i=0;$i<$jum;$i++)
		{
			$row=mysql_fetch_assoc($hasilselect);
			$isi_field=htmlentities($row[$nama_field]);
			$penamaan_field=htmlentities($row[$nama_field_penamaan]);
			?>
			<option value="<?php echo $isi_field;?>" 
			<?php 
			if($isi_field=="")
			{
				if($i==0)
				{
				echo " selected";
				}
			}else
			{
			if($isi_field==$isi_terpilih)
			{ 
				echo " selected";
			}
			}
			?> ><?php echo $penamaan_field;?></option>
			<?php
		}
	}
	else
	{
		$bufferhasilselect=-1;
	}
	//mysql_close($link);

	//return $bufferhasilselect;
}

function database_list_div($nama_table,$nama_table_query,$order_by,$order_by_pil,$per_jumlah,$page)
{
	GLOBAL $dbusername;
	GLOBAL $dbpassword;
	GLOBAL $hostname;
	GLOBAL $dbname;
	GLOBAL $buffernya;
	
	$password=$dbpassword;
	$username=$dbusername;
	$namadatabase=$dbname;

	$str_up=strtoupper($st);	
	
	$link=$DbConn=mysql_pconnect($hostname,$username,$password);
	if (! $link)
	die("Couldn't connect to MySQL");
	mysql_select_db($namadatabase , $link)
	or die("Couldn't open $namadatabase : ".mysql_error());
	//echo "order_by ".$order_by."<br>";
	if($order_by=="")
	{
		$order="";
	}else
	{
		$order=" order by ".$order_by." ".$order_by_pil;
	}
	
	$strquery="select * from $nama_table $nama_table_query $order ";
	$strquery=filter_sql($strquery);		
	
	
	$hasilselect=mysql_query($strquery,$link);
	$lines=mysql_num_rows($hasilselect);
	$str_count="$nama_table $nama_table_query ";
	$str_count=str_replace("select * ","",$str_count);
	
	$strnya="SELECT count(*) from $str_count $order ";
	$strnya=filter_sql($strnya);
	
	$lines=mysql_result(mysql_query($strnya),0);
	
	//echo $strquery." [".$lines."]";
	
	$count=$per_jumlah;	
	if($count=="")
	{
		$count=10;
	}
	//echo $count;
	if($lines>$count)
	{
		$pagecount=ceil($lines/$count);
	}else
	{
		$pagecount=0;
	}
	if($page=="")
	{
		$page=1;
	}		
	if ($page<1) $page=1;
	if ($page>$pagecount) $page=$pagecount;
	$clooping=1;	
	if($lines==0)
	{

			$hasil="<table border=0 width=100% cellspacing=1 cellpadding=1 bordercolor=#CCCCCC style=border-collapse: collapse>";
			$hasil = $hasil."<tr>";
			$hasil = $hasil."<td>";
			$hasil = $hasil."data tidak tersedia";
			$hasil = $hasil."</td>";
			$hasil = $hasil."</tr>";
			$hasil = $hasil."</table>";

	}
	else
	{
			//echo $strquery." [$lines] [$page] [$begin] [$count]<br>";
			$ctr_kolom=1;
			$ctr_baris=1;
			$hasil="<table border=0 width=100% cellspacing=1 cellpadding=1 bordercolor=#CCCCCC style=border-collapse: collapse>";
			$begin=($page-1)*$count;
			
			if($begin<0)
			{
				$begin=0;
			}
			//echo $strquery." [$lines] [$page] [$begin] [$count]<br>";
			
			$counterloop=1;	
			$no=1;
			if($page>1)
			{
				$no=(($page-1)*$count)+1;
			}
			$clooping=$no;			
			$query=mysql_query("$strquery LIMIT $begin,$count");		
			
			
			while ($row=mysql_fetch_array($query))	
			{
				$isi=$row[nama_perusahaan];		
				$hasil = $hasil."<tr onclick=getselectedvalue(this.id); class=#table_list_netral id=\" echo $id_baris; \"  onmouseout=\"tbl_list_mouse_out(this);\" onmouseover=\"tbl_list_mouse_over(this);\">";
				$hasil = $hasil."<td>";
				//$isi_1=filter_set($isi_1);
				$hasil = $hasil."".$isi;	
				$hasil = $hasil."</td>";
				$hasil = $hasil."</tr>";					
			}

							
			$hasil = $hasil."</table>";
	}
	return $hasil;
}
function filter_insert($st)
{
	$hasil=$st;
	$hasil=addslashes(trim($hasil));
	$hasil=mysql_real_escape_string($hasil);
	return $hasil;
}
function filter_read($st)
{
	$hasil=$st;
	$hasil=htmlentities($hasil);
	$hasil=stripslashes($hasil);
	return $hasil;
}

function filter_set($st)
{
	$hasil=$st;
	$hasil=str_replace("”","\"",$hasil);
	$hasil=str_replace("“","\"",$hasil);
	$hasil=str_replace("’","\'",$hasil);
	$hasil=str_replace("'","\'",$hasil);
	//$hasil=str_replace("+","signplus",$hasil);
	$hasil=mysql_real_escape_string($hasil);
	return $hasil;
}
function filter_sql($st)
{
	$hasil=$st;	
	$hasil=str_replace("&singlequote;","'",$hasil);	
	$hasil=str_replace("signplus","+",$hasil);
	//echo "[$hasil]";
	$hasil=str_replace("quote_one","'",$hasil);
	$hasil=str_replace("–","-",$hasil);
	$hasil=str_replace("\'","'",$hasil);
	$hasil=str_replace("Consolas","ARIAL",$hasil);	
	return $hasil;
}
function filter_sql_2($st)
{
	$hasil=$st;	
	$hasil=str_replace("quote_one","'",$hasil);
	$hasil=str_replace("–","-",$hasil);
	$hasil=str_replace("\'","'",$hasil);
	$hasil=str_replace("//","/",$hasil);
	$hasil=str_replace("\n","<br>",$hasil);
	$hasil=str_replace("Consolas","ARIAL",$hasil);
	$hasil=str_replace("–","-",$hasil);
	
	return $hasil;
}

function get_client_ip()
{
	$v='';
	$v= (!empty($_SERVER['REMOTE_ADDR']))?$_SERVER['REMOTE_ADDR'] :((!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR']: @getenv('REMOTE_ADDR'));
	if(isset($_SERVER['HTTP_CLIENT_IP']))
	$v=$_SERVER['HTTP_CLIENT_IP'];
	return htmlspecialchars($v,ENT_QUOTES);
}

function ada_record($namatabelnya,$fieldnya,$nilainya)
{ 	


	
	Global $dbhost;
	Global $dbusername;
	Global $dbpassword;
	Global $dbname;
	
	$hostname=$dbhost;
	$username=$dbusername;
	$password=$dbpassword;
	$namadatabase=$dbname;	
	
	
	//$dbusername="t61980_t61980";
	//$dbpassword="mitra2007";
	
	$hostnamebaca_record="localhost";
	$usernamebaca_record=$dbusername;
	$passwordbaca_record=$dbpassword;
	$namadatabasebaca_record=$namadatabase;	
		
	
	$hasil=false;	
	$linkbaca_record=$DbConnbaca_record=mysql_connect($hostnamebaca_record,$usernamebaca_record,$passwordbaca_record);
	if (! $linkbaca_record)
		die("Couldn't connect to MySQL");
	mysql_select_db($namadatabasebaca_record , $linkbaca_record)
	or die("Couldn't open $namadatabasebaca_record : ".mysql_error());
	$tnilainya=strtoupper($nilainya);
	$strquerybaca_record="select * from $namatabelnya where upper($fieldnya)='$tnilainya'";	
	$hasilselectbaca_record=mysql_query($strquerybaca_record,$linkbaca_record);
	$jumbaca_record=mysql_num_rows($hasilselectbaca_record);
	
	//echo "Sql = $strquerybaca_record<br>";
	//echo "Jumlah =".$jumbaca_record." $strquerybaca_record<br>";
	if($jumbaca_record>0)
	{	
		$bufferhasilselectbaca_record=true;
	}
	else
	{
		$bufferhasilselectbaca_record=false;
	}
	//mysql_close($linkbaca_record);
	return $bufferhasilselectbaca_record;
}


function generate_page($base,$pagecount,$currentpage)
{
	?>	
	<script language="javascript">
	var last_btn;
	var cur_btn=<?php echo $currentpage;?>;
	function swap_button_page_2(obj,num)
	{
		var background;
		background=obj;
		background.style.backgroundImage = 'url(btn_num_1s.png)';
		
			var n='num_'+num;
			var obj_font=document.getElementById(n);			
			obj_font.style.color='#FFFFFF';		
	}
	
	function swap_button_page_1(obj,pil,num)
	{
		var background;
		background=obj;
		if(pil==0)
		{
			background.style.backgroundImage = 'url(btn_num_2s.png)';
			var n='num_'+num;
			//alert(n);
			var obj_font=document.getElementById(n);
			obj_font.style.color='#000000';
		}
	}
	</script>	
	
	<table border=0 cellpadding=0 cellspacing=0 style="margin-left:8px;">
	<tr>
		<td height=4>
			<font style="font-size:6px">&nbsp;</font>
		</td>
	</tr>
	<tr>
	<?php			
	if($currentpage=="")
	{
		$currentpage=1;
	}
	$total_page=$pagecount+1;
	$loo=$pagecount+1;
	if($loo>16)
	{	
		$loo=8;
		if($currentpage<7)
		{
			
			for($c=1;$c<$loo;$c++)
			{
				$url=$base."&page=$c";				
				?>
				<td onmouseover="swap_button_page_2(this,'<?php echo $c;?>');" onmouseout="swap_button_page_1(this,'<?php if($c==$currentpage) {echo  "1";}else { echo  "0";};?>','<?php echo $c;?>');" id="backnum_<?php echo $c;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
					<a href="<?php echo $url?>" target=_self style="text-decoration:none;<?php if($c==$currentpage) { ?> font-color:white; <?php }else{?> font-color:black; <?php } ?>">
						<font id="num_<?php echo $c;?>" style="font-size:12px;" <?php if($c==$currentpage) { ?> color=#FFFFFF <?php }else{?> color=#00000 <?php } ?>  >
							<?php if($c==$currentpage) { ?> <b> <?php } ?>
							<?php echo $c;?>
							<?php if($c==$currentpage) { ?> </b> <?php } ?>
						</font>
					</a>
				</td>
				<?php
			}	
			if($total_page>10)
			{
				$cc=$c;	
				for($c=1;$c<3;$c++)
				{
					$url=$base."&page=$c";
					?>
					<td  id="backnum_<?php echo $cc;?>" valign=center align=center width="30" height="30" background="btn_num_2s.png">
						.
					</td>
					<?php		
					$cc++;		
				}		
				$cc=$c;	
				for($c=$total_page-3;$c<$total_page+1;$c++)
				{
					$url=$base."&page=$c";
					?>
					<td onmouseover="swap_button_page_2(this,'<?php echo $c;?>');" onmouseout="swap_button_page_1(this,'<?php if($c==$currentpage) {echo  "1";}else { echo  "0";};?>','<?php echo $c;?>');" id="backnum_<?php echo $c;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
						<a href="<?php echo $url?>" target=_self style="text-decoration:none;<?php if($c==$currentpage) { ?> font-color:white; <?php }else{?> font-color:black; <?php } ?>">
							<font id="num_<?php echo $c;?>" style="font-size:12px;" <?php if($c==$currentpage) { ?> color=#FFFFFF <?php }else{?> color=#00000 <?php } ?>  >
								<?php if($c==$currentpage) { ?> <b> <?php } ?>
								<?php echo $c;?>
								<?php if($c==$currentpage) { ?> </b> <?php } ?>
							</font>
						</a>
					</td>
					<?php		
					$cc++;		
				}							
			}else
			{
				for($c=$cc;$c<$loo;$c++)
				{
					$url=$base."&page=$c";				
					?>
					<td onmouseover="swap_button_page_2(this,'<?php echo $c;?>');" onmouseout="swap_button_page_1(this,'<?php if($c==$currentpage) {echo  "1";}else { echo  "0";};?>','<?php echo $c;?>');" id="backnum_<?php echo $c;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
						<a href="<?php echo $url?>" target=_self style="text-decoration:none;<?php if($c==$currentpage) { ?> font-color:white; <?php }else{?> font-color:black; <?php } ?>">
							<font id="num_<?php echo $c;?>" style="font-size:12px;" <?php if($c==$currentpage) { ?> color=#FFFFFF <?php }else{?> color=#00000 <?php } ?>  >
								<?php if($c==$currentpage) { ?> <b> <?php } ?>
								<?php echo $c;?>
								<?php if($c==$currentpage) { ?> </b> <?php } ?>
							</font>
						</a>
					</td>
					<?php
				}						
			}
						
			

		
		}else
		{
			$cc=1;
			
			for($c=1;$c<3;$c++)
			{
				$url=$base."&page=$c";
				?>
				<td onmouseover="swap_button_page_2(this,'<?php echo $c;?>');" onmouseout="swap_button_page_1(this,'<?php if($c==$currentpage) {echo  "1";}else { echo  "0";};?>','<?php echo $c;?>');" id="backnum_<?php echo $cc;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
					<a href="<?php echo $url?>" target=_self style="text-decoration:none;<?php if($c==$currentpage) { ?> font-color:white; <?php }else{?> font-color:black; <?php } ?>">
						<font id="num_<?php echo $c;?>" style="font-size:12px;" <?php if($c==$currentpage) { ?> color=#FFFFFF <?php }else{?> color=#00000 <?php } ?>  >
							<?php if($c==$currentpage) { ?> <b> <?php } ?>
							<?php echo $c;?>
							<?php if($c==$currentpage) { ?> </b> <?php } ?>
						</font>
					</a>
				</td>
				<?php	
				$cc++;			
			}
			for($c=1;$c<3;$c++)
			{
				$url=$base."&page=$c";
				?>
				<td  id="backnum_<?php echo $cc;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
					.
				</td>
				<?php		
				$cc++;		
			}			
			if(($currentpage+4)>=$total_page)
			{
				$to_page=$total_page;//$currentpage+4;
				$s_pas=true;
			}else
			{
				$to_page=$currentpage+3;
				$s_pas=false;
			}
			
			for($c=$currentpage-2;$c<$to_page;$c++)
			{
				$url=$base."&page=$c";
				?>
				<td onmouseover="swap_button_page_2(this,'<?php echo $c;?>');" onmouseout="swap_button_page_1(this,'<?php if($c==$currentpage) {echo  "1";}else { echo  "0";};?>','<?php echo $c;?>');" id="backnum_<?php echo $cc;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
					<a href="<?php echo $url?>" target=_self style="text-decoration:none;<?php if($c==$currentpage) { ?> font-color:white; <?php }else{?> font-color:black; <?php } ?>">
						<font id="num_<?php echo $c;?>" style="font-size:12px;" <?php if($c==$currentpage) { ?> color=#FFFFFF <?php }else{?> color=#00000 <?php } ?>  >
							<?php if($c==$currentpage) { ?> <b> <?php } ?>
							<?php echo $c;?>
							<?php if($c==$currentpage) { ?> </b> <?php } ?>
						</font>
					</a>
				</td>
				<?php		
				$cc++;	
				$last=$c;	
			}	
			if($s_pas==false)
			{			
				for($c=1;$c<3;$c++)
				{
					$url=$base."&page=$c";
					?>
					<td id="backnum_<?php echo $cc;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
						.
					</td>
					<?php		
					$cc++;		
				}
				if($last==($total_page-3))
				{
					$to_page=$last+1;
				}else
				{
					$to_page=$total_page-3;
				}
				for($c=$to_page;$c<$total_page;$c++)
				{
					$url=$base."&page=$c";
					?>
					<td onmouseover="swap_button_page_2(this,'<?php echo $c;?>');" onmouseout="swap_button_page_1(this,'<?php if($c==$currentpage) {echo  "1";}else { echo  "0";};?>','<?php echo $c;?>');" id="backnum_<?php echo $cc;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
						<a href="<?php echo $url?>" target=_self style="text-decoration:none;<?php if($c==$currentpage) { ?> font-color:white; <?php }else{?> font-color:black; <?php } ?>">
							<font id="num_<?php echo $c;?>" style="font-size:12px;" <?php if($c==$currentpage) { ?> color=#FFFFFF <?php }else{?> color=#00000 <?php } ?>  >
								<?php if($c==$currentpage) { ?> <b> <?php } ?>
								<?php echo $c;?>
								<?php if($c==$currentpage) { ?> </b> <?php } ?>
							</font>
						</a>
					</td>
					<?php	
					$cc++;			
				}					
			}

								
		}
	}else
	{
		for($c=1;$c<$loo;$c++)
		{
			$url=$base."&page=$c";
			
			?>
			<td onmouseover="swap_button_page_2(this,'<?php echo $c;?>');" onmouseout="swap_button_page_1(this,'<?php if($c==$currentpage) {echo  "1";}else { echo  "0";};?>','<?php echo $c;?>');" id="backnum_<?php echo $c;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
				<a href="<?php echo $url?>" target=_self style="text-decoration:none;<?php if($c==$currentpage) { ?> font-color:white; <?php }else{?> font-color:black; <?php } ?>">
					<font id="num_<?php echo $c;?>" style="font-size:12px;" <?php if($c==$currentpage) { ?> color=#FFFFFF <?php }else{?> color=#00000 <?php } ?>  >
						<?php if($c==$currentpage) { ?> <b> <?php } ?>
						<?php echo $c;?>
						<?php if($c==$currentpage) { ?> </b> <?php } ?>
					</font>
				</a>
			</td>
			<?php
		}	
		
	}

	?>
	</tr>
	<tr>
		<td height=4>
			<font style="font-size:6px">&nbsp;</font>
		</td>
	</tr>	
	</table>
	<?php
}
function generate_page_pop_up($pil,$base,$pagecount,$currentpage)
{
	?>	
	<script language="javascript">
	var last_btn;
	var cur_btn=<?php echo $currentpage;?>;
	function swap_button_page_2(obj,num)
	{
		var background;
		background=obj;
		background.style.backgroundImage = 'url(btn_num_1s.png)';
		
			var n='num_'+num;
			var obj_font=document.getElementById(n);			
			obj_font.style.color='#FFFFFF';		
	}
	
	function swap_button_page_1(obj,pil,num)
	{
		var background;
		background=obj;
		if(pil==0)
		{
			background.style.backgroundImage = 'url(btn_num_2s.png)';
			var n='num_'+num;
			//alert(n);
			var obj_font=document.getElementById(n);
			obj_font.style.color='#000000';
		}
	}
	</script>	
	
	<table border=0 cellpadding=0 cellspacing=0 style="margin-left:8px;">
	<tr>
		<td height=4>
			<font style="font-size:6px">&nbsp;</font>
		</td>
	</tr>
	<tr>
	<?php
	
	if($pil=="1")
	{
		$nama_btn="btn_goto_pop_up";
	}	
	if($pil=="2")
	{
		$nama_btn="btn_goto_pop_up_2";
	}				
	if($currentpage=="")
	{
		$currentpage=1;
	}
	$total_page=$pagecount+1;
	$loo=$pagecount+1;
	if($loo>16)
	{	
		$loo=8;
		if($currentpage<7)
		{
			
			for($c=1;$c<$loo;$c++)
			{
				$url=$base."&page=$c";			
				$page=$c;	
				?>
				<td onmouseover="swap_button_page_2(this,'<?php echo $c;?>');" onmouseout="swap_button_page_1(this,'<?php if($c==$currentpage) {echo  "1";}else { echo  "0";};?>','<?php echo $c;?>');" id="backnum_<?php echo $c;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
					<a onclick="<?php echo $nama_btn;?>('<?php echo $id;?>','<?php echo $page;?>','<?php echo $y;?>');" target=_self style="cursor:pointer;text-decoration:none;<?php if($c==$currentpage) { ?> font-color:white; <?php }else{?> font-color:black; <?php } ?>">
						<font id="num_<?php echo $c;?>" style="font-size:12px;" <?php if($c==$currentpage) { ?> color=#FFFFFF <?php }else{?> color=#00000 <?php } ?>  >
							<?php if($c==$currentpage) { ?> <b> <?php } ?>
							<?php echo $c;?>
							<?php if($c==$currentpage) { ?> </b> <?php } ?>
						</font>
					</a>
				</td>
				<?php
			}	
			if($total_page>10)
			{
				$cc=$c;	
				for($c=1;$c<3;$c++)
				{
					$url=$base."&page=$c";
					?>
					<td  id="backnum_<?php echo $cc;?>" valign=center align=center width="30" height="30" background="btn_num_2s.png">
						.
					</td>
					<?php		
					$cc++;		
				}		
				$cc=$c;	
				for($c=$total_page-3;$c<$total_page+1;$c++)
				{
					$url=$base."&page=$c";
					$page=$c;
					?>
					<td onmouseover="swap_button_page_2(this,'<?php echo $c;?>');" onmouseout="swap_button_page_1(this,'<?php if($c==$currentpage) {echo  "1";}else { echo  "0";};?>','<?php echo $c;?>');" id="backnum_<?php echo $c;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
						<a onclick="<?php echo $nama_btn;?>('<?php echo $id;?>','<?php echo $page;?>','<?php echo $y;?>');" target=_self style="cursor:pointer;text-decoration:none;<?php if($c==$currentpage) { ?> font-color:white; <?php }else{?> font-color:black; <?php } ?>">
							<font id="num_<?php echo $c;?>" style="font-size:12px;" <?php if($c==$currentpage) { ?> color=#FFFFFF <?php }else{?> color=#00000 <?php } ?>  >
								<?php if($c==$currentpage) { ?> <b> <?php } ?>
								<?php echo $c;?>
								<?php if($c==$currentpage) { ?> </b> <?php } ?>
							</font>
						</a>
					</td>
					<?php		
					$cc++;		
				}							
			}else
			{
				for($c=$cc;$c<$loo;$c++)
				{
					$url=$base."&page=$c";	
					$page=$c;			
					?>
					<td onmouseover="swap_button_page_2(this,'<?php echo $c;?>');" onmouseout="swap_button_page_1(this,'<?php if($c==$currentpage) {echo  "1";}else { echo  "0";};?>','<?php echo $c;?>');" id="backnum_<?php echo $c;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
						<a onclick="<?php echo $nama_btn;?>('<?php echo $id;?>','<?php echo $page;?>','<?php echo $y;?>');" target=_self style="cursor:pointer;text-decoration:none;<?php if($c==$currentpage) { ?> font-color:white; <?php }else{?> font-color:black; <?php } ?>">
							<font id="num_<?php echo $c;?>" style="font-size:12px;" <?php if($c==$currentpage) { ?> color=#FFFFFF <?php }else{?> color=#00000 <?php } ?>  >
								<?php if($c==$currentpage) { ?> <b> <?php } ?>
								<?php echo $c;?>
								<?php if($c==$currentpage) { ?> </b> <?php } ?>
							</font>
						</a>
					</td>
					<?php
				}						
			}
				
		}else
		{
			$cc=1;
			
			for($c=1;$c<3;$c++)
			{
				$url=$base."&page=$c";
				$page=$c;
				?>
				<td onmouseover="swap_button_page_2(this,'<?php echo $c;?>');" onmouseout="swap_button_page_1(this,'<?php if($c==$currentpage) {echo  "1";}else { echo  "0";};?>','<?php echo $c;?>');" id="backnum_<?php echo $cc;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
					<a onclick="<?php echo $nama_btn;?>('<?php echo $id;?>','<?php echo $page;?>','<?php echo $y;?>');" target=_self style="cursor:pointer;text-decoration:none;<?php if($c==$currentpage) { ?> font-color:white; <?php }else{?> font-color:black; <?php } ?>">
						<font id="num_<?php echo $c;?>" style="font-size:12px;" <?php if($c==$currentpage) { ?> color=#FFFFFF <?php }else{?> color=#00000 <?php } ?>  >
							<?php if($c==$currentpage) { ?> <b> <?php } ?>
							<?php echo $c;?>
							<?php if($c==$currentpage) { ?> </b> <?php } ?>
						</font>
					</a>
				</td>
				<?php	
				$cc++;			
			}
			for($c=1;$c<3;$c++)
			{
				$url=$base."&page=$c";
				$page=$c;
				?>
				<td  id="backnum_<?php echo $cc;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
					.
				</td>
				<?php		
				$cc++;		
			}			
			if(($currentpage+4)>=$total_page)
			{
				$to_page=$total_page;//$currentpage+4;
				$s_pas=true;
			}else
			{
				$to_page=$currentpage+3;
				$s_pas=false;
			}
			
			for($c=$currentpage-2;$c<$to_page;$c++)
			{
				$url=$base."&page=$c";
				$page=$c;
				?>
				<td onmouseover="swap_button_page_2(this,'<?php echo $c;?>');" onmouseout="swap_button_page_1(this,'<?php if($c==$currentpage) {echo  "1";}else { echo  "0";};?>','<?php echo $c;?>');" id="backnum_<?php echo $cc;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
					<a onclick="<?php echo $nama_btn;?>('<?php echo $id;?>','<?php echo $page;?>','<?php echo $y;?>');" target=_self style="cursor:pointer;text-decoration:none;<?php if($c==$currentpage) { ?> font-color:white; <?php }else{?> font-color:black; <?php } ?>">
						<font id="num_<?php echo $c;?>" style="font-size:12px;" <?php if($c==$currentpage) { ?> color=#FFFFFF <?php }else{?> color=#00000 <?php } ?>  >
							<?php if($c==$currentpage) { ?> <b> <?php } ?>
							<?php echo $c;?>
							<?php if($c==$currentpage) { ?> </b> <?php } ?>
						</font>
					</a>
				</td>
				<?php		
				$cc++;	
				$last=$c;	
			}	
			if($s_pas==false)
			{			
				for($c=1;$c<3;$c++)
				{
					$url=$base."&page=$c";
					?>
					<td id="backnum_<?php echo $cc;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
						.
					</td>
					<?php		
					$cc++;		
				}
				if($last==($total_page-3))
				{
					$to_page=$last+1;
				}else
				{
					$to_page=$total_page-3;
				}
				for($c=$to_page;$c<$total_page;$c++)
				{
					$url=$base."&page=$c";
					$page=$c;
					?>
					<td onmouseover="swap_button_page_2(this,'<?php echo $c;?>');" onmouseout="swap_button_page_1(this,'<?php if($c==$currentpage) {echo  "1";}else { echo  "0";};?>','<?php echo $c;?>');" id="backnum_<?php echo $cc;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
						<a onclick="<?php echo $nama_btn;?>('<?php echo $id;?>','<?php echo $page;?>','<?php echo $y;?>');" target=_self style="cursor:pointer;text-decoration:none;<?php if($c==$currentpage) { ?> font-color:white; <?php }else{?> font-color:black; <?php } ?>">
							<font id="num_<?php echo $c;?>" style="font-size:12px;" <?php if($c==$currentpage) { ?> color=#FFFFFF <?php }else{?> color=#00000 <?php } ?>  >
								<?php if($c==$currentpage) { ?> <b> <?php } ?>
								<?php echo $c;?>
								<?php if($c==$currentpage) { ?> </b> <?php } ?>
							</font>
						</a>
					</td>
					<?php	
					$cc++;			
				}					
			}
		}
	}else
	{
		for($c=1;$c<$loo;$c++)
		{
			$url=$base."&page=$c";
			$page=$c;
			?>
			<td onmouseover="swap_button_page_2(this,'<?php echo $c;?>');" onmouseout="swap_button_page_1(this,'<?php if($c==$currentpage) {echo  "1";}else { echo  "0";};?>','<?php echo $c;?>');" id="backnum_<?php echo $c;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
				<a onclick="<?php echo $nama_btn;?>('<?php echo $id;?>','<?php echo $page;?>','<?php echo $y;?>');" target=_self style="cursor:pointer;text-decoration:none;<?php if($c==$currentpage) { ?> font-color:white; <?php }else{?> font-color:black; <?php } ?>">
					<font id="num_<?php echo $c;?>" style="font-size:12px;" <?php if($c==$currentpage) { ?> color=#FFFFFF <?php }else{?> color=#00000 <?php } ?>  >
						<?php if($c==$currentpage) { ?> <b> <?php } ?>
						<?php echo $c;?>
						<?php if($c==$currentpage) { ?> </b> <?php } ?>
					</font>
				</a>
			</td>
			<?php
		}	
		
	}

	?>
	</tr>
	<tr>
		<td height=4>
			<font style="font-size:6px">
			
			</font>
		</td>
	</tr>	
	</table>
	<?php
}

function generate_select_page($na,$pagecount,$currentpage,$pil)
{
	?>
	<form name="form_gen_sel_page_<?php echo $na;?>">
		<select name="gen_sel_page_<?php echo $na;?>" onchange="btn_gen_sel(this,'<?php echo $pil;?>')" style="padding:2">
			<?php
			for($c=0;$c<$pagecount;$c++)
			{
				$cc=$c+1;
				?>			
					<option value="<?php echo $cc;?>" <?php if($cc==$currentpage) { echo " selected";}?>><?php echo $c+1;?></option>			
				<?php
			}
			?>
		</select>
	</form>
	<?php
}

function generate_page_asli($base,$pagecount,$currentpage)
{
	?>	
	<script language="javascript">
	var last_btn;
	var cur_btn=<?php echo $currentpage;?>;
	function swap_button_page_2(obj,num)
	{
		var background;
		background=obj;
		background.style.backgroundImage = 'url(btn_num_1s.png)';
		
			var n='num_'+num;
			var obj_font=document.getElementById(n);			
			obj_font.style.color='#FFFFFF';		
	}
	
	function swap_button_page_1(obj,pil,num)
	{
		var background;
		background=obj;
		if(pil==0)
		{
			background.style.backgroundImage = 'url(btn_num_2s.png)';
			var n='num_'+num;
			//alert(n);
			var obj_font=document.getElementById(n);
			obj_font.style.color='#000000';
		}
	}
	</script>	
	
	<table border=0 cellpadding=0 cellspacing=0 style="margin-left:8px;">
	<tr>
		<td height=4>
			<font style="font-size:6px">&nbsp;</font>
		</td>
	</tr>
	<tr>
	<?php			
	if($currentpage=="")
	{
		$currentpage=1;
	}
	
	for($c=1;$c<$pagecount+1;$c++)
	{
		$url=$base."&page=$c";
		
		?>
		<td onmouseover="swap_button_page_2(this,'<?php echo $c;?>');" onmouseout="swap_button_page_1(this,'<?php if($c==$currentpage) {echo  "1";}else { echo  "0";};?>','<?php echo $c;?>');" id="backnum_<?php echo $c;?>" valign=center align=center width="30" height="30" <?php if($c==$currentpage) { ?> background="btn_num_1s.png" <?php }else{?> background="btn_num_2s.png" <?php } ?>>
			<a href="<?php echo $url?>" target=_self style="text-decoration:none;<?php if($c==$currentpage) { ?> font-color:white; <?php }else{?> font-color:black; <?php } ?>">
				<font id="num_<?php echo $c;?>" style="font-size:12px;" <?php if($c==$currentpage) { ?> color=#FFFFFF <?php }else{?> color=#00000 <?php } ?>  >
					<?php if($c==$currentpage) { ?> <b> <?php } ?>
					<?php echo $c;?>
					<?php if($c==$currentpage) { ?> </b> <?php } ?>
				</font>
			</a>
		</td>
		<?php
	}
	?>
	</tr>
	<tr>
		<td height=4>
			<font style="font-size:6px">&nbsp;</font>
		</td>
	</tr>	
	</table>
	<?php
}


function tambah_index($jenis,$judul,$id_sumber,$id_nama,$isi,$nama_table,$id_pengguna,$waktu_sumber,$waktu_1,$waktu_2)
{
	$waktu=ambil_waktu("0");
	
	$id_index=gen_id($para);
	//echo "function tambah index <br>";
	$sqlnya="insert into tbl_indek (id,judul,id_sumber,id_nama,jenis,isi,nm_table,id_pengguna,waktu,waktu_sumber,waktu_1,waktu_2,status,status_delete)values(";
	$sqlnya=$sqlnya."'$id_index','$judul','$id_sumber','$id_nama','$jenis','$isi','$nama_table','$id_pengguna','$waktu','$waktu_sumber','$waktu_1','$waktu_2','1','0'";
	$sqlnya=$sqlnya.")";
	//echo "sql tambah index [$sqlnya]";
	sql_execute($sqlnya);	

}

function comboleveljumlah($batas,$level,$idupper,$level_terpilih,$id_terpilih)
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
	if($idupper=="")
	{
		$strquery="select * from tbl_cabang_olahraga_$level where status_delete='0' and status='1' order by level asc";		
	}else
	{
		$strquery="select * from tbl_cabang_olahraga_$level where id_upper='$idupper' and status_delete='0' and status='1' order by level asc";	
	}
	//echo "strquery baca urutan  $strquery";	
	$hasilselect=mysql_query($strquery,$link);
	$jum=mysql_num_rows($hasilselect);
	return $jum;	
}
GLOBAL $st;
$st=1;
function combolevel($batas,$level,$idupper,$level_terpilih,$id_terpilih)
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
	if($idupper=="")
	{
		$strquery="select * from tbl_cabang_olahraga_$level where status_delete='0' and status='1' order by level asc";		
	}else
	{
		$strquery="select * from tbl_cabang_olahraga_$level where id_upper='$idupper' and status_delete='0' and status='1' order by level asc";	
	}
	//echo "strquery baca urutan  $strquery";	
	$hasilselect=mysql_query($strquery,$link);
	$jum=mysql_num_rows($hasilselect);
	if($jum>0)
	{			
		GLOBAL $st;
		for($c=0;$c<$jum;$c++)
		{
			$row=mysql_fetch_assoc($hasilselect);
			$isi_field_0=filter_sql($row[nama]);
			$id_content_0=$row[cabang_id];	
			
			$id_kriteria_0=$row[id_kriteria_0];	
			$id_kriteria_1=$row[id_kriteria_1];	
			$nama_kriteria_0=baca_record_sql("select singkatan from tbl_kriteria_0 where id='$id_kriteria_0'","singkatan");
			$nama_kriteria_1=baca_record_sql("select singkatan from tbl_kriteria_1 where id='$id_kriteria_1'","singkatan");
			if($nama_kriteria_0=="")
			{
			}else
			{
				$nama_kriteria_0="".$nama_kriteria_0."";
			}
			if($nama_kriteria_1=="")
			{
			}else
			{
				$nama_kriteria_1="".$nama_kriteria_1."";
			}			
			if($level>0)
			{
				$sp=$level+3;
				$selisih=($level-1)*2;
				$sp=$sp+$selisih;
			}else
			{
				$sp=0;
			}
			$space="";		
			for($cc=0;$cc<$sp;$cc++)
			{
				//$space=$space."-";
			}
			$isi=$space.$isi_field_0;
			if($idupper=="")
			{
				$value="0_".$id_content_0;
			}else
			{
				//$value=$level."_".$idupper."_".$id_content_0;
				$value=$level."_".$id_content_0;
			}

						
			$tempnextlevel=$level+1;
			$jumlahbawah=comboleveljumlah($batas,$tempnextlevel,$id_content_0,$level_terpilih,$id_terpilih);
			//echo "jumlah[$jumlahbawah]";
			if($jumlahbawah==0)
			{
				
				$id_top=cari_top_level($level,$id_content_0);
				$nama_top=baca_record_sql("select nama from tbl_cabang_olahraga_0 where cabang_id='$id_top'","nama");
				
				$isi="$nama_top ".$isi." $nama_kriteria_0 $nama_kriteria_1";			
				?>
				<option value="<?php echo $value;?>" <?php if(($level==$level_terpilih) &&( $id_content_0==$id_terpilih)) { echo " selected"; }?>><?php //echo "[$level][$level_terpilih][$id_content_0][$id_terpilih]";?><?php if(($level==$level_terpilih) &&( $id_content_0==$id_terpilih)) { }?><?php echo $isi;?></option>
				<?php
				$st++;
			}
			if($level<$batas)
			{
				$nextlevel=$level+1;				
				combolevel($batas,$nextlevel,$id_content_0,$level_terpilih,$id_terpilih);
			}				
		}		
	}
}
function combolevel_for_java($batas,$level,$idupper,$level_terpilih,$id_terpilih)
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
	if($idupper=="")
	{
		$strquery="select * from tbl_cabang_olahraga_$level where status_delete='0' and status='1' order by level asc";		
	}else
	{
		$strquery="select * from tbl_cabang_olahraga_$level where id_upper='$idupper' and status_delete='0' and status='1' order by level asc";	
	}
	//echo "strquery baca urutan  $strquery";	
	$hasilselect=mysql_query($strquery,$link);
	$jum=mysql_num_rows($hasilselect);
	if($jum>0)
	{			
		for($c=0;$c<$jum;$c++)
		{
			$row=mysql_fetch_assoc($hasilselect);
			$isi_field_0=filter_sql($row[nama]);
			$id_content_0=$row[cabang_id];	

			$id_kriteria_0=$row[id_kriteria_0];	
			$id_kriteria_1=$row[id_kriteria_1];	
			$nama_kriteria_0=baca_record_sql("select singkatan from tbl_kriteria_0 where id='$id_kriteria_0'","singkatan");
			$nama_kriteria_1=baca_record_sql("select singkatan from tbl_kriteria_1 where id='$id_kriteria_1'","singkatan");
			if($nama_kriteria_0=="")
			{
			}else
			{
				$nama_kriteria_0="[".$nama_kriteria_0."]";
			}
			if($nama_kriteria_1=="")
			{
			}else
			{
				$nama_kriteria_1="[".$nama_kriteria_1."]";
			}
						
			if($level>0)
			{
				$sp=$level+3;
				$selisih=($level-1)*2;
				$sp=$sp+$selisih;
			}else
			{
				$sp=0;
			}
			$space="";		
			for($cc=0;$cc<$sp;$cc++)
			{
				//$space=$space."-";
			}
			$isi=$space.$isi_field_0;
			if($idupper=="")
			{
				$value="0_".$id_content_0;
			}else
			{
				//$value=$level."_".$idupper."_".$id_content_0;
				$value=$level."_".$id_content_0;
			}
			//echo "[$level][$id_content_0]<br>";
			$id_top=cari_top_level($level,$id_content_0);
			$nama_top=baca_record_sql("select nama from tbl_cabang_olahraga_0 where cabang_id='$id_top'","nama");
			$isi="$nama_top ".$isi." $nama_kriteria_0 $nama_kriteria_1";
			
			echo " <option value=$value ";
			if(($level==$level_terpilih) &&( $id_content_0==$id_terpilih)) 
			{ 
				echo " selected "; 
			}
		 	echo ">";
			 echo $isi;
			 echo "</option>";
			
			if($level<$batas)
			{
				$nextlevel=$level+1;				
				combolevel_for_java($batas,$nextlevel,$id_content_0,$level_terpilih,$id_terpilih);
			}	
						
		}//end for		
	}
}

function cari_top_level($level,$id)
{
	Global $dbhost;
	Global $dbusername;
	Global $dbpassword;
	Global $dbname;	
					
	$hostname=$dbhost;
	$username=$dbusername;
	$password=$dbpassword;
	$namadatabase=$dbname;
					
	$hasil=$id;
	//$level=$levelcab;
	if($level>0)
	{
		$link=$DbConn=mysql_pconnect($hostname,$username,$password);
		if (! $link)
			die("Couldn't connect to MySQL");
		mysql_select_db($namadatabase , $link)
		or die("Couldn't open $namadatabase : ".mysql_error());
		$strquery="select * from tbl_cabang_olahraga_$level where cabang_id='$id' and status='1' and status_delete='0'";
		$hasilselect=mysql_query($strquery,$link);
		$jum=mysql_num_rows($hasilselect);
		//echo "[$level][$strquery][$jum]<br>";				
		if($jum>0)
		{		
			//for($c=0;$c<$jum;$c++)
			//{
				$hasil=$id;
				$row=mysql_fetch_assoc($hasilselect);
				$id_up=$row[id_upper];
				$id_cur=$row[cabang_id];
				if($level>0)
				{
					$level--;
					//echo "cari top level $level,$id_up<br>";
					$hasil=cari_top_level($level,$id_up);
				}else
				{
					$hasil=$id;
					$level--;
					//echo "hasil = [$level][$hasil]<br>";
					//return $hasil;
					//exit;
				}
			//}
		}		
	}else
	{
		//echo "hasil nol = [$level][$hasil]<br>";
		return $hasil;
	}
	if($level=="-1")
	{
		//echo "<0 $hasil<br>";
		return $hasil;
		//break;
		//exit;
	}	
	//echo "hasil ujung = [$level][$hasil]<br>";
	return $hasil;
}	

?>