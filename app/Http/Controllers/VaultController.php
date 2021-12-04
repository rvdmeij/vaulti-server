<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vault;

class VaultController extends Controller
{
    public function index(Request $request)
    {
        return Vault::where('user_id', Auth::user()->getId())
        ->get();
    }
 
    public function show($id)
    {
        return Vault::find($id);
    }

    public function store(Request $request)
    {
        return Vault::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $vault = Vault::findOrFail($id);
        $vault->update($request->all());

        return $vault;
    }

    public function delete(Request $request, $id)
    {
        $vault = Vault::findOrFail($id);
        $vault->delete();

        return 204;
    }
}
