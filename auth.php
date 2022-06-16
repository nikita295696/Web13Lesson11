<?php
// форма авторизации пользователей

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authorization</title>
</head>
<body>
<style>
    .container {
        max-width: 800px;
        margin: auto;
        text-align: center;
        padding: 30px 0;
    }
    form {
        border: 2px solid teal;
        padding: 30px;
    }
    input, button {
        width: 90%;
        padding: 15px 10px;
        margin-bottom: 15px;
        border: 1px solid teal;
        font-size: 18px;
    }
    input:focus {
        outline: 2px solid orange;
        border: none;
    }
    button {
        width: 93%;
        background-color: white;
        font-size: 20px;
    }
    .error {
        color: red;
        font-size: 20px;
        text-align: left;
        padding-left: 30px;
    }
</style>
<div class="container">
    <form id="auth" method="POST">
        <h2>Welcome to authorization form!</h2>
        <div class="loginDiv">
            <input type="text" class="login  name="login" placeholder="Login">
        </div>
        <div class="passDiv">
            <input type="password" class="password" name="password" placeholder="Password">
        </div>
        <button type="submit">Send</button>

    </form>
</div>
<script>
    let form = document.querySelector("#auth");
    let loginDiv = document.querySelector(".loginDiv");
    let passDiv = document.querySelector(".passDiv");
    let login = document.querySelector(".login");
    let pass = document.querySelector(".password");
    let logDiv = document.createElement("div");
    let pasDiv = document.createElement("div");
    let formDiv = document.createElement("div");
    logDiv.classList.add("error");
    pasDiv.classList.add("error");
    formDiv.classList.add("error");

    login.addEventListener("blur", handleCheckLogin);
    function handleCheckLogin () {
        logDiv.innerHTML = "";
        if (login.value.length == 0) {

            logDiv.innerHTML = "Введите логин!!";
            loginDiv.appendChild(logDiv);
        } else if (login.value.length < 3 || login.value.length > 12) {

            logDiv.innerHTML = "Логин должен содержать не менее 3 и не более 12 символов!!";
            loginDiv.appendChild(logDiv);
        }
    }
    pass.addEventListener("blur", handleCheckPassword);
    function handleCheckPassword () {
        pasDiv.innerHTML = "";
        if (pass.value.length == 0) {

            pasDiv.innerHTML = "Введите пароль!!";
            passDiv.appendChild(pasDiv);
        } else if (pass.value.length < 4 || pass.value.length > 16) {

            pasDiv.innerHTML = "Логин должен содержать не менее 4 и не более 16 символов!!";
            passDiv.appendChild(pasDiv);
        }
    }
    form.addEventListener("submit", async function (e) {
        e.preventDefault();
        let login = e.target[0].value;
        let password = e.target[1].value;
        console.log(login, password);
        let formData = new FormData();
        formData.append("login", login);
        formData.append("password", password);

        let response = await fetch("authCheck.php",{
            method: "POST",
            body: formData,
        });

        let answer = await response.json();

        if (answer == "ok") {
            window.location = "index.php";
        } else {
            formDiv.innerHTML = "Такого пользователя не существует, либо введены неверные данные";
            form.appendChild(formDiv);
        }

    });
</script>
</body>
</html>
