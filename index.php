<?php
// echo "<pre>" ;
// echo "hehehe" ;
function get_web_page( $url , $username , $referer ) {
		$user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
		$options = array(
				CURLOPT_CUSTOMREQUEST  => "GET",        //set request type post or get
				CURLOPT_USERAGENT      => $user_agent, //set user agent
				CURLOPT_COOKIEFILE     => dirname(__FILE__) .'/'.$username.'.txt' , //set cookie file
				CURLOPT_COOKIEJAR      => dirname(__FILE__) .'/'.$username.'.txt' , //set cookie jar
				CURLOPT_RETURNTRANSFER => true,     // return web page
				CURLOPT_HEADER         => true,    // don't return headers
				CURLOPT_FOLLOWLOCATION => false,     // follow redirects
				CURLOPT_ENCODING       => "",       // handle all encodings
				CURLOPT_AUTOREFERER    => true,     // set referer on redirect
				CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
				CURLOPT_TIMEOUT        => 120,      // timeout on response
				// CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
				CURLOPT_REFERER     	=> $referer ,       // referrer
				CURLOPT_SSL_VERIFYPEER => false,		// set verify ssl false
		);

		$ch      = curl_init( $url );
		curl_setopt_array( $ch, $options );
		$content = curl_exec( $ch );
		$err     = curl_errno( $ch );
		$errmsg  = curl_error( $ch );
		$header  = curl_getinfo( $ch );
		curl_close( $ch );

		$header['errno']   = $err;
		$header['errmsg']  = $errmsg;
		$header['content'] = $content;
		// var_dump("get_web_page");
		// var_dump($header);

		return $header;
}
function post_web_page( $url , $postdata , $user , $referer ){

			// var_dump("post_web_page");
			$user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
			$options = array(
					CURLOPT_CUSTOMREQUEST  => "POST",        //set request type post or get
					CURLOPT_POST		   => true ,
					CURLOPT_USERAGENT      => $user_agent, //set user agent
					CURLOPT_COOKIEFILE     => dirname(__FILE__) .'/'.$user.'.txt' , //set cookie file
					CURLOPT_COOKIEJAR      => dirname(__FILE__) .'/'.$user.'.txt' , //set cookie jar
					CURLOPT_RETURNTRANSFER => true ,     // return web page
					CURLOPT_HEADER         => true ,    // don't return headers
					CURLOPT_FOLLOWLOCATION => false ,     // follow redirects
					CURLOPT_ENCODING       => "",       // handle all encodings
					CURLOPT_AUTOREFERER    => true,     // set referer on redirect
					CURLOPT_CONNECTTIMEOUT => 60,      // timeout on connect
					CURLOPT_TIMEOUT        => 60,      // timeout on response
					// CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
					CURLOPT_POSTFIELDS     => $postdata ,       // stop after 10 redirects
					CURLOPT_REFERER     	=> $referer ,       // referrer
					CURLOPT_SSL_VERIFYPEER => false,		// set verify ssl false
			);
			$ch      = curl_init( $url );
			curl_setopt_array( $ch, $options );
			$content = curl_exec( $ch );
			$err     = curl_errno( $ch );
			$errmsg  = curl_error( $ch );
			$header  = curl_getinfo( $ch );
			curl_close( $ch );

				// var_dump("selesai curl");
			$header['errno']   = $err;
			$header['errmsg']  = $errmsg;
			$header['content'] = $content;
			// var_dump("post_web_page");
			// var_dump($header);

			return $header;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>API BCA</title>
<style type="text/css">
body {
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;
}

.def, .def td, .def th, .def tr {
	margin:0px;
	padding:0px;
}

.def {
	border-left:#ddf2fa solid 1px;
	border-bottom:#ddf2fa solid 1px;
}

.def td, .def th {
	border-top:#ddf2fa solid 1px;
	border-right:#ddf2fa solid 1px;
}

.def th {
	background-color:#999999;
}

.debet {
	background-color:#FF9BA3;
}

.kredit {
	background-color:#A8B3FF;
}
</style>
<link rel="stylesheet" href="jquerycustom.css" />
<script language="javascript" type="text/javascript" src="jquery.js"></script>
<script language="javascript" type="text/javascript" src="jquerycustom.js"></script>
<script language="javascript" type="text/javascript">
<!--
$(document).ready(function() {
	$("#s").datepicker({minDate: -30, maxDate: 1, dateFormat: 'yy-mm-dd'});
	$("#e").datepicker({minDate: -30, maxDate: 1, dateFormat: 'yy-mm-dd'});
});
-->
</script>
</head>
<body>
<form method="post" action="#">
<table>
<tr>
<td>Tanggal Awal</td>
<td>:</td>
<td><input type="text" name="s" id="s" value="<?php echo date('Y-m-d'); ?>" /></td>
</tr>
<tr>
<td>Tanggal Akhir</td>
<td>:</td>
<td><input type="text" name="e" id="e" value="<?php echo date('Y-m-d'); ?>" /></td>
</tr>
<tr>
<td>User</td>
<td>:</td>
<td><input type="text" name="user" id="user" value="" /></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input type="password" name="pass" id="pass" value="" /></td>
</tr>
<td>
<td colspan="3"><input type="submit" value="Lihat" /></td>
</td>
</table>
</form>
<br />
</body>
</html>
<?php
set_time_limit(300);
ini_set("display_errors", 0);
date_default_timezone_set("Asia/Jakarta");
$username = "" ;
$password = "" ;
if (!empty($_POST)) {
	$cookie=dirname(__FILE__).$_POST['user'].".txt";
	$username=$_POST['user'];
	$password=$_POST['pass'];
	$yesterday = strtotime($_POST['s']);
	$today = strtotime($_POST['e']);

	$startdate = date("d", $yesterday);
	$startmonth = date("n", $yesterday);
	$startyear = date("Y", $yesterday);

	$enddate = date("d", $today);
	$endmonth = date("n", $today);
	$endyear = date("Y", $today);
	// echo "<pre>" ;
	// var_dump($_POST);
}


// $now = DateTime::createFromFormat('U.u', microtime(true));
// echo 'Start Login : '.$now->format("m-d-Y H:i:s.u").'<br><br>';
$url="https://ibank.klikbca.com";
$referer = "" ;
// $ch = curl_init();

$result = get_web_page( $url , $username , $referer ) ;
// var_dump ($result) ;

// echo "start_here <pre> <br>" ;
// echo "<br>------------------------------------------------------------------------------------------------------------------<br>" ;


if($username != '' && $password != '') {
	// var_dump("ada masuk ke dalam sini");

// $data = explode('<input type="hidden" name="value(CurNum)" value="',$result);
// $CurNum = explode('">',@$data[1]);
$url = "https://ibank.klikbca.com/authentication.do" ;
$referer = "https://ibank.klikbca.com/" ;
// $postdata = "value(actions)=login&value(user_id)=".$username."&value(mobile)=mobile&value(CurNum)=".$CurNum[0]."&value(pswd)=".$password."&value(user_ip)=".$_SERVER['REMOTE_ADDR']."&value(Submit)=LOGIN";
$postdata = "value(actions)=login&value(user_id)=".$username."&value(user_ip)=".$_SERVER['REMOTE_ADDR']."&value(browser_info)= Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36&value(mobile)=false&value(pswd)=".$password."&value(Submit)=LOGIN";
// curl_setopt ($ch, CURLOPT_URL, 'https://ibank.klikbca.com/authentication.do');
// curl_setopt ($ch, CURLOPT_REFERER, 'https://ibank.klikbca.com/');
// curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
// curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
// curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
// curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie);
// curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata);
// curl_setopt ($ch, CURLOPT_POST, 1);
// $result = curl_exec ($ch);
$result = post_web_page( $url , $postdata , $username , $referer ) ;
// var_dump ($result) ;

$login_success = 0;
if(stristr($result['content'], 'welcome')) {
	$login_success = 1;
	echo "login berhasil " ;
} else {
	$login_success = 0;
	echo "gagal login " ;
}
if($login_success == 1) {
	// echo "masuk sampai ke login success" ;
	// $now = DateTime::createFromFormat('U.u', microtime(true));
	// echo 'Start Statement : '.$now->format("m-d-Y H:i:s.u").'<br><br>';
	$postdata = "value(D1)=0&value(r1)=1&value(startDt)=".$startdate."&value(startMt)=".$startmonth."&value(startYr)=".$startyear."&value(endDt)=".$enddate."&value(endMt)=".$endmonth."&value(endYr)=".$endyear."&value(fDt)=&value(tDt)=&value(submit1)=Lihat Mutasi Rekening";
	// curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 0 );
	// curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	// curl_setopt( $ch, CURLOPT_URL, 'https://ibank.klikbca.com/accountstmt.do?value(actions)=acctstmtview' );
	// curl_setopt( $ch, CURLOPT_REFERER, 'https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm' );
	// curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata);
	// curl_setopt ($ch, CURLOPT_POST, 1);
	// $data = curl_exec ($ch);

	$url = "https://ibank.klikbca.com/accountstmt.do?value(actions)=acctstmtview" ;
	$referer = "https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm" ;
	$result = post_web_page( $url , $postdata , $username , $referer ) ;
	$data = $result['content'] ;

	// var_dump($data);
	// $now = DateTime::createFromFormat('U.u', microtime(true));
	// echo 'Finish Statement : '.$now->format("m-d-Y H:i:s.u").'<br><br>';


	$data_bank = explode('</table>', @$data);

$d = explode('</tr>',@$data_bank[3]);
unset($d[0]);
unset($d[1]);
$totaldata = count($d)+1;
?>
<style>
thead{
	background: #000;
    color: #fff;
}
thead td{
	padding:5px;
}
tbody td{
	padding:5px;
}
.a {
	background-color: #a8b3ff;
}

</style>
<table cellpadding="0" cellspacing="2">
	<thead>
		<tr>
			<td>Date</td>
			<td>Keterangan</td>
			<td>Nama</td>
			<td>Koin Mutasi</td>
			<td>Mutasi</td>
			<td>Balance</td>
		</tr>
	</thead>
	<tbody>
			<?php
			for($i = 0; $i <= $totaldata; $i++)
			{
				$d[$i] = explode('</td>',@$d[$i]);
				$totaldetail = count(@$d[$i]);
				$d[$i]['Tgl.'] = strip_tags(str_replace(' ','',@$d[$i][0]));
				$d[$i]['Keterangan'] = str_replace("\r\n", "", @$d[$i][1]);
				$d[$i]['digit'] = strip_tags(str_replace("\r\n", "", str_replace(' ','',@$d[$i][2])));
				$d[$i]['Mutasi'] = strip_tags(str_replace("\r\n", "", str_replace(' ','',@$d[$i][3])));
				$d[$i]['Mutasi (2)'] = strip_tags(str_replace("\r\n", "", str_replace(' ','',@$d[$i][4])));
				$d[$i]['Saldo'] = strip_tags(str_replace("\r\n", "", str_replace(' ','',@$d[$i][5])));
			}

					$total = count($d)+1;
                        for($a=0;$a<=($total);$a++)
						{
							$class = '';
							($a%2 == 0)?$class='class="a"':$class='class="a"';
							if(strlen(@$d[$a][0]) > 1)
							{
								$tanggal = $d[$a]['Tgl.'];
								$tanggal = strip_tags($tanggal);
                                $nama = explode('<br>',$d[$a]['Keterangan']);
                                $tot = count($nama)-2;
								if(count($nama)==4)
								{
                                	$note = '-';
									$note = strip_tags($note);
								}
								elseif(count($nama)==5)
								{
                                	$note = $nama[2];
									$note = strip_tags($note);
								}
								elseif(count($nama)==6)
								{
                                	$note = $nama[2].' '.$nama[3];
									$note = strip_tags($note);
								}
								elseif(count($nama)==7)
								{
                                	$note = $nama[2].' '.$nama[3].' '.$nama[4];
									$note = strip_tags($note);
								}
								elseif(count($nama)==8)
								{
                                	$note = $nama[2].' '.$nama[3].' '.$nama[4].' '.$nama[5];
									$note = strip_tags($note);
								}
								else
								{
									$note = '';
								}
								$namaAcc = $nama[$tot];
								$namaAcc = strip_tags($namaAcc);
								//$namaAcc = ereg_replace('<div align="left"><font face="verdana" size="1" color="#0000bb">','',$namaAcc);

								//$namaAcc = ereg_replace('</div>','',$namaAcc);

								$keterangan = $d[$a]['Keterangan'];
								$keterangan = addslashes(strip_tags($keterangan));

								if(strstr($keterangan,'SWITCHING CR')){
									$namaAcc = str_replace('TRANSFER   DR','',@$nama[1]);
									if(strpos($namaAcc,'TANGGAL') !== false){
									$namaAcc = substr($namaAcc,18);
									}else{
									}
									$namaAcc = str_replace(range(0,9),'',$namaAcc);
									if(substr($namaAcc,0,3) == '  -')
									{
										$namaAcc = substr($namaAcc,3);
									}
									$namaAcc = str_replace('  ','',strip_tags(substr($namaAcc,0,18)));
									if(substr($namaAcc,0,1) == ' ')
									{
										$namaAcc = substr($namaAcc,1);
									}
								}

								elseif(strstr($keterangan,'SETORAN VIA CDM')){
									$namaAcc = explode(':',@$nama[1]);
									if(@$namaAcc[2] != ''){
									$namaAcc = substr(@$namaAcc[2],6);
									$namaAcc = str_replace(range(0,9),'',$namaAcc);
									if(substr($namaAcc,0,9) == '  IDR    '){
										$namaAcc = substr($namaAcc,9);
									}
									}else{
									$namaAcc = substr($namaAcc[1],6);
									$namaAcc = str_replace(range(0,9),'',$namaAcc);
									if(substr($namaAcc,0,9) == '  IDR    '){
										$namaAcc = substr($namaAcc,9);
									}
									}
									$namaAcc = substr(str_replace('  ','',strip_tags($namaAcc)),0,19);
								}
								else{
								$namaAcc = substr(str_replace('  ','',strip_tags($namaAcc)),0,19);
								}


								if(substr(@$namaAcc,0,1) == ' '){
									$namaAcc = substr($namaAcc,1,18);
								}else{
									$namaAcc = substr($namaAcc,0,18);
								}
								if(substr(@$namaAcc,-4) == ' IDR'){
									$namaAcc = substr($namaAcc,0,-4);
								}
								if(substr(@$namaAcc,-1) == ' ')
								{
									$namaAcc = substr($namaAcc,0,-1);
								}

								$nom = $d[$a]['Mutasi'];
								$saldo = $d[$a]['Saldo'];

								$nom2 = substr($d[$a]['Mutasi'],0,-7);
								$nom = substr($d[$a]['Mutasi'],0,-3);
								if(@$dc == 1)
								{
									if(strpos($namaAcc,'TARIKAN ATM') !== false)
									{
										$namaAcc = 'TARIKAN ATM';
									}
								}

								echo '<tr '.$class.' data-type="row">';
									echo '<td data-type="tanggal">'.$tanggal.'</td>';
									echo '<td data-type="keterangan">'.$keterangan.'</td>';
									echo '<td data-type="nama">'.$namaAcc.'</td>';
									echo '<td data-type="nominal2">'.$nom2.'</td>';
									echo '<td data-type="nominal">'.$nom.'</td>';
									echo '<td data-type="saldo">'.$saldo.'</td>';
									echo '<td><button data-type="copy">Copy</button></td>';
								echo '</tr>';
							}
						}

			?>
	</tbody>
</table>
<?php

		//logout
		// curl_setopt( $ch, CURLOPT_URL, 'https://ibank.klikbca.com/authentication.do?value(actions)=logout' );
		// curl_setopt( $ch, CURLOPT_REFERER, 'https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm' );
		// $logout = curl_exec ($ch);
		$url = "https://ibank.klikbca.com/authentication.do?value(actions)=logout" ;
		$referer = "https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm" ;
		$result = get_web_page( $url , $username , $referer ) ;
		// curl_close($ch);
		// $now = DateTime::createFromFormat('U.u', microtime(true));
		// echo 'Logout : '.$now->format("m-d-Y H:i:s.u").'<br><br>';
	}
	unlink( dirname(__FILE__) . '/index.txt' );
	unlink( dirname(__FILE__) .'/'.$username.'.txt' );
	// echo "unlink disini" ;
}
// $now = DateTime::createFromFormat('U.u', microtime(true));
// echo 'End Fetching : '.$now->format("m-d-Y H:i:s.u");
?>
<script type="text/javascript">
	document.querySelectorAll('button[data-type="copy"]')
	  .forEach(function(button){
	      button.addEventListener('click', function(){
	      let tanggal = this.parentNode.parentNode
	        .querySelector('td[data-type="tanggal"]')
	        .innerText;
	      let keterangan = this.parentNode.parentNode
	        .querySelector('td[data-type="keterangan"]')
	        .innerText;
	      let nama = this.parentNode.parentNode
	        .querySelector('td[data-type="nama"]')
	        .innerText;
	      let nominal2 = this.parentNode.parentNode
	        .querySelector('td[data-type="nominal2"]')
	        .innerText;
	      let nominal = this.parentNode.parentNode
	        .querySelector('td[data-type="nominal"]')
	        .innerText;
	      let saldo = this.parentNode.parentNode
	        .querySelector('td[data-type="saldo"]')
	        .innerText;

	      let tmp = document.createElement('textarea');
	          tmp.value = nama + ' \t ' + nominal2 + ' \t ' + nominal;
	          tmp.setAttribute('readonly', '');
	          tmp.style.position = 'absolute';
	          tmp.style.left = '-9999px';
	          document.body.appendChild(tmp);
	          tmp.select();
	          document.execCommand('copy');
	          document.body.removeChild(tmp);
	          console.log(`${tmp.value} copied.`);
	    });
	});
</script>
