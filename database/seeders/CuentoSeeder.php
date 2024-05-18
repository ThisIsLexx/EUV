<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Cuento;

class CuentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cuento::create(
            [
                'titulo' => 'El patito feo',
                'contenido' => 'Había una vez un patito feo que era rechazado por todos los animales de la granja. Un día, harto de ser maltratado, decidió huir y buscar un lugar donde lo aceptaran tal y como era. Después de mucho caminar, encontró un lago en el que se reflejaba su imagen. Al ver que era un hermoso cisne, comprendió que no era un patito feo, sino un cisne que aún no había descubierto su belleza.'
            ]
        );

        Cuento::create(
            [
                'titulo' => 'La liebre y la tortuga',
                'contenido' => 'Había una vez una liebre que se burlaba de una tortuga por ser lenta. Cansada de las burlas, la tortuga retó a la liebre a una carrera. La liebre, confiada en su velocidad, aceptó el reto. La carrera comenzó y la liebre, segura de su victoria, decidió tomarse una siesta. Mientras tanto, la tortuga siguió avanzando lentamente pero sin detenerse. Al despertar, la liebre se dio cuenta de que la tortuga estaba a punto de cruzar la meta. A pesar de correr lo más rápido que pudo, la liebre llegó tarde y la tortuga ganó la carrera.'
            ]
        );
    }
}
