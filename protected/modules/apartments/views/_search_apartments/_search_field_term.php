<input type="hidden" name="property_search[check_out]" id="check_out" value="<?php echo $this->checkOut; ?>"/>
<?php ?>
<?php  $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                        'name'=>'property_search[check_in]',
                        'flat'=>true,
                        'theme' => 'default',
                        'options'=>array(
                            'showAnim'=>'fade',
                            'dateFormat' => 'yy-mm-dd',
                            'minDate' => date("Y-m-d"),
                            'maxDate' => date("Y-m-d", strtotime(date("Y-m-d")." +60 day")),
                            'onSelect'=> "js:function ( dateText, inst ) {
                              var d1, d2;
                              prv = cur;
                              cur = (new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay)).getTime();
                              if ( prv == -1 || prv == cur ) {
                                 prv = cur;
                                 $('input#check_in').val( dateText );
                               } else {
                                 d1 = $.datepicker.formatDate( 'yy-mm-dd', new Date(Math.min(prv,cur)), {} );
                                 d2 = $.datepicker.formatDate( 'yy-mm-dd', new Date(Math.max(prv,cur)), {} );
                                 $('input#check_in').val( d1 );
                                 $('input#check_out').val( d2 );
                                 search.changeSearch();
                              }
                            }",
                            'beforeShowDay' => "js:function ( date ) {
                              return [true, ( (date.getTime() >= Math.min(prv, cur) && date.getTime() <= Math.max(prv, cur)) ? 'ui-state-active' : '')];
                            }"
                        ),
                        'htmlOptions' => array('class' => 'range-dates', 'id' =>'check_in', 'value' => $this->checkIn)
                    )
        );
?>