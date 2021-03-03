<h1>Mis Categorias</h1>

<a href="<?=base_url?>categoria/crear" class='button button-small'>Crear Categorias</a>

<table>
    <tr>
        <th>ID</th>
        <th>Categoria</th>
    </tr>
    <?php while($cat = $categorias->fetch_object()): ?>
        <tr>
            <td><?=$cat->id?></td>
            <td><?=$cat->nombre?></td>
        </tr>
    <?php endwhile; ?>
</table>