<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_inventario".
 *
 * @property int $id_inventario
 * @property int $id_producto
 * @property int $cantidad
 * @property string $fecha_ing
 * @property string $fecha_mod
 * @property int $id_usuario
 *
 * @property TblProductos $producto
 * @property TblUsuarios $usuario
 */
class TblInventario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_inventario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_producto', 'cantidad', 'fecha_ing', 'fecha_mod', 'id_usuario'], 'required'],
            [['id_producto', 'cantidad', 'id_usuario'], 'integer'],
            [['fecha_ing', 'fecha_mod'], 'safe'],
            [['id_producto'], 'exist', 'skipOnError' => true, 'targetClass' => TblProductos::className(), 'targetAttribute' => ['id_producto' => 'id_producto']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => TblUsuarios::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_inventario' => 'Inventario',
            'id_producto' => 'Producto',
            'cantidad' => 'Cantidad',
            'fecha_ing' => 'Fecha Ing',
            'fecha_mod' => 'Fecha Mod',
            'id_usuario' => 'Id Usuario',
        ];
    }

    /**
     * Gets query for [[Producto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(TblProductos::class, ['id_producto' => 'id_producto'] );
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(TblUsuarios::className(), ['id_usuario' => 'id_usuario']);
    }
}
