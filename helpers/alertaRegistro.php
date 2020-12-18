<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
<div class="alert alert-primary" role="alert">
    Registro agregado correctamente
</div>

<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
<div class="alert alert-danger" role="alert">
    Registro fallido.
</div>

<?php endif; ?>
<?php Utils::deleteSession('register'); ?>