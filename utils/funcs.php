<?php
    function format_images_array($FILES) {
        $array = [];
        foreach($FILES as $key => $value) {
            foreach($value as $k => $v) {
                $array[$k][$key] = $v;
            }
            unset($_FILES[$key]);
        }
        return $array;
    }

    function upload_image($image, $path) {
        $imageTmpName = $image['tmp_name'];
        $errorCode = $image['error'];

        if($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($imageTmpName)) {
            $errorMessage = [
                UPLOAD_ERR_INI_SIZE   => "Размер файла {$image['name']} превысил значение upload_max_filesize в конфигурации PHP.",
                UPLOAD_ERR_FORM_SIZE  => "Размер файла {$image['name']} превысил значение MAX_FILE_SIZE в HTML-форме.",
                UPLOAD_ERR_PARTIAL    => "Файл {$image['name']} был получен только частично.",
                UPLOAD_ERR_NO_FILE    => "Файл {$image['name']} не был загружен.",
                UPLOAD_ERR_NO_TMP_DIR => "Отсутствует временная папка.",
                UPLOAD_ERR_CANT_WRITE => "Не удалось записать файл {$image['name']} на диск.",
                UPLOAD_ERR_EXTENSION  => "PHP-расширение остановило загрузку файла {$image['name']}.",
            ];
            $unknownMessage = "Неизвестная ошибка при загрузке файла {$image['name']}";
            $outputMessage = isset($errorMessage[$errorCode])? $errorMessage[$errorCode]: $unknownMessage;
            $_SESSION['errors'][] = $outputMessage;
            header('Location: add.php');die();
        }

        $imageInfo = getimagesize($imageTmpName);
        $name = md5_file($imageTmpName);
        $extension = image_type_to_extension($imageInfo[2]);
        if(!move_uploaded_file($imageTmpName,$path."/$name$extension")) {
            $_SESSION['errors'][] = "При записи файла {$image['name']} произошла ошибка";
            die();
        };
        return $name.$extension;
    }

    function get_rows($link, $table='applications', $where=0, $order=0, $limit=0) {
        if(mysqli_connect_errno()) {
            die('Ошибка подключения: '.mysqli_error());
        }

        $query = "SELECT * FROM $table ";

        if($where) $query .= "WHERE $where ";
        if($order) {
            $desc = mb_substr($order, 0, 1);
            $query .= $desc === '-'? "ORDER BY ".ltrim($order, '-')." DESC ": "ORDER BY $order ";
        }
        if($limit) $query .= "LIMIT $limit";

        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
        return $data;
    }

    function create_query_related($fields, $where=0) {
        $tables = [];
        $query = "SELECT applications.id, applications.description, applications.title, applications.year, applications.price, applications.volume, applications.running, ";
        foreach($fields as $field) {
            $i = strpos($field, '_id');
            if($i) {
                $table = substr($field, 0, $i);
                $tables[] = $table;
                $query .= "$table.title as {$table}_title, ";
            }
        }
        $query = rtrim($query, ', ' ).' FROM applications ';

        foreach($tables as $table) {
            $query .= "LEFT JOIN $table ON $table.id=applications.{$table}_id ";
        }

        if($where) $query .= "WHERE applications.$where";

        return $query;
    }

    function get_applcation_image($link, $id) {
        $query = "SELECT images.name FROM applications
                    LEFT JOIN application_image ON application_image.application_id=applications.id 
                    LEFT JOIN images ON application_image.image_id=images.id
                    WHERE applications.id=$id LIMIT 1;
                 ";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $imageName = mysqli_fetch_assoc($result)['name'];
        return $imageName;
    }
?>
