
<h1><?php echo $model->description->title; ?></h1>
<div><?php echo City::getCityName($model->city->id).', '.$model->description->address; ?></div>
<ul>
    <li><?php echo ApartmentsModule::t('Type'); ?>:<span><?php echo $model::getNameByType($model->type); ?></span></li>
    <li><?php echo ApartmentsModule::t('Rooms'); ?>:<span><?php echo $model->num_of_rooms; ?></span></li>
    <li><?php echo ApartmentsModule::t('Square'); ?>:<span><?php echo ApartmentsModule::t('Square {value}', array('{value}' => $model->square)); ?></span></li>
    <li><?php echo ApartmentsModule::t('Number of berths'); ?>:<span><?php echo $model->berths; ?></span></li>
</ul>

<h2><?php echo ApartmentsModule::t('Description apartment'); ?></h2>
<div><?php echo $model->description->description; ?></div>
<?php
$attributes = $model->getFullInformation($model->id, 0);
$i = 0;

echo "<ul class='attributes'>";
foreach($attributes as $value) {

    if($value['active'] == true)
        echo "<li>".$value['title']."</li>";


    $i++;
}

echo "</ul>";
?>
<div><?php echo ApartmentsModule::t('Phones'); ?>:  <?php echo $model->phone.", ".$model->phone_additional; ?></div>
<div><?php echo ApartmentsModule::t('Price'); ?>: <?php echo ApartmentsModule::t('Price {value}', array('{value}' => $model->price));?></div>
<?php if($model->description->description_near): ?>
    <h2><?php echo ApartmentsModule::t('Near description'); ?></h2>
    <div><?php echo $model->description->description_near; ?></div>
<?php endif; ?>