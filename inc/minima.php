<?php



if($notrack !== 1) {
	//include 'var/cookie_consent.php';
	if(!$_COOKIE['msessionid']){
		$arr = str_split('ABCDEFGHIJKLMNOPRSTUVZQYabcdefghijklmnoprstuvzqy1234567890');
		shuffle($arr);
		$arr = array_slice($arr, 0, rand(3, 58));
		$r = implode('', $arr);
		setcookie('msessionid', crypt($r), time()+7200);
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
		$sql = "SELECT * FROM posts WHERE status = 'public' ORDER BY id DESC LIMIT 0,15";

		$res = mysql_query($sql) or die(mysql_error());

		if(mysql_num_rows($res) !=0){
			while($row = mysql_fetch_assoc($res)) {



				echo '<div class="post"><div class="post-title"><h3><a href="p.php?id=' . $row['id'] . '">'  . preg_replace("/</", "&lt;", stripslashes($row['title'])) .  '</a></h3></div><div class="featured-image"><img src="'.$row['featured'].'" />';


				
				echo '<div style="clear: both;">&nbsp;</div>';
				$body = $row['content'];
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
function read_content($id = ''){
$id = mysql_real_escape_string($id);
$sql = "SELECT * FROM posts WHERE id = '$id'";

$res = mysql_query($sql) or die(mysql_error());

if(mysql_num_rows($res) != 0){
 while($row = mysql_fetch_assoc($res)){
echo '<div class="post">';
echo '<div class="title">';
echo $row['title'];
echo '</div>';
echo '<div class="author">'.$this->get_user_realname($row['author']).'</div>';
echo '<div class="content">'.$row['content'].'</div>';
echo '</div>';
}
}
else {
//die($this->errors('404'));
}
}

function errors($id = ''){
if($id == 404){
echo 'Nothing here.';
}
}

function get_user_realname($id = ''){
if($id != ''){
$id = mysql_real_escape_string($id);
$sql = "SELECT * FROM users WHERE id = $id";
}
else {
$this->errors(1001);
// da se ne kosi s http kodovima, koristim error kodove za minimu koji kreću od 1000. 1001 je prvi i označava nedeklariranu obveznu vrijednost.
}
$res = mysql_query($sql) or die(mysql_error());

if(mysql_num_rows($res) != 0){
while($row = mysql_fetch_assoc($res)){
echo $row['realname'];
}
}

}

function get_slides(){
$sql = "SELECT * FROM slides WHERE status = 'public'";
$res = mysql_query($sql) or die(mysql_error());

if(mysql_num_rows($res) != 0){
while ($row = mysql_fetch_assoc($res)){
echo '<div class="slide" id="slide'.$row['id'].'" style="background-image: url(\''.$row['picture'].'\');">'.$row['text'].'</div>';
}
}
else{
$this->errors(404);
}
}

} // završava class

?>
