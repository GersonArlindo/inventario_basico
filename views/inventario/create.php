<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblInventario */

$this->title = 'Create Tbl Inventario';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-inventario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
