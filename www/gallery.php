<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>

<main>
  <div class="login-cont">
    <h2>File Uploader</h2>

    <form action="gallery.php" method="POST" enctype="multipart/form-data" class="login-form">
      <input type="hidden" name="MAX_FILE_SIZE" value="5000000" class="input-group">
      <label>Upload:</label> <br> <br>
      <input type="file" name="theFile" class="input-group">
      <button type="submit">Insert</button>
      <button type="reset">Clean </button>
    </form>

  </div>

  <div class="login-error">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if ($_FILES['theFile']['error'] == 0) {
        $file = $_FILES['theFile']['tmp_name'];
        $file_info = new finfo(FILEINFO_MIME);

        $mime_type_long = $file_info->buffer(file_get_contents($file));
        $intpos = strpos($mime_type_long, ";");
        $mime_type = substr($mime_type_long, 0, $intpos);

        if (
          $mime_type == 'image/jpeg' || $mime_type == 'image/jpg' ||
          $mime_type == 'image/gif' || $mime_type == 'image/png' ||
          $mime_type == 'image/bmp' || $mime_type == 'image/pjpg' ||
          $mime_type == 'image/x-png'
        ) {

          doFileCheck($file);
        } else {
          echo "Invalid type $mime_type.";
        }
      } else {
        echo "The error check" . checkErrorCodes($_FILES['theFile']['error']);
      }
    }
    ?>
  </div>

  </div>


  <div class="gallery-container">

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
      $count = 1;
      foreach ($images as $image) {
        echo '<form action="approveFile.php" method="POST" enctype="multipart/form-data">';
        echo "<img src='$dir$image' width='200' height='200' alt='$image'/>",
        "<input type='hidden' name='movefrom' value='$dir$image'><br>",
        "<div class='login-form'><button type='submit' name='submit' value='$count'>Approve</button></div><br><br>";
        echo '</form>';
        $count++;
      }
      closedir($stream);
    }
    ?>

  </div>
</main>




<?php include 'inc/footer.php'; ?>

<?php
include 'inc/dbFunctions.php';
function doFileCheck($file)
{
  $imageinfo_array = getimagesize($file);
  if ($imageinfo_array !== false) {
    $uploadDir = './tempUploads/';
    $uploadFile = $uploadDir . basename($_FILES['theFile']['name']);

    if (file_exists($uploadFile)) {
      echo "File alredy exists";
    } else {
      if (move_uploaded_file($_FILES['theFile']['tmp_name'], $uploadFile)) {

        echo 'The file is valid';
      } else {
        echo 'Invalid file - posible attack';
      }
    }
  }
}

function checkErrorCodes($errorCode)
{
  switch ($errorCode) {
    case '1':
      $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
      break;
    case '2':
      $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
      break;
    case '3':
      $message = "The uploaded file was only partially uploaded. File is likely too large.";
      break;
    case '4':
      $message = "No file was uploaded.";
      break;
    case '6':
      $message = "Missing a temporary folder.";
      break;
    case '7':
      $message = "Failed to write file to disk.";
      break;
    case '8':
      $message = "A PHP extension stopped the file upload.";
      break;
    default:
      $message = "An unknown error has occurred";
      break;
  }
  return $message;
}


function move_file($fromFile, $to)
{
  $path_parts = pathinfo($fromFile);
  $goingTo = "$to/" . $path_parts['basename'] . "";
  if (rename($fromFile, $goingTo)) {
    return $goingTo;
  }
  return null;
}


?>