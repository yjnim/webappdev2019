<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>
		
		<!-- Ex 1: Number of Songs (Variables) -->
		<?php 
		$song_count = 1234;
		$song_hours = intval($song_count/10);
		 ?> 
		<p>
			I love music.
			I have <?php print "$song_count"; ?> total songs,
			which is over <?php print "$song_hours"; ?> hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Billboard News</h2>
		
			<ol>
				<?php 
				$news_pages = $_GET['newspages'];
				$current_month = date("m");
				if ($news_pages < $current_month) {
					for ($i=0; $i<$news_pages; $i++) {
						$month = $current_month - $i;
						if ($month>=10) {
							print "<li><a href='https://www.billboard.com/archive/article/2019{$month}'>2019-{$month}</a></li>";
						} elseif ($month > 0 or $month < 10) {
							print "<li><a href='https://www.billboard.com/archive/article/20190{$month}'>2019-0{$month}</a></li>";						
						}
					}
				}
				?>
			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
		
			<ol>
			<?php 
			$artists = array();
			$fp = fopen("./favorite.txt","r");
			while( !feof($fp) ) {
				$doc_data = fgets($fp);
				array_push($artists, $doc_data);
			}
			fclose($fp);			
			for ($i=0; $i<count($artists); $i++) {
				$output = str_replace(" ", "_", $artists[$i]);
				$output = str_replace("'", "", $output);
				print "<li><a href='http://en.wikipedia.org/wiki/{$output}'>{$artists[$i]}</a></li>";
			}
			?>
			</ol>
		</div>
		
		<!-- Ex 6: Music (Multiple Files) -->
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
				<?php
				$filenamearr = array();
				$sizearr = array();
				foreach (glob("lab5/musicphp/songs/*.mp3") as $mp3) {
					$output = explode("/", $mp3);
					$kbsize = floor(filesize($mp3) / 1024);
					$sizearr[$output[count($output)-1]] = $kbsize;
					array_push($filenamearr, $output[count($output)-1]);
				}
				arsort($sizearr);

				foreach ($sizearr as $key => $value) {
					print "<li class='mp3item'>
					<a href='../lab5/musicphp/songs/{$key}'>{$key}</a>
					({$value} KB)</li>";
				}

				?>

				<!-- Exercise 8: Playlists (Files) -->
				<?php
					$temp = array(); // array to save playlists' name
					
					$temp3 = array(); // array to connect playlists' name and songs
					foreach (glob("lab5/musicphp/songs/*.m3u") as $playlist) {
						$output = explode("/", $playlist);
						array_push($temp, $output[count($output)-1]);

						$plistarr = file($playlist);

						$temp2 = array(); // array to save songs' name
						foreach ($plistarr as $line) {
							if (strpos($line, "#") !== 0) {
								array_push($temp2, $line);
							}
						}
						$temp3[$output[count($output)-1]] = $temp2;
					}
					rsort($temp);

					for ($i=0; $i<count($temp); $i++) {
						print "<li class='playlistitem'>{$temp[$i]}<ul>";
						shuffle($temp3[$temp[$i]]);
						for ($j=0; $j<count($temp3[$temp[$i]]); $j++) {
							print "<li>{$temp3[$temp[$i]][$j]}</li>";
						}
						print "</ul></li>";
					
					}
					

				?>
			</ul>
		</div>

		<div>
			<a href="https://validator.w3.org/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="https://jigsaw.w3.org/css-validator/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
