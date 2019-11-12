<?php

session_start();

if(isset($_POST['email']) && !empty($_POST['email'])){
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));

    //conexao ao banco

    $dsn = "mysql:dbname=blog;host=localhost";
    $dbuser = "root";
    $dbpass = "";

    try{
        $db = new PDO($dsn, $dbuser, $dbpass);

        $sql = $db->query("SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'");

        if($sql->rowCount() > 0){
            $dado = $sql->fetch();

            $_SESSION['id'] = $dado['id'];

            header("Location: index.php");
        }
    }catch (PDOException $erro){
        echo "Falhou: {$erro->getMessage()}";
    }
}

?>


<style>
    body{
        background-color: #5c5c5c;
    }
    .form{
        background-color: #347aba;
        padding: 30px;
        border-radius: 20px;
        width: 300px;
        height:250px;
        margin: auto;
        margin-top: 150px;
        box-shadow: 10px 5px 5px black;
    }
</style>
<div class="form">
    <form method="post">
        Email:<br>
        <input type="email" name="email"><br>
        Senha:<br>
        <input type="password" name="senha"><br>
        <br>
        <button type="submit">Ok</button>
    </form>
</div>
