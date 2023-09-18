<?php

// Check if a file was uploaded
if (isset($_FILES["file"])) {
    // Get the file information
    $file_name = $_FILES["file"]["name"];
    $file_type = $_FILES["file"]["type"];
    $file_size = $_FILES["file"]["size"];
    $file_tmp_name = $_FILES["file"]["tmp_name"];
    $file_error = $_FILES["file"]["error"];

    // Check if the file is an image
    if ($file_type == "image/jpeg" || $file_type == "image/png" || $file_type == "image/gif") {
        // Check if the file size is less than 2 MB
        if ($file_size < 2097152) {
            // Check if there was no error during the upload
            if ($file_error == 0) {
                // Set the upload folder
                $upload_folder = "uploads/";

                // Move the file from the temporary folder to the upload folder
                if (move_uploaded_file($file_tmp_name, $upload_folder . $file_name)) {
                    // Display a success message
                    echo "The file " . $file_name . " has been uploaded.";
                } else {
                    // Display an error message
                    echo "There was an error uploading the file.";
                }
            } else {
                // Display an error message
                echo "There was an error uploading the file.";
            }
        } else {
            // Display an error message
            echo "The file size is too large.";
        }
    } else {
        // Display an error message
        echo "The file type is not supported.";
    }
} else {
    // Display an error message
    echo "No file was uploaded.";
}

?>
