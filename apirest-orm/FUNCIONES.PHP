<?php

//TRAE TODOS LOS DATOS
$array_cds = App\Models\cd::all();

//TRAE EL PRIMERO Y ULTIMO DE LA TABLA
$cd = new \App\Models\cd();
$primero = $cd->all()->first();
$primero = $cd->all()->last(); 

//TRAE EL ELEMENTO CON EL ID
$cd = new \App\Models\cd();
  //obtiene un unico objeto
$un_cd = $cd->find('$id');


//OBTIENE DATOS ESPECIFICADOS
$array_cds = $cd->where('jahr', $anio)->get();

$array_cds = $cd->where('titel', "like", $titulo)->get();

//tambien se puede llamar a metodos con el nombre de la columna
$array_cds = $cd->whereinterpret($inter)->get();
$array_cds = $cd->whereid($obj->id)->get();

//indica si existe la key en un objeto json
property_exists($json, "id");

//AGREGAR
$cd = new cdORM();

$cd->titel = "Álbum nuevo";
$cd->interpret = "uno nuevo";
$cd->jahr = 2021;

$cd->save();

//modificar

$un_cd = $cd->find($id);

$un_cd->titel = "Álbum modificado";
$un_cd->interpret = "uno modificado";
$un_cd->jahr = 2022;

$un_cd->save();
//eliminar
$cd->find($id)->delete();

//fisrtorfuntion
//obtiene el primer registro encontrado o ejercuta la funcion
$un_cd = cdORM::where('titel', $obj->titel)->firstOr(function(){

$rta = new stdClass();
$rta->exito = false;
$rta->mensaje = "No hay registros que coincidan con el parámetro envidado.";

echo json_encode($rta);

});
//EJERCUTA O LANZA EXCEPCION
//lanza una excepcion si no encuentra el registro con id
$un_cd = $cd->findOrFail($obj->id);

$cantidad_cds = cdORM::all()->count();
$anio_mayor = cdORM::all()->max("jahr");
$anio_menor = cdORM::all()->min("jahr");
$suma_anios = cdORM::all()->sum("jahr");
$promedio_anios = cdORM::all()->avg("jahr");

//lo mismo pero con Capsule (Traer)
$cds = Capsule::table('cds')->where('jahr', '>', 1990)->get();
 

$cds = Capsule::table('cds')->where('jahr', '>', 1990)
                          ->whereIn('id', [1,2,3,4,5])
                          ->where('titel', 'like', 'G%')
                          ->orWhere('interpret', 'Ryuichi Sakamoto')
                          ->orWhere(function($query) {
                            $query->whereDate('created_at', '>', '2021-03-01')
                                  ->whereNull('updated_at');
                          })
                          ->orderBy('titel')
                          ->limit(3)
                          ->get();

     //select                     
    $rs = Capsule::select('select * from cds where id >= ?', [1]);
    //insert
    $id_agregado = Capsule::table('cds')->insertGetId([
      'titel' => 'agregado desde query',
      'jahr' => 2021,
      'interpret' => 'interprete desde query'
    ]);
  
    //update
    $cantidad_filas_afectadas = Capsule::table('cds')->where('id', 8)
                                                         ->update(['titel' => 'modificado desde query',
                                                                   'jahr' => 2020,
                                                                   'interpret' => 'interprete modificado']);
//delete                                                                   
  $cantidad_filas_afectadas = Capsule::table('cds')->where('id', 8)->delete();