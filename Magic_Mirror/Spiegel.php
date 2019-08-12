<!DOCTYPE html>
<html>
<head>
   <style>
		body
		{
			background-color: #000000		<!--Background Schwarz-->
		}								
   </style>
   <script type = 'text/javascript'>
		setInterval(reload, 600000);		//alle 10 Minuten Funktion reload ausführen
		function reload()
		{
				location.reload(true);		//Seite reloaden true == nicht gecachte Version benutzten
		}
		
		
		
   </script>
   
</head>
<body onkeydown="keyEvent(event)" style="color:white;background-color:black">		<!--Wenn Taste gedrückt Funktion keyEvent ausführen  Schriftfarbe Weiß-->
   <script>
			function keyEvent(event)
			{
				var keyID = event.keyCode;
				if (keyID == 97)	//49 = Taste "1" //1 ungleich Numpad 1 (97)
				{
					window.open("http://localhost/Leer.html","_self"); 		//wenn Taste = Numpad 1 dann Leere Seite öffnen  _self bedeutet im selben Tab
				}
				else if (keyID ==98)  //=Numpad Taste 2
				{
					window.open("http://localhost/NachrichtenFokus.php","_self"); 	//wenn Taste = Numpad 2 dann NachrichtenFokus öffnen
				}
			}
	</script>
   <div style="background:#000000; width:50%; height:320px; float:left;" id="Uhr" > 		<!--Div Box oben Links Analog Uhr-->
      <canvas id="Ziffernblatt" width="320" height="320" style="background-color:#000000; float:left;"></canvas> <!--Canvas um Uhr zu zeichnen ID = Ziffernblatt-->
	  <script>
	    var canvas = document.getElementById("Ziffernblatt");  	//Variable Canvas holt sich Canvas mit ID Ziffernblatt
        var ctx = canvas.getContext("2d");						//2D Context holen
        var radius = canvas.height / 2;							//Radius ausrechnen
        ctx.translate(radius, radius);							//0|0 auf Mitte des Canvas setzen
        setInterval(drawClock, 1000); 							//1 Sekunden Intervall ruft Funktion drawClock() auf
		drawClock();											//Beim ersten laden der Seite Funktion drawClock ausführen
	    
		function drawClock() 
		{
		   deleteOld(ctx, radius);								//Funktion deleteOld zeichnet großen Kreis und füllt diesen Schwarz dass die nächste Zeit gezeichnet werden kann 
           drawNumbers(ctx, radius);							//drawNumbers zeichnet Ziffernblatt
		   drawTime(ctx, radius);								//drawTime zeichnet Zeiger mit aktueller zeit
		}
		
		function deleteOld(ctx, radius)
		{
           ctx.lineWidth = radius;
           ctx.beginPath();
           ctx.arc(0, 0, radius, 0, 2*Math.PI);					//zeichnet Kreis
           ctx.fillStyle = '#000000';
           ctx.fill();											//Kreis wird schwarz gefüllt
		}
		
		function drawNumbers(ctx, radius)
		{
			for(i = 0; i < 12; i++)
			{
				drawMarker(ctx, Math.PI/6, radius, 0.04, 0.8);	//Ruft 12 mal die funktion drawMarker auf
			}
			drawMarker(ctx, 3*Math.PI/6, radius, 0.055, 0.7);	//Übermalt jeden dritten Marker mit einem Dickeren (3,6,9,12)
			drawMarker(ctx, 3*Math.PI/6, radius, 0.055, 0.7);
			drawMarker(ctx, 3*Math.PI/6, radius, 0.055, 0.7);
			drawMarker(ctx, 3*Math.PI/6, radius, 0.055, 0.7);
		}

		function drawMarker(ctx, pos, radius, width, length)	//Context, Rotation in Bogenmaß, Endpunkt der Linie, Linienstärke im zusammenhang mit dem Radius, Länge von mittelpunkt bis anfang des Markers
		{
		    ctx.beginPath();
			ctx.lineWidth= radius*width;						//Linienstärke
			ctx.lineCap = "round";								//Runde Enden an den Linien
			ctx.moveTo(0,0);									//Zeiger auf Mittelpunkt setzen
			ctx.rotate(pos); 									//Zeiger rotieren
			ctx.moveTo(0,-radius*length);						//Zeiger zu anfangspunkt des Markers bewegen	
			ctx.lineTo(0, -radius*0.95);						//Linie nach außen ziehen
			ctx.strokeStyle = "#FFFFFF";						//in weiß
			ctx.stroke();										//Zeichnen
		}

		function drawTime(ctx, radius)
		{
			var now = new Date();								//Aktuelle zeit holen
			var hour = now.getHours();							//in Stunden	
			var minute = now.getMinutes();						//Minuten und
			var second = now.getSeconds();						//Sekunden aufteilen
			//hour
			hour=hour%12;
			hour=(hour*Math.PI/6)+(minute*Math.PI/(6*60))+(second*Math.PI/(360*60)); //Stunden in Bogenmaß umrechnen
			drawHand(ctx, hour, radius*0.5, radius*0.07);		//Stundenzeiger Zeichnen
			//minute
			minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));//Minuten in Bogenmaß umrechnen
			drawHand(ctx, minute, radius*0.8, radius*0.07);		//Minutenzeiger zeichnen
			// second
			second=(second*Math.PI/30);							//Sekunden in Bogenmaß umrechnen
			drawHand(ctx, second, radius*0.9, radius*0.02);		//Sekundenzeiger zeichnen
		}
		
		function drawHand(ctx, pos, length, width) 
		{
			ctx.beginPath();
			ctx.lineWidth = width;								//Linienstärke
			ctx.lineCap = "round";								//Runde Enden
			ctx.moveTo(0,0);									//Zeiger auf mittelpunkt 
			ctx.rotate(pos);									//Zeiger Rotieren
			ctx.lineTo(0, -length);								//Linie ziehen
			ctx.stroke();										//Zeichnen 
			ctx.rotate(-pos);									//Zeiger zurück rotieren
		}
      </script>
   </div>
   <div style="background:#000000; width:50%; height:320px; float:right;" id="Wetter" > <!--Wetter Box-->
		<?php
			$url = "http://api.openweathermap.org/data/2.5/forecast?id=2820859&APPID=e885528ee59071ff54b8cc867e8be6f1&mode=xml&units=metric&lang=de";	//API Call URL
			$xml = simplexml_load_file($url);					//XML File von Api Laden
			if ($xml != FALSE)									//Wenn XML File existiert
			{
				$temp = $xml->forecast->time[0]->temperature['value'];
				$condition = $xml->forecast->time[0]->symbol['name'];
				if ($temp%1 >0.5)
				{
					$temp = $temp+(1-$temp%1);
				}
				else
				{
					$temp = $temp-($temp%1);
				}
				echo "<h1 style=font-family:arial>$condition bei</h1>";
				echo "<h1 style=font-family:arial>$temp °C</h1>";
				
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
					if ($xml->forecast->time[0]->symbol['var'] == "01d")
					{
						echo "<img src=Sonne.bmp>";
					}
					else
					{
						echo "<img src=Mond.bmp>";
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
			}
			else
			{
				echo "<h1>FALSE</h1>";							//Wenn XML File nicht existiert
			}
		?>
   </div>
   <div style="background:#000000; width:100%; height:1270px;" id="Spiegel"> <!--Leere Box mit schwarzem hintergrund Für Spiegelfläche-->	
      
   </div>
   <div style="background:#000000; width:100%; height:330px;" id="RSS" > <!--Nachrichten Box-->
		<?php
			$url = "http://www.tagesschau.de/xml/rss2";			//API Call URL
			$xml = simplexml_load_file($url);					//XML File von API laden
			if ($xml != FALSE)									//Wenn XML File existiert
			{
				for ($i=0;$i<5;$i++)							//5 Einträge Laden
				{
					$title = $xml->channel->item[$i]->title;	//Titel von Item an der stelle i 
					echo "<h1 style=font-family:arial>- $title</h1>";					//Titel anzeigen
				}
			}
			else
			{
				echo "<h1>FALSE</h1>";							//Wenn XML FIle nicht existiert
			}
		?>
   </div>
</body>
</html>