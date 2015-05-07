<html>
<head>
    <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/styles/report.css" type="text/css" />
</head>
<body>
	<htmlpageheader name="hader1" style="display:none">
		<h3 class="pagetitle">กำหนดข้อมูลตำบล</h3>
		<div class="printdate">
			<div align="left" style="float: left; width:200px;">วันเวลาที่พิมพ์ {DATE j/m/Y H:m:s}</div>
			<div align="right">หน้าที่ {PAGENO}</div>
		</div>
	</htmlpageheader>
	<sethtmlpageheader name="hader1" page="O" value="on" show-this-page="1" />
	<div class="content">
	    <?php
	        $sql = "select * from settumb ";
	        $command = Yii::app()->db->createCommand($sql);
	        $dataReader = $command->query();
	        $i = 0;
	        $dataReader->bindColumn(2, $tumbcode);
	        $dataReader->bindColumn(3, $tumbdesc);
	        while ($dataReader->read() !== false) {
	        	echo "<p>".$tumbcode."  :  ".$tumbdesc."</p>";
	        }
	    ?>
	</div>
</body>