
<?php $x = $y = 0;?>
<?php $positions = array();
$num = 0;
$weights = array_column($graph->out, 'weight');
$max_weights = max($weights);
?>
<?php foreach ($graph->out as $key => $item) {
	?>
	<?php if (!empty($positions[$key])) {
		$x = $positions[$key]['x'] + 50;
		$y = $positions[$key]['y'];
		foreach ($item['groups']['group1'] as $value) {
			?>
			<?php if (empty($positions[$value['id']])) {
				$positions[$value['id']]['x'] = $x = $x + 50;
				$positions[$value['id']]['y'] = $y = $y + 40;?>
			<div id="<?=$value['id'];?>" class="officialItem" style="top: <?=$y;?>px;left: <?=$x;?>px" data-weight="<?=$graph->out[$value['id']]['weight'];?>" data-id="<?=$graph->out[$value['id']]['label'];?>" data-max="<?=$max_weights;?>">
				<div class="itemNode">
					<?=$graph->out[$value['id']]['label'];?>
				</div>
			</div>
			<?php }?>
		<?php }
	} else {
		$positions[$key]['x'] = $x = 0;
		$positions[$key]['y'] = $y = $num > 0 ? $y + 40 : 0;?>
		<div id="<?=$key;?>" class="officialItem" style="top: <?=$y;?>px;left: <?=$x;?>px" data-weight="<?=$item['weight'];?>" data-id="<?=$item['label'];?>" data-max="<?=$max_weights;?>">
			<div class="itemNode">
				<?=$item['label'];?>
			</div>
		</div>
		<?php foreach ($item['groups']['group1'] as $value) {
			?>
			<?php if (empty($positions[$value['id']])) {
				$positions[$value['id']]['x'] = $x = $x + 50;
				$positions[$value['id']]['y'] = $y = $y + 40;?>
			<div id="<?=$value['id'];?>" class="officialItem" style="top: <?=$y;?>px;left: <?=$x;?>px" data-weight="<?=$graph->out[$value['id']]['weight'];?>" data-id="<?=$graph->out[$value['id']]['label'];?>" data-max="<?=$max_weights;?>">
				<div class="itemNode">
					<?=$graph->out[$value['id']]['label'];?>
				</div>
			</div>
			<?php }?>

		<?php }?>
	<?php }?>
	<?php $num++;?>
<?php }?>
<div id="jsonBlock" data-json='<?=json_encode($graph->out);?>'></div>