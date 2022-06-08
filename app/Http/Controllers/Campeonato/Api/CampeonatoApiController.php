<?php

namespace App\Http\Controllers\Campeonato\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAndUpdateCampeonatoRequest;
use App\Repositories\Campeonato\CampeonatoRepository;
use Illuminate\Http\Request;

class CampeonatoApiController extends Controller
{
    public function __construct(private CampeonatoRepository $repository)
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
            $campeonatos = $this->repository->listaCampeonatos();
            return response()->json($campeonatos, 200);
        } catch (\Exception $e) {
            $mensagem = ["mensagem" => "Não foi possivel recuperar os campenatos"];
            return response()->json($mensagem, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreAndUpdateCampeonatoRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAndUpdateCampeonatoRequest $request)
    {
        try {
            $campeonato = $this->repository->criaCampeonato($request->nome);
            return response()->json($campeonato, 201);
        } catch (\Exception $e) {
            $mensagem = ["mensagem" => "Não foi possivel recuperar os campenatos"];
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
            $campeonato = $this->repository->buscaCampeonatoPorId($id);
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
    public function update(StoreAndUpdateCampeonatoRequest $request, Int $id)
    {
        try {
            $registroAtualziado = $this->repository->atualizaCampeonato($request->nome, $id);
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
            $registroDeletado = $this->repository->deletaCampeonato($id);
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