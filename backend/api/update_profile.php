<?php
session_start();
require_once('../DBconn.php');

// Get user ID from the session
$session_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact_no = $_POST['contact_no'];
    $email = $_POST['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    // Validate form data (you may add more validation as needed)

    // Fetch user information from the database
    $sqlSelectUser = "SELECT u.*, a.password as current_password 
                      FROM users u 
                      JOIN accounts a ON u.session_id = a.session_id 
                      WHERE u.id = :session_id";
    $stmtSelectUser = $pdo->prepare($sqlSelectUser);
    $stmtSelectUser->bindParam(':session_id', $session_id, PDO::PARAM_STR);
    $stmtSelectUser->execute();

    // Check if user exists
    if ($stmtSelectUser->rowCount() > 0) {
        $user = $stmtSelectUser->fetch(PDO::FETCH_ASSOC);

        // Verify current password before updating
        if (md5($current_password) == $user['current_password']) {
            // Update user profile information
            $sqlUpdateProfile = "UPDATE users SET 
                firstname = :firstname,
                middlename = :middlename,
                lastname = :lastname,
                age = :age,
                gender = :gender,
                contact_no = :contact_no,
                email = :email
                WHERE id = :session_id";

            $stmtUpdateProfile = $pdo->prepare($sqlUpdateProfile);
            $stmtUpdateProfile->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $stmtUpdateProfile->bindParam(':middlename', $middlename, PDO::PARAM_STR);
            $stmtUpdateProfile->bindParam(':lastname', $lastname, PDO::PARAM_STR);
            $stmtUpdateProfile->bindParam(':age', $age, PDO::PARAM_INT);
            $stmtUpdateProfile->bindParam(':gender', $gender, PDO::PARAM_STR);
            $stmtUpdateProfile->bindParam(':contact_no', $contact_no, PDO::PARAM_STR);
            $stmtUpdateProfile->bindParam(':email', $email, PDO::PARAM_STR);
            $stmtUpdateProfile->bindParam(':session_id', $session_id, PDO::PARAM_STR);

            if ($stmtUpdateProfile->execute()) {
                // Check if a new password is provided and update it
               // Check if a new password is provided and update it
        if (!empty($new_password)) {
            $hashed_password = md5($new_password);
            $sqlUpdatePassword = "UPDATE accounts SET password = :password WHERE session_id = :session_id";
            $stmtUpdatePassword = $pdo->prepare($sqlUpdatePassword);
            $stmtUpdatePassword->bindParam(':password', $hashed_password, PDO::PARAM_STR);
            $stmtUpdatePassword->bindParam(':session_id', $session_id, PDO::PARAM_STR);

            if ($stmtUpdatePassword->execute()) {
                echo 'success'; // Return success response
            } else {
                echo 'error'; // Return error response
            }
        } else {
            echo 'success'; // Return success response (no password update)
        }

            } else {
                echo 'error'; // Return error response
            }
        } else {
            echo 'incorrect_password'; // Return incorrect password response
        }
    } else {
        echo 'user_not_found'; // Return user not found response
    }
} else {
    echo 'invalid_request'; // Return invalid request response
}
?>
