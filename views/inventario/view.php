<?php

use yii\helpers\Html;

Yii::$app->formatter->locale = 'en-US';
$this->title = 'Detalle';
$this->params['breadcrumbs'][] = ['label' => 'Listado', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?=  $model->producto->nombre ?></h3>
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped table-hover table-bordered">
                    <tr>
                        <td width="10%"><b>ID:</b></td>
                        <td width="20%"><?= $model->id_inventario ?></td>
                        <td width="10%"><b>Producto:</b></td>
                        <td width="40%"> <?= $model->producto->nombre ?></td>
                        <td width="10%"><b>Cantidad</b></td>
                        <td width="10%"><span class="badge bg-<?= $model->cantidad <= 10 ? "red" : "blue"; ?>"><?= $model->cantidad ?></span></td>
                    </tr>
                    <tr>
                        <td><b>Fecha creacion:</b></td>
                        <td><?= date('d-m-Y H:m:i', strtotime($model->fecha_ing)) ?></td>
                        <td><b>Fecha modificacion:</b></td>
                        <td><?= date('d-m-Y H:m:i', strtotime($model->fecha_mod)) ?></td>
                        <td><b>Usuario: </b></td>
                        <td><?= $model->usuario->nombre ?></td>
                    </tr>

                </table>
            </div>
            <div class="card-footer">
                <?php echo Html::a('<i class="fa fa-ban"></i> Cancelar', ['index'], ['class' => 'btn btn-danger', 'data-toggle' => 'tooltip', 'title' => 'Cancelar']) ?>
            </div>
        </div>
    </div>
</div>