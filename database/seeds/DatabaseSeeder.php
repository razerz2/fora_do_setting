<?php

use App\Genero;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GeneroTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(PermissaoTableSeeder::class);
        $this->call(PaisesTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(CidadesTableSeeder::class);
        $this->call(MotivoInativacaoTableSeeder::class);
        $this->call(AgendamentoPeriodoTableSeeder::class);
        $this->call(AgendamentoTipoTableSeeder::class);
    }
}
