<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-image: linear-gradient(45deg, rgb(20, 4, 94), rgb(68, 108, 216));
        }

        .container {
            display: flex;
            max-width: 10000px;
            background-color: rgba(0, 0, 0, 0.7);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 45px;
            border-radius: 15px;
            color: #fff;
        }

        .left-half {
            flex: 1;
            padding: 125px;
            text-align: center;
        }

        .right-half {
            flex: 1;
            padding: 103px;
            background-image: url('sua-imagem.jpg');
            background-size: cover;
        }

        .form {
            text-align: center;
        }

        .form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-half">
            <h2>Faça login</h2>
            <form class="form" action="logar.php" method="POST">
                <div>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <button type="submit">Entrar</button>
    </div>
    </form>
        </div>
        <div class="right-half" style="background-image: url('imagens/LogoA7agro.png');"></div>
    </div>
</body>
</html>
