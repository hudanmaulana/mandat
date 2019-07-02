<li class="nav-item"><?=anchor(BASE_URL, '<i class="fa fa-home fa-border"></i>', 'class="nav-link ajax"')?></li>
<?php
if(@$topmenu):
	foreach ($topmenu as $value):
		?>
		<li class="nav-item"><?=anchor($value->name, $value->value, 'class="nav-link ajax"')?></li>
		<?php
	endforeach;
endif;
?>