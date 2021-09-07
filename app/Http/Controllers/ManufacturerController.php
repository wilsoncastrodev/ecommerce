<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manufacturers = Manufacturer::all()->toArray();
        return view('admin.manufacturers.index', compact('manufacturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manufacturers.create');
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
            'manufacturer_title' => 'required|unique:manufacturers|max:255',
            'manufacturer_top' => 'required',
            'manufacturer_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $image = $request->file('manufacturer_image');
        $file_name = Str::slug($request->manufacturer_title) . '_' . time() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('public/imagens/fabricantes', $file_name);

        $manufacturer = new Manufacturer;
        $manufacturer->manufacturer_title = $request->manufacturer_title;
        $manufacturer->manufacturer_top = $request->manufacturer_top;
        $manufacturer->manufacturer_image = $path;
        $manufacturer->save();
        
        return redirect()->back()->with('success', 'Fabricante cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function show(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturer $manufacturer)
    {
        //
    }
}
