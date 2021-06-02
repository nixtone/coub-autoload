<div class="item" data-id="<?=$data['ID']?>">
	<a href="//coub.com/embed/<?=$data['COUB_ID']?>?autoplay=true&muted=false" class="link">
		<img src="<?=$data['thumbUrl']?>" alt="" class="preview bimg">
		<? if(!empty($data['TITLE'])): ?><span class="name"><?=$data['TITLE']?></span><? endif; ?>
	</a>
	<? if(!empty($data['TAGS'])):
		$tags = explode(",", $data['TAGS']); ?>
		<div class="tags">
			<? foreach($tags as $tag): ?>
				<span class="tag"><?=$tag?></span>
			<? endforeach; ?>
		</div>
	<? endif; ?>
</div>