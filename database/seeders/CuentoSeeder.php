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
                'contenido' => 'Había una vez un patito feo que era rechazado por todos los animales de la granja. Un día, harto de ser maltratado, decidió huir y buscar un lugar donde lo aceptaran tal y como era. Después de mucho caminar, encontró un lago en el que se reflejaba su imagen. Al ver que era un hermoso cisne, comprendió que no era un patito feo, sino un cisne que aún no había descubierto su belleza.',
                'dificultad' => 'baja',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'La liebre y la tortuga',
                'contenido' => 'Había una vez una liebre que se burlaba de una tortuga por ser lenta. Cansada de las burlas, la tortuga retó a la liebre a una carrera. La liebre, confiada en su velocidad, aceptó el reto. La carrera comenzó y la liebre, segura de su victoria, decidió tomarse una siesta. Mientras tanto, la tortuga siguió avanzando lentamente pero sin detenerse. Al despertar, la liebre se dio cuenta de que la tortuga estaba a punto de cruzar la meta. A pesar de correr lo más rápido que pudo, la liebre llegó tarde y la tortuga ganó la carrera.',
                'dificultad' => 'media',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'The Ant And The Grasshopper',
                'contenido' => 'One bright day in late autumn a family of Ants were bustling about in the warm sunshine, drying out the grain they had stored up during the summer, when a starving Grasshopper, his fiddle under his arm, came up and humbly begged for a bite to eat. "What!" cried the Ants in surprise, "have you not stored anything away for the winter? What in the world were you doing all last summer?" "I did not have time to store up any food," whined the Grasshopper; "I was so busy making music that before I knew it the summer was gone." The Ants shrugged their shoulders in disgust. "Making music, were you?" they cried. "Very well; now dance!" And they turned their backs on the Grasshopper and went on with their work. There is a time for work and a time for play.',
                'dificultad' => 'media',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'Ozymandias',
                'contenido' => 'I met a traveller from an antique land, Who said— “Two vast and trunkless legs of stone stand in the desert. . . . Near them, on the sand, half sunk a shattered visage lies, whose frown, and wrinkled lip, and sneer of cold command tell that its sculptor well those passions read, which yet survive, stamped on these lifeless things, the hand that mocked them, and the heart that fed; and on the pedestal, these words appear: My name is Ozymandias, King of Kings; Look on my Works, ye Mighty, and despair!... Nothing beside remains. Round the decay of that colossal Wreck, boundless and bare. The lone and level sands stretch far away.”',
                'dificultad' => 'alta',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'The King of Kong: A Fistful of Quarters',
                'contenido' => 'I have heard a lot of talk of Billy Mitchell, and I have heard a lot of talk of strange videos and things. But I have not heard much in the way of him getting in front of a camera crew with people and getting a record in front of people. I have not heard about that yet. Maybe he did that 25 years ago. But I have not heard of him doing it lately, and it makes you wonder why not.',
                'dificultad' => 'media',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'The Call of Cthulhu',
                'contenido' => 'The most merciful thing in the world, I think, is the inability of the human mind to correlate all its contents. We live on a placid island of ignorance in the midst of black seas of infinity, and it was not meant that we should voyage far.',
                'dificultad' => 'alta',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'Shawshank Redemption',
                'contenido' => 'Sometimes it makes me sad, though... Andy being gone. I have to remind myself that some birds are not meant to be caged. Their feathers are just too bright. And when they fly away, the part of you that knows it was a sin to lock them up DOES rejoice. But still, the place you live in is that much more drab and empty that they are gone. I guess I just miss my friend.',
                'dificultad' => 'media',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'Hollow Knight',
                'contenido' => 'No cost too great. No mind to think. No will to break. No voice to cry suffering. Born of God and Void. You shall seal the blinding light that plagues their dreams. You are the Vessel. You are the Hollow Knight.',
                'dificultad' => 'media',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'Entrenamiento de la Escuela de la Tortuga',
                'contenido' => 'Hay que trabajar, hay que aprender, hay que comer, hay que descansar y también hay que jugar. Esas son las bases del entrenamiento del maestro Roshi para tener una buena condición',
                'dificultad' => 'baja',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'The Monty Python and the Holy Grail',
                'contenido' => 'Listen. Strange women lying in ponds distributing swords is no basis for a system of government. Supreme executive power derives from a mandate from the masses, not from some farcical aquatic ceremony.',
                'dificultad' => 'baja',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'Dale Carnegie, How to Win Friends and Influence People',
                'contenido' => 'Any fool can criticize, complain, and condemn—and most fools do. But it takes character and self-control to be understanding and forgiving.',
                'dificultad' => 'baja',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'Christopher Nevinson, La Mitrailleuse',
                'contenido' => 'And the gunners? Are they men? No! They have become machines. They are as rigid and as implacable as their terrible gun. The machine has retaliated by making men in its own image... The crew and the gun are one, equipped for one end, only one - destruction.',
                'dificultad' => 'media',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'Gladiator',
                'contenido' => 'My name is Maximus Decimus Meridius, Commander of the Armies of the North, General of the Felix Legions, loyal servant to the true emperor, Marcus Aurelius. Father to a murdered son, husband to a murdered wife. And I will have my vengeance, in this life or the next.',
                'dificultad' => 'media',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'Ezekiel 25:17',
                'contenido' => "The path of the righteous man is beset on all sides by the inequities of the selfish and the tyranny of evil men. Blessed is he who, in the name of charity and good will, shepherds the weak through the valley of darkness, for he is truly his brother's keeper and the finder of lost children. And I will strike down upon thee with great vengeance and furious anger those who attempt to poison and destroy my brothers. And you will know my name is the Lord when I lay my vengeance upon thee.",
                'dificultad' => 'alta',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'Rocky Balboa',
                'contenido' => "You, me, or nobody is gonna hit as hard as life. But it ain't about how hard you hit. It is about how hard you can get hit and keep moving forward. How much you can take and keep moving forward.",
                'dificultad' => 'baja',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'Forrest Gump',
                'contenido' => 'One day it started raining, and it did not quit for four months. We been through every kind of rain there is. Little bitty stinging rain... and big old fat rain. Rain that flew in sideways. And sometimes rain even seemed to come straight up from underneath. Shoot, it even rained at night.',
                'dificultad' => 'media',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'Hawkeye Gough',
                'contenido' => 'The dragons shall never be forgotten… We knights fought valiantly, but for every one of them, we lost three score of our own. Exhiliration, pride, hatred, rage… The dragons teased out our dearest emotions. …Thou will understand, one day. At thy twilight, old thoughts return, in great waves of nostalgia.',
                'dificultad' => 'alta',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'The War to End All Wars',
                'contenido' => 'They push - we push. Every once in awhile, we push hard enough that the light breaks through the clouds, so the world beyond the war glimmers, just out of reach. The war is the world and the world is the war. But behind every gunsight is a human being. We are those people. We are the jaded and we are the naive. We are the honourable and the criminal. We are the bound for legend and the lost to history. We are the knights of the sky, the ghosts in the desert and the rats in the mud. These are our stories.',
                'dificultad' => 'baja',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'Ancient One',
                'contenido' => 'We do not get to choose our time. Death is what gives life meaning. To know your days are numbered. Your time is short. You would think after all this time, I would be ready. But look at me. Stretching one moment out into a thousand... just so that I can watch the snow.',
                'dificultad' => 'baja',
            ]
        );

        Cuento::create(
            [
                'titulo' => 'we Can Do This',
                'contenido' => 'It is truly amazing what you can do when you believe in your own ability. That is why you need faith - a deep down, dogged belief that, regardless of the evidence, you are going to make it! You are going to achieve what you have set out to accomplish. You are going to make a difference in this life.',
                'dificultad' => 'media',
            ]
        );

    }
}













