<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    $users = json_decode(file_get_contents("C:\\Users\\Issam\\Desktop\\web-l\\users.json"), true) ?: [];
    $user = array_filter($users, function ($u) use ($data) {
        return $u["username"] === $data["username"] && $u["password"] === $data["password"];
    });

    if ($user) {
        echo "Login successful! Welcome, " . $user[0]["username"] . "!";
    } else {
        http_response_code(401);
        echo "Invalid username or password";
    }
}
?>
