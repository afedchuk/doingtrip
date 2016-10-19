<div class="control-group">
<?php foreach(Apartment::getTypesArray() as $key=>$type) : ?>
    <label class="checkbox span1">
        <input type="checkbox" onchange="search.changeSearch();" name="property_search[objType][]" <?php echo in_array($key, (isset($this->objType) ? $this->objType : array())) ? 'checked="checked"' : null; ?> value="<?php echo $key; ?>">
            <?php echo $type; ?>
    </label>
<?php endforeach; ?>
</div>