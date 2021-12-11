<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Vault;
use App\Models\VaultData;
use App\Traits\EncryptionTrait;
use Symfony\Component\HttpFoundation\JsonResponse;

class VaultController extends Controller
{
    use EncryptionTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Vault::class, 'vault');
    }

    /**
     * Return all vaults of the authenticated user.
     * 
     * @return  Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request): Collection
    {
        return Vault::where('user_id', Auth::user()->id)->get();
    }
 
    /**
     * Retrieve vault details by VaultData UUID.
     * 
     * @param App\Models\Vault $vault
     */
    public function show(Vault $vault)
    {
        $vault_data = $vault->data()->get()->first();
        
        return [
            'info' => $vault,
            'data' => $this->decrypt($vault_data->data),
        ];
    }

    /**
     * Store a new vault.
     * 
     * @param Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $params['user_id'] = Auth::user()->id;

        $vault = Vault::create($params);
        VaultData::create([
            'data' => $this->encrypt($request->get('data')),
            'vault_id' => $vault->id,
        ]);

        return $vault;
    }

    /**
     * Update vault storage.
     * 
     * @param Illuminate\Http\Request $request
     * @param App\Models\Vault $vault
     */
    public function update(Request $request, Vault $vault): array
    {
        $vault->update($request->all());
        $vault_data = $vault->data()
            ->get()
            ->first()
            ->setData($this->encrypt($request->get('data'))
        );
        $vault_data->save();

        return [
            'info' => $vault,
            'data' => $this->decrypt($vault_data->data),
        ];
    }

    /**
     * Remove a vault.
     * 
     * @param App\Models\Vault $vault
     */
    public function delete(Vault $vault)
    {
        $vault->delete();
        return new JsonResponse(null, 204);
    }

}
