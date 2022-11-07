<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Unidadadministrativa
 *
 * @property $id
 * @property $ejercicio_id
 * @property $sector
 * @property $programa
 * @property $subprograma
 * @property $proyecto
 * @property $actividad
 * @property $denominacion
 * @property $unidadejecutora
 * @property $institucion_id
 * @property $nivel
 * @property $email
 * @property $telefono
 * @property $descripcion
 * @property $inversion
 * @property $nivelejecutor
 * @property $created_at
 * @property $updated_at
 *
 * @property Ejecucione[] $ejecuciones
 * @property Ejercicio $ejercicio
 * @property Institucione $institucione
 * @property Meta[] $metas
 * @property Poa[] $poas
 * @property Requisicione[] $requisiciones
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Unidadadministrativa extends Model
{
    
    static $rules = [
		'ejercicio_id' => 'required',
		'sector' => 'required',
		'programa' => 'required',
		'subprograma' => 'required',
		'proyecto' => 'required',
		'actividad' => 'required',
		'denominacion' => 'required',
		'unidadejecutora' => 'required',
		'institucion_id' => 'required',
		'nivel' => 'required',
		'email' => 'required',
		'telefono' => 'required',
		'descripcion' => 'required',
		'inversion' => 'required',
		'nivelejecutor' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ejercicio_id','sector','programa','subprograma','proyecto','actividad','denominacion','unidadejecutora','institucion_id','nivel','email','telefono','descripcion','inversion','nivelejecutor'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ejecuciones()
    {
        return $this->hasMany('App\Ejecucione', 'unidadadministrativa_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ejercicio()
    {
        return $this->hasOne('App\Ejercicio', 'id', 'ejercicio_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function institucione()
    {
        return $this->hasOne('App\Institucione', 'id', 'institucion_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metas()
    {
        return $this->hasMany('App\Meta', 'unidadadministrativa_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function poas()
    {
        return $this->hasMany('App\Poa', 'unidadadministrativa_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requisiciones()
    {
        return $this->hasMany('App\Requisicione', 'unidadadministrativa_id', 'id');
    }
    

}
