<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_productos".
 *
 * @property int $id_producto
 * @property int $id_categoria
 * @property string $nombre
 * @property string|null $descripcion
 * @property float $precio
 * @property string|null $imagen
 * @property string $fecha_ing
 * @property string $fecha_mod
 * @property int $id_usuario
 * @property int $estado
 * @property string|null $campo_extra
 *
 * @property TblCategorias $categoria
 * @property TblImagenes[] $tblImagenes
 * @property TblInventario[] $tblInventarios
 * @property TblUsuarios $usuario
 */
class TblProductos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_categoria', 'nombre', 'precio', 'fecha_ing', 'fecha_mod', 'id_usuario', 'estado'], 'required'],
            [['id_categoria', 'id_usuario', 'estado'], 'integer'],
            [['descripcion'], 'string'],
            [['precio'], 'number'],
            [['fecha_ing', 'fecha_mod'], 'safe'],
            [['nombre', 'imagen'], 'string', 'max' => 255],
            [['campo_extra'], 'string', 'max' => 25],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => TblUsuarios::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => TblCategorias::className(), 'targetAttribute' => ['id_categoria' => 'id_categoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_producto' => 'Id',
            'id_categoria' => 'Categoria',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'precio' => 'Precio',
            'imagen' => 'Imagen',
            'fecha_ing' => 'Fecha Ing',
            'fecha_mod' => 'Fecha Mod',
            'id_usuario' => 'Usuario',
            'estado' => 'Estado',
            'campo_extra' => 'Campo Extra',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(TblCategorias::className(), ['id_categoria' => 'id_categoria']);
    }

    /**
     * Gets query for [[TblImagenes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblImagenes()
    {
        return $this->hasMany(TblImagenes::className(), ['id_producto' => 'id_producto']);
    }

    /**
     * Gets query for [[TblInventarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblInventarios()
    {
        return $this->hasOne(TblInventario::class, ['id_producto' => 'id_producto']);
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
