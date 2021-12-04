<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vault;
use App\Models\VaultData;

class VaultController extends Controller
{
    /**
     * Return all vaults of the authenticated user.
     */
    public function index(Request $request)
    {
        return Vault::where('user_id', Auth::user()->getId())->get();
    }
 
    /**
     * Retrieve vault details by VaultData UUID.
     */
    public function show($uuid)
    {
        $data = VaultData::find($uuid);
        $data_user_id = $data->vault()
            ->first()
            ->user()
            ->first()
            ->getId();

        if ($data_user_id !== Auth::user()->getId()) {
            return response()->json(['error' => 'Not authorized.'],403);
        }

        return $data;
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
