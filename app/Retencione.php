<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Retencione
 *
 * @property $id
 * @property $descripcion
 * @property $porcentaje
 * @property $tipo
 * @property $tiporetencion
 * @property $created_at
 * @property $updated_at
 *
 * @property Detalleretencione[] $detalleretenciones
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Retencione extends Model
{
    
    static $rules = [
		'descripcion' => 'required',
		'porcentaje' => 'required',
		'tipo' => 'required',
		'tiporetencion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['descripcion','porcentaje','tipo','tiporetencion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleretenciones()
    {
        return $this->hasMany('App\Detalleretencione', 'retencion_id', 'id');
    }
    

}
