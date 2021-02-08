<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class EnderecoController extends Controller
{
    // LISTAR
    public function index() {

        return Endereco::all();

    }

    // CONSULTAR
    public function show($endereco)
    {
       
        $dados_endereco = Endereco::find($endereco);
        return response()->json([
            'data' => $dados_endereco
        ],200);
    }

    // INSERIR
    public function store(Request $request) {

        $endereco = Endereco::create([
            "logradouro"=>$request->input("logradouro"),
            "numero"=>$request->input("numero"),
            "complemento"=>$request->input("complemento"),
            "bairro"=>$request->input("bairro"),
            "cidade"=>$request->input("cidade"),
            "uf"=>$request->input("uf"),
            "cep"=>$request->input("cep")
        ]);

        return $endereco;

    }

    // ATUALIZAR
    public function update(Request $request, Endereco $endereco) {

        $endereco->logradouro = $request->input('logradouro');
        $endereco->numero = $request->input('numero');
        $endereco->complemento = $request->input('complemento');
        $endereco->bairro = $request->input('bairro');
        $endereco->cidade = $request->input('cidade');
        $endereco->uf = $request->input('uf');
        $endereco->cep = $request->input('cep');

        $endereco->save();

        return $endereco;

    }

    // EXCLUIR
    public function remove(Endereco $endereco) {

        $endereco->delete();

        return response()->json([
            'message'=>'Endereco excluido com sucesso'
        ]);

    }

    // CONSULTAR CEP
    public function showcep($endereco)
    {
        
 
        $dados_endereco = Endereco::where('cep', '=', $endereco)->first();
        if ($dados_endereco) { 

            // 1. BUSCA NA BASE LOCAL
            return response()->json([
                'message' => $dados_endereco
            ],200);
         } else {

            // 2. NAO ENCONTRADO NA BASE LOCAL, PORTANTO BUSCA EM API EXTERNA

            $client = new Client(); //GuzzleHttp\Client
            $url = "https://viacep.com.br/ws/".$endereco."/json/";

            header('Content-type: text/html; charset=utf-8'); 

            $response = $client->request('GET', $url, [
                'verify'  => false,
            ]);

            return $response->getBody();

         }

    }    


    public function showfuzzylogradouro($endereco)
    {

        // BUSCA USANDO MODULO PG_TRGM DO POSTGRES PARA FUZZY SEARCH
        $dados_endereco = Endereco::whereRaw("? % logradouro", [$endereco])->first();
        if ($dados_endereco) { 
            return response()->json([
                'message' => $dados_endereco
            ],200);
         } 
 
    }


}