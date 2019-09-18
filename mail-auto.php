//===== Envoi du mail au nouvel inscrit ===============================
            $mail = $_POST['email']; //adresse de destination.
            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
            {
                $passage_ligne = "\r\n";
            }
            else
            {
                $passage_ligne = "\n";
            }
            //=====Déclaration des messages au format text.
        
            $message_txt = 'Bonjour ' . $_POST['pseudo'] . ', /n '. 
            Bienvenue sur www.monsite.com /n/n 
            Pour confirmer votre inscription nous vous invitons à compléter votre fiche 
            <a href="www.monsite.com/confirmation-inscription.php"> en cliquant ici </a> ./n/n
            
            Si le lien ne s'affiche pas correctement, cliquez sur l'url suivante :
            //url de destination
            /n/n 
            
             Voici vos identifiants : /n
             <i style="color:red">N\'oubliez pas de modifier votre mot de passe</i><br/>
             Login : ' . $_POST['email'] . '/n
             Mot de passe : '. $_POST['password'] .'/n/n
             
             //ou
             
             Mot de passe : Celui que vous avez saisi lors de votre inscription /n/n

             A très vite sur www.monsite.com!';
        
            //=====Déclaration des messages au format html.

            $message_html = '<html><head></head><body><b>Bonjour ' . $_POST['pseudo'] . ', <br/>
            Bienvenue sur www.monsite.com<br/><br/> 
            Pour confirmer votre inscription nous vous invitons à compléter votre fiche 
            <a href="www.monsite.com/confirmation-inscription.php"> en cliquant ici </a> ..<br/><br/>
            
            Si le lien ne s'affiche pas correctement, cliquez sur l'url suivante :
            //url de destination
            <br/><br/>
            
             <br/>Voici vos identifiants : <br/>
             <i style="color:red">N\'oubliez pas de modifier votre mot de passe</i><br/>
             Login : ' . $_POST['email'] . '<br/>
             Mot de passe : ' .$_POST['password'] .'<br/><br/>
             
             //ou
             
             Mot de passe : Celui que vous avez saisi lors de votre inscription <br/><br/>
             
             A très vite sur www.monsite.com!</body></html>';
            //=====Création de la boundary
            $boundary = "-----=".md5(rand());
            //=====Définition du sujet.
            $sujet = $_POST['pseudo'] . ' Votre inscription sur monsite.com';
            //=====Création du header de l'e-mail.
            $header = "From: \"MonSite\"<no-reply@monsite.com>".$passage_ligne;
            $header.= "Reply-to: \"WeaponsB\" <no-reply@monsite.com>".$passage_ligne;
            $header.= "MIME-Version: 1.0".$passage_ligne;
            $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
            //=====Création du message.
            $message = $passage_ligne."--".$boundary.$passage_ligne;
            //=====Ajout du message au format texte.
            $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
            $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
            $message.= $passage_ligne.$message_txt.$passage_ligne;
            $message.= $passage_ligne."--".$boundary.$passage_ligne;
            //=====Ajout du message au format HTML
            $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
            $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
            $message.= $passage_ligne.$message_html.$passage_ligne;
            //==========
            $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
            $message.= $passage_ligne."--".$boundary."--".$passage_ligne;

            //=====Envoi de l'e-mail.
            mail($mail,$sujet,$message,$header);
            //==========
