<?php
use yii\helpers\Url;
Yii::$app->language = 'es_ES';
$this->title = 'Dashboard';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">
    <div class="row">
        <a href="<?php echo Url::toRoute(['/categorias/index']); ?>" class="text-white">
            <div class="enlace col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>&nbsp;&nbsp;</h3>
                        <p> CATEGORIAS </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-boxes"></i>
                    </div>
                    <p class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></p>
                </div>
        </a>
    </div>
    <a href="<?php echo Url::toRoute(['/productos/index']); ?>" class="text-white">
        <div class="enlace col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>&nbsp;&nbsp;</h3>
                    <p> PRODUCTOS</p>
                </div>
                <div class="icon">
                    <i class="fa fa-tags"></i>
                </div>
                <p class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></p>
            </div>
    </a>
</div>
<a href="<?php echo Url::toRoute(['/inventario/index']); ?>" class="text-white">
    <div class="enlace col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>&nbsp;&nbsp;</h3>
                <p> INVENTARIO </p>
            </div>
            <div class="icon">
                <i class="fa fa-clipboard"></i>
            </div>
            <p class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></p>
        </div>
</a>
</div>

</div>

</div>