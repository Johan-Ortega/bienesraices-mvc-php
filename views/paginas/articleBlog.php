<?php foreach($entradas as $entrada){ ?>
<article class="entrada-blog">
    <div class="imagen">
        <picture>
            <source srcset="<?php echo $entrada->imagen; ?>.webp" type="image/webp">
            <source srcset="<?php echo $entrada->imagen; ?>.jpg" type="image/jpeg">
            <img loading="lazy" src="<?php echo $entrada->imagen; ?>.jpg" alt="Texto Entrada Blog">
        </picture>
    </div>

    <div class="texto-entrada">
        <a href="/entrada?id=<?php echo $entrada->id; ?>">
            <h4><?php echo $entrada->titulo ?></h4>
            <p class="informacion-meta">Escrito el: <span><?php echo $entrada->fecha ?></span> por: <span>Admin</span></p>

            <p><?php echo $entrada->descripcion ?></p>
        </a>
    </div>
</article>
<?php } ?>