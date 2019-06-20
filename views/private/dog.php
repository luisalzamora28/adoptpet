<?php create('content',function(){ extract($GLOBALS['view_variables']); ?>
    <div id="title">Perros</div>
    <a href="#" id="link_dog_create" class="trans boxed">Agregar perro</a>
    <div id="formWrapper" class="sf-wrapper" style="display:none;max-width:620px;">
        <h3 class="sf-title boxed" style="margin:0px 10px 10px 10px;">Nuevo perro</h3>
        <form id="form_new-existing_dog" class="sf-container" action="<?= url('admin/dog/create') ?>" method="post" enctype="multipart/form-data">
            <div class="sf-group">
                <div class="sf-pair-container boxed">
                    <label class="sf-label">Nombre</label>
                    <input type="text" class="sf-input boxed" name="name" required>
                </div>
                <div class="sf-pair-container boxed">
                    <label class="sf-label">Sexo</label>
                    <select name="sex" class="sf-input boxed" required>
                        <option value="">Seleccionar</option>
                        <option value="masculino">masculino</option>
                        <option value="femenino">femenino</option>
                    </select>
                </div>
                <div class="sf-pair-container boxed">
                    <label class="sf-label">Edad (años)</label>
                    <select name="age" class="sf-input boxed" required>
                        <option value="">Seleccionar</option>
                        <?php for ($i = 1; $i < 9; $i++) { ?><option value="<?= $i ?>"><?= $i ?></option><?php } ?>
                    </select>
                </div>
                <div class="sf-pair-container boxed">
                    <label class="sf-label">Tamaño</label>
                    <select name="size" class="sf-input boxed" required>
                        <option value="">Seleccionar</option>
                        <option value="pequeño">pequeño</option>
                        <option value="mediano">mediano</option>
                        <option value="grande">grande</option>
                    </select>
                </div>
                <div class="sf-pair-container boxed">
                    <label class="sf-label">Tipo de pelo</label>
                    <select name="fur" class="sf-input boxed" required>
                        <option value="">Seleccionar</option>
                        <option value="corto">corto</option>
                        <option value="largo">largo</option>
                    </select>
                </div>
                <div class="sf-pair-container boxed">
                    <label class="sf-label">Nivel de actividad</label>
                    <select name="activity" class="sf-input boxed" required>
                        <option value="">Seleccionar</option>
                        <option value="bajo">bajo</option>
                        <option value="medio">medio</option>
                        <option value="alto">alto</option>
                    </select>
                </div>
                <div class="sf-pair-container boxed">
                    <label class="sf-label">Espacio abierto requerido</label>
                    <select name="required_space" class="sf-input boxed" required>
                        <option value="">Seleccionar</option>
                        <option value="no es necesario">no es necesario</option>
                        <option value="pequeño">pequeño</option>
                        <option value="mediano">mediano</option>
                        <option value="grande">grande</option>
                    </select>
                </div>
                <div class="sf-pair-container boxed">
                    <label class="sf-label">Tiempo solo</label>
                    <select name="time_alone" class="sf-input boxed" required>
                        <option value="">Seleccionar</option>
                        <option value="le gusta estar acompañado">le gusta estar acompañado</option>
                        <option value="1 a 3 horas">1 a 3 horas</option>
                        <option value="4 a 6 horas">4 a 6 horas</option>
                        <option value="+7 horas">+7 horas</option>
                    </select>
                </div>
                <div class="sf-pair-container boxed">
                    <label class="sf-label">Código</label>
                    <input type="text" class="sf-input boxed" name="code" required>
                </div>
                <div class="sf-pair-container boxed">
                    <label class="sf-label">Contribución de adopción (S/)</label>
                    <input type="number" class="sf-input boxed" name="adoption_contribution" required>
                </div>
            </div>
            <div class="sf-group" id="group_files">
                <div class="sf-file-container boxed">
                    <div class="sf-file bgContain" style="height:180px">
                        <span>+</span>
                        <input type="file" accept="image/*" onchange="read_files(this);" multiple>
                        <input type="hidden">
                    </div>
                </div>
            </div>
            <input type="submit" id="reg_new-existing_dog" class="sf-button trans boxed" value="Agregar Perro" style="clear:both;">
        </form>
    </div>
    <?php if(!empty($dogs)){ ?><div class="st-wrapper"><table id="list_dogs">
        <thead><tr>
            <th>Nombre</th>
            <th style="width:80px;">Sexo</th>
            <th style="width:80px;">Edad</th>
            <th style="width:80px;">Fotos</th>
            <th style="width:100px;">Registrado</th>
            <th style="width:100px;">Actualizado</th>
            <th style="width:120px;text-align:center;">Estado</th>
        </tr></thead>
        <tbody><?php foreach ($dogs as $dog) { ?><tr>
            <td><a href="#" class="link_dog_show_edit" data-id="<?= $dog['id'] ?>"><?= $dog['name'] ?></a></td>
            <td><?= $dog['sex'] ?></td>
            <td><?= $dog['age'] ?></td>
            <td><?= $dog['c_img'] ?></td>
            <td><?= date('d/m/Y',strtotime($dog['created_at'])) ?></td>
            <td><?= date('d/m/Y',strtotime($dog['updated_at'])) ?></td>
            <td style="text-align:center;">
                <a href="#" class="link_dog_change_status" data-id="<?= $dog['id'] ?>"
                    style="color:<?= @['#0c0','#c00'][$dog['adoption_status']] ?>"><?= @['NO ADOPTADO','ADOPTADO'][$dog['adoption_status']] ?>
                </a>
            </td>
        </tr><?php } ?></tbody>
    </table></div><?php } ?>
<?php }); ?>

<?php include("_layout.php"); ?>