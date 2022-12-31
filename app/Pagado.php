<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pagado
 *
 * @property $id
 * @property $ordenpago_id
 * @property $beneficiario_id
 * @property $transferencia_id
 * @property $montopagado
 * @property $fechaanulacion
 * @property $status
 * @property $egreso
 * @property $tipoordenpago
 * @property $created_at
 * @property $updated_at
 *
 * @property Beneficiario $beneficiario
 * @property Detallepagado[] $detallepagados
 * @property Ordenpago $ordenpago
 * @property Transferencia $transferencia
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pagado extends Model
{
    
    static $rules = [
		'ordenpago_id' => 'required',
		'beneficiario_id' => 'required',
		'transferencia_id' => 'required',
		'montopagado' => 'required',
		'fechaanulacion' => 'required',
		'status' => 'required',
		'egreso' => 'required',
		'tipoordenpago' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ordenpago_id','beneficiario_id','transferencia_id','montopagado','fechaanulacion','status','egreso','tipoordenpago'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function beneficiario()
    {
        return $this->hasOne('App\Beneficiario', 'id', 'beneficiario_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallepagados()
    {
        return $this->hasMany('App\Detallepagado', 'pagado_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ordenpago()
    {
        return $this->hasOne('App\Ordenpago', 'id', 'ordenpago_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transferencia()
    {
        return $this->hasOne('App\Transferencia', 'id', 'transferencia_id');
    }
    

}
