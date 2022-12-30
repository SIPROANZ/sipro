<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transferencia
 *
 * @property $id
 * @property $cuentasbancaria_id
 * @property $beneficiario_id
 * @property $ordenpago_id
 * @property $montotransferencia
 * @property $fechaanulacion
 * @property $concepto
 * @property $egreso
 * @property $montoorden
 * @property $referenciabancaria
 * @property $conceptoanulacion
 * @property $created_at
 * @property $updated_at
 *
 * @property Beneficiario $beneficiario
 * @property Cuentasbancaria $cuentasbancaria
 * @property Ordenpago $ordenpago
 * @property Pagado[] $pagados
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Transferencia extends Model
{
    
    static $rules = [
		'cuentasbancaria_id' => 'required',
		'beneficiario_id' => 'required',
		'ordenpago_id' => 'required',
		'montotransferencia' => 'required',
		'fechaanulacion' => 'required',
		'concepto' => 'required',
		'egreso' => 'required',
		'montoorden' => 'required',
		'referenciabancaria' => 'required',
		'conceptoanulacion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cuentasbancaria_id','beneficiario_id','ordenpago_id','montotransferencia','fechaanulacion','concepto','egreso','montoorden','referenciabancaria','conceptoanulacion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function beneficiario()
    {
        return $this->hasOne('App\Beneficiario', 'id', 'beneficiario_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cuentasbancaria()
    {
        return $this->hasOne('App\Cuentasbancaria', 'id', 'cuentasbancaria_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ordenpago()
    {
        return $this->hasOne('App\Ordenpago', 'id', 'ordenpago_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagados()
    {
        return $this->hasMany('App\Pagado', 'transferencia_id', 'id');
    }
    

}
