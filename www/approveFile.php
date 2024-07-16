<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve File</title>
</head>

<body>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['submit']) {
        move_file($_POST['movefrom'], "gallery/");
       
    }

    if ($stream = opendir('tempUploads/')) {
        while ($entry = readdir($stream)) {
            $files[] = $entry;
        }

        $images = preg_grep('/\.(jpg|jpeg|png|gif|x-png|bmp)(?:[\?\#].*)?$/i', $files);
        $dir = "tempUploads/"; ?>
  
    <?php
        
        closedir($stream);
        header("Location: gallery.php");
    }
    ?>


    <?php
    
    
    function move_file($fromFile, $to)
    {
        include_once 'inc/dbFunctions.php';
        $path_parts = pathinfo($fromFile);
        $goingTo = "$to/" . $path_parts['basename'] . "";
        if (rename($fromFile, $goingTo)) {

            insertImage($conn, $path_parts['basename'], "$to" . $path_parts['basename'], $path_parts['filename']);
            return $goingTo;
        }
        return null;
    }
    ?>

</body>

</html>