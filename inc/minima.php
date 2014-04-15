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
				$abm = '</i><br><abbr title="Skraćeni prikaz, kliknite da bi pročitali u cjelosti" /><a href="p.php?id=' . $row['id'] . '">(...)</a></abbr>';
				$body = stripslashes(((strlen($body) > 200) ? substr($body,0,197) : $body));
				$body = strip_tags($body, "<p><br></p></br><b></b><i></i>");
				$body = $body.$abm;
				echo '<div class="body"> <p>' . $body, '</p> </div></div>';
				echo '<div class="metadata"><div class="author">'.$this->get_user_realname($row['author']).'</div><div class="relativetime">'.$this->get_relative_time($row['timestamp'], 'hr').'</div>';


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
				echo '<div class="relativetime>'.$this->get_relative_time($row['timestamp'], 'hr').'</div>';
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

	function get_relative_time($post, $lang){
		$dif = time() - $post;
		if($lang == 'en'){
			if($dif < 0){
				$this->errors(1002); // greška: ovo se još nije dogodilo
			}
			if($dif == 0){
				return 'right now';
			}
			if(($dif > 0) && ($dif<10)){
				return 'just now';
			}
			if(($dif >= 10) && ($dif<=60)){
				return 'this minute';
			}
			if(($dif > 60) && ($dif < 60*30)){
				return ''.floor(($dif/60)).' minutes ago';
			}
			if(($dif >= 60*30) && ($dif < 60*31)){
				return 'half an hour ago';
			}
			if(($dif >= 60*31) && ($dif < 60*45)){
				return 'more than half an hour ago';
			}
			if(($dif > 60*45) && ($dif < 60*58)){
				return ''.floor(($dif/60)).' minutes ago';
			}
			if(($dif >= 60*60) && ($dif < 60*60*2)){
				return 'an hour ago';
			}
			if(($dif >= 60*60*2) && ($dif < 60*60*24)){
				return ''.floor(($dif/(60*60))).' hours ago';
			}
			if(($dif >= 60*60*24) && ($dif <= 60*60*25)){
				return 'yesterday';
			}
			if(($dif >= 60*60*25) && ($dif <= 60*60*24*30)){
				return ''.floor($dif/(60*60*24)).' days ago';
			}
			if(($dif >= 60*60*24*30) && ($dif <= 60*60*24*60)){
				return 'a month ago';
			}
			if(($dif >= 60*60*24*60) && ($dif <= 60*60*24*30*12)){
				return ''.floor(($dif/(60*60*24*30))).' months ago';
			}
			if(($dif >= 60*60*24*30*12) && ($dif <= 60*60*24*30*12*2)){
				return 'about a year ago';
			}
			if($dif >= 60*60*24*30*12){
				return 'about '.floor(($dif/(60*60*24*30*12))).' years ago';
			}
		}

		elseif($lang == 'hr'){
			if($dif < 0){
				$this->errors(1002);
			}
			if($dif == 0){
				return 'upravo sad';
			}
			if(($dif > 0) && ($dif<10)){
				return 'upravo sad';
			}
			if(($dif >= 10) && ($dif<=60)){
				return 'ove minute';
			}
			if(($dif > 60) && ($dif < 60*30)){
				return 'prije '.floor(($dif/60)).' minuta';
			}
			if(($dif >= 60*30) && ($dif < 60*31)){
				return 'prije pola sata';
			}
			if(($dif >= 60*31) && ($dif < 60*45)){
				return 'prije više od pola sata';
			}
			if(($dif > 60*45) && ($dif < 60*58)){
				return 'prije '.floor(($dif/60)).' minuta'; 
			}
			/*
			našao sam logiku u ovom! (vjerojatno je bila općepoznata, ali svejedno se ponosim sobom)
			nije mi se baš dalo implementirati, ali napravit ću to poslije
			uglavnom, a ovo je posebno bitno kod minuta, gleda se zadnja znamenka broja
			kod jednoznamenkastih brojeva, 1 je 'minutu', 2-4 je 'minute', 5-9 je 'minuta', a 0 je vjerojatno također (iako ???) 'minuta'
			kod dvoznamenkastih brojeva, izuzev onih od 5-20, gleda se zadnja znamenka i ide se po gornjem pravilu
			dakle, 21, 31, 41, 51 su 'minutu', 22, 23, 52 (shvaćate poantu) su 'minute', a 20, 30, 49 itd. su 'minuta'
			u svakom slučaju, mindfuck at its finest.
			*/
			if(($dif >= 60*60) && ($dif < 60*60*2)){
				return 'prije sat vremena';
			}
			if(($dif >= 60*60*2) && ($dif < 60*60*5)){
				return 'prije '.floor(($dif/(60*60))).' sata'; //ovo je razbijeno u
			}
			if(($dif >= 60*60*5) && ($dif < 60*60*21)){ // nekoliko if-ova
				return 'prije '.floor(($dif/(60*60))).' sati'; // zbog gluposti u hrvatskom jeziku
			}
			if(($dif >= 60*60*21) && ($dif < 60*60*22)){ // oko oblika riječi 'sat' uz broj
				return 'prije '.floor(($dif/(60*60))).' sat'; // naime, za 1 i 21 se rabi 'sat', za 2-4 i 22-24 'sata', a za 5-20 'sati'
			}
			if(($dif >= 60*60*22) && ($dif < 60*60*24)){
				return 'prije '.floor(($dif/(60*60))).' sata';
			}
			if(($dif >= 60*60*24) && ($dif <= 60*60*25)){ //ovo mi se čini neispravno, trebao bih testirati, ali je kod kojeg sam pisao još prije pa se ne sjećam najbolje
				return 'jučer';
			}
			if(($dif >= 60*60*25) && ($dif <= 60*60*24*30)){
				return 'prije '.floor($dif/(60*60*24)).' dana'; // ovo bi trebalo biti ispravno, osim u slučaju da tu dopadne i broj 1 (a ne bi trebao, zato postoji 'jučer'). 
			}
			if(($dif >= 60*60*24*30) && ($dif <= 60*60*24*60)){
				return 'prije mjesec dana';
			}
			if(($dif >= 60*60*24*60) && ($dif <= 60*60*24*30*5)){ // ponovno imamo gluposti hrvatskog jezika
				return 'prije '.floor(($dif/(60*60*24*30))).' mjeseca'; // na sreću, ima samo 12 mjeseci u godini
			}
			if(($dif >= 60*60*24*5) && ($dif <= 60*60*24*30*12)){ // za 1 se rabi 'mjesec', za 2-4 'mjeseca', za 5-12 'mjeseci'
				return 'prije '.floor(($dif/(60*60*24*30))).' mjeseci';
			}
			if(($dif >= 60*60*24*30*12) && ($dif <= 60*60*24*30*12*2)){ 
				return 'prije otprilike godinu dana';
			}
			if(($dif >= 60*60*24*30*12*2) && ($dif < 60*60*24*30*12*5)){ 
				return 'prije '.floor(($dif/(60*60*24*30*12))).' godine';
			}
			if($dif >= 60*60*24*30*12){
				return 'prije '.floor(($dif/(60*60*24*30*12))).' godina'; // valjda neće imati istu stranicu idućih 20 godina
			}
		}
	} 


	function get_settings_value($setting) { // ova funkcija se koristi za dobivanje postavki iz tablice settings, tipa aktivne teme ili imena stranice
		$setting = mysql_real_escape_string($setting);
		$sql = "SELECT * FROM settings WHERE name = '$setting'";

		$res = mysql_query($sql) or die(mysql_error());

		if(mysql_num_rows($res) != 0){
			while($row = mysql_fetch_assoc($res)){
				return $row['value'];
			}
		}
		else{
			$this->errors(1404); // interni 404 error :D wow such innovate
		}
	}


} // završava class

?>
