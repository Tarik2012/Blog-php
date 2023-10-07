<?php  require 'header.php'; ?>
    <div class='contenedor'> 
        <div class="post">
            <article>
                <h2 class="titulo">Nuevo articulo</h2>
                    <form class='formulario' method='post' enctype='multipart/form-data' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <input type="text" name='titulo' placeholder='Titulo del titulo'>
                    <input type="text" name='Extracto' placeholder='Extracto del titulo'>
                    <textarea name="texto" placeholder='Texto del Articulo'></textarea>
                    <input type="file" name='thumb'>

                    <input type="submit" value='Crear Articulo'>
                </form>
            </article>
        </div>
    </div>
	

<?php  require 'footer.php'; ?>