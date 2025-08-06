<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'senha' =>  'required'
            ],
            [
                'email.required' => 'Informe um email.',
                'email.email' => 'Informe um email válido.',
                'senha.required' => 'Informe uma senha.'
            ]
        );

        $email = $request->input('email');
        $senha = $request->input('senha');

        $usuario = User::where('email', $email)
            ->where('status', 'Ativo')
            ->first();

        if (!$usuario) {
            return redirect()->back()->withInput()->with('loginErro', 'Email ou senha incorretos.');
        }

        if (!password_verify($senha, $usuario->senha)) {
            return redirect()->back()->withInput()->with('loginErro', 'Email ou senha incorretos.');
        }

        if ($senha == '1234') {
            return redirect()->route('esqueci')->with('alerta', 'Atualize a sua senha.');
        }

        $usuario->ultimo_acesso = Carbon::now();
        $usuario->save();

        session([
            'usuario' => [
                'id' => $usuario->id,
                'nome' => $usuario->nome,
                'acesso' => $usuario->perfil
            ]
        ]);

        if (session('usuario.acesso') == "Administrador") {
            return redirect()->route('menu');
        } else {
            return redirect()->route('requisicoes');
        }
    }

    public function esqueci()
    {
        return view('auth.esqueci');
    }

    public function esqueciSubmit(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'senha' => 'required',
                'confirma' => 'required'
            ],
            [
                'email.required' => 'Informe um email.',
                'email.email' => 'Informe um email válido.',
                'senha.required' => 'Informe a nova senha.',
                'confirma.required' => 'Confirme a nova senha.'
            ]
        );

        $email = $request->input('email');
        $senha = $request->input('senha');
        $confirma = $request->input('confirma');

        $usuario = User::where('email', $email)
            ->where('status', 'Ativo')
            ->first();

        if (!$usuario) {
            return redirect()->back()->withInput()->with('loginErro', 'Usuário não encontrado.');
        }

        if ($senha != $confirma) {
            return redirect()->back()->withInput()->with('loginErro', 'As senhas não são iguais.');
        }

        if ($senha == '1234') {
            return redirect()->back()->withInput()->with('alerta', 'Não é possível cadastrar essa senha.');
        }

        $usuario->senha = bcrypt($senha);
        $usuario->save();

        return redirect()->route('login')->with('alerta', 'Senha atualizada.');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
