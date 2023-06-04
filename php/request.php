<?php
    // ini_set('display_errors', 1);
    // error_reporting(E_ALL);
    require_once("../database.php");

    $dbConnection = dbConnect();

    $type = $_SERVER['REQUEST_METHOD'];

    // $request = substr($_SERVER['PATH_INFO'], 1);
    // $request = explode('/', $request);
    // $requestRessource = array_shift($request);


    if(isset($_GET['request']) && $_GET['request'] == 'last_ecoute'){
        $last_ecoute = dbGetLastEcoute($dbConnection, $_GET['id_perso']);
        echo json_encode($last_ecoute);
    }
    if(isset($_GET['request']) && $_GET['request'] == 'playlist'){
        $playlist = dbGetPlaylist($dbConnection, $_GET['id_perso']);
        echo json_encode($playlist);
    }
    if(isset($_POST['request']) && $_POST['request']=='likeMusic'){
        $idMusic = dbAddLike($dbConnection, $_POST['idPerso'], $_POST['idMusic']);
        echo json_encode($idMusic);
    }

    if(isset($_GET['request']) && $_GET['request'] == 'getOnePLaylist'){
        $playlist = dbGetOnePlaylist($dbConnection, $_GET['idPlaylist'],$_GET['idPerso']);
        echo json_encode($playlist);
    }

    if(isset($_GET['request']) && $_GET['request'] == 'getOneArtist'){
        $artist = dbGetOneArtist($dbConnection, $_GET['idArtist']);
        echo json_encode($artist);
    }
    if(isset($_GET['request']) && $_GET['request'] == 'getTop3'){
        $music = getTop3Music($dbConnection, $_GET['idArtist']);
        echo json_encode($music);
    }
    if(isset($_GET['request']) && $_GET['request'] == 'getOneAlbum'){
        $album = dbGetAlbumWithId($dbConnection, $_GET['idAlbum'], $_GET['idPerso']);
        echo json_encode($album);
    }
    if(isset($_GET['request']) && $_GET['request'] == 'playlistWithMusic'){
        $playlist = dbGetPlaylistWithMusic($dbConnection, $_GET['idMusic'],$_GET['id_perso']);
        echo json_encode($playlist);
    }

    if(isset($_POST['request']) && $_POST['request'] == 'addToPlaylist'){
        $idMusic = dbAddToPlaylist($dbConnection,$_POST['idMusic'], $_POST['idPlaylist'], $_POST['idPerso']);
        echo json_encode($idMusic);
    }
    if(isset($_GET['request']) && $_GET['request']=='music'){
        $music = dbGetMusicInfo($dbConnection, $_GET['idMusic']);
        echo json_encode($music);
    }

    if($type == 'DELETE' && isset($_GET['request']) && $_GET['request']=='deleteMusicFromPlaylist'){
        // echo 'coucuo';
        $music = dbDeleteMusic($dbConnection, $_GET['idMusic'], $_GET['idPlaylist']);
        echo json_encode($music);
    }

    if(isset($_GET['request']) && $_GET['request']=='playMusic'){
        $music = dbGetOneMusic($dbConnection, $_GET['idMusic'], $_GET['idPerso']);
        echo json_encode($music);
    }

    if($type=='POST'){
        // parse_str(file_get_contents('php://input'), $_POST);
        if(isset($_POST['request']) && $_POST['request']=='upDateHistory'){
            // echo json_encode("coucou");
            // echo $_PUT['idMusic'];
            // echo $_PUT['idPerso'];
            $playlist = dbUpdateHistory($dbConnection, $_POST['idMusic'],$_POST['idPerso']);
            echo json_encode($playlist);
        }
    }

    if(isset($_GET['request']) && $_GET['request']=='getCurrentUser'){
        $user = dbGetUser($dbConnection, $_GET['idPerso']);
        echo json_encode($user);
    }

    if(isset($_GET['request']) && $_GET['request']=='searchMusic'){
        $music = dbRechercheMusic($dbConnection, $_GET['recherche'],$_GET['idPerso']);
        echo json_encode($music);
    }
    if(isset($_GET['request']) && $_GET['request']=='searchAlbum'){
        $album = dbRechercheAlbum($dbConnection, $_GET['recherche']);
        echo json_encode($album);
    }
    if(isset($_GET['request']) && $_GET['request']=='searchArtist'){
        $artist = dbRechercheArtiste($dbConnection, $_GET['recherche']);
        echo json_encode($artist);
    }
    if(isset($_POST['request']) && $_POST['request'] == 'addPlaylist'){
        $addPlaylist = dbAddPlaylist($dbConnection, $_POST['idPerso'], $_POST['name']);
        echo json_encode($addPlaylist);
    }
    
    if($type == 'DELETE' && isset($_GET['request']) && $_GET['request']=='deletePlaylist'){
        // echo 'coucuo';
        $isDeleted = dbDeletePlaylist($dbConnection, $_GET['id_playlist'], $_GET['id_user']);
        echo json_encode($isDeleted);
    }

    if (isset($_POST['request']) && $_POST['request'] == 'modifyPlaylist') {
        $modified = dbModifyPlaylist($dbConnection, $_POST['id_playlist'],$_POST['name'],$_POST['id_user']);
        echo json_encode($modified);
    }

    if(isset($_GET['request']) && $_GET['request']=='getUser'){
        $user = dbGetUser($dbConnection,$_GET['idPerso']);
        echo json_encode($user);
    }
    
    parse_str(file_get_contents('php://input'), $_PUT);
    // echo json_encode($_PUT);

    if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['request']) && $_GET['request'] == 'modifyAccount') {
        $name = $_GET['name'];
        $lastname = $_GET['lastname'];
        $email = $_GET['email'];
        $idPerso = $_GET['idPerso'];
        $birthdate = $_GET['birthdate'];
        $telephone = $_GET['telephone'];

        $modified = dbModifyAccount($dbConnection, $name, $lastname, $email, $idPerso, $birthdate, $telephone);
        echo json_encode($modified);
    }
        // $name = $_POST['name'];
        // $id_playlist = $_POST['id_playlist'];
        // $id_user = $_POST['id_user'];
    
        // if (isset($_FILES['image'])) {
        //     // Traitement du fichier ici
        //     $file = $_FILES['image'];
        //     // ...
        //     $destinationPath = '../playlist/';
          
        //     // Déplacer le fichier vers le dossier de destination
        //     $targetPath = $destinationPath . $file['name'];
        //     move_uploaded_file($file['tmp_name'], $targetPath);
          
        //     // Répondre avec un message de succès ou autre information
        //     echo json_encode(true);
        // }else{
        //     // Répondre avec un message d'erreur ou autre information
        //     echo json_encode(false);
        // }
        

?>
