<?php

namespace App\Http\Controllers;

use App\Models\Output;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class OutputController extends Controller
{
    public function saidas()
    {
        $saidas = Output::with(['requisicoes', 'produtos', 'usuarios'])->get();

        foreach ($saidas as $saida) {
            $saida->data = date('d/m/Y H:i', strtotime($saida->data));
            $saida->produto = $saida->produtos->nome;
            $saida->autorizado_por = $saida->usuarios->nome;

            $requisicao = ModelsRequest::where('id', $saida->id_requisicao)->with('usuarios')->first();

            $saida->requisitante = $requisicao->usuarios->nome;
            $saida->departamento = $requisicao->usuarios->departamento;
        }

        return view('outputs.menu', ['saidas' => $saidas]);
    }

    public function filtrarSaidas(Request $request)
    {
        $de = date('Y-m-d 00:00:00', strtotime($request->input('de')));
        $inputAte = $request->input('ate');
        $ate = $inputAte ? date('Y-m-d 23:59:59', strtotime($inputAte)) : date('Y-m-d 23:59:59');

        $saidas = Output::whereBetween('data', [$de, $ate])->with(['requisicoes', 'produtos', 'usuarios'])->get();

        foreach ($saidas as $saida) {
            $saida->data = date('d/m/Y H:i', strtotime($saida->data));
            $saida->produto = $saida->produtos->nome;
            $saida->autorizado_por = $saida->usuarios->nome;

            $requisicao = ModelsRequest::where('id', $saida->id_requisicao)->with('usuarios')->first();

            $saida->requisitante = $requisicao->usuarios->nome;
            $saida->departamento = $requisicao->usuarios->departamento;
        }

        return view('outputs.menu', ['saidas' => $saidas]);
    }
}
