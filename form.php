    <?php 
        include("connect.inc.php");
        $conn = new PDO("mysql:host=$host;dbname=$dbname", "$login", "$password");

        function createListLang($conn, $lang_type, $label_text){
            $stmt = $conn->prepare("SELECT * FROM language");
            $stmt->execute();
            echo "<label>$label_text:</label><select value=1 name=$lang_type required>";
            foreach($stmt as $q){
                echo "<option value=".$q['id_lang'].">".$q['lang']."</option>";
            }
            echo "</select>";
        }


        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $first_name=$_POST['first_name'];
            $last_name=$_POST['last_name'];
            $email=$_POST['email'];
            $tel=$_POST['tel'];           
            $lang_from=$_POST['lang_from'];
            $lang_to=$_POST['lang_to'];
            $doc_description=$_POST['doc_description'];
                 
            $qoute_type=$_POST['qoute_type'];
            $doc_type=$_POST['doc_type'];
            $destination= '';

            if($url != "service-oral"){
                $destination="files/".$_FILES["doc"]["name"];
                if (file_exists($destination)) {
                    $destination="files/".$_FILES["doc"]["name"]."(2)";
                }         
            
                $upfile=$_FILES["doc"]["tmp_name"];
                move_uploaded_file($upfile,$destination); 
            }
            
            $conn = new PDO("mysql:host=$host;dbname=$dbname", "$login", "$password");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	        $conn->exec("set names utf8");	
	        $conn->exec("set names latin1");            
            
            $checkUser = $conn->prepare("SELECT id_client FROM client WHERE email='$email'");
            $checkUser->execute();
            
             if (empty($checkUser->fetchAll())) {
                 $rInsertToClient = "INSERT INTO client ( first_name, last_name, email, tel ) VALUES ('$first_name','$last_name','$email','$tel')";
                 $conn->exec($rInsertToClient);
//                 $rInsertToAdmin = "INSERT INTO admin ( username, password ) VALUES ('$email','$last_name','$email','$tel')";
//                 $conn->exec($rInsertToClient);
             }     
                        
            $idClient = $conn->prepare("SELECT id_client FROM client WHERE email='$email'");
            $idClient->execute();        
            
            foreach($idClient as $r){
                $currentId = $r['id_client'];
            }
        
            $rInsertToQuote = "INSERT INTO qoute(lang_from, lang_to, doc_description, doc, qoute_type, id_client, doc_type) VALUES ($lang_from, $lang_to, '$doc_description', '$destination', '$qoute_type', $currentId,'$doc_type')";
            $conn->exec($rInsertToQuote);    
           
        }           
    ?>
       
    <form action="" method="post" enctype="multipart/form-data">
        Remplissez ce formulaire afin d'obtenir un devis pour votre projet
        <br>
        <br>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Nom" name="first_name" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Prénom" name="last_name" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Mail" name="email" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Téléphone" name="tel" required>
        </div>
        <?php if($url == "ordre"){
            echo 
                "<div class='form-group'>
                    <label for=''>Type de document:</label>
                    <select value='oral' name='doc_type' required>
                        <option value='oral'>Oral</option>
                        <option value='techn'>Littéraire</option>
                        <option value='liter'>Technique</option>
                    </select>
                </div>";
        }?>

        <div class="form-group">
            <?php createListLang($conn, "lang_from", "Langue de"); ?>            
        </div>
        <div class="form-group">
            <?php createListLang($conn, "lang_to", "Langue à"); ?>        
        </div>

        <div class="form-group">
            <textarea name="doc_description" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        
        <?php
            if($url != "service-oral"){
                 echo "<div class='form-group'><input type='file' class='form-control-file' name='doc' id='doc' required></div>";
            }       
            $qoute_type = '';
            switch($url){
                case "ordre": $qoute_type = "ordre"; break;
                case "service-oral": $qoute_type = "qoute"; $doc_type = 'oral'; break;
		        case "service-art": $qoute_type = "qoute"; $doc_type = 'liter'; break;
		        case "service-technical": $qoute_type = "qoute"; $doc_type = 'techn'; break;
            }
            echo "<input type='hidden' name='qoute_type' value=$qoute_type>";
            
            if($url != "ordre"){
                echo "<input type='hidden' name='doc_type' value=$doc_type>";
            }
            
        ?>
        
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>