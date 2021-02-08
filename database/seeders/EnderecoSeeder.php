<?php

namespace Database\Seeders;

use App\Models\Endereco;
use Illuminate\Database\Seeder;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Endereco::create(
            [
			"logradouro" => "Rua XV de Novembro",
			"numero" => "123",
	        "complemento" => "SobreLoja",
			"bairro" => "Centro",
			"cidade" => "Curitiba",
			"uf" => "PR",
			"cep" => "80123000"
            ]
        );
    }
}