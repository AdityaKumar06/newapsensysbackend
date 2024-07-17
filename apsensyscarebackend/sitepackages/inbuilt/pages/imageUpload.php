<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $file = $_FILES['fileToUpload'];
        $folder = $_POST['folder'];
        // echo($file['name']);die;
        $allowedSizes = [
            ['width' => 150, 'height' => 200, 'maxSize' => 80 * 1024], // 80 KB for 150 × 200 px products size
            ['width' => 100, 'height' => 100, 'maxSize' => 100 * 1024], // 100 KB for 100x100
            ['width' => 230, 'height' => 460, 'maxSize' => 100 * 1024], // 100 KB for 100x100
            ['width' => 570, 'height' => 460, 'maxSize' => 100 * 1024], // 100 KB for 100x100
            ['width' => 1200, 'height' => 1800, 'maxSize' => 600 * 1024], // 700 KB for 1200x1800
            ['width' => 450, 'height' => 250, 'maxSize' => 200 * 1024], // 200 KB for 400x250
            ['width' => 570, 'height' => 300, 'maxSize' => 200 * 1024], // 200 KB for 400x250
            ['width' => 700, 'height' => 360, 'maxSize' => 200 * 1024], // 200 KB for 400x250
            ['width' => 330, 'height' => 330, 'maxSize' => 200 * 1024], // 200 KB for 400x250
            ['width' => 365, 'height' => 300, 'maxSize' => 200 * 1024], // 200 KB for 400x250
            ['width' => 400, 'height' => 200, 'maxSize' => 200 * 1024], // 200 KB for 400x250
        ];
        
        $fileSize = $file['size'];
        $validSize = false;
    
        foreach ($allowedSizes as $size) {
            if ($fileSize <= $size['maxSize']) {
                $validSize = true;
                break;
            }
        }
        
        if (!$validSize) {
            $response = [
                'status' => 'error',
                'message' => 'Invalid file size. Allowed sizes: 100 KB, 200 KB, and 700 KB.',
            ];
            http_response_code(500);
            echo json_encode($response);
            die;
        }
        
        $imageInfo = getimagesize($file['tmp_name']);
        if (!$imageInfo) {
            $response = [
                'status' => 'error',
                'message' => 'Invalid image file.',
            ];
            http_response_code(500);
            echo json_encode($response);
            die;
        }
        
        $validSize = false;
        foreach ($allowedSizes as $size) {
            if (($imageInfo[0] == $size['width'] && $imageInfo[1] == $size['height']) ||
                ($imageInfo[0] == $size['height'] && $imageInfo[1] == $size['width'])) {
                $validSize = true;
                break;
            }
        }
        if (!$validSize) {
            $response = [
                'status' => 'error',
                'message' => 'Invalid image dimensions. Allowed sizes are 100x100, 400x250, or 1200x1800.',
            ];
            http_response_code(500);
            echo json_encode($response);
            die;
        }
        
        $uploadFolder = '../assets/'.$folder.'/';

         // Ensure the destination folder exists
        if (!file_exists($uploadFolder)) {
            mkdir($uploadFolder, 0777, true);
        }
        
        $filename = uniqid('image_') . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        
        $destinationPath = $uploadFolder . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $destinationPath)) {
            // Determine the content type based on the file extension
            $contentType = mime_content_type($destinationPath);
    
            // Set the appropriate Content-Type header
            header('Content-Type: ' . $contentType);
    
            // Output the image content
            // readfile($destinationPath);
    
            // // Optionally, you can delete the uploaded file after sending it
            // unlink($destinationPath);
            $response = [
                'status' => 'success',
                'message' => 'upload success.',
                'name'=>$filename,
            ];
            echo json_encode($response);
        }else {
            $response = [
                'status' => 'error',
                'message' => 'Error moving image to the destination folder.',
            ];
            http_response_code(500);
            // Send JSON response for errors
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        
}
