<h4>Інші пропозиції власника</h4>
<ul class="additional-proposition">
<?php  $i=1; foreach ($related as $value) : ?>
        <li <?php if(count($related) == $i): ?> class="last" <?php endif; ?>><a title="<?php echo $value['title']; ?>" alt="<?php echo $value['title']; ?>" href="<?php echo Yii::app()->createUrl('/apartments/main/view', array(
			'id' => $value['id'],
			'title' => setTranslite($value['title']),
                    )) ?>"><?php echo $value['title']; ?></a>
    <p><img src="<?php echo $value['image'];?>"/><span class="price"><?php echo Yii::app()->numberFormatter->formatCurrency($value['price'],'UAH'); ?><span> за добу</span></span><br/><?php echo getSnippet($value['description'], 200);?></p>
    
     </li>
<?php $i++; endforeach; ?>
</ul>