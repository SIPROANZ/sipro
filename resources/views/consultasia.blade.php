//como hacer dos select dependiente de otro en laravel?  
public function getplants()
{
    try {    
        $plantas = Planta::all();
        $response = ['data' => $plantas];
    } catch (\Exception $exception) {
        return response()->json([ 'message' => 'There was an error retrieving the records' ], 500);
    }
    return response()->json($response);
}

public function getareas(Request $request)
{
    try {    
        $plant_id = $request->input('plant_id');
        $areas = Area::when($plant_id, function ($query) use ($plant_id) {
            $query->where('plant_id', $plant_id)
        })->get();
        $response = ['data' => $areas];
    } catch (\Exception $exception) {
        return response()->json([ 'message' => 'There was an error retrieving the records' ], 500);
    }
    return response()->json($response);
}

public function getequipos(Request $request)
{
    try {    
        $area_id = $request->input('area_id');
        $equipos = Equipo::when($area_id, function ($query) use ($area_id) {
            $query->where('area_id', $area_id)
        })->get();
        $response = ['data' => $equipos];
    } catch (\Exception $exception) {
        return response()->json([ 'message' => 'There was an error retrieving the records' ], 500);
    }
    return response()->json($response);
}


Route::get('publisher/getplants', 'PublisherController@getplants')->name('getplants');
Route::get('publisher/getareas', 'PublisherController@getareas')->name('getareas');
Route::get('publisher/getequipos', 'PublisherController@getequipos')->name('getequipos');


<div>
    <label>Planta:</label>
    <select id="plant_id">
        <option value="">Todas--</option>
    </select>
</div>
<div>
    <label>Area:</label>
    <select id="area_id">
        <option value="">Elije una planta--</option>
    </select>
</div>
<div>
    <label>Equipo:</label>
    <select id="equipo_id">
        <option value="">Elije un area--</option>
    </select>
</div>

<script type="text/javascript">
$(document).ready(function() {
    // por comodidad puedes asignar los selects a una variable, ya que los vas a usar mas de una vez
    var plantSelect = $('#plant_id');
    var areaSelect = $('#area_id');
    var equipoSelect = $('#equipo_id');
    // primero obtienes las plantas y llenas el select
    function populatePlantSelect() {
        $.ajax({
            url: "{{ route('getplants') }}",
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $.each(response.data, function (key, value) {
                    plantSelect.append("<option value='" + value.id + "'>" + value.name + "</option>");
                });
            },
            error: function () {
                alert('Hubo un error obteniendo las plantas!');
            }
        });
    }
    populatePlantSelect();
    // luego indicas que cuando se seleccione una planta, se obtengan las areas correspondientes y se llene el select de areas
    plantSelect.change(function(){
        var plantId = $(this).val();
        areaSelect.empty();

        if (plantId) {
            $.ajax({
                url: "{{ route('getareas') }}",
                type: 'GET',
                data: { plant_id: plantId },
                dataType: 'json',
                success: function (response) {
                    areaSelect.append('<option value="">--Elije un area</option>')
                    $.each(response.data, function (key, value) {
                        areaSelect.append("<option value='" + value.id + "'>" + value.name + "</option>");
                    });
                },
                error : function(){
                    alert('Hubo un error obteniendo las areas!');
                }
            });
        }
    });
    // finalmente, indicas que cuando se seleccione un area, se obtengan los equipos correspondientes y se llene el select de equipos
    areaSelect.change(function(){
        var areaId = $(this).val();
        equipoSelect.empty();

        if (areaId) {
            $.ajax({
                url: "{{ route('getequipos') }}",
                type: 'GET',
                data: { area_id: areaId },
                dataType: 'json',
                success: function (response) {
                    equipoSelect.append('<option value="">--Elije un equipo</option>')
                    $.each(response.data, function (key, value) {
                        equipoSelect.append("<option value='" + value.id + "'>" + value.name + "</option>");
                    });
                },
                error : function(){
                    alert('Hubo un error obteniendo los equipos!');
                }
            });
        }
    });
});
</script>


    function populatePlantSelect() {
        $.ajax({
            url: "{{ route('getplants') }}",
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $.each(response.data, function (key, value) {
                    plantSelect.append("<option value='" + value.id + "'>" + value.name + "</option>");
                });
                $("#plant_id option:first").attr('selected','selected');
                plantSelect.trigger('change');
            },
            error: function () {
                alert('Hubo un error obteniendo las plantas!');
            }
        });
    }
    populatePlantSelect();

    plantSelect.change(function(){
        var plantId = $(this).val();
        areaSelect.empty();

        if (plantId) {
            $.ajax({
                url: "{{ route('getareas') }}",
                type: 'GET',
                data: { plant_id: plantId },
                dataType: 'json',
                success: function (response) {
                    $.each(response.data, function (key, value) {
                        areaSelect.append("<option value='" + value.id + "'>" + value.name + "</option>");
                    });
                    $("#area_id option:first").attr('selected','selected');
                    areaSelect.trigger('change');
                },
                error : function(){
                    alert('Hubo un error obteniendo las areas!');
                }
            });
        }
    });

    areaSelect.change(function(){
        var areaId = $(this).val();
        equipoSelect.empty();

        if (areaId) {
            $.ajax({
                url: "{{ route('getequipos') }}",
                type: 'GET',
                data: { area_id: areaId },
                dataType: 'json',
                success: function (response) {
                    $.each(response.data, function (key, value) {
                        equipoSelect.append("<option value='" + value.id + "'>" + value.name + "</option>");
                    });
                    $("#equipo_id option:first").attr('selected','selected');
                },
                error : function(){
                    alert('Hubo un error obteniendo los equipos!');
                }
            });
        }
    }); 


    function populatePlantSelect() {
        var plantaEnBD = null;
        @isset($publisher)
        plantaEnBD = '{{ $publisher->plant_id }}';
        @endisset

        $.ajax({
            url: "{{ route('getplants') }}",
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $.each(response.data, function (key, value) {
                    plantSelect.append("<option value='" + value.id + "'>" + value.name + "</option>");
                });
                plantSelect.val( plantaEnBD? plantaEnBD: $("#plant_id option:first").val() )
                    .find("option[value=" + plantaEnBD +"]").attr('selected', true)
                    .trigger('change');
            },
            error: function () {
                alert('Hubo un error obteniendo las plantas!');
            }
        });
    }
    populatePlantSelect();

    plantSelect.change(function(){
        var plantId = $(this).val();
        areaSelect.empty();
        equipoSelect.empty();
        var areaEnBD = null;
        @isset($publisher)
            areaEnBD = '{{ $publisher->area_id }}';
        @endisset

        if (plantId) {
            $.ajax({
                url: "{{ route('getareas') }}",
                type: 'GET',
                data: { plant_id: plantId },
                dataType: 'json',
                success: function (response) {
                    $.each(response.data, function (key, value) {
                        areaSelect.append("<option value='" + value.id + "'>" + value.name + "</option>");
                    });
                    areaSelect.val( areaEnBD? areaEnBD: $("#area_id option:first").val() )
                        .find("option[value=" + areaEnBD +"]").attr('selected', true)
                        .trigger('change');
                },
                error : function(){
                    alert('Hubo un error obteniendo las areas!');
                }
            });
        }
    });

    areaSelect.change(function(){
        var areaId = $(this).val();
        equipoSelect.empty();
        var equipoEnBD = null;
        @isset($publisher)
            equipoEnBD = '{{ $publisher->equipo_id }}';
        @endisset

        if (areaId) {
            $.ajax({
                url: "{{ route('getequipos') }}",
                type: 'GET',
                data: { area_id: areaId },
                dataType: 'json',
                success: function (response) {
                    $.each(response.data, function (key, value) {
                        equipoSelect.append("<option value='" + value.id + "'>" + value.name + "</option>");
                    });
                    equipoSelect.val( equipoEnBD? equipoEnBD: $("#equipo_id option:first").val() )
                        .find("option[value=" + equipoEnBD +"]").attr('selected', true)
                        .trigger('change');
                },
                error : function(){
                    alert('Hubo un error obteniendo los equipos!');
                }
            });
        }
    });



