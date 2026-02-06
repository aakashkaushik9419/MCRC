<?php
// Database connection
$conn = mysqli_connect('sql109.infinityfree.com', 'if0_36862604', 'vIgyFSWffw82xyc', 'if0_36862604_mcrc') or die('Connection failed');

// Check if form is submitted
if (isset($_POST['submit'])) {
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Aadhar = $_POST['Aadhar'];
    $Gender = $_POST['Gender'];
    $Books = $_POST['Books'];
    $School = $_POST['School'];
    $Contact = $_POST['Contact'];
    $Address = $_POST['Address'];
    
    // Initialize arrays for file uploads and errors
    $uploads = [];
    $upload_errors = [];
    
    // Handle file uploads
    $file_keys = ['image1', 'image2'];
    
    foreach ($file_keys as $file_key) {
        if (isset($_FILES[$file_key])) {
            $file = $_FILES[$file_key];
            $file_name = $file['name'];
            $file_tmp_name = $file['tmp_name'];
            $file_error = $file['error'];
            $file_folder = 'library_img/' . basename($file_name);
            
            if ($file_error === UPLOAD_ERR_OK) {
                if (move_uploaded_file($file_tmp_name, $file_folder)) {
                    $uploads[$file_key] = $file_name;
                } else {
                    $upload_errors[] = 'Error moving uploaded file: ' . $file_name;
                }
            } else {
                $upload_errors[] = 'File upload error for ' . $file_name . ': ' . $file_error;
            }
        } else {
            $upload_errors[] = 'No file uploaded for ' . $file_key;
        }
    }
    
    if (!empty($upload_errors)) {
        foreach ($upload_errors as $error) {
            echo $error . '<br>';
        }
        exit();
    }
    
    // Prepare SQL query to insert data
    $insert_query = mysqli_prepare($conn, "INSERT INTO Library (Name, Email, Aadhar, image1, image2, Gender, Books, School, Contact, Address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($insert_query) {
        mysqli_stmt_bind_param($insert_query, 'ssssssssss', $Name, $Email, $Aadhar, $uploads['image1'], $uploads['image2'], $Gender, $Books, $School, $Contact, $Address);
        
        if (mysqli_stmt_execute($insert_query)) {
            echo "Registration successful.";
            header('Location: https://mcrcindia.in/library_success.html');
            exit();
        } else {
            echo 'Error saving user information to database: ' . mysqli_error($conn);
        }
        
        mysqli_stmt_close($insert_query);
    } else {
        echo 'Error preparing SQL statement: ' . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
