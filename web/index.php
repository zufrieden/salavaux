<?php

$error = false;
$email_envoye = false;
$destinataire = 'thefried+salavaux@gmail.com';

if(isset($_POST['nom'])){

   $nom = addslashes($_POST['nom']);
   $prenom = addslashes($_POST['prenom']);
   $email = addslashes($_POST['email']);
   $redirection = 'Oui';
   
   $regexp = "/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";
   
   if($nom!=''&&$prenom!=''&&preg_match($regexp, $email)){
      
      
     $sujet = "$nom $prenom désire une adresse @salavaux.ch";
     $from  = "From: $email\n";
     $from .= "MIME-version: 1.0\n";
     $from .= "Content-type: text/html; charset= iso-8859-1\n";
  
     $contenu_mail = '
        <table border="0" cellspacing="5" cellpadding="5">
          <tr><td>
           Nom
          </td><td>
           '.$nom.'
          </td></tr>
          <tr><td>
           Prénom
          </td><td>
           '.$prenom.'
          </td></tr>
          <tr><td>
           Email
          </td><td>
           '.$email.'
          </td></tr>
          <tr><td>
           Redirection
          </td><td>
           '.$redirection.'
          </td></tr>
        </table>
     ';
  
     mail($destinataire,$sujet,$contenu_mail,$from);
     
      $email_envoye = "Merci, votre email sera créé ! Nous vous enverrons un message de confirmation à $email.";
      
   }else{
      $error = 'Merci de renseigner tous les champs.';
   }
}




?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Salavaux.ch | Le site pour les habitants de Salavaux</title>
  <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
  <meta name="title" content="Salavaux.ch | Le site pour les habitants de Salavaux | Adresse e-mail @salavaux.ch gratuite" />
   <meta name="description" content="Pour les habitants de Salavaux, nous proposons des informations provenant de la toile, news et photos. Ainsi que des adresses e-mail @salavaux.ch" />
   <link rel="image_src" href="http://www.salavaux.ch/images/salavaux.jpg" / >
  
  <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
  <style type="text/css" media="screen">

  </style>
</head>

<body>
   <div id="salavaux">
      <div id="email_request">

      <h1>Une adresse email @salavaux.ch ?</h1>

      <?php if(!$email_envoye):?>
        <form id="email_request_form" name="email_request_form" method="post" action="" class="form_style">
          <h1>Formulaire de demande d'adresse</h1>
                <p>Une adresse e-mail <em>prenom.nom@salavaux.ch</em> gratuite vous intéresse, il suffit de remplir le formulaire suivant.
          <br/>Dès que l'email sera créé, un message vous sera envoyé ...
          
          <?php if($error):?>
            <span class="error"><?php echo $error ?></span>
          <?php endif;?>
          
          </p>
          <label>Nom
              <span class="small">Votre nom de famille</span>
          </label>
          <input type="text" name="nom" id="nom"  value="<?php echo isset($nom) ? $nom: '';?>"/>

          <label>Prénom
              <span class="small">Votre prénom</span>
          </label>
          <input type="text" name="prenom" id="prenom"  value="<?php echo isset($prenom) ? $prenom: '';?>"/>
          
          <label>Email actuel
              <span class="small">Important</span>
          </label>
          <input type="text" name="email" id="email" value="<?php echo isset($email) ? $email: '';?>"/>

          <label>Redirection ?
              <span class="small">Transmettre les e-mails @salavaux.ch sur votre email actuel</span>
          </label>
          <input type="checkbox" name="redirection" value="oui" id="redirection" checked="checked" disabled="disabled">
          <div class="spacer"></div>
          <p></p>

          <button  type="submit">Envoyer</button>
          <div class="spacer"></div>

        </form>
        <?php else:?>
         <p class="result"><?php echo $email_envoye; ?></p>
         <?php endif;?>
      </div>
      <div id="infos">
       <div id="fans">
          <h1>Fans de Salavaux ?</h1>
              <a href="http://www.facebook.com/group.php?v=wall&amp;ref=ts&amp;gid=15560349866" title="Facebook"><img src="images/bt_fb.gif" width="193" height="49" alt=""/></a>
       </div>

       <div id="news">
          <h1>News sur Salavaux</h1>
          <script src="http://widgets.twimg.com/j/2/widget.js"></script>
          <script>
          new TWTR.Widget({
            version: 2,
            type: 'profile',
            rpp: 3,
            interval: 6000,
            width: 'auto',
            height: 300,
            theme: {
              shell: {
                background: '#ffffff',
                color: '#000000'
              },
              tweets: {
                background: '#ffffff',
                color: '#000000',
                links: '#455bff'
              }
            },
            features: {
              scrollbar: false,
              loop: false,
              live: false,
              hashtags: true,
              timestamp: true,
              avatars: false,
              behavior: 'all'
            }
          }).render().setUser('Salavaux').start();
          </script>
         
       </div>
       <h1>Salavaux en images</h1>
       <div id="flickr">

       </div>

      </div>   
      <div style="clear:both"></div>
   </div>
   <script type="text/javascript">
   $(document).ready(function(){

    $.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?&tagmode=any&format=json&jsoncallback=?&tags=salavaux", function(data){
      $.each(data.items, function(index, item){
      $("<img/>").attr("src", item.media.m).attr("height", "60").appendTo("#flickr")
        .wrap("<a href='" + item.link + "'></a>");
      });
    });
  });
  </script>
  
   <script type="text/javascript"> 
   var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
   document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
   </script> 
   <script type="text/javascript"> 
   try {
    var pageTracker = _gat._getTracker("UA-330251-1");
    pageTracker._trackPageview();
   } catch(err) {}</script>
</body>
</html>
