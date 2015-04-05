<?php foreach ($rows as $row): ?>
	<?php echo strtr(trim($row), array("\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />')); ?>
<?php endforeach; ?>