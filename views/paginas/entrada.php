<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $entrada->titulo ?></h1>

    <picture>
        <source srcset="<?php echo $entrada->imagen ?>.webp" type="image/webp">
        <source srcset="<?php echo $entrada->imagen ?>.jpg" type="image/jpeg">
        <img loading="lazy" src="<?php echo $entrada->imagen ?>.jpg" alt="imagen de la propiedad">
    </picture>

    <p  class="informacion-meta">Escrito el: <span><?php echo $entrada->fecha ?></span> por: <span>Admin</span></p>

    <div class="resumen-propiedad">
        <p><?php echo $entrada->descripcion ?>
        <?php echo $entrada->descripcion ?>
        <?php echo $entrada->descripcion ?>
        <?php echo $entrada->descripcion ?>
        </p>
    </div>
</main>