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

        foreach ($saidas as $saida)
        {
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
