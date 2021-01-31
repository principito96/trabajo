<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AlumnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = Alumnos::orderBy('id')->paginate(5);

        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required'],
            'apellidos' => ['required'],
            'email' => ['required', 'unique:alumnos,email'],
            'telefono' => ['nullable'],
        ]);
        $alumno = new Alumnos();
        $alumno->nombre = ucwords($request->nombre);
        $alumno->apellidos = ucwords($request->apellidos);
        $alumno->email = $request->email;
        $alumno->telefono = $request->telefono;
        if (is_uploaded_file($request->foto)) {
            $nombreF = 'img/nombreF' . uniqid() . "_" . $request->foto->getClientOriginalName();
            Storage::disk('public')->put($nombreF, File::get($request->foto));
            $alumno->foto = 'storage/' . $nombreF;
        }
        $alumno->save();

        return redirect()->route('alumnos.index')->with('mensaje', '!!!Alumno Guardado¡¡¡');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumnos  $alumnos
     * @return \Illuminate\Http\Response
     */
    public function show(Alumnos $alumno)
    {
        return view('alumnos.detalle', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumnos  $alumnos
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumnos $alumno)
    {
        return view('alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumnos  $alumnos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumnos $alumno)
    {
        $request->validate([
            'nombre' => ['required'],
            'apellidos' => ['required'],
            'email' => ['required', 'unique:alumnos,email,'.$alumno->id],
            'telefono' => ['nullable'],
        ]);
        //No modifica la foto
        if ($request->has('foto')) {
            $request->validate([
                'foto' => ['image'],
            ]);
            $file = $request->file('foto');
            $nombre = 'img/nombreF'.time().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put($nombre, File::get($file));
            if (basename($alumno->foto) != 'default.png') {
                unlink($alumno->foto);
            }
            $alumno->update($request->all());
            $alumno->update(['foto' => "storage/$nombre"]);
        } else {
            $alumno->update($request->all());
        }

        return redirect()->route('alumnos.index')->with('mensaje', 'Alumno Modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumnos $alumno)
    {
        $foto = basename($alumno->foto);
        if ($foto != 'default.png') {
            unlink($alumno->foto);
        }
        $alumno->delete();
        return redirect()->route('alumnos.index')->with("mensaje", "Alumno borrado");
    }
}
