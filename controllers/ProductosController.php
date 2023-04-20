<?php

namespace app\controllers;

use app\models\TblProductos;
use app\models\TblImagenes;
use app\models\TblInventario;
use app\models\ProductosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\UploadedFile;

/**
 * ProductosController implements the CRUD actions for TblProductos model.
 */
class ProductosController extends Controller
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
     * Lists all TblProductos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblProductos model.
     * @param int $id_producto Id Producto
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_producto)
    {
        $imagenes = TblImagenes::find()->where(['id_producto' => $id_producto])->all();
        $inv = TblInventario::find()->where(['id_producto' => $id_producto])->all();
        return $this->render('view', [
            'model' => $this->findModel($id_producto),
            'imagenes' => $imagenes,
            'inv' => $inv,
        ]);
    }

    /**
     * Creates a new TblProductos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
            $model = new TblProductos();
            $path2 = [];
        if ($model->load($this->request->post())) {
            $model->fecha_ing = date('Y-m-d H:i:s');
            $model->fecha_mod = date('Y-m-d H:i:s');
            $model->id_usuario = \Yii::$app->user->identity->id;
            $images = UploadedFile::getInstances($model, 'imagen');       

            foreach($images as $imagen) {
            $tmp = explode(".", $imagen->name);
            $ext = end($tmp);
            $name = \Yii::$app->security->generateRandomString() . ".{$ext}";
            $path = \Yii::$app->basePath . '/web/productos/' . $name;
            //$path2 = \Yii::$app->request->baseUrl . '/productos/' . $name;
            array_push($path2, \Yii::$app->request->baseUrl . '/productos/' . $name);
            //$model->imagen = $path2; //Ojo aqui es donde se almacena el path      
            $imagen->saveAs($path); 
            }
            
            if (!$model->save()){
               print_r($model->getErrors());
               die(); 
            }
            if(!count($path2) == 0){
                foreach ((array)$path2 as $rutaImagen) {
                    $modelProductosImagen = new TblImagenes();
                    $modelProductosImagen->id_producto = $model->id_producto;
                    $modelProductosImagen->url_imagen = $rutaImagen;
    
                    if (!$modelProductosImagen->save()) {
                        throw new Exception(implode("<br/>", \yii\helpers\ArrayHelper::getColumn($model->getErrors(), 0, false)));
                    }
                }
            }
            
            return $this->redirect(['view', 'id_producto' => $model->id_producto]);
        } else {
            return $this->render('create', [
                'model' => $model, 
            ]);
        }
    }



    /**
     * Updates an existing TblProductos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_producto Id Producto
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_producto)
    {
        $model = $this->findModel($id_producto);
        $path2 = [];
        if ($model->load($this->request->post())) {
            $model->fecha_mod = date('Y-m-d H:i:s');
            $images = UploadedFile::getInstances($model, 'imagen'); 

            foreach($images as $imagen) {
                $tmp = explode(".", $imagen->name);
                $ext = end($tmp);
                $name = \Yii::$app->security->generateRandomString() . ".{$ext}";
                $path = \Yii::$app->basePath . '/web/productos/' . $name;
                array_push($path2, \Yii::$app->request->baseUrl . '/productos/' . $name);
                $imagen->saveAs($path); 
                }
            
            
            if (!$model->save()){
               print_r($model->getErrors());
               die(); 
            }
            if(!count($path2) == 0){
                $img = TblImagenes::find()->where(['id_producto' => $id_producto])->all();
                foreach($img as $i) {
                    //$this->findModel($i)->delete();
                    \Yii::$app
                    ->db
                    ->createCommand()
                    ->delete('tbl_imagenes', ['id_producto' => $i])
                    ->execute();
                }            
                foreach ((array)$path2 as $rutaImagen) {
                    $modelProductosImagen = new TblImagenes();
                    $modelProductosImagen->id_producto = $model->id_producto;
                    $modelProductosImagen->url_imagen = $rutaImagen;
    
                    if (!$modelProductosImagen->save()) {
                        throw new Exception(implode("<br/>", \yii\helpers\ArrayHelper::getColumn($model->getErrors(), 0, false)));
                    }
                }
            }

            return $this->redirect(['view', 'id_producto' => $model->id_producto]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TblProductos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_producto Id Producto
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_producto)
    {
        $model = $this->findModel($id_producto);
        $model->estado = 0;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the TblProductos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_producto Id Producto
     * @return TblProductos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_producto)
    {
        if (($model = TblProductos::findOne(['id_producto' => $id_producto])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
