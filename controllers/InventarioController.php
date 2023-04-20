<?php

namespace app\controllers;

use app\models\TblInventario;
use app\models\TblInventarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InventarioController implements the CRUD actions for TblInventario model.
 */
class InventarioController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all TblInventario models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TblInventarioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblInventario model.
     * @param int $id_inventario Id Inventario
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_inventario)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_inventario),
        ]);
    }

    /**
     * Creates a new TblInventario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
 public function actionCreate()
    {
        $model = new TblInventario();

        if ($model->load($this->request->post())) {
            $model->fecha_ing = date('Y-m-d H:i:s');
            $model->fecha_mod = date('Y-m-d H:i:s');
            $model->id_usuario = \Yii::$app->user->identity->id;
            
            if (!$model->save()){
               print_r($model->getErrors());
               die(); 
            }

            return $this->redirect(['view', 'id_inventario' => $model->id_inventario]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TblInventario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_inventario Id Inventario
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_inventario)
    {
        $model = $this->findModel($id_inventario);

        if ($model->load($this->request->post())) {
            $model->fecha_mod = date('Y-m-d H:i:s');
            
            if (!$model->save()){
               print_r($model->getErrors());
               die(); 
            }

            return $this->redirect(['view', 'id_inventario' => $model->id_inventario]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TblInventario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_inventario Id Inventario
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_inventario)
    {
        $model = $this->findModel($id_inventario);
        $model->cantidad = 0;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the TblInventario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_inventario Id Inventario
     * @return TblInventario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_inventario)
    {
        if (($model = TblInventario::findOne(['id_inventario' => $id_inventario])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
