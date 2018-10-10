<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Mon Explorateur de fichier</title>
  </head>
  <body>
    <header>
      <h2>Mes dossiers / fichiers</h2>
    </header>
    <aside>
      <h4>Explorer</h4>
      <div class="vertical">
          <ul>
            <a href="#" id="create"><img src="img/creer.png" height='20' width='20'>Créer dossiers</a>
                <div class="create mm">
                  <!--*********creation de nouveau Dossier********-->
                  <form class=""  method="POST">

                    <input type="text" name="faire"  placeholder="Nouveau Dossier">

                    <input type="submit" name="valide" value="Créer">

                  </form>

                    <?php
                          if (isset($_POST['valide']))
                         {
                          if(is_dir($_POST['faire'])){

                          echo "Repertoire exist";
                          }
                          else{
                          mkdir($_POST['faire']);

                          echo "creer";
                          }
                        }
                     ?>
                     <script type="text/javascript">
                       document.querySelector("#create").addEventListener('click',function(){
                         document.querySelector(".create").style.display="flex";
                       })
                     </script>
                </div>
                <a href="#" id="createfile"><img src="img/creer.png" height='20' width='20'>Créer fichiers</a>
                    <div class="createfile mm">
                      <!--*********creation de nouveau fichier********-->
                             <form class=""  method="POST">

                               <input type="text" name="fichierr"  placeholder="Nouveau fichier">

                               <input type="submit" name="validerr" value="Créer">

                             </form>

                             <?php
                             if (isset($_POST['validerr'])) {
                               if (file_exists($_POST['fichierr'])) {
                                 echo "fichier existe";
                               }
                               else {
                                file_put_contents($_POST['fichierr'], ""); // crée un fichier vide
                                echo "fichier creer";
                               }
                             }
                             ?>
                         <script type="text/javascript">
                           document.querySelector("#createfile").addEventListener('click',function(){
                             document.querySelector(".createfile").style.display="flex";
                           })
                         </script>
                    </div>
            <a href="#" id="copied"><img src="img/copier.png" height='20' width='20'>Copier dossiers / fichiers</a>
            <div class="copied mm">
              <!--Copier un fichier -->
       		   <form  method="POST">
       		       <input type="text" name="ACopier" placeholder="fichier à copier">
       		       <input type="text" name="NouvNomFCopier" placeholder="nouveau fichier">
       		       <input type="submit" name="Copii" value="Copier">
       		   </form>
       			 <?php
       			 if (isset($_POST['Copii'])){
       			     $file=$_POST['ACopier'];
       			     $newfile=$_POST['NouvNomFCopier'];
       			     if (!copy($file, $newfile)) {
       			         echo "La copie $file du fichier a échoué...\n";
       			     }
       			 }
       			 ?>
             <script type="text/javascript">
               document.querySelector("#copied").addEventListener('click',function(){
                 document.querySelector(".copied").style.display="flex";
               })
             </script>
            </div>
            <a href="#" id="renamed"><img src="img/renommer.png" height='20' width='20'>Renommer dossiers / fichiers</a>
            <div class="renamed mm">
              <!--renommer un fichier-->
                <form  method="POST">
                    <input type="text" name="Arenommer" placeholder="à renommer">
                    <input type="text" name="newrenommer" placeholder="nouveau nom">
                    <input type="submit" name="rename" value="Renommer">
                </form>
                <?php
                // Renommer un fichier
                if (isset($_POST['rename'])){
                    $recupnomf=$_POST['Arenommer'];
                    $Nomnouvf=$_POST['newrenommer'];
                    if(!rename("$recupnomf", "$Nomnouvf")){
                        echo "Impossible de renommer.";
                    }
                  }
                 ?>
                 <script type="text/javascript">
                   document.querySelector("#renamed").addEventListener('click',function(){
                     document.querySelector(".renamed").style.display="flex";
                   })
                </script>
             <br>
            </div>
            <a href="#" id="deleted"><img src="img/supprimer.png" height='20' width='20'>Supprimer dossiers / fichiers</a>
            <div class="deleted mm">
              <form action="" method="post">
              	<input type="text" name="doc" placeholder="à supprimer">
              	<input type="submit" name="supprimer" value="Supprimer">
              </form>
              <?php

              //Supprimer

              if (isset($_POST['supprimer']))
                  {

                $doc = $_POST['doc'];
                if (isset($doc))
                  {
                 if (is_dir($doc))
                  {
                    rmdir($doc);
                  }
                else
                  {
                    unlink($doc);
                  }
                }
                header('location: interface.php');//actualiser la page
                  }
               ?>
               <script type="text/javascript">
                 document.querySelector("#deleted").addEventListener('click',function(){
                   document.querySelector(".deleted").style.display="flex";
                 })
              </script>
            </div>
            <a href="#" id="uploaded"><img src="img/upload.png" height='20' width='20'>Uploader dossiers / fichiers</a>
            <div class="uploaded mm">
              <!--*********upload********-->
              <form class=""  method="POST" enctype="multipart/form-data">
               <p>
                 <label></label>
                 <input type="hidden" name="fileName" id="fileName" value="">
               </p>
               <p>
                 <input type="file" name="fichier" value="">
               </p>
               <p>
                 <input type="submit" name="envoyer" value="Uploader">
               </p>
               <?php
               if (isset($_POST['envoyer'])) {
                 $cheminETNomTemporaire = $_FILES['fichier']['tmp_name'];
                 $cheminETNomDefinitif = 'upload/'.$_FILES['fichier']['name'];
                 $moveIsOK = move_uploaded_file($cheminETNomTemporaire,$cheminETNomDefinitif);
                 if ($moveIsOK) {
                   $message = "Le fichier a été uploadé dans".$cheminETNomDefinitif;
                 }
                 else {
                   $message = "Suite à une erreur, le fichier n'a pas été uploadé";
                 }
               }
                ?>
              </form>
              <p><?php $message ?></p>
              <script type="text/javascript">
                document.querySelector("#uploaded").addEventListener('click',function(){
                  document.querySelector(".uploaded").style.display="flex";
                })
             </script>
            </div>
          </ul>
      </div>
    </aside>
    <section>
      <div class="section1">
        <!--Mes dossiers dans section-->

          <?php



                  $racine='./interface.php';      //on stock le chemin vers la racine

             //on initialise path
              $path="";
                  echo "<a href='$racine'><img src='img/retour.png' width='25' height='25'></a>";

              if(sizeof($_GET) != 0)
              	{
              		$path =
              		$_GET["path"];
          		}

              if(strlen($path)==0) $path=".";
              else if ($path !=".")
              {
                  $parent_dir = substr($path,0,strrpos($path,"/")); //contient le dossier précédemment visité



                      echo "<a href='./interface.php?path=$parent_dir'><img src='img/retour.png' width='25' height='25'></a>"; //lien vers le dossier précédent

                  ?>

              <?php
              }
              // on ouvre le dossier et on le parcourt
              $dir = opendir($path);
              $directories=array();
              $files=array();
              while($file = readdir($dir))
              {
                  if($file != "." && $file != "..")
                  {
                      // on stock les dossiers et les fichiers dans deux variables différentes
                      if(is_dir("$path/$file"))
                      {
                          $directories[]="$file";
                      }
                      else $files[]="$file";
                  }
              }
              // on tri le tableau directories
                  if(isset($directories))
                      {
                          sort($directories);
                          foreach($directories as $d) //on parcourt le tableau et on l'affiche
                          {
                                            //avec un icône pour les dossiers
                              echo "<tr><th scope='row'><a href='./interface.php?path=$path/$d'><img src='img/dossier.png'width='25' height='25' ><br>$d</a></th> <td>&nbsp;&nbsp;&nbsp;&nbsp;<br>" ."</td>"." <td></td></tr>";
                               //et un lien vers les sous dossiers
                          ?>

                          <?php
                          }
                      }


            // on trie les fichoers dans l'ordre alphabétique
                  if(isset($files))
                  {
                      sort($files);
                  if($files!= 'interface.php')
                  {
                      foreach($files as $files2)

                      {
                           $extension = pathinfo($files2, PATHINFO_EXTENSION);

                           if ($extension=="pdf")
                            {
                                echo "<tr><th scope='row'><a href=\"$path/$files2\" > <img src='img/pdf.png' width='25' height='25'><br> $files2 </a>
                          </th> <td>&nbsp;&nbsp;&nbsp;&nbsp;<br>" .filesize($path.'/'.$files2). " bytes</td>"." <td></td></tr>";

                           }

                           elseif ($extension == "png"  || $extension =="jpg"|| $extension =="JPG" || $extension =="jpeg" || $extension =="ico" )
                            {


                                echo "<tr><th scope='row'><a href=\"$path/$files2\" > <img src='img/img.png' width='25' height='25'><br> $files2 </a>
                          </th> <td>&nbsp;&nbsp;&nbsp;&nbsp;<br>" .filesize($path.'/'.$files2). " bytes</td>"." <td></td></tr>";

                           }
                            elseif ($extension == "mp3" )
                            {


                                echo "<tr><th scope='row'><a href=\"$path/$files2\" > <img src='img/mp3.png' width='25' height='25'><br> $files2 </a>
                          </th> <td>&nbsp;&nbsp;&nbsp;&nbsp;<br>" .filesize($path.'/'.$files2). " bytes</td>"." <td></td></tr>";

                           }
                            elseif ($extension == "doc" || $extension == "docx" )
                            {


                                echo "<tr><th scope='row'><a href=\"$path/$files2\" > <img src='img/doc.png' width='25' height='25'><br> $files2 </a>
                          </th> <td>&nbsp;&nbsp;&nbsp;&nbsp;<br>" .filesize($path.'/'.$files2). " bytes</td>"." <td></td></tr>";

                           }


                           else if ( $extension!="pdf" && "png" && "jpg"&& "JPG" && "jpeg" && "mp3" && "ico" && "doc" && "docx")
                               {
                          echo "<tr><th scope='row'><a href=\"$path/$files2\" > <img src='img/fichier.png' width='25' height='25'><br> $files2 </a>
                          </th> <td>&nbsp;&nbsp;&nbsp;&nbsp;<br>" .filesize($path.'/'.$files2). " bytes</td>"." <td></td></tr>";}           //ouverture du fichier dans une nouvelle fenêtre

                      }
                  }
                  }
                  //on ferme la lecture dossier
              closedir($dir);


           ?>
      </div>

    </section>
    <footer>
    </footer>
  </body>
</html>
