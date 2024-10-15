<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            EnderecoSeeder::class,
            AdministradorSeeder::class,
            VendedorSeeder::class,
            ClienteSeeder::class,
            TransportadoraSeeder::class,
            GeneroSeeder::class,
            DimensaoSeeder::class,
            LivroSeeder::class,
            ComentarioSeeder::class,
            VisitadoSeeder::class,
            FavoritoSeeder::class,
            CartaoSeeder::class,
            CarrinhoSeeder::class,
            PedidoSeeder::class,
            FeedbackSeeder::class
        ]);

    }
}
