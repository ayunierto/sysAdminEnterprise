<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Auth::user()->companies_id;
        return Inertia::render('Settings/Index', [
            'colors' => Customizer::where('companies_id', $company)->get(),
            'customizers' => Customizer::where('companies_id', $company)->get(),
            'companies' => Company::where('id', $company)->get(),
            'company' => Company::find(Auth::user()->companies_id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Revisar para correcto funcionamiento
        $company = Company::find($id);
        $company->update($request->all());
        
        $customizer = Customizer::find($request->customizers_id);
        if ($request->hasFile("logo")) {
            $cod = $request->companies_id;
            $nombre = 'logo_empresa' . $cod . '.' . $request->logo->getClientOriginalExtension();
            $destino = 'img/empresa' . $cod . '/';
            $directorio = $destino . $nombre;
            if (file_exists($destino)) {
                $files = glob($destino . '/*'); //obtenemos todos los nombres de los ficheros
                foreach ($files as $file) {
                    if (is_file($file))
                        unlink($file); //elimino el fichero
                }
            }
            $uploadSuccess = $request->logo->move($destino, $nombre);
            $customizer->update([
                'color_menu' => $request->color_menu,
                'color_sub_menu' => $request->color_sub_menu,
                'color_header' => $request->color_header,
                'color_footer' => $request->color_footer,
                'color_text' => $request->color_text,
                'logo' => '../../' . $directorio,
            ]);
        } else {
            $customizer->update([
                'color_menu' => $request->color_menu,
                'color_sub_menu' => $request->color_sub_menu,
                'color_header' => $request->color_header,
                'color_footer' => $request->color_footer,
                'color_text' => $request->color_text,
            ]);
        }
        return Redirect::route('settings.index');
    }
}
