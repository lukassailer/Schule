<!DOCTYPE html>
 <meta charset="UTF-8"> 
<html>
	<body onkeydown="keyEvent(event)" style="background-color:black;color:white;">
		 <script>
			function keyEvent(event)
			{
				var keyID = event.keyCode;
				if (keyID == 97 || keyID == 98)	//49 = Taste "1" //1 ungleich Numpad 1 (97) //50 = Taste "2"
				{
					window.open("http://localhost/Spiegel.php","_self"); 	//wenn Taste = Numpad 1 oder 2 dann Spiegel Hauptseite öffnen
				}
			}
		</script>
		<?php
			$url = "http://api.openweathermap.org/data/2.5/forecast?id=2820859&APPID=e885528ee59071ff54b8cc867e8be6f1&mode=xml&units=metric&lang=de";	//API Call URL
			$xml = simplexml_load_file($url);					//XML File von Api Laden
			$hour = date("G");
			$hour = $hour/3;
			$hour = floor($hour);
			$offset = 10 - intval($hour);
		?> 
			<div style="background:#000000; width:100%; height:480px; float:left;" id="aktuell">
			<h1>Aktuell</h1>
		 
		
			<div style="background:#000000; width:50%; height:250px; float:left;" id="aktuellIcon">
				<?php
					if ($xml->forecast->time[0]->symbol['number'] > 802)	//Wolken
					{
							echo "<img src=Wolke.bmp>";
					}
					else if ($xml->forecast->time[0]->symbol['number'] > 800) //Wolke+Sonne
					{					
						if ($xml->forecast->time[0]->symbol['var'] == "02d" || $xml->forecast->time[0]->symbol['var'] == "03d")
						{
							echo "<img src=WolkeSonne.bmp>";
						}
						else
						{
							echo "<img src=WolkeMond.bmp>";
						}
					}
					else if ($xml->forecast->time[0]->symbol['number'] == 800) //Sonne
					{					
						if ($xml->forecast->time[0]->symbol['var'] == "01n")
						{
							echo "<img src=Mond.bmp>";
						}
						else
						{
							echo "<img src=Sonne.bmp>";
						}
					}
					else if ($xml->forecast->time[0]->symbol['number'] > 700) //Nebel
					{					
						echo "<img src=Nebel.bmp>";
					}
					else if ($xml->forecast->time[0]->symbol['number'] > 600) //Schnee
					{					
						echo "<img src=Schnee.bmp>";
					}
					else if ($xml->forecast->time[0]->symbol['number'] > 300) //Regen
					{					
						echo "<img src=Regen.bmp>";
					}
					else if ($xml->forecast->time[0]->symbol['number'] > 200) //Gewitter
					{					
						echo "<img src=Blitz.bmp>";
					}					
				?>
			</div>

			<div style="background:#000000; width:50%; height:250px; float:right;" id="aktuellTemp">
				<?php
					$temp = $xml->forecast->time[0]->temperature['value'];
					$condition = $xml->forecast->time[0]->symbol['name'];
				
					$temp = round($temp);
				
					echo "<h1 style=font-family:arial>$condition bei</h1>";
					echo "<h1 style=font-family:arial;font-size:500%>$temp °C</h1>";
				?>		 
			</div>

			<div style="background:#000000; width:33%; height:150px; float:left;" id="aktuell3h">
				<div style="background:#000000; width:45%; float:left;" id="aktuell3hIcon">
				<?php	
					if ($xml->forecast->time[1]->symbol['number'] > 802)	//Wolken
					{
							echo "<img src=Wolke.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[1]->symbol['number'] > 800) //Wolke+Sonne
					{					
						if ($xml->forecast->time[1]->symbol['var'] == "02d" || $xml->forecast->time[1]->symbol['var'] == "03d")
						{
							echo "<img src=WolkeSonne.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=WolkeMond.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[1]->symbol['number'] == 800) //Sonne
					{					
						if ($xml->forecast->time[1]->symbol['var'] == "01n")
						{
							echo "<img src=Mond.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=Sonne.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[1]->symbol['number'] > 700) //Nebel
					{					
						echo "<img src=Nebel.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[1]->symbol['number'] > 600) //Schnee
					{					
						echo "<img src=Schnee.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[1]->symbol['number'] > 300) //Regen
					{					
						echo "<img src=Regen.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[1]->symbol['number'] > 200) //Gewitter
					{					
						echo "<img src=Blitz.bmp width=150 height=150>";
					}					
				?>
				</div>
				
				<div style="background:#000000; width:55%; float:right;" id="aktuell3hTemp">
				<?php
					$temp = $xml->forecast->time[1]->temperature['value'];
					$condition = $xml->forecast->time[1]->symbol['name'];
					$temp = round($temp);
					echo "<h1 style=font-family:arial;font-size:130%>In 3 Stunden</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$condition bei</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$temp °C</h1>";
				?>
				</div>
			</div>

			<div style="background:#000000; width:33%; height:150px; float:right;" id="aktuell9h">
				<div style="background:#000000; width:45%; float:left;" id="aktuell9hIcon">
				<?php	
					if ($xml->forecast->time[3]->symbol['number'] > 802)	//Wolken
					{
							echo "<img src=Wolke.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[3]->symbol['number'] > 800) //Wolke+Sonne
					{					
						if ($xml->forecast->time[3]->symbol['var'] == "02d" || $xml->forecast->time[3]->symbol['var'] == "03d")
						{
							echo "<img src=WolkeSonne.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=WolkeMond.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[3]->symbol['number'] == 800) //Sonne
					{					
						if ($xml->forecast->time[3]->symbol['var'] == "01n")
						{
							echo "<img src=Mond.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=Sonne.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[3]->symbol['number'] > 700) //Nebel
					{					
						echo "<img src=Nebel.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[3]->symbol['number'] > 600) //Schnee
					{					
						echo "<img src=Schnee.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[3]->symbol['number'] > 300) //Regen
					{					
						echo "<img src=Regen.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[3]->symbol['number'] > 200) //Gewitter
					{					
						echo "<img src=Blitz.bmp width=150 height=150>";
					}					
				?>
				</div>
				
				<div style="background:#000000; width:55%; float:right;" id="aktuell9hTemp">
				<?php
					$temp = $xml->forecast->time[3]->temperature['value'];
					$condition = $xml->forecast->time[3]->symbol['name'];
					$temp = round($temp);
					echo "<h1 style=font-family:arial;font-size:130%>In 9 Stunden</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$condition bei</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$temp °C</h1>";
				?>
				</div>
			</div>

			<div style="background:#000000; position:relative; height:149px; width:34%; top:250px;  left:33%;" id="aktuell6h">
				<div style="background:#000000;position:relative; top:-400px; width:45%; float:left;" id="aktuell6hIcon">
				<?php	
					if ($xml->forecast->time[2]->symbol['number'] > 802)	//Wolken
					{
							echo "<img src=Wolke.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[2]->symbol['number'] > 800) //Wolke+Sonne
					{					
						if ($xml->forecast->time[2]->symbol['var'] == "02d" || $xml->forecast->time[2]->symbol['var'] == "03d")
						{
							echo "<img src=WolkeSonne.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=WolkeMond.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[2]->symbol['number'] == 800) //Sonne
					{					
						if ($xml->forecast->time[2]->symbol['var'] == "01n")
						{
							echo "<img src=Mond.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=Sonne.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[2]->symbol['number'] > 700) //Nebel
					{					
						echo "<img src=Nebel.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[2]->symbol['number'] > 600) //Schnee
					{					
						echo "<img src=Schnee.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[2]->symbol['number'] > 300) //Regen
					{					
						echo "<img src=Regen.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[2]->symbol['number'] > 200) //Gewitter
					{					
						echo "<img src=Blitz.bmp width=150 height=150>";
					}					
				?>
				</div>
				
				<div style="background:#000000; position:relative; top:-400px; width:55%; float:right;" id="aktuell6hTemp">
				<?php
					$temp = $xml->forecast->time[2]->temperature['value'];
					$condition = $xml->forecast->time[2]->symbol['name'];
					$temp = round($temp);
					echo "<h1 style=font-family:arial;font-size:130%>In 6 Stunden</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$condition bei</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$temp °C</h1>";
				?>
				</div>
			</div>

		</div>

			<div style="background:#000000; width:100%; height:480px; float:left;" id="aktuell">
			<h1>Morgen von 6 - 9 Uhr</h1>
		 
		
			<div style="background:#000000; width:50%; height:250px; float:left;" id="aktuellIcon">
				<?php
					if ($xml->forecast->time[$offset]->symbol['number'] > 802)	//Wolken
					{
							echo "<img src=Wolke.bmp>";
					}
					else if ($xml->forecast->time[$offset]->symbol['number'] > 800) //Wolke+Sonne
					{					
						if ($xml->forecast->time[$offset]->symbol['var'] == "02d" || $xml->forecast->time[0]->symbol['var'] == "03d")
						{
							echo "<img src=WolkeSonne.bmp>";
						}
						else
						{
							echo "<img src=WolkeMond.bmp>";
						}
					}
					else if ($xml->forecast->time[$offset]->symbol['number'] == 800) //Sonne
					{					
						if ($xml->forecast->time[$offset]->symbol['var'] == "01n")
						{
							echo "<img src=Mond.bmp>";
						}
						else
						{
							echo "<img src=Sonne.bmp>";
						}
					}
					else if ($xml->forecast->time[$offset]->symbol['number'] > 700) //Nebel
					{					
						echo "<img src=Nebel.bmp>";
					}
					else if ($xml->forecast->time[$offset]->symbol['number'] > 600) //Schnee
					{					
						echo "<img src=Schnee.bmp>";
					}
					else if ($xml->forecast->time[$offset]->symbol['number'] > 300) //Regen
					{					
						echo "<img src=Regen.bmp>";
					}
					else if ($xml->forecast->time[$offset]->symbol['number'] > 200) //Gewitter
					{					
						echo "<img src=Blitz.bmp>";
					}					
				?>
			</div>

			<div style="background:#000000; width:50%; height:250px; float:right;" id="aktuellTemp">
				<?php
					$temp = $xml->forecast->time[$offset]->temperature['value'];
					$condition = $xml->forecast->time[$offset]->symbol['name'];
					$temp = round($temp);
					echo "<h1 style=font-family:arial>$condition bei</h1>";
					echo "<h1 style=font-family:arial;font-size:500%>$temp °C</h1>";
				?>		 
			</div>

			<div style="background:#000000; width:33%; height:150px; float:left;" id="aktuell3h">
				<div style="background:#000000; width:45%; float:left;" id="aktuell3hIcon">
				<?php	
					if ($xml->forecast->time[$offset+1]->symbol['number'] > 802)	//Wolken
					{
							echo "<img src=Wolke.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+1]->symbol['number'] > 800) //Wolke+Sonne
					{					
						if ($xml->forecast->time[$offset+1]->symbol['var'] == "02d" || $xml->forecast->time[$offset+1]->symbol['var'] == "03d")
						{
							echo "<img src=WolkeSonne.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=WolkeMond.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[$offset+1]->symbol['number'] == 800) //Sonne
					{					
						if ($xml->forecast->time[$offset+1]->symbol['var'] == "01n")
						{
							echo "<img src=Mond.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=Sonne.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[$offset+1]->symbol['number'] > 700) //Nebel
					{					
						echo "<img src=Nebel.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+1]->symbol['number'] > 600) //Schnee
					{					
						echo "<img src=Schnee.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+1]->symbol['number'] > 300) //Regen
					{					
						echo "<img src=Regen.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+1]->symbol['number'] > 200) //Gewitter
					{					
						echo "<img src=Blitz.bmp width=150 height=150>";
					}					
				?>
				</div>
				
				<div style="background:#000000; width:55%; float:right;" id="aktuell3hTemp">
				<?php
					$temp = $xml->forecast->time[$offset+1]->temperature['value'];
					$condition = $xml->forecast->time[$offset+1]->symbol['name'];
					$temp = round($temp);
					echo "<h1 style=font-family:arial;font-size:130%>Von 9 - 12 Uhr</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$condition bei</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$temp °C</h1>";
				?>
				</div>
			</div>

			<div style="background:#000000; width:33%; height:150px; float:right;" id="aktuell9h">
				<div style="background:#000000; width:45%; float:left;" id="aktuell9hIcon">
				<?php	
					if ($xml->forecast->time[$offset+3]->symbol['number'] > 802)	//Wolken
					{
							echo "<img src=Wolke.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+3]->symbol['number'] > 800) //Wolke+Sonne
					{					
						if ($xml->forecast->time[$offset+3]->symbol['var'] == "02d" || $xml->forecast->time[$offset+3]->symbol['var'] == "03d")
						{
							echo "<img src=WolkeSonne.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=WolkeMond.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[$offset+3]->symbol['number'] == 800) //Sonne
					{					
						if ($xml->forecast->time[$offset+3]->symbol['var'] == "01n")
						{
							echo "<img src=Mond.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=Sonne.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[$offset+3]->symbol['number'] > 700) //Nebel
					{					
						echo "<img src=Nebel.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+3]->symbol['number'] > 600) //Schnee
					{					
						echo "<img src=Schnee.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+3]->symbol['number'] > 300) //Regen
					{					
						echo "<img src=Regen.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+3]->symbol['number'] > 200) //Gewitter
					{					
						echo "<img src=Blitz.bmp width=150 height=150>";
					}					
				?>
				</div>
				
				<div style="background:#000000; width:55%; float:right;" id="aktuell9hTemp">
				<?php
					$temp = $xml->forecast->time[$offset+3]->temperature['value'];
					$condition = $xml->forecast->time[$offset+3]->symbol['name'];
					$temp = round($temp);
					echo "<h1 style=font-family:arial;font-size:130%>Von 15 - 18 Uhr</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$condition bei</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$temp °C</h1>";
				?>
				</div>
			</div>

			<div style="background:#000000; position:relative; height:149px; width:34%; top:250px;  left:33%;" id="aktuell6h">
				<div style="background:#000000;position:relative; top:-400px; width:45%; float:left;" id="aktuell6hIcon">
				<?php	
					if ($xml->forecast->time[$offset+2]->symbol['number'] > 802)	//Wolken
					{
							echo "<img src=Wolke.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+2]->symbol['number'] > 800) //Wolke+Sonne
					{					
						if ($xml->forecast->time[$offset+2]->symbol['var'] == "02d" || $xml->forecast->time[$offset+2]->symbol['var'] == "03d")
						{
							echo "<img src=WolkeSonne.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=WolkeMond.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[$offset+2]->symbol['number'] == 800) //Sonne
					{					
						if ($xml->forecast->time[$offset+2]->symbol['var'] == "01n")
						{
							echo "<img src=Mond.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=Sonne.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[$offset+2]->symbol['number'] > 700) //Nebel
					{					
						echo "<img src=Nebel.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+2]->symbol['number'] > 600) //Schnee
					{					
						echo "<img src=Schnee.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+2]->symbol['number'] > 300) //Regen
					{					
						echo "<img src=Regen.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+2]->symbol['number'] > 200) //Gewitter
					{					
						echo "<img src=Blitz.bmp width=150 height=150>";
					}					
				?>
				</div>
				
				<div style="background:#000000; position:relative; top:-400px; width:55%; float:right;" id="aktuell6hTemp">
				<?php
					$temp = $xml->forecast->time[$offset+2]->temperature['value'];
					$condition = $xml->forecast->time[$offset+2]->symbol['name'];
					$temp = round($temp);
					echo "<h1 style=font-family:arial;font-size:130%>Von 12 - 15 Uhr</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$condition bei</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$temp °C</h1>";
				?>
				</div>
			</div>

		</div>

			<div style="background:#000000; width:100%; height:480px; float:left;" id="aktuell">
			<h1>Übermorgen von 6 - 9 Uhr</h1>
		 
		
			<div style="background:#000000; width:50%; height:250px; float:left;" id="aktuellIcon">
				<?php
					if ($xml->forecast->time[$offset+8]->symbol['number'] > 802)	//Wolken
					{
							echo "<img src=Wolke.bmp>";
					}
					else if ($xml->forecast->time[$offset+8]->symbol['number'] > 800) //Wolke+Sonne
					{					
						if ($xml->forecast->time[$offset+8]->symbol['var'] == "02d" || $xml->forecast->time[0]->symbol['var'] == "03d")
						{
							echo "<img src=WolkeSonne.bmp>";
						}
						else
						{
							echo "<img src=WolkeMond.bmp>";
						}
					}
					else if ($xml->forecast->time[$offset+8]->symbol['number'] == 800) //Sonne
					{					
						if ($xml->forecast->time[$offset+8]->symbol['var'] == "01n")
						{
							echo "<img src=Mond.bmp>";
						}
						else
						{
							echo "<img src=Sonne.bmp>";
						}
					}
					else if ($xml->forecast->time[$offset+8]->symbol['number'] > 700) //Nebel
					{					
						echo "<img src=Nebel.bmp>";
					}
					else if ($xml->forecast->time[$offset+8]->symbol['number'] > 600) //Schnee
					{					
						echo "<img src=Schnee.bmp>";
					}
					else if ($xml->forecast->time[$offset+8]->symbol['number'] > 300) //Regen
					{					
						echo "<img src=Regen.bmp>";
					}
					else if ($xml->forecast->time[$offset+8]->symbol['number'] > 200) //Gewitter
					{					
						echo "<img src=Blitz.bmp>";
					}					
				?>
			</div>

			<div style="background:#000000; width:50%; height:250px; float:right;" id="aktuellTemp">
				<?php
					$temp = $xml->forecast->time[$offset+8]->temperature['value'];
					$condition = $xml->forecast->time[$offset+8]->symbol['name'];
					$temp = round($temp);
					echo "<h1 style=font-family:arial>$condition bei</h1>";
					echo "<h1 style=font-family:arial;font-size:500%>$temp °C</h1>";
				?>		 
			</div>

			<div style="background:#000000; width:33%; height:150px; float:left;" id="aktuell3h">
				<div style="background:#000000; width:45%; float:left;" id="aktuell3hIcon">
				<?php	
					if ($xml->forecast->time[$offset+9]->symbol['number'] > 802)	//Wolken
					{
							echo "<img src=Wolke.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+9]->symbol['number'] > 800) //Wolke+Sonne
					{					
						if ($xml->forecast->time[$offset+9]->symbol['var'] == "02d" || $xml->forecast->time[$offset+9]->symbol['var'] == "03d")
						{
							echo "<img src=WolkeSonne.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=WolkeMond.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[$offset+9]->symbol['number'] == 800) //Sonne
					{					
						if ($xml->forecast->time[$offset+9]->symbol['var'] == "01n")
						{
							echo "<img src=Mond.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=Sonne.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[$offset+9]->symbol['number'] > 700) //Nebel
					{					
						echo "<img src=Nebel.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+9]->symbol['number'] > 600) //Schnee
					{					
						echo "<img src=Schnee.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+9]->symbol['number'] > 300) //Regen
					{					
						echo "<img src=Regen.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+9]->symbol['number'] > 200) //Gewitter
					{					
						echo "<img src=Blitz.bmp width=150 height=150>";
					}					
				?>
				</div>
				
				<div style="background:#000000; width:55%; float:right;" id="aktuell3hTemp">
				<?php
					$temp = $xml->forecast->time[$offset+9]->temperature['value'];
					$condition = $xml->forecast->time[$offset+9]->symbol['name'];
					$temp = round($temp);
					echo "<h1 style=font-family:arial;font-size:130%>Von 9 - 12 Uhr</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$condition bei</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$temp °C</h1>";
				?>
				</div>
			</div>

			<div style="background:#000000; width:33%; height:150px; float:right;" id="aktuell9h">
				<div style="background:#000000; width:45%; float:left;" id="aktuell9hIcon">
				<?php	
					if ($xml->forecast->time[$offset+11]->symbol['number'] > 802)	//Wolken
					{
							echo "<img src=Wolke.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+11]->symbol['number'] > 800) //Wolke+Sonne
					{					
						if ($xml->forecast->time[$offset+11]->symbol['var'] == "02d" || $xml->forecast->time[$offset+11]->symbol['var'] == "03d")
						{
							echo "<img src=WolkeSonne.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=WolkeMond.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[$offset+11]->symbol['number'] == 800) //Sonne
					{					
						if ($xml->forecast->time[$offset+11]->symbol['var'] == "01n")
						{
							echo "<img src=Mond.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=Sonne.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[$offset+11]->symbol['number'] > 700) //Nebel
					{					
						echo "<img src=Nebel.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+11]->symbol['number'] > 600) //Schnee
					{					
						echo "<img src=Schnee.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+11]->symbol['number'] > 300) //Regen
					{					
						echo "<img src=Regen.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+11]->symbol['number'] > 200) //Gewitter
					{					
						echo "<img src=Blitz.bmp width=150 height=150>";
					}					
				?>
				</div>
				
				<div style="background:#000000; width:55%; float:right;" id="aktuell9hTemp">
				<?php
					$temp = $xml->forecast->time[$offset+11]->temperature['value'];
					$condition = $xml->forecast->time[$offset+11]->symbol['name'];
					$temp = round($temp);
					echo "<h1 style=font-family:arial;font-size:130%>Von 15 - 18 Uhr</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$condition bei</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$temp °C</h1>";
				?>
				</div>
			</div>

			<div style="background:#000000; position:relative; height:149px; width:34%; top:250px;  left:33%;" id="aktuell6h">
				<div style="background:#000000;position:relative; top:-400px; width:45%; float:left;" id="aktuell6hIcon">
				<?php	
					if ($xml->forecast->time[$offset+10]->symbol['number'] > 802)	//Wolken
					{
							echo "<img src=Wolke.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+10]->symbol['number'] > 800) //Wolke+Sonne
					{					
						if ($xml->forecast->time[$offset+10]->symbol['var'] == "02d" || $xml->forecast->time[$offset+10]->symbol['var'] == "03d")
						{
							echo "<img src=WolkeSonne.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=WolkeMond.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[$offset+10]->symbol['number'] == 800) //Sonne
					{					
						if ($xml->forecast->time[$offset+10]->symbol['var'] == "01n")
						{
							echo "<img src=Mond.bmp width=150 height=150>";
						}
						else
						{
							echo "<img src=Sonne.bmp width=150 height=150>";
						}
					}
					else if ($xml->forecast->time[$offset+10]->symbol['number'] > 700) //Nebel
					{					
						echo "<img src=Nebel.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+10]->symbol['number'] > 600) //Schnee
					{					
						echo "<img src=Schnee.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+10]->symbol['number'] > 300) //Regen
					{					
						echo "<img src=Regen.bmp width=150 height=150>";
					}
					else if ($xml->forecast->time[$offset+10]->symbol['number'] > 200) //Gewitter
					{					
						echo "<img src=Blitz.bmp width=150 height=150>";
					}					
				?>
				</div>
				
				<div style="background:#000000; position:relative; top:-400px; width:55%; float:right;" id="aktuell6hTemp">
				<?php
					$temp = $xml->forecast->time[$offset+10]->temperature['value'];
					$condition = $xml->forecast->time[$offset+10]->symbol['name'];
					$temp = round($temp);
					echo "<h1 style=font-family:arial;font-size:130%>Von 12 - 15 Uhr</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$condition bei</h1>";
					echo "<h1 style=font-family:arial;font-size:130%>$temp °C</h1>";
				?>
				</div>
			</div>

		</div>
	</body>



</html>