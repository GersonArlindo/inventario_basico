<?php

use yii\helpers\Html;
Yii::$app->formatter->locale = 'en-US';
$this->title = 'Detalle';
$this->params['breadcrumbs'][] = ['label' => 'Listado', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-4">
        <div id="galeria">
            <?php if ($imagenes) { ?>
            <?php $n = 1;
                foreach ($imagenes as $imagen) { ?>
            <td rowspan="9" colspan="2">
                <img src="<?= Yii::$app->request->hostInfo . $imagen->url_imagen ?>" />
            </td>
            <?php $n++;
            } ?>
            <?php }else { ?>
            <td rowspan="9" colspan="2">
                <img class="w3-border w3-padding" src="../web/productos/productosDefault.png" />
            </td>
            <?php } ?>
        </div>
        <div id="contenedor-principal">
            <div id="contenedor-interno">
                <img id="img-activa" src="/img/img1.jpg" alt="galeria de imagenes">
                <button id="btn-cierra" type="button">x</button>
                <button id="btn-retrocede" type="button">&lt;</button>
                <button id="btn-adelanta" type="button">&gt;</button>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $model->nombre ?></h3>
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped table-hover table-bordered">
                    <tr>
                        <td width="16%"><b>Nombre:</b></td>
                        <td width="34%"><?= $model->nombre ?></td>
                        <td width="16%"><b>Categoria:</b></td>
                        <td width="34%"> <?= $model->categoria->nombre ?></td>
                    </tr>
                    <tr>
                        <td><b>Descripción:</b></td>
                        <td colspan="3"><?= $model->descripcion ?></td>
                    </tr>
                    <tr>
                        <td><b>Precio:</b></td>
                        <td><span><?= '$ ' . $model->precio ?></td>
                    </tr>
                    <tr>
                        <td><b>Fecha creacion:</b></td>
                        <td><?= date('d-m-Y H:i:s', strtotime($model->fecha_ing)) ?></td>
                        <td><b>Fecha modificacion:</b></td>
                        <td><?= date('d-m-Y H:i:s', strtotime($model->fecha_mod)) ?></td>
                    </tr>
                    <tr>
                        <td><b>Usuario: </b></td>
                        <td><?= $model->usuario->nombre ?></td>
                        <td><b>Estado: </b></td>
                        <td><span
                                class="badge bg-<?= $model->estado == 1 ? "green" : "red"; ?>"><?= $model->estado == 1 ? "Activo" : "Inactivo"; ?></span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <?php if ($inv) { ?>
                <?php $n = 1;
                foreach ($inv as $inventario) { ?>
                <?php echo Html::a('<i class="fa fa-caret-up"></i> Cantidad', ['inventario/update', 'id_inventario' => $inventario->id_inventario, 'id_producto' => $model->id_producto], ['class' => 'btn btn-dark', 'data-toggle' => 'tooltip', 'title' => 'Edit record']) ?>
                <?php $n++;
            } ?>
                <?php }else { ?>
                <?php echo Html::a('<i class="fa fa-caret-up"></i> Cantidad', ['inventario/create', 'id_producto' => $model->id_producto], ['class' => 'btn btn-warning', 'data-toggle' => 'tooltip', 'title' => 'Create record']) ?>
                <?php } ?>

                <?php echo Html::a('<i class="fa fa-edit"></i> Editar', ['update', 'id_producto' => $model->id_producto], ['class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'title' => 'Edit record']) ?>

                <?php echo Html::a('<i class="fa fa-ban"></i> Cancelar', ['index'], ['class' => 'btn btn-danger', 'data-toggle' => 'tooltip', 'title' => 'Cancelar']) ?>
            </div>
        </div>
    </div>
</div>



<script>
const btnCierra = document.querySelector('#btn-cierra');
const btnAdelanta = document.querySelector('#btn-adelanta');
const btnRetrocede = document.querySelector('#btn-retrocede');
const imagenes = document.querySelectorAll('#galeria img');
const lightbox = document.querySelector('#contenedor-principal');
const imagenActiva = document.querySelector('#img-activa');
let indiceImagen = 0;

/*Abre el Lightbox*/

const abreLightbox = (event) => {
    imagenActiva.src = event.target.src;
    lightbox.style.display = 'flex';
    indiceImagen = Array.from(imagenes).indexOf(event.target);
};

imagenes.forEach((imagen) => {
    imagen.addEventListener('click', abreLightbox);
});

/*Cierra el Lightbox */

btnCierra.addEventListener('click', () => {
    lightbox.style.display = 'none';
});

/* Adelanta la imagen*/

const adelantaImagen = () => {
    if (indiceImagen === imagenes.length - 1) {
        indiceImagen = -1;
    }
    imagenActiva.src = imagenes[indiceImagen + 1].src;
    indiceImagen++;
};

btnAdelanta.addEventListener('click', adelantaImagen);

/*Retrocede la Imagen*/

const retrocederImagen = () => {
    if (indiceImagen === 0) {
        indiceImagen = imagenes.length;
    }
    imagenActiva.src = imagenes[indiceImagen - 1].src;
    indiceImagen--;
};

btnRetrocede.addEventListener('click', retrocederImagen);
</script>
<style>
#galeria {
    position: fixed;
    display: grid;
    /*grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));*/
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 2px;
    max-width: 25%;
    min-width: 20%;
    padding: 0 10px;

}

#galeria img {
    width: 100%;
    height: auto;
    border-radius: 5px;
    cursor: pointer;
}

#img-activa {
    width: 100%;
    height: auto;
}

/*Contenedor Principal del Lightbox*/

#contenedor-principal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10;
    background-color: rgba(0, 0, 0, 0.55);
    display: none;
    justify-content: center;
    align-items: center;
}

/*Contenedor interno del Lightbox*/

#contenedor-interno {
    border: 2px #f3f3f3 solid;
    padding: 2px;
    background: #3f3f3f;
    max-width: 500px;
    min-height: 400px;
    position: relative;
    display: flex;
    justify-content: center;
}

/*Botones*/

button {
    cursor: pointer;
    background: transparent;
    border: none;
    color: #f3f3f3;
}

#btn-cierra {
    position: absolute;
    top: 0;
    right: 0;
    font-size: 3rem;
    color: teal;
}

#btn-retrocede {
    position: absolute;
    top: 50%;
    left: 0;
    font-size: 3rem;
    color: teal;
}

#btn-adelanta {
    position: absolute;
    top: 50%;
    right: 0;
    font-size: 3rem;
    color: teal;
}
</style>