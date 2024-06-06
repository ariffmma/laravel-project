<?php

namespace App\Http\Controllers;

use app\Models\User;
use \App\Models\User as Model;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $viewIndex = 'user_index';
    private $viewCreate = 'user_form';
    private $viewEdit = 'user_form';
    private $viewShow = 'user_show';
    private $routePrefix = 'user';


    public function index()
    {
        return view('operator.' .$this->viewIndex, [
            'models' => Model::where('akses', '<>', 'wali')
            ->latest()
            ->paginate(50),
            'routePrefix' => $this->routePrefix,
            'title' => 'DATA USER'
        ]);
        // $models = Model::where('akses', '<>', 'wali')->latest()->paginate(50);
        // $data['models'] = $models;
        // $datauser['title'] = 'Data User';
        // return view('operator.user_index', $data, $datauser);
    }
    public function create()
    {
        $data = [
            'model' => new \App\Models\User(),
            'method' => 'POST',
            'route' => 'user.store',
            'button' => 'SIMPAN',
            'title' => 'FORM DATA USER'
        ];
        return view('operator.user_form', $data);
    }
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'nohp' => 'required|unique:users',
            'akses' => 'required|in:operator,admin,wali',
            'password' => 'required'
        ]);
        $requestData['password'] = bcrypt($requestData['password']);
        $requestData['email_verified_at'] = now();
        Model::create($requestData);
        flash('Data berhasil disimpan');
        return back();
    }
    public function edit($id)
    {
        $data = [
            'model' => \App\Models\User::findOrFail($id),
            'method' => 'PUT',
            'route' => ['user.update', $id],
            'button' => 'UPDATE',
            'title' => 'FORM EDIT DATA USER'
        ];
        return view('operator.user_form', $data);
    }
    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' .$id,
            'nohp' => 'required|unique:users,nohp,' .$id,
            'akses' => 'required|in:operator,admin,wali',
            'password' => 'nullable'
        ]);
        $model = Model::findOrFail($id);
        if ($requestData['password'] == ""){
            unset($requestData['password']);
        }else{
            $requestData['password'] = bcrypt($requestData['password']);
        }
        $model->fill($requestData);
        $model->save();
        if ($model->email == "operator1@contoh.com") {
            flash('Data tidak bisa diupdate')->error();
            return back();
        }
        flash('Data berhasil diupdate');
        return redirect()->route('user.index');
    }
    public function destroy($id)
    {
        $model = Model::findOrFail($id);
        if ($model->email == "operator1@contoh.com") {
            flash('Data tidak bisa dihapus')->error();
            return back();
        }
        $model->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}
