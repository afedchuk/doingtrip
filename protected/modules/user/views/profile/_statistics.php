<?php 
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(

      'title' => array('text' => UserModule::t('Statistic view')),
      'xAxis' => array(
         'type' => 'datetime',
         'categories' => $ranges
      ),
      'yAxis' => array(
         'title' => array('text' => UserModule::t('Count view')),
          'min' => 0,
          

      ),
      'plotOptions'=>array(
                'spline'=>array(
                    'lineWidth'=> 2,
                    'states'=>array(
                        'hover' => array(
                            'lineWidth'=> 3
                        )
                    ),
                    'marker' =>array(
                        'enabled'=> false
                    ),


                )
      ),

      'series' => $visited,
      'navigation' => array(
                'menuItemStyle' => array(
                'fontSize'=>'10px'
      )
      )
   )
)); ?>