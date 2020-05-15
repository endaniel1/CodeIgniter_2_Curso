<section class="s-featured">
	<div class="row">
		<div class="col-full">
			<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				<input placeholder="Titulo" type="title" name="title">
				<input placeholder="Intro del Post"  type="text" name="intro">
				<textarea placeholder="Contenido" id="summernote" name="content"></textarea>
				<select name="category">
					<?php foreach ($categories as $category): ?>
						<option value="<?=$category["id"]?>"><?=$category["name"]?></option>
					<?php endforeach?>
				</select>
				<input placeholder="Nombre del Tag"  type="text" name="tags">
				<input type="file" name="banner" required="">
				<br>
				<input type="submit" name="enviar" value="Enviar">
			</form>
		</div>
	</div>
</section>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({

        });
    });
  </script>
