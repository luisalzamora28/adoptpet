<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADOPTPET</title>
    <style type="text/css">
        *{margin: 0px;padding: 0px;font-family:"Calibri";color:#2e5391;}
        html{height: 100%;}
        body{background-color: #fff;height: 100%;min-height: 400px;position:relative;}
        #title{font-size: 54px;text-align: center;color: #2e5391;}
        #title{font-weight:normal;/*position:absolute;right:0;bottom:0px;*/}
        section{width: calc(100% - 40px);padding: 20px;max-width: 1200px;}
        section{position: absolute;left: 50%;top: 50%;transform: translate(-50%,-50%);}
        #welcome{margin: auto;max-width: 360px;padding-bottom: 0px;}
        #error{text-decoration:underline;margin:10px 0px;text-align:center;}
        #captcha{font-weight:bold;}
        #business{font-size: 20px;text-align: right;}
        form{max-width: 360px;margin: auto;width: calc(100%);}
        input{border: none;display: block;padding: 5px;width: calc(100% - 12px);}
        input{border-bottom: 1px solid #4e73b1;background-color: #fff;color: #2e5391;}
        input[type=text],input[type=password]{margin-bottom:10px;font-size: 16px;}
        input:focus{outline: none;}
        input::-webkit-input-placeholder{color: #2e5391;}
        input::-moz-placeholder{color: #2e5391;}
        input:-ms-input-placeholder{color: #2e5391;}
        input:-moz-placeholder{color: #2e5391;}
        button{border: 1px solid #4e73b1;padding: 5px;color: #fff;font-size: 16px;}
        button{background-color: #2e5391;width: 100%;margin-bottom: 10px;}
        button:hover{cursor: pointer;}
    </style>
</head>
<body>
    <section>
        <div id="welcome">
            <div id="title">ADOPTPET</div>
            <div style="text-align:center;">Administrador</div>
            <?php if(@$error_login) { ?>
                <div id="error"><?= $message_err ?></div>
            <?php } ?>
        </div>
        <form action="<?= url('admin/login') ?>" method="post" autocomplete="off">
            <input type="text" placeholder="Usuario" name="email" required>
            <input type="password" placeholder="Contraseña" name="password" required>
            <?php if(isset($_SESSION['admin_captcha'])){ ?>
            <div>Más de 3 intentos. Resuelve el capctha:</div>
            <div id="captcha"><?= $_SESSION['admin_question'] ?></div>
            <input type="text" placeholder="Respuesta" name="captcha" required>
            <?php } ?>
            <button>Ingresar</button>
        </form>
    </section>
</body>
</html>