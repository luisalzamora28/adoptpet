<?php create('content',function(){ extract($GLOBALS['view_variables']); ?>
    <div id="title">Contáctanos</div>
    <div class="sf-wrapper" style="max-width:400px;margin-bottom:80px;">
        <form class="sf-container" action="<?= url('contact/send') ?>" method="post" enctype="multipart/form-data">
            <label class="sf-label">Nombre</label>
            <input type="text" class="sf-input boxed" name="name" required>
            <label class="sf-label">Email</label>
            <input type="email" class="sf-input boxed" name="email" required>
            <label class="sf-label">Mensaje</label>
            <textarea class="sf-textarea boxed" name="body" maxlength="300" required></textarea>
            <label class="sf-label">Captcha</label>
            <div id="captchaWrapper">
                <img id="captcha" src="<?= url('contact/captcha') ?>" url="<?= url('contact/captcha') ?>" alt="Captcha">
                <a href="#">&#10227;</a>
                <input type="text" class="sf-input boxed" name="captcha" required>
            </div>
            <input type="submit" class="sf-button trans boxed" value="Enviar mensaje" style="clear:both;">
        </form>
    </div>
<?php }); ?>

<?php include("_layout.php"); ?>