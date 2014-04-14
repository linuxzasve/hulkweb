<?php



if($notrack !== 1) {
	include 'var/cookie_consent.php';
	if(!$_COOKIE['msessionid']){
		$arr = str_split('ABCDEFGHIJKLMNOPRSTUVZQYabcdefghijklmnoprstuvzqy1234567890');
		shuffle($arr);
		$arr = array_slice($arr, 0, rand(3, 58));
		$r = implode('', $arr);
		setcookie('pllsessionid', crypt($r), time()+7200);
	}

	
if($_COOKIE['cookieconsent'] == 'allow') {
	
}

}

class minima{

	var $host;
	var $username;
	var $password;
	var $db;

	function connect() {
		$con = mysql_connect($this->host, $this->username, $this->password) or die(mysql_error());
		mysql_select_db($this->db, $con) or die(mysql_error());
	}

	function get_content() {
		$sql = "SELECT * FROM cms_content WHERE status = 'public' ORDER BY id DESC LIMIT 0,15";

		$res = mysql_query($sql) or die(mysql_error());

		if(mysql_num_rows($res) !=0){
			while($row = mysql_fetch_assoc($res)) {



				echo '<div class="post"><div class="post-title"><h3><a href="p.php?id=' . $row['id'] , '">'  . preg_replace("/</", "&lt;", stripslashes($row['title'])) .  '</a></h3></div><div class="featured-image"><img src=".$row['featured'].'" />';


				
				echo '<div style="clear: both;">&nbsp;</div>';
				$body = $row['body'];
				$abm = '</i><br><abbr title="Trimmed, click to read in full." /><a href="p.php?id=' . $row['id'] . '">(...)</a></abbr>';
				$body = stripslashes(((strlen($body) > 200) ? substr($body,0,197) : $body));
				$body = strip_tags($body, "<p><br></p></br><b></b><i></i>");
				$body = $body.$abm;
				echo '<div class="body"> <p>' . $body, '</p> </div></div>';


			}
		} else {
			echo 'wat';
		}

	}

}

?>
