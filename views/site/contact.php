<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Users */
/* @var $friends array */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Registration';
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->getSession()->hasFlash('formSubmitted')): ?>

        <div class="alert alert-success">
            Вы зарегистрированы на конференцию
        </div>

    <?php else: ?>

        <p>Fill the form below. Every field is required.</p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'user-form', 'enableClientValidation' => false]); ?>

                    <?= $form->field($model, 'name') ?>

                    <?= $form->field($model, 'phone') ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'position') ?>

                    <?= $form->field($model, 'image')->fileInput() ?>

                    <p>You may invite as many friends as you want. Just list them.</p>

                    <div id="friends" class="form-group">

                    <?php if(!empty($friends)) {
                        foreach ($friends as $key => $friend) { ?>

                            <div class="new-friend">

                                <?= $form->field($friend, 'name')
                                    ->textInput(['name' => 'friend_name[]'])
                                    ->label('<label class="control-label">Name</label>') ?>

                                <?= $form->field($friend, 'position')
                                    ->textInput(['name' => 'friend_position[]'])
                                    ->label('<label class="control-label">Position</label>') ?>

                                <?= $form->field($friend, 'image')
                                    ->fileInput(['name' => 'friend_image[]'])
                                    ->label('<label class="control-label">Image</label>') ?>


                                <input type="button" class="btn btn-danger delete-friend" value="Remove">
                            </div>

                        <?php }
                    } ?>

                    </div>

                    <div class="form-group">
                        <input type="button" class="btn btn-primary" id="add-friend" value="Add">

                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
