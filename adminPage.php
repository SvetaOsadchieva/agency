<?php
session_start(); 
if($_SESSION['login_user'] != 'admin'){
      header("location: login");
}

include("connect.inc.php");



?>

    <div class="container-fluid">
            <?php 
            $conn = new PDO("mysql:host=$host;dbname=$dbname", "$login", "$password");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
           
            $doc=empty($_GET["doc"])?"":$_GET["doc"]; 
            $price=empty($_GET["price"])?"":$_GET["price"]; 
            $time=empty($_GET["time"])?"":$_GET["time"]; 
            $status_work=empty($_GET["status_work"])?"":$_GET["status_work"]; 
            $status_pay=empty($_GET["status_pay"])?"":$_GET["status_pay"]; 
            $id_qoute=empty($_GET["id_qoute"])?"":$_GET["id_qoute"]; 
        
            $rUpdate = "UPDATE qoute SET price=$price, time=$time, status_work='$status_work',
            status_pay='$status_pay' WHERE id_qoute=$id_qoute";
        
            $action = empty($_GET["action"]) ? "" : $_GET["action"]; 
            switch($action) {
                case "form_modif": formulaire("modif", $price, $time, $status_work, $status_pay, $doc, $id_qoute); break;
                case "modif": maj($conn, $rUpdate); break;      
                default : liste($conn); break;
            }

            function liste($conn){
                $stmt = $conn->prepare("SELECT client.first_name, client.last_name, client.email,client.tel,client.id_client, 
                                        qoute.lang_from, qoute.lang_to, qoute.doc_type, qoute.price, qoute.time, qoute.status_work, qoute.status_work, qoute.status_pay, qoute.id_qoute,
                                        firstlang.id_lang, firstlang.lang as langfrom, secondlang.id_lang, secondlang.lang as langto, doc, qoute_type
                                        FROM client INNER JOIN qoute ON client.id_client=qoute.id_client
                                        JOIN language as firstlang ON qoute.lang_from=firstlang.id_lang 
                                        JOIN language as secondlang ON qoute.lang_to=secondlang.id_lang 
                                        ORDER BY id_client;");
                $stmt->execute();





                echo "<br><br><table class='table table-striped col-md-12'>
                        <tr>
                            <th>#</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Langue de</th>
                            <th>Langue à</th>
                            <th>Type</th>
                            <th>Fichier</th>
                            <th>Devis</th>
                            <th>Prix</th>
                            <th>Temps</th>
                            <th>Statut de travail</th>
                            <th>Statut du paiement</th>
                            <th></th>
                        </tr>";

                $count = 0;
                foreach($stmt as $q){
                    $count++;
                    echo "<tr>";
                    echo 
                        "<td>".$count."</td>".
                        "<td>".$q['first_name']."</td>".
                        "<td>".$q['last_name']."</td>".
                        "<td>".$q['email']."</td>".
                        "<td>".$q['tel']."</td>".
                        "<td>".$q['langfrom']."</td>".
                        "<td>".$q['langto']."</td>".
                        "<td>".$q['doc_type']."</td>".
                        "<td>".$q['doc']."</td>".
                        "<td>".$q['qoute_type']."</td>".
                        "<td>".$q['price']."</td>".
                        "<td>".$q['time']."</td>".
                        "<td>".$q['status_work']."</td>".
                        "<td>".$q['status_pay']."</td>";
                        $doc=$q['doc'];
                        $price=$q['price'];
                        $time=$q['time'];
                        $status_work=$q['status_work'];
                        $status_pay=$q['status_pay'];
                        $id_qoute=$q['id_qoute'];

                        $linkMod=$_SERVER["PHP_SELF"]."?action=form_modif&doc=$doc&price=$price&time=$time&status_work=$status_work&id_qoute=$id_qoute";

                        echo"<td><a href='$linkMod'>Modifier</a></td>";
                    echo "</tr>";
            }
        }
         function createSelect($options, $dbValue, $name){
                echo "<select value='$dbValue' name='$name'>";
                foreach($options as $option){
                    if($dbValue == $option){
                        echo "<option value='$option' selected>$option</option>";
                    }
                    else if($option == ""){
                        if($dbValue == ""){
                            echo "<option disabled selected value>$option</option>";
                        }
                        else{
                            echo "<option disabled value>$option</option>";         
                        }                                       
                    }
                    else{
                        echo "<option value='$option'>$option</option>";
                    }
                    
                }
                echo "</select>";
            }
            function formulaire($action, $price, $time, $status_work, $status_pay, $doc, $id_qoute){
                $payOptions = array("","payed","unpayed","not_required");
                $workOptions = array("open","resolved");
                $link = $_SERVER["PHP_SELF"]."?action=form_modif";
                        echo "<br><br><form action='$link' method='GET' class='col-md-4 col-md-offset-4'>
                                <fieldset>
                                    <input type='hidden' name='action' value='$action' />
                                    <input type='hidden' name='id_qoute' value='$id_qoute' />
                                        <div class='form-group'>
                                            <label for='Qoute :'>Fichier :</label>
                                            <input type='text' name='doc' size='3' maxlength='20' value='$doc' class='form-control' placeholder='Fichier' readonly>
                                        </div>
                                        <div class='form-group'>
                                            <label for='Qoute :'>Prix :</label>
                                            <input type='text' name='price' size='20' maxlength='20' value='$price' class='form-control' placeholder='Prix' required>
                                        </div>
                                        <div class='form-group'>
                                            <label for='Qoute :'>Temps :</label>
                                            <input type='text' name='time' size='3' maxlength='5' value='$time' class='form-control' placeholder='Temps' required>
                                        </div> 
                                         <div class='form-group'>
                                            <label for='Qoute :'>Le statut de travail :</label>
                                            <p>";
                                        createSelect($workOptions, $status_work,'status_work');                                           
                                        echo 
                                        "</p>                                                                        
                                        </div>
                                        <div class='form-group'>
                                            <label for='Qoute :'>Le statut de paiement :</label>
                                            <p>";
                                        createSelect($payOptions, $status_pay, 'status_pay');
                                        echo "</p></div> 
                                    <p>
                <input type='reset' value='Annuler' class='btn btn-default hoverbtn'>
                <input type='submit' value='Valider' class='btn btn-default hoverbtn'>
                </p>
                </fieldset>
            </form>";
                }
        //function execute query
                function maj($conn, $requete){
                        $conn->exec($requete);
                        liste($conn);
                }

 ?>

        </table>
    </div>