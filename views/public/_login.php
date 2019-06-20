<?php create('content',function(){ extract($GLOBALS['view_variables']); ?>
    <style>
        #title{font-size: 54px;text-align: center;color: #2e5391;}
        #title{font-weight:normal;/*position:absolute;right:0;bottom:0px;*/}
        #welcome{margin: auto;max-width: 360px;padding-bottom: 0px;}
        #error{text-decoration:underline;margin:10px 0px;text-align:center;color:#2e5391;}
        #captcha{font-weight:bold;}
        #business{font-size: 20px;text-align: right;}
        form{max-width: 360px;margin: auto;width: calc(100%);color:#2e5391;}
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
    <div id="welcome">
        <div id="title" style="margin:0px;margin-top:40px;">ADOPTPET</div>
        <div style="text-align:center;color:#2e5391;">Club</div>
        <?php if(@$error_login) { ?>
            <div id="error"><?= $message_err ?></div>
        <?php } ?>
    </div>
    <form action="<?= url('customer/login') ?>" method="post" autocomplete="off">
        <input type="text" placeholder="Usuario" name="email" required>
        <input type="password" placeholder="Contraseña" name="password" required>
        <?php if(isset($_SESSION['customer_captcha'])){ ?>
        <div>Más de 3 intentos. Resuelve el capctha:</div>
        <div id="captcha"><?= $_SESSION['customer_question'] ?></div>
        <input type="text" placeholder="Respuesta" name="captcha" required>
        <?php } ?>
        <button>Ingresar</button>
    </form>
<?php }); ?>

<?php include("_layout.php"); ?>
