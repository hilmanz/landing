<?php

//******************************* FILE
	function get_extension($from_file) {
		$ext = strtolower(strrchr($from_file,"."));
		return $ext;		
	}
function file_type_description($n)
{
	$hasil="";
	$ext = strtolower(strrchr($n,"."));
	//echo "F $n";
	switch($ext)
	{
		case ".ai"	:	$hasil="Adobe Illustrator";
						break;
		case ".avi"	:	$hasil="Video";
						break;		
		case ".bmp"	:	$hasil="Bitmap Image";
						break;	
		case ".cs"	:	$hasil="Adobe";
						break;		
		case ".doc"	:	$hasil="Microsoft Word";
						break;
		case ".exe"	:	$hasil="Application";
						break;		
		case ".fla"	:	$hasil=true;
						break;																								
		case ".flv"	:	$hasil="Flash Video";
						break;
		case ".gif"	:	$hasil="Image";
						break;
		case ".htm"	:	$hasil="Internet Document";
						break;								
		case ".html"	:	$hasil="Internet Document";
						break;
		case ".jpg"	:	$hasil="Image";
						break;						
		case ".xls"	:	$hasil="Microsoft Excell";
						break;
		case ".mdb"	:	$hasil="Microsoft Access Database";
						break;								
		case ".pdf"	:	$hasil="Adobe Acrobat";
						break;
		case ".js"	:	$hasil="Javascript";
						break;						
		case ".mp3"	:	$hasil="Audio";
						break;					
		case ".ppt"	:	$hasil="Microsoft Powerpoint Document";
						break;		
		case ".pps"	:	$hasil="Microsoft Powerpoint Slideshow";
						break;										
		case ".zip"	:	$hasil="Archive";
						break;		
		case ".txt"	:	$hasil="Text";
						break;						
		case ".png"	:	$hasil="Image Portable Network Graphics";
						break;		
		case ".rdp"	:	$hasil="Remote Desktop Protocol";
						break;						
		case ".swf"	:	$hasil="Video SWF";
						break;
		case ".swt"	:	$hasil="Video SWT";
						break;						
		case ".vsd"	:	$hasil="Microsoft Visio";
						break;	
		case ".xml"	:	$hasil="Sincronous Markup Language";
						break;		
		case ".wav"	:	$hasil="Wave Audio";
						break;	
		case ".psd"	:	$hasil="Adobe Photoshop";
						break;																																						
	}
	return $hasil;
}
function list_icon_exist($n)
{
	$hasil=false;
	
	switch(strtoupper($n))
	{
		case ".AI"	:	$hasil=true;
						break;
		case ".AVI"	:	$hasil=true;
						break;		
		case ".BMP"	:	$hasil=true;
						break;	
		case ".CS"	:	$hasil=true;
						break;		
		case ".DOC"	:	$hasil=true;
						break;
		case ".EXE"	:	$hasil=true;
						break;		
		case ".FLA"	:	$hasil=true;
						break;																								
		case ".FLV"	:	$hasil=true;
						break;
		case ".GIF"	:	$hasil=true;
						break;
		case ".HTM"	:	$hasil=true;
						break;								
		case ".HTML"	:	$hasil=true;
						break;
		case ".JPG"	:	$hasil=true;
						break;						
		case ".XLS"	:	$hasil=true;
						break;
		case ".MDB"	:	$hasil=true;
						break;								
		case ".PDF"	:	$hasil=true;
						break;
		case ".JS"	:	$hasil=true;
						break;						
		case ".MP3"	:	$hasil=true;
						break;					
		case ".PPT"	:	$hasil=true;
						break;		
		case ".PPS"	:	$hasil=true;
						break;										
		case ".ZIP"	:	$hasil=true;
						break;		
		case ".TXT"	:	$hasil=true;
						break;						
		case ".PNG"	:	$hasil=true;
						break;		
		case ".RDP"	:	$hasil=true;
						break;						
		case ".SWF"	:	$hasil=true;
						break;
		case ".SWT"	:	$hasil=true;
						break;						
		case ".vsd"	:	$hasil=true;
						break;	
		case ".XML"	:	$hasil=true;
						break;	
		case ".PSD"	:	$hasil=true;
						break;	
		case ".WAV"	:	$hasil=true;
						break;																																						
	}
	return $hasil;
}

function get_file_extension($from_file) 
	{
		$ext = strtolower(strrchr($from_file,"."));
		$t=list_icon_exist($ext);
		if(!$t)
		{
			$ext="";
		}
		return $ext;		
	}
function getSize($file) { 
        $size = filesize($file); 
        if ($size < 0) 
            if (!(strtoupper(substr(PHP_OS, 0, 3)) == 'WIN')) 
                $size = trim(`stat -c%s $file`); 
            else{ 
                $fsobj = new COM("Scripting.FileSystemObject"); 
                $f = $fsobj->GetFile($file); 
                $size = $file->Size; 
            } 
        return $size; 
} 
    
    function GetRealSize($file) {
        // Return size in Mb
        clearstatcache();
        $INT = 4294967295;//2147483647+2147483647+1;
        $size = filesize($file);
        $fp = fopen($file, 'r');
        fseek($fp, 0, SEEK_END);
        if (ftell($fp)==0) $size += $INT;
        fclose($file);
        if ($size<0) $size += $INT;
        return ceil($size/1024/1024);
    }
	
function fil_get_last_modified($f)
{
	$hasil="";
	$filename = $f;
	if (file_exists($filename)) 
	{
    $hasil= date ("F d Y H:i:s.", filemtime($filename));
}
return $hasil;
}	

function list_all_drive_space($para)
{
    for ($i = 67; $i <= 90; $i++)
    {
        $drive = chr($i);
        if (is_dir($drive.':'))
        {
            $freespace             = disk_free_space($drive.':');
            $total_space         = disk_total_space($drive.':');
            $percentage_free     = $freespace ? round($freespace / $total_space, 2) * 100 : 0;
            echo $drive.': '.to_readble_size($freespace).' / '.to_readble_size($total_space).' ['.$percentage_free.'%]<br />';
        }
    }


}

function to_readble_size($size)
    {
        switch (true)
        {
            case ($size > 1000000000000):
                $size /= 1000000000000;
                $suffix = 'TB';
                break;
            case ($size > 1000000000):
                $size /= 1000000000;
                $suffix = 'GB';
                break;
            case ($size > 1000000):
                $size /= 1000000;
                $suffix = 'MB';    
                break;
            case ($size > 1000):
                $size /= 1000;
                $suffix = 'KB';
                break;
            default:
                $suffix = 'B';
        }
        return round($size, 2).$suffix;
}

function get_file_size_formated($filename)
{
	$size=getSize($filename);
	$hasil=to_readble_size($size);	
	return $hasil;
}

function FileSize_formated($file, $setup = null)
{
    $FZ = ($file && @is_file($file)) ? filesize($file) : NULL;
    $FS = array("B","kB","MB","GB","TB","PB","EB","ZB","YB");
   
    if(!$setup && $setup !== 0)
    {
        return number_format($FZ/pow(1024, $I=floor(log($FZ, 1024))), ($i >= 1) ? 2 : 0) . ' ' . $FS[$I];
    } elseif ($setup == 'INT') return number_format($FZ);
    else return number_format($FZ/pow(1024, $setup), ($setup >= 1) ? 2 : 0 ). ' ' . $FS[$setup];
}
 
function roundsize($size){
    $i=0;
    $iec = array("B", "Kb", "Mb", "Gb", "Tb");
    while (($size/1024)>1) {
        $size=$size/1024;
        $i++;}
    return(round($size,1)." ".$iec[$i]);} 
    
function ConvertBytes($number)
{
    $len = strlen($number);
    if($len < 4)
    {
        return sprintf("%d b", $number);
    }
    if($len >= 4 && $len <=6)
    {
        return sprintf("%0.2f Kb", $number/1024);
    }
    if($len >= 7 && $len <=9)
    {
        return sprintf("%0.2f Mb", $number/1024/1024);
    }
    
    return sprintf("%0.2f Gb", $number/1024/1024/1024);
                            
} 


function get_icon_by_ext($file_ext)
{

			$str_icon="icon_ask.jpg";
			switch(strtoupper($file_ext))
			{
				case ".AI"	:	$str_icon="ai.gif";
								break;	
				case ".AVI"	:	$str_icon="avi.gif";
								break;		
				case ".BMP"	:	$str_icon="bmp.gif";
								break;	
				case ".CS"	:	$str_icon="cs.gif";
								break;										
				case ".DLL"	:	$str_icon="dll.gif";
								break;																								
				case ".DOC"	:	$str_icon="doc.gif";
								break;
				case ".EXE"	:	$str_icon="exe.gif";
								break;		
				case ".FLA"	:	$str_icon="fla.gif";
								break;																
				case ".FLV"	:	$str_icon="flv.gif";
								break;								
				case ".GIF"	:	$str_icon="gif.gif";
								break;									
				case ".HTM"	:	$str_icon="htm.gif";
								break;		
				case ".HTML"	:	$str_icon="html.gif";
								break;	
				case ".JS"	:	$str_icon="js.gif";
								break;																	
				case ".JPG"	:	$str_icon="jpg.gif";
								break;				
				case ".MDB"	:	$str_icon="mdb.gif";
								break;	
				case ".MP3"	:	$str_icon="mp3.gif";
								break;	
				case ".PNG"	:	$str_icon="png.gif";
								break;																																						
				case ".PPT"	:	$str_icon="ppt.gif";
								break;	
				case ".PDF"	:	$str_icon="pdf.gif";
								break;								
				case ".PPS"	:	$str_icon="pps.gif";
								break;								
				case ".PSD"	:	$str_icon="psd.gif";
								break;			
				case ".SWF"	:	$str_icon="swf.gif";
								break;	
				case ".SWT"	:	$str_icon="swt.gif";
								break;	
				case ".TXT"	:	$str_icon="txt.gif";
								break;		
				case ".XLS"	:	$str_icon="xls.gif";
								break;	
				case ".XML"	:	$str_icon="xml.gif";
								break;										
				case ".ZIP"	:	$str_icon="zip.gif";
								break;																																												
			}
			return $str_icon;
}

function baca_file($fullfilename)
{
	$hasil="";
	//$fsize = filesize($fullfilename);
	//echo "[$fsize]";
	$fsize=1024;
	$fd = fopen ($fullfilename, "r");    
    while(!feof($fd)) {
        $buffer = fread($fd,$fsize);
        $hasil=$hasil."".$buffer;
    }
	fclose ($fd);	
	return $hasil;
}
?>
