<?php

/*$db = mysql_connect ("servername","user","password"); 
mysql_select_db ("dbname",$db);*/

$uploaddir = '../../files/';
$file = $_POST['value'];
$name = $_POST['name'];

// Получаем расширение файла
$getMime = explode('.', $name);
$mime = end($getMime);

// Выделим данные
$data = explode(',', $file);

// Декодируем данные, закодированные алгоритмом MIME base64
$encodedData = str_replace(' ','+',$data[1]);
$decodedData = base64_decode($encodedData);

// Вы можете использовать данное имя файла, или создать произвольное имя.
// Мы будем создавать произвольное имя!
$randomName = substr_replace(sha1(microtime(true)), '', 12).'.'.$mime;

// Создаем изображение на сервере
if(file_put_contents($uploaddir.$name, $decodedData)) {

	//mysql_query ("INSERT INTO files (date,catalog,filename) VALUES (NOW(),'$uploaddir','$randomName')");
	require_once('html2pdf.class.php');
	
	$html2pdf = new HTML2PDF('L','A4','en', true, 'UTF-8', 0);
	$html2pdf->pdf->SetDisplayMode('fullpage');
	$contentHTML = file_get_contents('../../files/'.$name);
	$html2pdf->writeHTML($contentHTML);
	//$content=iconv("UTF-8","CP1251",$contentHTML);
	//$content - страница html из которой хотим получить pdf	 
	$html2pdf->Output('../../files/'.$name.'.pdf','F');
	echo $name.":загружен успешно";
} else {

	echo "Что-то пошло не так. Убедитесь, что файл не поврежден!";
}
?>