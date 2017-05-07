<?php
// header("Content-Type:text/html;charset=utf-8");
error_reporting(E_ALL || ~E_NOTICE);

function getVailcode(){
	$url=sprintf("http://jwc.hrbnu.edu.cn/Account/Access/Login");

	$curl=curl_init($url);
	curl_setopt($curl,CURLOPT_HEADER,1);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
	$content = curl_exec($curl);
	curl_close($curl);
	list($header, $body) = explode("\r\n\r\n", $content);

	preg_match('/__RequestVerificationToken=(.*);/iU', $header, $matches);
	$Token = $matches[1];
	$GLOBALS['Token'] = $Token;
	preg_match('/ARRAffinity=(.*);/iU', $header, $matches);
	$ARRAffinity = $matches[1];
	$GLOBALS['ARRAffinity'] = $ARRAffinity;
	preg_match('/type="hidden" value="(.*)>/iU', $content, $matches);
	$codeToken = $matches[1];
	
	$newCodeToken = substr($codeToken,0,strlen($codeToken)-3); 
	$GLOBALS['codeToken'] = $newCodeToken;
	$url = "http://jwc.hrbnu.edu.cn/Account/Access/GetValidateCode";
	$curl=curl_init($url);
	$requstcookie="pgv_pvi=7158313984; pgv_si=s9945829376; __RequestVerificationToken=".$Token."; ARRAffinity=".$ARRAffinity;
	curl_setopt($curl,CURLOPT_COOKIE,$requstcookie);
	curl_setopt($curl,CURLOPT_HEADER,1);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
	$content_code = curl_exec($curl);
	curl_close($curl);
	list($header, $body) = explode("\r\n\r\n", $content_code);
	preg_match('/ASP.NET_SessionId=(.*);/iU', $header, $matches);
	$SessionId = $matches[1];
	$GLOBALS['SessionId'] = $SessionId;
	return $body;
}

$imageData=getVailcode();
while(strlen($imageData)<300)
{
	$imageData=getVailcode();
}
$filename = 'code.jpg';  
$fp= @fopen($filename,"w+"); //将文件绑定到流 
fwrite($fp,$imageData); //写入文件
fclose($fp);
// header("Content-Type:image/jpg");
// echo $imageData;

function codeDist(){

	$res = imagecreatefromjpeg('code.jpg');
	$size = getimagesize('code.jpg');


	$data = array();
	$data1 = array();
	$data2 = array();
	$data3 = array();
	$data4 = array();
	$data5 = array();
	$data6 = array();
	$d_1 = array();
	$d_2 = array();
	$d_3 = array();
	$d_4 = array();
	$d_5 = array();
	$d_6 = array();

	$y_1 = 0;
	$y_2 = 0;
	$y_3 = 0;
	$y_4 = 0;
	$y_5 = 0;
	$y_6 = 0;

	$k_0=0;
	$k_1=0;
	$k_2=0;
	$k_3=0;
	$k_4=0;
	$k_5=0;
	$k_6=0;
	$k_7=0;
	$k_8=0;
	$k_9=0;
	$data_1 = "000000100000111000011110001111100110010000001100000011000000110000001000000110000001100000011000";
	$data_2 = "000111000011111001110011010000110000001100000110000011100001110000111000010100000101111011111110";
	$data_3 = "000111100011111100000011000000110000001000001111000011100000011000000110110001111111111001111000";
	$data_4 = "000000110000011100001111000011000001111000110110011001101100010011111110111111100110110000001000";
	$data_5 = "001011110011101000010000001001000111110001111110111001010000001100000110110001101111110000111000";
	$data_6 = "000011100011111100110011011000000011110001111110011001100110001001100110011001110111110000111000";
	$data_7 = "011111110111111100000010000001100000110000001100000110000001100000110000001100000010000011100000";
	$data_8 = "000111100001111100100011011000110110001100111110011111101110011011000110110001100111111000111000";
	$data_9 = "000111000011111001100111011000110110001101100111011111100011111100000010110011101111110001111000";
	$data_0 = "000111100011111000110011011000110110001111100011010000110100001111000110111001100111110000111000";

	for($i=0; $i < $size[1]; ++$i)
	{
		for($j=0; $j < $size[0]; ++$j)
		{
			$rgb = imagecolorat($res,$j,$i);
			$rgbarray = imagecolorsforindex($res, $rgb);
			if($rgbarray['red'] < 100 || $rgbarray['green']<100
			|| $rgbarray['blue'] < 100)
			{
				$data[$i][$j]=1;
			}else{
				$data[$i][$j]=0;
			}
		}
	}
	for ($a=0; $a < $size[1]; $a++) { 
		for ($b=0; $b < $size[0]; $b++) { 
			if ($data[$a][$b]==1&&$data[$a-1][$b]==0&&$data[$a+1][$b]==0&&$data[$a][$b-1]==0&&$data[$a][$b+1]==0) {
					$data[$a][$b]=0;
			}
		}
	}

	for ($i=0; $i < $size[1]; $i++) { 
		for ($j=0; $j < $size[0]; $j++) { 
			// echo $data[$i][$j];
		}
		// echo "<br>";
	}

	//第一个数字取出
	for ($i=5; $i < 17; $i++) { 
		for ($j=7; $j < 15; $j++) { 
			$data1[$i-5][$j-7] = $data[$i][$j];
			// echo $data[$i][$j];
		}
	}
	//第二个数字取出
	for ($i=5; $i < 17; $i++) { 
		for ($j=16; $j < 24; $j++) { 
			$data2[$i-5][$j-16] = $data[$i][$j];
			//echo $data[$i][$j];
		}
	}


	for ($i=5; $i < 17; $i++) { 
		for ($j=25; $j < 33; $j++) { 
			$data3[$i-5][$j-25] = $data[$i][$j];
			//echo $data[$i][$j];
		}
	}

	//第四个数字取出
	for ($i=5; $i < 17; $i++) { 
		for ($j=34; $j < 42; $j++) { 
			$data4[$i-5][$j-34] = $data[$i][$j];
			//echo $data[$i][$j];
		}
	}

	//第五个数字取出
	for ($i=5; $i < 17; $i++) { 
		for ($j=43; $j < 51; $j++) { 
			$data5[$i-5][$j-43] = $data[$i][$j];
			//echo $data[$i][$j];
		}
	}
	//第六个数字取出
	for ($i=5; $i < 17; $i++) { 
		for ($j=52; $j < 60; $j++) { 
			$data6[$i-5][$j-52] = $data[$i][$j];
			//echo $data[$i][$j];
		}
	}

	for ($j=0; $j < $size[1]; $j++) { 
		for ($k=0; $k < $size[0]; $k++) { 
			//echo $data6[$j][$k];
		}
		//
	}

	//验证码识别
	for ($k=1; $k < 7; $k++) { 
		for ($i=0; $i < 12; $i++) { 
			for ($j=0; $j < 8; $j++) { 
				${'d_'.$k}[$i*8+$j] = ${'data'.$k}[$i][$j];
			}
		}
	}
	for ($j=1; $j < 7; $j++) { 
		for ($i=0; $i < 96; $i++) { 
			//echo ${'d_'.$j}[$i];
		}
		//
	}
	for ($i=1; $i < 7; $i++) { 
		for ($j=0; $j < 10; $j++) { 
			for ($k=0; $k < 96; $k++) { 
				if (${'d_'.$i}[$k] == ${'data_'.$j}[$k]) {
					${'k_'.$j}++;
				}
			}
		}
		$g = $k_0;

		for ($a=1; $a < 10; $a++) { 

			 if (${'k_'.$a} > $g ){
			 	$g = ${'k_'.$a};
			 	${'y_'.$i} = $a;
			 	
			 }
		}
		$k_0=0;
		$k_1=0;
		$k_2=0;
		$k_3=0;
		$k_4=0;
		$k_5=0;
		$k_6=0;
		$k_7=0;
		$k_8=0;
		$k_9=0;
	}
	$vailcode = $y_1.$y_2.$y_3.$y_4.$y_5.$y_6;
	$GLOBALS['vailcode'] = $vailcode;
	return $vailcode;
}

$vailcode=codeDist();
while(strlen($vailcode)<6)
{
	$vailcode=codeDist();
}
echo '<img src="code.jpg">';
echo "<br>";
echo $vailcode;
