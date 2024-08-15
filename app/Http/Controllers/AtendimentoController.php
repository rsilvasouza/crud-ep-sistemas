<?php

namespace App\Http\Controllers;

use App\Enums\ComoNosConheceu;
use App\Http\Requests\AtendimentoFormRequest;
use App\Models\Atendimento;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    public function index()
    {
        $comoNosConheceu = ComoNosConheceu::getComoNosConheceu();
        return view('atendimento.index')->with('comoNosConheceu', $comoNosConheceu);
    }

    public function list()
    {
        $atendimentos = Atendimento::all();
        return response()->json(['msg_type' => 'success', 'atendimentos' => $atendimentos], 200);
    }

    public function store(AtendimentoFormRequest $request, Atendimento $atendimento)
    {

        $data = $atendimento->create($request->all());
        if (!$data->save()) {
            return response()->json(['msg' => 'Ocorreu um erro ao processar sua solicitação.', 'msg_type' => 'error'], 500);
        }
        return response()->json(['msg' => 'Dados criado com sucesso!', 'msg_type' => 'success'], 201);
    }

    public function show(Atendimento $atendimento)
    {

        return response()->json(['atendimento' => $atendimento, 'msg_type' => 'success']);
    }

    public function update(AtendimentoFormRequest $request, Atendimento $atendimento)
    {

        $data = $atendimento->fill($request->all());
        if (!$data->save()) {
            return response()->json(['msg' => 'Ocorreu um erro ao processar sua solicitação.', 'msg_type' => 'error'], 500);
        }
        return response()->json(['msg' => 'Dados atualizado com sucesso!', 'msg_type' => 'success'], 200);
    }

    public function card()
    {
        $atendimentosDiarios = Atendimento::whereDate('created_at', Carbon::today())->get();
        $atendimentosSemanais = Atendimento::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $atendimentosMensais = Atendimento::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->get();

        return response()->json(['msg_type' => 'success', 'diario' => $atendimentosDiarios->count(), 'semanal' => $atendimentosSemanais->count(), 'mensal' => $atendimentosMensais->count()]);
    }

    public function destroy($id)
    {
        $atendimento = Atendimento::find($id);
        if (!$atendimento->delete()) {
            return response()->json(['msg' => 'Ocorreu um erro ao processar sua solicitação.', 'msg_type' => 'error'], 500);
        }
        return response()->json(['msg' => 'Dados deletado com sucesso!', 'msg_type' => 'success'], 200);
    }
}
