<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function usuarios()
    {

        $usuarios = User::all();

        foreach ($usuarios as $usuario) {
            $usuario->ultimo_acesso = isset($usuario->ultimo_acesso) ? date('d/m/Y H:i', strtotime($usuario->ultimo_acesso)) : '-';
        }

        return view('users.menu', ['usuarios' => $usuarios]);
    }

    public function cadastrar()
    {
        return view('users.cadastrar');
    }

    public function enviaCadastro(Request $request)
    {

        $request->validate(
            [
                'nome' => 'required|max:100',
                'email' => 'required',
                'departamento' => 'required',
                'perfil' => 'required'
            ],
            [
                'nome.required' => 'Informe o nome do usuário.',
                'nome.max' => 'Informe no máximo 100 caracteres.',
                'email.required' => 'Informe o email do usuário.',
                'departamento.required' => 'Informe o departamento que o usuário pertence.',
                'perfil.required' => 'Informe o perfil do usuário no sistema.'

            ]
        );

        $nome = $request->input('nome');
        $email = $request->input('email');
        $departamento = $request->input('departamento');
        $perfil = $request->input('perfil');

        $usuario = new User();
        $usuario->id = Str::uuid();
        $usuario->nome = $nome;
        $usuario->email = $email;
        $usuario->departamento = $departamento;
        $usuario->perfil = $perfil;
        $usuario->senha = bcrypt('1234');
        $usuario->save();

        return redirect()->route('usuarios')->with('alerta', 'Usuário cadastrado.');
    }

    public function editar($id)
    {
        $usuario = User::find($id);

        return view('users.editar', ['usuario' => $usuario]);
    }

    public function enviaEdicao(Request $request, $id)
    {
        $request->validate(
            [
                'nome' => 'required|max:100',
                'email' => 'required',
                'departamento' => 'required',
                'perfil' => 'required'
            ],
            [
                'nome.required' => 'Informe o nome do usuário.',
                'nome.max' => 'Informe no máximo 100 caracteres.',
                'email.required' => 'Informe o email do usuário.',
                'departamento.required' => 'Informe o departamento que o usuário pertence.',
                'perfil.required' => 'Informe o perfil do usuário no sistema.'

            ]
        );

        $nome = $request->input('nome');
        $email = $request->input('email');
        $departamento = $request->input('departamento');
        $perfil = $request->input('perfil');

        $usuario = User::find($id);
        $usuario->nome = $nome;
        $usuario->email = $email;
        $usuario->departamento = $departamento;
        $usuario->perfil = $perfil;
        $usuario->save();

        return redirect()->route('usuarios')->with('alerta', 'Usuário editado.');
    }

    public function ativar($id)
    {

        $usuario = User::find($id);

        $usuario->status = 'Ativo';
        $usuario->save();

        return redirect()->route('usuarios');
    }

    public function desativar($id)
    {

        $usuario = User::find($id);

        $usuario->status = 'Inativo';
        $usuario->save();

        return redirect()->route('usuarios');
    }
}
