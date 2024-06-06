<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use \App\Models\Siswa as Model;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    private $viewIndex = 'siswa_index';
    private $viewCreate = 'user_form';
    private $viewEdit = 'user_form';
    private $viewShow = 'user_show';
    private $routePrefix = 'siswa';


    public function index(Request $request)
    {
        if ($request->filled('input_search')) {
            $models = Model::search($request->input_search)->paginate(50);
        }else {
            $models = Model::latest()->paginate(50);
        }


        return view('operator.' .$this->viewIndex, [
            'models' => $models,
            'routePrefix' => $this->routePrefix,
            'title' => 'DATA SISWA'
        ]);
    }


    public function create()
    {
        $data = [
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'FORM DATA SISWA',
            'wali' => User::where('akses', 'wali')->pluck('name', 'id')
        ];
        return view('operator.siswa_form', $data);
    }

    public function store(StoreSiswaRequest $request)
    {
        //
    }

    public function show(Siswa $siswa)
    {
        //
    }


    public function edit(Siswa $siswa)
    {
        //
    }


    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        //
    }


    public function destroy(Siswa $siswa)
    {
        //
    }
}
