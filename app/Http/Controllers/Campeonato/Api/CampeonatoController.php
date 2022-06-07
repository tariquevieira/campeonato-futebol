<?php

namespace App\Http\Controllers\Campeonato\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAndUpdateCampeonatoRequest;
use App\Repositories\Campeonato\CampeonatoRepository;
use Illuminate\Http\Request;

class CampeonatoController extends Controller
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
            $campeonato = $this->repository->criarCampeonato($request->nome);
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
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}