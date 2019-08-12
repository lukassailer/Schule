<!DOCTYPE html>
<html>
	<body onkeydown="keyEvent(event)" style="background-color:black; color:white;">
		 <script>
			function keyEvent(event)
			{
				var keyID = event.keyCode;
				if (keyID == 97)	//97 = Numpad Taste "1" //1 ungleich Numpad 1 (97)
				{
					window.open("http://localhost/Spiegel.php","_self"); 		//wenn Taste = Numpad 1 dann Spiegel Hauptseite öffnen
				}				
				else if (keyID ==98)  //98 = Numpad Taste "2"
				{
					window.open("http://localhost/WetterFokus.php","_self"); 	//wenn Taste = Numpad 2 dann WetterFokus öffnen	
				}
			}
		 </script>

		 <?php
			$url = "http://www.tagesschau.de/xml/rss2";						//API Call URL
			$xml = simplexml_load_file($url);								//XML File laden
			if ($xml != FALSE)												//wenn XML File existiert
			{
				for ($i=0;$i<7;$i++)										//7 einträge laden
				{
					$title = $xml->channel->item[$i]->title;				//Titel von Item an der Stelle i laden
					echo "<h1 style=font-family:arial>- $title</h1>";		//Titel anzeigen
					$description = $xml->channel->item[$i]->description;	//Beschreibung von Item ander Stelle i laden
					echo "<p style=font-size:160%;font-family:arial>	$description</p>";		//Beschreibung mit vergrößerter schrift anzeigen (Lesbarkeit)
				}
			}
			else
			{
				echo "<h1>FALSE</h1>";										//wenn XML File nicht existiert
			}
		?>

	</body>



</html>