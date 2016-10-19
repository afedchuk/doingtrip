<?php if ($services) : ?>
    <div class="services">
      <ul class="auth-services icons">
      <?php
        foreach ($services as $name => $service) {
            echo '<li class="auth-service '.$service->id.'">';
            $html = '<span class="auth-icon '.$service->id.'"><i></i></span>';
            $html .= '<span class="auth-title">'.$service->title.'</span>';
            $html = CHtml::link($html, Yii::app()->createUrl($action, array('service' => $name)), array(
            //$html = CHtml::link($html, array($action, 'service' => $name), array(
                'class' => 'auth-link '.$service->id,
            ));
            echo $html;
            echo '</li>';
        }
      ?>
      </ul>
    </div>
<?php endif; ?>