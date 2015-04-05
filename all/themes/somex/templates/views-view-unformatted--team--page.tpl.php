<?php if (!empty($title)): ?>
  <h3><span><?php print $title; ?></span></h3>
<?php endif; ?>
<div class="clearfix team_container team_container_<?php echo $id; ?>">
	<?php foreach ($rows as $id => $row): ?>
		<div <?php if ($classes_array[$id]) { print 'class="' . $classes_array[$id] .'"';  } ?>>
			<?php print $row; ?>
		</div>
	<?php endforeach; ?>
</div>