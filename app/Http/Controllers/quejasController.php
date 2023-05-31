<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE Illuminate\Support\Facades\DB;

class quejasController extends Controller
{
    public function index(){
        $datos=DB::select("select * from quejas");
        return view('dashboard')->with("datos",$datos);
    }    

    public function create(Request $request)
    {    
        $aux = $request->file('image');
        try{
            if ($aux) {
                $sql = DB::insert(" insert into quejas (email, direccion, categoriaqueja, descripcion, fecha, estado, imagenes) values (?,?,?,?,NOW(),'Pendiente',?)", [
                    $request->txtemail,
                    $request->txtdireccion,
                    $request->txtcategoriaqueja,
                    $request->mensaje,
                    file_get_contents($aux->getRealPath()), // Lee el contenido de la imagen
                ]);
            }
            else{
                $sql = DB::insert(" insert into quejas (email, direccion, categoriaqueja, descripcion, fecha, estado) values (?,?,?,?,NOW(),'Pendiente')", [
                    $request->txtemail,
                    $request->txtdireccion,
                    $request->txtcategoriaqueja,
                    $request->mensaje,
                ]);
            }
            
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if($sql==true){
            error_log('correcto.' );
            return back()->with("correcto", "Queja registrada correctamente");
        } else {
            error_log('incorrecto.' );
            return back()->with("incorrecto", "Error al registrar");
        }
    }



    public function update(Request $request)
    {
        try{
            $sql = DB::insert("update quejas set email=?, direccion=?, categoriaqueja=?, descripcion=? fecha=?, estado=? where idqueja=?", [
                $request->txtemail,
                $request->txtdireccion,
                $request->txtcategoriaqueja,
                $request->txtdescripcion,
                $request->txtfecha,
                $request->txtestado,
                $request->idqueja
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if($sql==true){
            return back()->with("correcto", "Queja actualizada correctamente");
        } else {
            return back()->with("incorrecto", "Error al actualizar");
        }
    }

    public function actualizarEstado($idqueja) {
        DB::table('quejas')->where('idqueja', $idqueja)->update(['estado' => 2]);
        return back()->with("Correcto", "Queja marcada como completada!");
    }

    public function descartarEstado($idqueja) {
        DB::table('quejas')->where('idqueja', $idqueja)->update(['estado' => 3]);
        return back()->with("Correcto", "Queja marcada como descartada!");
    }
}
