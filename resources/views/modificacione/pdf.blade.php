<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- CSS only 
     <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}" type="text/css"> 

    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  -->
<!--


 Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

<!-- Area para colocar la descripcion de la orden de compra -->
<section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Modificacion Presupuestaria</span>
                        </div>
                       
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Numero:</strong>
                            {{ $modificacione->numero }}
                        </div>
                        <div class="form-group">
                            <strong>Tipomodificacion Id:</strong>
                            {{ $modificacione->tipomodificacion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $modificacione->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $modificacione->status }}
                        </div>
                        <div class="form-group">
                            <strong>Fechaanulacion:</strong>
                            {{ $modificacione->fechaanulacion }}
                        </div>
                        <div class="form-group">
                            <strong>Montocredita:</strong>
                            {{ $modificacione->montocredita }}
                        </div>
                        <div class="form-group">
                            <strong>Montodebita:</strong>
                            {{ $modificacione->montodebita }}
                        </div>
                        <div class="form-group">
                            <strong>Ncredito:</strong>
                            {{ $modificacione->ncredito }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Area para colocar los detalles del analisis de cotizacion-->
    <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                      
										<th>Modificacion Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Ejecucion Id</th>
										<th>Montoacredita</th>
										<th>Montodebita</th>

                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesmodificaciones as $detallesmodificacione)
                                        <tr>
                                           
                                            
											<td>{{ $detallesmodificacione->modificacion_id }}</td>
											<td>{{ $detallesmodificacione->unidadadministrativa_id }}</td>
											<td>{{ $detallesmodificacione->ejecucion_id }}</td>
											<td>{{ $detallesmodificacione->montoacredita }}</td>
											<td>{{ $detallesmodificacione->montodebita }}</td>

                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>



    
                                    
</body>
</html>