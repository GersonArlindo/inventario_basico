<?php

namespace app\controllers;

use app\models\TblProductos;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use Yii;
use yii\data\ActiveDataProvider;


class ApiController extends ActiveController
{
    public function actionOptions() {
        $header = header('Access-Control-Allow-Origin: *');
    }
    public function behaviors() {
        $behaviors = parent::behaviors();
    
        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);
    
        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
        ];
    
        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];
        return $behaviors;
    }

    public $modelClass = 'app\models\TblProductos';   
  
}


