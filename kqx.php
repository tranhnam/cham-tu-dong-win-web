﻿<?php
echo "<html><head><title>Kết quả</title><meta http-equiv='refresh' content='30'/></head><body>";

if (isset($_POST['chon'])) {
	redirect("?bd=".$_POST['maso'],1);
}
if (isset($_GET['bd'])) { //co so bao danh
	$sbd = $_GET['bd'];
	if (isset($_GET['f'])) { //xem 1 bai nop cu the
		$tep = $_GET['f'];
		echo "KẾT QUẢ NỘP BÀI $tep CỦA SBD: $sbd <hr/>";
		echo "<div><h2>Kết quả chạy chương trình</h2><pre>";
		includeornot(__DIR__ ."\\upload\\$sbd\\".str_replace(".pas","_kq.txt",$tep),"không có");
		echo "</pre></div>";
		echo "<div><h2>Lỗi khi chạy chương trình</h2><pre>";
		includeornot(__DIR__ ."\\upload\\$sbd\\".str_replace(".pas","_chay.txt",$tep),"không có");
		echo "</pre></div>";
		echo "<div><h2>Lỗi biên dịch chương trình</h2><pre>";
		includeornot(__DIR__ ."\\upload\\$sbd\\".str_replace(".pas","_dich.txt",$tep),"không có");
		echo "</pre></div>";
		
	} else { //xem tat ca ket qua
		echo "<div>Tất cả các bài nộp của sbd: $sbd</div>";
		if ($handle = opendir(__DIR__ ."\\upload\\$sbd")) {
			echo "<ul>";
			while (false !== ($file = readdir($handle)))
			{
				if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'pas')
				{
					echo '<li><a href="?bd='.$sbd.'&f='.$file.'">'.$file.'</a></li>';
				}
			}
			closedir($handle);
			echo "</ul>";
		}
	}
} else { //khong co sbd -> chon
	echo "<form action='' method='post'>";
	echo "Chọn số báo danh: <input name='maso' type='text' size='9'>";
	echo " <input name='chon' type='submit' value='Xem'>";
	echo "</form>";
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