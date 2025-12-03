<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('users.index');
    }

    public function listUsers(): \Illuminate\Http\JsonResponse
    {
        $users = User::with('profile')->get();

        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): \Illuminate\Http\JsonResponse
    {
        $normalize = fn($v) => str_replace(['.', '-', ',', ' ', '/'], '', $v);

        if (User::where('email', $request->email)->exists()) {
            return response()->json(['status' => 'error', 'message' => 'Usuário já existe!'], 200);
        }

        DB::beginTransaction();

        try {
            // Criação de usuário
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Crio perfil atrelado ao ultimo usuário inserido
            Profile::create([
                'user_id' => $user->id,
                'marital_status' => $request->marital_status,
                'zipcode' => $normalize($request->zipcode),
                'cpf' => $normalize($request->cpf),
                'rg' => $normalize($request->rg),
                'date_birth' => $request->input('date_birth'),
                'address' => $request->address,
                'number' => $request->number,
                'neighborhood' => $request->neighborhood,
                'city' => $request->city,
                'state' => $request->state,
                'uf' => $request->uf,
                'phone_number' => $normalize($request->phone_number),
            ]);

            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Usuário criado com sucesso!'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao criar usuário',
                'debug' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('profile')->find($id);

        return view('users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $normalize = fn($v) => str_replace(['.', '-', ',', ' ', '/'], '', $v);

        $user = User::findOrFail($id);
        $profile = Profile::where('user_id', $id)->firstOrFail();

        if (!$user || !$profile) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuário não encontrado.'
            ], 404);
        }

        DB::beginTransaction();

        try {

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $profile->update([
                'marital_status' => $request->marital_status,
                'zipcode' => $normalize($request->zipcode),
                'cpf' => $normalize($request->cpf),
                'rg' => $normalize($request->rg),
                'date_birth' => $request->input('date_birth'),
                'address' => $request->address,
                'number' => $request->number,
                'neighborhood' => $request->neighborhood,
                'city' => $request->city,
                'state' => $request->state,
                'uf' => $request->uf,
                'phone_number' => $normalize($request->phone_number),
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Usuário atualizado com sucesso!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao atualizar usuário',
                'debug' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $user = User::find($request->id);

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Usuário não encontrado.'
                ], 404);
            }

            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Usuário deletado com sucesso!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao deletar usuário.',
                'debug' => $e->getMessage()
            ], 500);
        }
    }
}
