<?php create('content',function(){ extract($GLOBALS['view_variables']); ?>
    <h2 style="margin:20px auto;">Adopta un cachorro</h2>
    <hr>
    <form action="<?= url('adopt') ?>" filters='<?= json_encode($filters) ?>' id="dog_filters" class="sf-group">
        <div class="sf-pair-container boxed">
            <label class="sf-label">Sexo</label>
            <select name_="sex" class="sf-input boxed">
                <option value=""            <?= @$filters['sex'] == '' ? 'selected' : '' ?>>Seleccionar</option>
                <option value="masculino"   <?= @$filters['sex'] == 'masculino' ? 'selected' : '' ?>>masculino</option>
                <option value="femenino"    <?= @$filters['sex'] == 'femenino' ? 'selected' : '' ?>>femenino</option>
            </select>
        </div>
        <div class="sf-pair-container boxed">
            <label class="sf-label">Edad (años)</label>
            <select name_="age" class="sf-input boxed">
                <option value=""            <?= @$filters['age'] == '' ? 'selected' : '' ?>>Seleccionar</option>
                <?php for ($i = 1; $i < 9; $i++) { ?>
                <option value="<?= $i ?>"   <?= @$filters['age'] == $i ? 'selected' : '' ?>><?= $i ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="sf-pair-container boxed">
            <label class="sf-label">Tamaño</label>
            <select name_="size" class="sf-input boxed">
                <option value=""            <?= @$filters['size'] == '' ? 'selected' : '' ?>>Seleccionar</option>
                <option value="pequeño"     <?= @$filters['size'] == 'pequeño' ? 'selected' : '' ?>>pequeño</option>
                <option value="mediano"     <?= @$filters['size'] == 'mediano' ? 'selected' : '' ?>>mediano</option>
                <option value="grande"      <?= @$filters['size'] == 'grande' ? 'selected' : '' ?>>grande</option>
            </select>
        </div>
        <div class="sf-pair-container boxed">
            <label class="sf-label">Tipo de pelo</label>
            <select name_="fur" class="sf-input boxed">
                <option value=""            <?= @$filters['fur'] == '' ? 'selected' : '' ?>>Seleccionar</option>
                <option value="corto"       <?= @$filters['fur'] == 'corto' ? 'selected' : '' ?>>corto</option>
                <option value="largo"       <?= @$filters['fur'] == 'largo' ? 'selected' : '' ?>>largo</option>
            </select>
        </div>
        <div class="sf-pair-container boxed">
            <label class="sf-label">Nivel de actividad</label>
            <select name_="activity" class="sf-input boxed">
                <option value=""            <?= @$filters['activity'] == '' ? 'selected' : '' ?>>Seleccionar</option>
                <option value="bajo"        <?= @$filters['activity'] == 'bajo' ? 'selected' : '' ?>>bajo</option>
                <option value="medio"       <?= @$filters['activity'] == 'medio' ? 'selected' : '' ?>>medio</option>
                <option value="alto"        <?= @$filters['activity'] == 'alto' ? 'selected' : '' ?>>alto</option>
            </select>
        </div>
        <div class="sf-pair-container boxed">
            <label class="sf-label">Espacio abierto requerido</label>
            <select name_="required_space" class="sf-input boxed">
                <option value=""            <?= @$filters['required_space'] == '' ? 'selected' : '' ?>>Seleccionar</option>
                <option value="no es necesario" <?= @$filters['required_space'] == 'no es necesario' ? 'selected' : '' ?>>no es necesario</option>
                <option value="pequeño"     <?= @$filters['required_space'] == 'pequeño' ? 'selected' : '' ?>>pequeño</option>
                <option value="mediano"     <?= @$filters['required_space'] == 'mediano' ? 'selected' : '' ?>>mediano</option>
                <option value="grande"      <?= @$filters['required_space'] == 'grande' ? 'selected' : '' ?>>grande</option>
            </select>
        </div>
        <div class="sf-pair-container boxed">
            <label class="sf-label">Tiempo solo</label>
            <select name_="time_alone" class="sf-input boxed">
                <option value=""            <?= @$filters['time_alone'] == '' ? 'selected' : '' ?>>Seleccionar</option>
                <option value="le gusta estar acompañado"   <?= @$filters['time_alone'] == 'le gusta estar acompañado' ? 'selected' : '' ?>>le gusta estar acompañado</option>
                <option value="1 a 3 horas" <?= @$filters['required_space'] == '1 a 3 horas' ? 'selected' : '' ?>>1 a 3 horas</option>
                <option value="4 a 6 horas" <?= @$filters['required_space'] == '4 a 6 horas' ? 'selected' : '' ?>>4 a 6 horas</option>
                <option value="+7 horas"    <?= @$filters['required_space'] == '+7 hora' ? 'selected' : '' ?>>+7 horas</option>
            </select>
        </div>
    </form>
    <hr>
    <div id="dogsWrapper" style="width:100%;">
        <?php if (!empty($dogs)) { foreach ($dogs as $dog) { ?><div class="dog">
            <div class="image bgFull" style="background-image:url(<?= asset('img/dog/'.$dog['bg']) ?>)">
                <a href="<?= url('dog/show?id='.$dog['id']) ?>" class="link_dog_show trans"><div class="trans"><i class="fa fa-search"></i> Conocer</div></a>
            </div>
            <div class="details">
                <h3><?= $dog['name'] ?></h3>
                <span><?= $dog['sex'] ?> | <?= $dog['age'] ?> años</span>
            </div>
        </div><?php }} else { ?>
            No se encontraron resultados para su búsqueda.
        <?php } ?>
    </div>
<?php }); ?>

<?php include("_layout.php"); ?>