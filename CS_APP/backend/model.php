<?php 
  header('Access-Control-Allow-Origin:*'); ///PERMISSION ;
    include_once "./db.php";
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){ 

//////////////////////récupération d'information dans les donnés forumalire qui existent dans "body": du requete///////////////////////////

        echo "\n HELLO \n";
        $fname =  $_POST["fName"];
        $lName = $_POST["lName"];

        $user_name = $_POST["user_name"];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $rPwd = $_POST['r_pwd'];

////////////////////Vérifications des champs qui sont vides////////////////////////////////////////////////////////////////////////////

        if(empty( $fname) || empty(  $lName )  || empty( $user_name) || empty( $email) || empty( $pwd) || empty( $rPwd)){
          http_response_code(400);
          echo "IL FAUT REMPLIR TOUS LES CHAMPS";
          exit();
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
          http_response_code(400);
          echo "EMAIL INVALIDE";
          exit();
        }
///////////////////Vérification mot de passe et répétition de mot de passe es que il sont identique ou nn//////////////////////////

        if($pwd != $rPwd){
          http_response_code(400);
          echo "mdp sont pas identique  ";
        }
        $pwd = password_hash($pwd , PASSWORD_DEFAULT);
        $rPwd = $pwd;
/////////////////préparation de la requete sql pour l'insertion dans base de données ///////////////////////////////////////////////////////

        $sql = "INSERT INTO users (first_name,last_name,user_name,email,pwd,r_pwd) VALUES (?,?,?,?,?,?);";
        /////PDO:$sql = 'INSERT INTO users (first_name,last_name,user_name,email,pwd,r_pwd) VALUES(:first_name,:last_name,:user_name,:email,:pwd;:r_pwd)';   
        
////////////////intialisation du variable stmt pour excuter la requete précidente   ////////////////////////////////////////

        //////ROLE : D'inserer 
        $stmt = $connexion->stmt_init();
        ///////////on utilise prepare pour vérifier la validité de la requete sql////

        if(!$stmt->prepare($sql)){
                  ////Si la requete est n'est pas valide ///// on envoie une mauvaise réponse  ///

          http_response_code(400);
          echo "Y a qlq chose";
        }
            ////bind_param c'est pour la corespendance entre la requete sql et informations formulaire/////////

        $stmt->bind_param('ssssss',$fname,$lName,$user_name,$email,$pwd,$rPwd);
                 /*PDO:
                          $stmt->bindParam(':firstname', $firstname);
                          $stmt->bindParam(':lastname', $lastname);
                          $stmt->bindParam(':email', $email);
                  */
            ////excution requete sql/////
        $stmt->execute();
        /////
        if($stmt->affected_rows>0){///////PDO: Vérifie par Try/Catch////
          http_response_code(200);
          echo "BRAVO";
        }else{
          http_response_code(400);
          echo "IL YA UN PROBLEME";
        }
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>