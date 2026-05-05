<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Footer;

class FooterController extends Controller
{
    // 1. Esta función ABRE la página exclusiva del Footer
    public function index()
    {
        $footer = Footer::first();
        return view('footer', compact('footer'));
    }

    // 2. Esta función GUARDA los cambios (la que ya teníamos)
    public function update(Request $request)
    {
        $footer = Footer::first();
        if (!$footer) {
            $footer = new Footer();
        }
        $footer->fill($request->all());
        $footer->save();

        return back()->with('success', '¡El pie de página se actualizó correctamente!');
    }
}