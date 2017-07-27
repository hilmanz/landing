<?php

function select_tahun($awal,$akhir,$terpilih)
{
	for($c=$akhir;$c>$awal-1;$c--)
	{
		?>
		<option value="<?php echo $c;?>" <?php if($c==$terpilih){ echo "selected";}?>><?php echo $c;?></option>
		<?php
	}
}
function select_tanggal($awal,$akhir,$terpilih)
{
	for($c=$awal;$c<$akhir+1;$c++)
	{
		?>
		<option  value="<?php echo $c;?>" <?php if($c==$terpilih){ echo " selected ";}?>><?php echo $c;?></option>
		<?php
	}
}
function select_bulan($terpilih)
{
	for($c=1;$c<13;$c++)
	{
		?>
		<option value="<?php echo $c;?>" <?php if($c==$terpilih){ echo "selected";}?>><?php echo nama_bulan_ind($c);?></option>
		<?php
	}
}
function addlistcombotahun_dgn_nilai($Comboname,$nilainya)
{	
	$y_n=date("Y")+10;
	//echo "t = $y_n";
	for($i=$y_n;$i>1945;$i--)
	{

		echo "<option value=\"";
		if($i<10)
		{
			echo "0";
		}		
		echo $i;
		echo "\"";
		if($i==$nilainya)
		{
			echo " selected";
		}
		echo ">";
		echo $i;
		echo "</option>";
	}
	return;
}
function addlistcombotahun_dgn_nilai_2($Comboname,$nilainya)
{	
	$y_n=date("Y")+10;
	//echo "t = $y_n";
	$t=$nilainya;
	if($t=="")
	{
		$t=date("Y");
		//echo "$t";
	}
	for($i=1979;$i<$y_n;$i++)
	{

		echo "<option value=\"";
		if($i<10)
		{
			echo "0";
		}		
		echo $i;
		echo "\"";
		if($i==$t)
		{
			echo " selected";
		}
		echo ">";
		echo $i;
		echo "</option>";
	}
	return;
}

function addlistcombobulan_dgn_nilai($Comboname,$nilainya)
{	
$bufferbulan[1]="Januari";
$bufferbulan[2]="Februari";
$bufferbulan[3]="Maret";
$bufferbulan[4]="April";
$bufferbulan[5]="Mei";
$bufferbulan[6]="Juni";
$bufferbulan[7]="Juli";
$bufferbulan[8]="Augustus";
$bufferbulan[9]="September";
$bufferbulan[10]="Oktober";
$bufferbulan[11]="November";
$bufferbulan[12]="Desember";

	for($i=1;$i<13;$i++)
	{

		echo "<option value=\"";
		if($i<10)
		{
			echo "0";
		}			
		echo $i;
		echo "\"";
		if($i==$nilainya)
		{
			echo " selected";
		}		
		echo ">";
		echo $bufferbulan[$i];
		echo "</option>";
	}
	return;
}


function nama_bulan($bln)
{
	if($_SESSION["lang_nama"]=="Indonesia")
	{
		$hasil=nama_bulan_ind($bln);
	}
	if($_SESSION["lang_nama"]=="English")
	{
		$hasil=nama_bulan_ing($bln);
	}
	return $hasil;
}
function nama_bulan_ind($bln)
{
	switch($bln)
	{
		case	"01"	:	$st="Januari";
							break;
		case	"02"	:	$st="Februari";
							break;
		case	"03"	:	$st="Maret";
							break;
		case	"04"	:	$st="April";
							break;
		case	"05"	:	$st="Mei";
							break;
		case	"06"	:	$st="Juni";
							break;
		case	"07"	:	$st="Juli";
							break;
		case	"08"	:	$st="Agustus";
							break;
		case	"09"	:	$st="September";
							break;
		case	"10"	:	$st="Oktober";
							break;
		case	"11"	:	$st="November";
							break;
		case	"12"	:	$st="Desember";
							break;		
	}
	return $st;
}
function nama_bulan_eng($bln)
{
	switch($bln)
	{
		case	"01"	:	$st="Januari";
							break;
		case	"02"	:	$st="Februari";
							break;
		case	"03"	:	$st="March";
							break;
		case	"04"	:	$st="April";
							break;
		case	"05"	:	$st="May";
							break;
		case	"06"	:	$st="Juny";
							break;
		case	"07"	:	$st="July";
							break;
		case	"08"	:	$st="Augustus";
							break;
		case	"09"	:	$st="September";
							break;
		case	"10"	:	$st="October";
							break;
		case	"11"	:	$st="November";
							break;
		case	"12"	:	$st="December";
							break;		
	}
	return $st;
}

function bulan_format_roman($bln)
{
	switch($bln)
	{
		case	"01"	:	$st="I";
							break;
		case	"02"	:	$st="II";
							break;
		case	"03"	:	$st="III";
							break;
		case	"04"	:	$st="IV";
							break;
		case	"05"	:	$st="V";
							break;
		case	"06"	:	$st="VI";
							break;
		case	"07"	:	$st="VII";
							break;
		case	"08"	:	$st="VIII";
							break;
		case	"09"	:	$st="IX";
							break;
		case	"10"	:	$st="X";
							break;
		case	"11"	:	$st="XI";
							break;
		case	"12"	:	$st="X";
							break;		
	}
	return $st;
}
function ambil_tahun($waktu)
{
	$hasil=substr($waktu,0,4);	
	return $hasil;
}
function ambil_bulan($waktu)
{
	$hasil=substr($waktu,5,2);	
	return $hasil;
}
function ambil_tanggal($waktu)
{
	$hasil=substr($waktu,8,2);	
	return $hasil;
}

function ambil_waktu($param)
{
	//$hasil='';
	$hasil=date('Y-m-d H:i:s');
	switch($param)
	{
		case "0"	:	$hasil=date('Y-m-d H:i:s');
						break;	
		case "1"	:	$hasil=date('YmdHis');
						break;
		case "2"	:	$hasil=date('Y-m-d');
						$hasil=$hasil." 00:00:00";
						break;	
		case "3"	:	$hasil=date('Y-m-d H:i:s');
						break;												
	}
	return $hasil;
}

function ambil_jam($waktu)
{
	$hasil="";
	$hasil=substr($waktu,11);	
	return $hasil;	
}
function ambil_jam_menit($waktu)
{
	$hasil="";
	$hasil=substr($waktu,11,5);	
	return $hasil;	
}
function ambil_date($waktu)
{
	$hasil="";
	$hasil=substr($waktu,0,10);	
	return $hasil;	
}
function translate_waktu($waktunya)
{
	$tgl=substr($waktunya,8,2);
	if(substr($tgl,0,1)=="0")
	{
		$tgl=substr($tgl,1,1);
	}
	$bulan=substr($waktunya,5,2);
	$tahun=substr($waktunya,0,4);
	$hasil=$tgl." ".$bulan." ".$tahun;
	$hasil=$tgl." ".nama_bulan_ind($bulan)." ".$tahun;
	return $hasil;
}
function translate_waktu_no_year($waktunya)
{
	$tgl=substr($waktunya,8,2);
	if(substr($tgl,0,1)=="0")
	{
		$tgl=substr($tgl,1,1);
	}
	if($tgl<10)
	{
		$tgl="0".$tgl;
	}
	$bulan=substr($waktunya,5,2);
	$tahun=substr($waktunya,0,4);
	$hasil=$tgl." ".$bulan." ".$tahun;
	$hasil=$tgl." ".nama_bulan_ind($bulan);
	return $hasil;
}

function display_format_waktu($pil,$waktunya)
{
	$hasil=$waktunya;
	switch($pil)
	{
		case "ddmmyyyy"				:	$hasil=translate_waktu_2($waktunya);
										break;
		case "ddmmmmyyyy"			:	$hasil=translate_waktu($waktunya);
										break;
		case "ddmmyyyy hh:mm:ss"	:	$hasil=translate_waktu_3($waktunya);
										break;	
		case "ddmmmmyyyy hh:mm:ss"	:	$hasil=translate_waktu_4($waktunya);
										break;		
		case "ddmmyyyy hh:mm"		:	$hasil=translate_waktu_6($waktunya);
										break;	
		case "ddmmmmyyyy hh:mm"		:	$hasil=translate_waktu_5($waktunya);
										break;																											
	}
	return $hasil;
}

function display_format_waktu_lengkap($waktunya)
{
	$hasil=translate_waktu_3($waktunya);
	return $hasil;
}
function translate_waktu_4($waktunya)
{
	$jam=substr($waktunya,11,2);
	$menit=substr($waktunya,14,2);
	$detik=substr($waktunya,17,2);

	$hasil=translate_waktu($waktunya)." ".$jam.":".$menit.":".$detik;
	return $hasil;
}
function translate_waktu_6($waktunya)
{
	$jam=substr($waktunya,11,2);
	$menit=substr($waktunya,14,2);
	$detik=substr($waktunya,17,2);
	$tgl=substr($waktunya,8,2);
	$bulan=substr($waktunya,5,2);
	$tahun=substr($waktunya,0,4);
	$hasil=$tgl."-".$bulan."-".$tahun." ".$jam.":".$menit;
	return $hasil;
}
function translate_waktu_5($waktunya)
{
	$jam=substr($waktunya,11,2);
	$menit=substr($waktunya,14,2);
	$detik=substr($waktunya,17,2);

	$hasil=translate_waktu($waktunya)." ".$jam.":".$menit;
	return $hasil;
}
function translate_waktu_3($waktunya)
{
	$jam=substr($waktunya,11,2);
	$menit=substr($waktunya,14,2);
	$detik=substr($waktunya,17,2);
	$tgl=substr($waktunya,8,2);
	$bulan=substr($waktunya,5,2);
	$tahun=substr($waktunya,0,4);
	$hasil=$tgl."-".$bulan."-".$tahun." ".$jam.":".$menit.":".$detik;
	return $hasil;
}
function translate_waktu_3b($waktunya)
{
	$jam=substr($waktunya,11,2);
	$menit=substr($waktunya,14,2);
	$detik=substr($waktunya,17,2);
	$tgl=substr($waktunya,8,2);
	$bulan=substr($waktunya,5,2);
	$tahun=substr($waktunya,0,4);
	$hasil=$tgl." ".nama_bulan_ind($bulan)." ".$tahun." ".$jam.":".$menit.":".$detik;
	return $hasil;
}
function translate_waktu_2($waktunya)
{
	$tgl=substr($waktunya,8,2);
	$bulan=substr($waktunya,5,2);
	$tahun=substr($waktunya,0,4);
	$hasil=$tgl."-".$bulan."-".$tahun;
	return $hasil;
}
function translate_waktu_2b($waktunya)
{
	$tgl=substr($waktunya,8,2);
	$bulan=substr($waktunya,5,2);
	$tahun=substr($waktunya,0,4);
	$hasil=$tgl."/".$bulan."/".$tahun;
	return $hasil;
}
function translate_waktu_7b($waktunya)
{
	$tgl=substr($waktunya,0,2);
	$bulan=substr($waktunya,3,2);
	$tahun=substr($waktunya,6,4);
	$hasil=$tahun."-".$bulan."-".$tgl;
	return $hasil;
}


function translate_waktu_get_date($waktunya)
{
	$tgl=substr($waktunya,8,2);
	$bulan=substr($waktunya,5,2);
	$tahun=substr($waktunya,0,4);
	$hasil=$tgl."-".$bulan."-".$tahun;
	return $hasil;
}
function translate_waktu_get_date_2($waktunya)
{
	$tgl=substr($waktunya,8,2);
	$bulan=substr($waktunya,5,2);
	$tahun=substr($waktunya,0,4);
	$hasil=$tgl."/".$bulan."/".$tahun;
	

	return $hasil;
}
function translate_waktu_get_hours_seconds($waktunya)
{
	$jam=substr($waktunya,11,2);
	$menit=substr($waktunya,14,2);
	$detik=substr($waktunya,17,2);
	$hasil=$jam.":".$menit.":".$detik;
	return $hasil;
}
function translate_waktu_get_hours($waktunya)
{
	$jam=substr($waktunya,11,2);
	$menit=substr($waktunya,14,2);
	$hasil=$jam.":".$menit;
	return $hasil;
}
function addCommas($num)
{
     return preg_replace("/(?<=\d)(?=(\d{3})+(?!\d))/",".",$num);
} 

function calculateAge($birthday){
 
	return floor((time() - strtotime($birthday))/31556926);
 
}
?>