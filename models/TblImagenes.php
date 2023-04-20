<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_imagenes".
 *
 * @property int $id_imagen
 * @property int $id_producto
 * @property string $url_imagen
 *
 * @property TblProductos $producto
 */
class TblImagenes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_imagenes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_producto', 'url_imagen'], 'required'],
            [['id_producto'], 'integer'],
            [['url_imagen'], 'string', 'max' => 255],
            [['id_producto'], 'exist', 'skipOnError' => true, 'targetClass' => TblProductos::className(), 'targetAttribute' => ['id_producto' => 'id_producto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_imagen' => 'Id Imagen',
            'id_producto' => 'Id Producto',
            'url_imagen' => 'Url Imagen',
        ];
    }

    /**
     * Gets query for [[Producto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(TblProductos::className(), ['id_producto' => 'id_producto']);
    }
}
