<?php 
    session_start();
    if (!isset($_SESSION['logged'])) {
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Profil: <?php echo $_SESSION['nick'];?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/profile.css">
        <?php
            if(isset($_FILES['image'])){
                $errors= array();
                $file_name = $_FILES['image']['name'];
                $file_size =$_FILES['image']['size'];
                $file_tmp =$_FILES['image']['tmp_name'];
                $file_type=$_FILES['image']['type'];
                @$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
                $extensions= array("jpg");
                unset($_FILES['image']);
                if(in_array($file_ext,$extensions)=== false){
                   $errors[]="Takie roszerzenie pliku jest zabronione prześlij JPEG lub PNG plik.";
                }
                if($file_size > 2147483648){
                   $errors[]='Plik musi być mniejszy od 2 MB';
                }
                if (!empty($_FILES['images'])) {
                    for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
                        if (empty($_FILES['images']['name'][$i])) {
                            // This item is empty
                            echo "Item $i references an empty field.\n";
                            continue;
                        }
                        echo "Item $i is a valid file.\n";
                    }
                }
                if(empty($errors)==true){
                   move_uploaded_file($file_tmp,"avatars/".$_SESSION["id"].".jpg");
                   header("Refresh:0");
                }else{
                   print_r($errors);
                }
             }
             
	    ?>
    </head>
    <body>
	<?php 
		if (isset($_SESSION['serverName'])) {
			echo '
			<div id="serverStatusBlock" style="display: flex;">
				<span style="padding: 1em;display: flex;">Nazwa gry:&nbsp;<div id="serverName"></div></span>
				<span style="padding: 1em;display: flex;">Status gry:&nbsp;<div id="serverStatus"></div></span>
                <span style="padding: 1em;display: flex;">Liczba graczy:&nbsp;<div id="players"></div> </span>
                <span style="padding: 1em;display: flex;"><a href="queue.php"><button>Powrót</button></a></span>
                <span style="padding: 1em;display: flex;"><a href="scripts/leaveGame.php"><button>Wyjście z gry</button></a></span>
			</div>
			<script type="text/javascript" defer>
				var status = '.$_SESSION['serverStatus'].';
				var name = "'.$_SESSION['serverName'].'";
				var activePlayer = '.$_SESSION['serverActivplayers'].';
				var maxplayer = '.$_SESSION['maxPlayers'].';	
				function loadGameInfo() {
					var xmlrequest = new XMLHttpRequest();
					xmlrequest.onreadystatechange = function () {
						if (this.readyState == 4 && this.status == 200) {
							var res = new Date().getTime()-pingS;
							console.log("ping: "+res);
							var data = this.responseText.split(";");
							doDataThing(data);
							
						}
					}
					xmlrequest.open("GET", "gameInfoLoad.php", true);
					xmlrequest.send();
					var pingS = new Date().getTime();
				}
				var interval = setInterval(loadGameInfo, 700);
				document.getElementById("serverName").innerHTML = name;
                document.getElementById("serverStatus").innerHTML =  "Gra nie rozpoczęta";
                document.getElementById("players").innerHTML = activePlayer+"/"+maxplayer;

				function doDataThing(data) {
					if (data[1] != "0") {
						//coś tam header gamebord;	
					}
					document.getElementById("players").innerHTML =  data[2]+"/"+maxplayer;
				}
			</script>';
		}
	?>
        <header>
            <a href="gamesList.php" class="logo">Ulanopoli</a>
            <?php 
                if (isset($_SESSION["error"])) {
                        echo $_SESSION["error"]; 
                        unset($_SESSION["error"]);
                    }
                ?>
            <div id="profil-ico" class="avatar">
                <a>
                    <img class="png" src="ico/icons8-user-64.png">
                </a>
            </div>
        </header>
        <main class="profile">
            <?php 
                if (file_exists("avatars/".$_SESSION["id"].".jpg")) {
                    echo '<img src="avatars/'.$_SESSION["id"].'.jpg" class="profilePicture" alt="profilePicture">';
                } else {
                    if ($_SESSION['theme'] == 0) {
                        echo '<img src="avatars/def.jpg" class="profilePicture" alt="profilePicture">';
                    } else {
                        echo '<img src="avatars/defL.jpg" class="profilePicture" alt="profilePicture">';
                    }
                }
            ?>
            
            <div class="statisticsContainer">
                <div class="profileInfo">
                    <div class="nickname"><span class="colorfullText"><?php echo $_SESSION['nick'];?></span></div>
                    <div class="buttons">
                        <button onclick="openSettings()">Ustawienia</button>
                    </div>
                </div>
                <div class="statistics">
                    <div class="stats1"><span id="stats1"></span></div>
                    <div class="stats2"><span id="stats2"></span></div>
                    <div class="stats3"><span id="stats3"></span></div>
                </div>
            </div>
        </main>
        <main class="settings">
            <span>Statystyki konta:</span>
            <form action="scripts/states.php"  method="post" name="f2">
                Pole 1:
                <select name="s1">
                    <option value="1">Rozegrane gry</option>
                    <option value="2">Wygrane</option>
                    <option value="3">Najwiekszy majatek</option>
                    <option value="4">Najwiecej pieniedzy</option>
                    <option value="5">Przegrane</option>
                    <option value="6">W/P</option>
                </select><br>
                Pole 2:
                <select name="s2">
                    <option value="1">Rozegrane gry</option>
                    <option value="2">Wygrane</option>
                    <option value="3">Najwiekszy majatek</option>
                    <option value="4">Najwiecej pieniedzy</option>
                    <option value="5">Przegrane</option>
                    <option value="6">W/P</option>
                </select><br>
                Pole 3:
                <select name="s3">
                    <option value="1">Rozegrane gry</option>
                    <option value="2">Wygrane</option>
                    <option value="3">Najwiekszy majatek</option>
                    <option value="4">Najwiecej pieniedzy</option>
                    <option value="5">Przegrane</option>
                    <option value="6">W/P</option>
                </select>
                <input type="submit">
                <br><br><br><br><br><br>
                Zmiana profilowego:<br>
            </form>
            Zalecana wielkość 4/3 (wysokość/szerokość) i maksymalny rozmiar 2mb. tylko i wyłącznie jpg.
            <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="image"><br>
                    <input type="submit" value="Prześlij" name="submit">
            </form><br><br>
            <button onclick="closeSettings()">Zamknij ustawienia</button>
        </main>
        <script>
            function openSettings() {
                document.querySelector('.settings').style.visibility = 'visible';
            }
            function closeSettings() {
                document.querySelector('.settings').style.visibility = 'hidden';
            }
        </script>
        <script type="text/javascript" defer>    
            var stats = <?php echo '"'.$_SESSION["gameStatsPlayer"].'"';?>;
            stats = stats.split(":");

            function plainText(i) {
                switch (i) {
                    case 0:
                        return "Rozegrane gry: ";
                    break;
                    case 1:
                        return "Wygrane gry: ";
                    break;
                    case 2:
                        return "Największy majątek: ";
                    break;
                    case 3:
                        return "Najwięcej w portfelu: ";
                    break;
                    case 4:
                        return "Przegrane: ";
                    break;
                    case 5:
                        return "Wygrane/przegrane: ";
                    break;
                }
            }
            for (var i = 0; i<stats.length;i++) {
                var whileV = stats[i].split(";");
                if (whileV[0][0] == "1") {
                    var place = document.getElementById("stats"+whileV[0][2]).innerHTML = plainText(i) + whileV[1]; 
                }
            }
        </script>
    </body>
</html>