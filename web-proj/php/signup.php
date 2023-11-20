<?php
session_start();

function validateInput($input) {
    return trim(htmlspecialchars($input));
}

function isUsernameUnique($username, $users) {
    foreach ($users as $user) {
        if ($user["username"] === $username) {
            return false;
        }
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = validateInput($_POST["username"]);
    $password = validateInput($_POST["password"]);
    $sex = validateInput($_POST["sex"]);

    $errors = [];
    if (empty($username)) {
        $errors[] = "Username is required";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($sex)) {
        $errors[] = "Sex is required";
    }

    
    $users = json_decode(file_get_contents("users.json"), true) ?: [];
    if (!isUsernameUnique($username, $users)) {
        $errors[] = "Username is already taken. Please choose a different one.";
    }

    if (count($errors) > 0) {
        $_SESSION["signup_errors"] = $errors;
        header("Location: signup.html");
        exit();
    }

    $userData = [
        "username" => $username,
        "password" => $password,
        "sex" => $sex
    ];

    $users[] = $userData;
    file_put_contents("users.json", json_encode($users));

    echo "Account created successfully!";
}
?>
