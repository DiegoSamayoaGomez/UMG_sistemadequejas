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
    public function __invoke()
    {
        $datos=DB::select("select * from quejas");
        return view('dashboard')->with("datos",$datos);
    }
    public function create(Request $request)
    {
        try{
            $sql = DB::insert("insert into producto (idqueja, email, direccion, categoriaqueja, descripcion, fecha, estado) values(null,?,?,?,?,?,?)", [
                $request->txtemail,
                $request->txtdireccion,
                $request->txtcategoriaqueja,
                $request->txtdescripcion,
                $request->txtfecha,
                $request->txtestado
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if($sql==true){
            return back()->with("correcto", "Queja registrada correctamente");
        } else {
            return back()->with("incorrecto", "Error al registrar");
        }
    }

    public function update(Request $request)
    {
        try{
            $sql = DB::insert("update queja set email=?, direccion=?, categoriaqueja=?, descripcion=? fecha=?, estado=? where idqueja=?", [
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
}
