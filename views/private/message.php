<?php create('content',function(){ extract($GLOBALS['view_variables']); ?>
    <div id="title">Mensajes</div>
    <div class="st-wrapper"><table id="list_messages">
        <thead><tr>
            <th>Nombre</th>
            <th>Email</th>
            <th style="width:80px;">Enviado</th>
            <th style="width:70px;">Estado</th>
            <th style="width:60px;">Acción</th>
        </tr></thead>
        <tbody><?php if (!empty($messages)) { foreach ($messages as $message) { ?><tr data-status="<?= $message['status'] ?>">
            <td><?= $message['name'] ?></td>
            <td><?= $message['email'] ?></td>
            <td><?= date('d/m/Y H:i:s',strtotime($message['created_at'])) ?></td>
            <td class="message_status" style="text-align:center;"></td>
            <td style="text-align:center;">
                <a href="#" class="link_message_show" data-id="<?= $message['id'] ?>" style="text-decoration:underline;">Ver</a>
            </td>
        </tr><tr data-open="0">
            <td colspan="5"><?= $message['body'] ?></td>
        </tr><?php }} else { ?><tr>
            <td colspan="5">No se tienen mensajes aún</td>
        </tr><?php } ?></tbody>
    </table></div>
<?php }); ?>

<?php include("_layout.php"); ?>