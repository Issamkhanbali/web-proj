function signup() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var sex = document.getElementById("sex").value;

    var userData = {
        "username": username,
        "password": password,
        "sex": sex
    };

    var users = JSON.parse(localStorage.getItem("users")) || [];
    users.push(userData);
    localStorage.setItem("users", JSON.stringify(users));

    alert("Account created successfully!");
    document.getElementById("signupForm").reset();
}

function login() {
    var loginUsername = document.getElementById("loginUsername").value;
    var loginPassword = document.getElementById("loginPassword").value;

    var users = JSON.parse(localStorage.getItem("users")) || [];
    var user = users.find(u => u.username === loginUsername && u.password === loginPassword);

    if (user) {
        alert("Login successful! Welcome, " + user.username + "!");
        document.getElementById("loginForm").reset();

        window.location.href = 'profile_page.html';
    } else {
        alert("Invalid username or password");
    }
}

