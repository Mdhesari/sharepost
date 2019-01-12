<?php

function imageAddPost($file, $user_id)
{
    if (!isset($file['name'])) {
        return 0;
    }

    $target_dir = 'assets/pictures/posts/' . $user_id . '/';
    $file_name = date('y') . '-' . date('m') . '-' . date('d') . '-' . uniqid();

    if (!file_exists($target_dir)) {
        mkdir($target_dir);
    }

    $target_dir .= $file_name;
    $result = [
        'error' => '',
        'img_src' => '',
    ];
    $imageFileType = strtolower(pathinfo(basename($file['name']), PATHINFO_EXTENSION));
    $target_file = $target_dir . '.' . $imageFileType;

    // Check if image is actual img
    // ****************************** Temporarry **************************************
   /*  $check = getimagesize($file['tmp_name']);
    if ($check === false) {
        $result['error'] = 'file is not an image.';
        return $result;
    } */
    // ********************************************************************************

    // Check if file exists
    if (file_exists($target_file)) {
        $result['error'] = 'file already exists...';
        return $result;
    }

    // File type limitation
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $result['error'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
        return $result;
    }

    // File size limitation
    if ($file['size'] > 1000000) {
        $result['error'] = 'file is too big!';
        return $result;
    }

    if (empty($result['error'])) {
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            $result['img_src'] = $file_name . '.' . $imageFileType;

        } else {
            $result['error'] = 'Unable to upload image.';

        }

        return $result;
    }

}
