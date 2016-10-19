<nav class="currency">
    <?php $currency  = Yii::app()->session['currency']; ?>
    <ul class="open"><li onmouseover="$(this).parent().removeClass('open').children().attr('style', 'display:block;');"  class="<?php echo $currency ? $currency : 'UAH'; ?>"><a href="#"><?php echo CurrencymanagerModule::t($currency); ?></a></li>
        <?php
            foreach($model as $row){
                if(($currency!=$row->currency_code))
                echo CHtml::tag('li', array('class' => $row->currency_code, 'style' => 'display:none;'), CHtml::link(CurrencymanagerModule::t($row->currency_code), 'javascript:void(0);',
                        ($currency!=$row->currency_code) ? array(
                            'onclick' => 'setcurrency("'.$row->currency_code.'");'
                        ) : array()
                    ));
            }
       ?>
    </ul>					
</nav> 