<?php

namespace App\Http\Controllers\Time\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAndUpdateTimeRequest;
use App\Services\Time\TimeService;


class TimeApiController extends Controller
{
    public function __construct(private TimeService $service)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $campeonatos = $this->service->listaTimes();
            return response()->json($campeonatos, 200);
        } catch (\Exception $e) {
            $mensagemException = $e->getMessage();
            $mensagem = ["mensagem" => $mensagemException];
            return response()->json($mensagem, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAndUpdateTimeRequest $request)
    {
        try {
            $campeonato = $this->service->criaTime($request->nome);
            return response()->json($campeonato, 201);
        } catch (\Exception $e) {
            $mensagemException = $e->getMessage();
            $mensagem = ["mensagem" => $mensagemException];
            return response()->json($mensagem, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Int $id)
    {
        try {
            $campeonato = $this->service->buscaTimePorId($id);
            return response()->json($campeonato, 200);
        } catch (\Exception $e) {
            $mensagemException = $e->getMessage();
            $mensagem = ["mensagem" => $mensagemException];
            return response()->json($mensagem, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAndUpdateTimeRequest $request, Int $id)
    {
        try {
            $registroAtualziado = $this->service->atualizaTime($request->nome, $id);
            if ($registroAtualziado) {
                return response()->json("", 204);
            }

            throw new \Exception("Não foi possivel atualizar o registro");
        } catch (\Exception $e) {
            $mensagemException = $e->getMessage();
            $mensagem = ["mensagem" => $mensagemException];
            return response()->json($mensagem, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        try {
            $registroDeletado = $this->service->deletaTime($id);
            if ($registroDeletado) {
                return response()->json("", 204);
            }

            throw new \Exception("Não foi possivel atualizar o registro");
        } catch (\Exception $e) {
            $mensagemException = $e->getMessage();
            $mensagem = ["mensagem" => $mensagemException];
            return response()->json($mensagem, 500);
        }
    }
}