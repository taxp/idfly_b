<?php

namespace app\controllers;

use app\models\Users;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Users();
        $friends = [];
        if ($model->load(Yii::$app->getRequest()->post())) {
            $model->image = UploadedFile::getInstanceByName('Users[image]');
            $model->setScenario('primary');

            try {
                $isValid = $model->validate();
            } catch(\Exception $e) {
                $model->addError('image', 'Not an image');
                $isValid = false;
            }

            if(Yii::$app->getRequest()->post('friend_name')) {
                $friendNames = Yii::$app->getRequest()->post('friend_name');
                $friendPositions = Yii::$app->getRequest()->post('friend_position');
                $numberOfFriends = sizeof($friendNames);

                for($i = 0; $i < $numberOfFriends; $i++) {
                    $friend = new Users();
                    $friend->name = $friendNames[$i];
                    $friend->position = $friendPositions[$i];
                    $friend->image = UploadedFile::getInstanceByName("friend_image[$i]");

                    try {
                        $friendValid = $friend->validate();
                    } catch(\Exception $e) {
                        $friend->addError('image', 'Not an image');
                        $friendValid = false;
                    }


                    $isValid = $isValid && $friendValid;
                    $friends[$i] = $friend;
                }
            }

            if($isValid) {
                $security = Yii::$app->getSecurity();
                $imagesPath = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
                $hash = $security->generateRandomString(25);
                $model->image->saveAs($imagesPath . $hash . '.' . $model->image->getExtension());
                $model->img_hash = $hash;
                $model->save(false);

                /** @var Users $friend */
                foreach($friends as $friend) {
                    $hash = $security->generateRandomString(25);
                    $friend->image->saveAs($imagesPath . $hash . '.' . $friend->image->getExtension());
                    $friend->img_hash = $hash;
                    $friend->parent_id = $model->id;
                    $friend->save(false);
                }

                Yii::$app->getSession()->setFlash('formSubmitted');
            }
        }
        return $this->render('contact', [
            'model' => $model,
            'friends' => $friends
        ]);
    }
}
