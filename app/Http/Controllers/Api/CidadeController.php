<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cidade;
use Illuminate\Support\Facades\Validator;


class CidadeController extends Controller
{
    public function index()
        {   
            $cidades_br = Cidade::all();
            if($cidades_br->count() > 0){
            return response()->json([
                $cidades_br
            ], 200);
        } else{
            return response()->json([
                'status' => 404,
                'cidades_br' => 'No records found'
            ]);
        }
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomeCidade'=> 'required|max:191',
            'nomeEstado'=> 'required|max:191',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages()
            ], 422);
        }else{
            $cidade = Cidade::create([
                'nomeCidade' => $request->nomeCidade,
                'nomeEstado' => $request->nomeEstado,
            ]);
            if($cidade){
                return response()->json([
                    'message'=> "Cidade inserida com sucesso"
                ],200);    
            } else{
                return response()->json([
                    'message'=> "Algo deu errado!"
                ],200);  
            }
        }

    }

    public function show($nomeEstado)
{
    $cidades = Cidade::where('nomeEstado', $nomeEstado)->get();

    if ($cidades->count() > 0) {
        return response()->json([
            $cidades
        ], 200);
    } else {
        return response()->json([
            "message" => "Cidades não encontradas para o estado fornecido"
        ], 404);
    }
}

    public function edit($id)
    {
        $cidade = Cidade::find($id);
        if($cidade){
            return response()->json([
                $cidade
            ], 200);
        } else {  
            return response()->json([
                "message"=> "Cidade não encontrada"
            ], 400);
        }
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nomeCidade'=> 'required|max:191',
            'nomeEstado'=> 'required|max:191',
        ]);
        if($validator->fails()){
            return response()->json([
                'errors'=> $validator->messages()
            ], 422);
        }else{
            $cidade = Cidade::find($id);
            
            if($cidade){
                $cidade -> update([
                    'nomeCidade' => $request->nomeCidade,
                    'nomeEstado' => $request->nomeEstado,
                ]);
                return response()->json([
                    'message'=> "Cidade atualizada com sucesso"
                ],200);    
            } else{
                return response()->json([
                    'message'=> "Cidade não encontrada!"
                ],404);  
            }
        }
    }

    public function destroy($id){
        $cidade = Cidade::find($id);
        if($cidade){
            $cidade->delete();
            return response()->json([
                "message"=> "Cidade deletada com sucesso!"
            ]);
        }else{
            return response()->json([
                'message'=> "Cidade não encontrada!"
            ],404);  
        }
    }   

}
