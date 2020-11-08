<?php
$user = unserialize($_COOKIE['user']);

$name = $_POST['themeName'];
$themeDesc = $_POST['themeDesc'];
$userId = $user['id'];
$themePreview = $_FILES['themePreview'];

$files = $_FILES['themeImages'];
$newArrFiles = [];

foreach ($files as $key => $file) {
    foreach ($file as $key1 => $fileInfo)
    {
        // echo "<br>";
        // echo $key;

        // echo "<br>";
        // echo $key1;

        // echo "<br>";
        // echo $fileInfo;
        // echo "<br>";
        // echo "<br>";

        // echo 'newArray['.$key1.']['.$key.'] = '.$fileInfo;
        $newArrFiles[$key1][$key] = $fileInfo;
    }
}

// echo "<pre>";
//     print_r($newArrFiles);
// echo "</pre>";

function moveFile($fileInfo)
{
    $fileName = time() . $fileInfo['name'];
    if (move_uploaded_file($fileInfo['tmp_name'], dirname(__DIR__) . '\theme-thumbnail\\' . $fileName))
    {
        // echo "<br>";
        // echo $fileName;

        return $fileName;
    }
    else 
    {
        return false;
    }
}

$files = '';

foreach ($newArrFiles as $key => $file) {
    if (!file_exists(dirname(__DIR__) . '\theme-thumbnail\\'.$file['name']))
    {
        if ($fileNameToDb = moveFile($file)) {
            
            // echo "<br>";
            // echo 'strlen($files) ' . strlen($files);
            // echo "<br>";

            // echo "<br>";
            // echo 'files до ' . $files;
            // echo "<br>";

            if (strlen($files) !== 0)
            {
                $files = $files . ', ' . $fileNameToDb;
            }
            else
            {
                $files = $fileNameToDb;
            }

            // echo "<br>";
            // echo 'files после '.$files;
            
        } else
        {
            $isSaved = false;
        }
    }
}

if (!file_exists(dirname(__DIR__) . '\theme-thumbnail\\'.$themePreview['name']))
{
    if ($PreviewFileNameToDb = moveFile($themePreview)) {

        // echo "<br>";
        // echo $PreviewFileNameToDb;

        require_once './connection.php';

        $newTheme = $pdo->prepare(
            "INSERT INTO 
                `themes`
                    (`id`, `name`, `description`, `image`, `images`, `date`, `author`, `status`) 
            VALUES 
                    (NULL, :name, :desc, :image, :images, NOW(), :userId, 1)");

        $themeInfo = ['name' => $name, 'desc' => $themeDesc, 'image' => $PreviewFileNameToDb, 'images' => $files, 'userId' => $userId];

        if ($newTheme->execute($themeInfo))
        {
            header('Location: ./../pages/my_themes.php');

            // echo "запись в БД есть!";
        }

    }
}

?>