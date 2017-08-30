<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\label\LabelInPlace;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
  <div class="row">
    <div class="Absolute-Center is-Responsive">
      <div id="logo-container"></div>
      <div class="col-sm-12 col-md-4 col-md-offset-4">
      <div class="panel panel-primary">
      <div class="panel-heading"><center><h3><strong> LOGIN </strong></h3></center></div>
      <div class="panel-body">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); 
        $config = ['template'=>"{input}\n{error}\n{hint}"];
        ?>

                <?= $form->field($model, 'username', ['template'=>"{input}\n{error}\n{hint}",
                'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-user"></i>']]
                ])->textInput(['autofocus' => true,'placeholder'=>'Your Username']) ?>

                <?= $form->field($model, 'password', ['template'=>"{input}\n{error}\n{hint}",
                'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-lock"></i>']]
                ])->passwordInput(['placeholder'=>'Your Password']) ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <!--<div style="color:#999;margin:1em 0">
                    Lupa password ? reset <?php //Html::a('Disini', ['site/request-password-reset']) ?>.
                </div>-->

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-lg btn-danger btn-block', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
            </div>
     </div>     
      </div>  
    </div>    
  </div>
</div>