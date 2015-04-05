<article<?php print $attributes; ?>>
  <?php print render($content['field_picture']); ?>
  <div<?php print $content_attributes; ?>>
    <?php
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>
  <?php if (!$page && $title): ?>
		<footer class="submitted">
			<?php print $title ?>
		</footer>
  <?php endif; ?>
</article>