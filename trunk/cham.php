﻿<?php
echo "<html><head><title>Kết quả</title><meta http-equiv='refresh' content='60'/><meta name='author' content='Tran Huu Nam'></head><body>";
include("thamso.php");
if (isset($_POST['chon'])) {
	redirect("?bd=".$_POST['maso'],1);
}
if (isset($_GET['bd'])) { //co so bao danh
	$sbd = $_GET['bd'];
	if (isset($_GET['f'])) { //xem 1 bai nop cu the
		$tep = $_GET['f'];
		echo "KẾT QUẢ NỘP BÀI ";
		if (strpos($tep,'.pas')!==false) {
			exec(__DIR__ ."\\chamtudong.exe ".__DIR__ ."\\upload\\$sbd\\$tep",$ketqua);
			echo "<hr/><div><pre>".implode(PHP_EOL,$ketqua)."</pre></div><hr/>";
			echo "<div><a href='ketqua.php?bd=$sbd&f=$tep'>Xem kết quả chi tiết</a></div>";
		}
		else
			echo "Chưa hỗ trợ chấm tự động định dạng tệp này";
		
	} else { //xem tat ca ket qua
		echo "<div>Tất cả các bài nộp của sbd: $sbd</div>";
		if ($handle = opendir(__DIR__ ."\\upload\\$sbd")) {
			echo "<ul>";
			while (false !== ($file = readdir($handle)))
			{
				if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'pas')
				{
					echo '<li><a href="?bd='.$sbd.'&f='.$file.'">'.$file.'</a> ('.date("d/m/Y H:i:s", filectime(__DIR__ ."\\upload\\$sbd\\".$file)).')</li>';
				}
			}
			closedir($handle);
			echo "</ul>";
		}
	}
} else { //khong co sbd -> chon
	echo "Chọn số báo danh<ul>";
	foreach (glob(__DIR__ ."\\upload\\*",GLOB_ONLYDIR) as $filename) {
		//echo "$filename size \n";
		$filen=basename($filename);
		echo "<li><a href='?bd=".$filen."'>$filen</a></li>";
	}
	echo "</ul>";
}
echo "</body></html>";
function includeornot($tenfile,$thongbao="")
{
	if (file_exists($tenfile))
		include($tenfile);
	else
		echo $thongbao;
}

function redirect($location, $delaytime = 0) {
    if ($delaytime>0) {    
        header( "refresh: $delaytime; url='".str_replace("&amp;", "&", $location)."'" );
    } else {
        header("Location: ".str_replace("&amp;", "&", $location));
    }    
}
?>
