<?php

namespace Tests\Feature\Cuentos;

use Tests\TestCase;
use App\Models\Cuento;
use App\Models\User;

use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\{ actingAs, assertDatabaseHas, post, get };

uses(refreshDatabase::class);

beforeEach(function () {
    $this->seed();
});

test('Se renderiza el listado de cuentos', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $request = $this->get('/cuento');
    $request->assertStatus(200);
    $request->assertInertia(fn (Assert $page) => $page
        ->component('Cuentos/Index')
        ->has('cuentos')
        ->where('cuentos', Cuento::all()->toArray())
    );
});

test('Se tienen los breadcrumbs en listado de cuentos', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $request = $this->get('/cuento');
    $request->assertStatus(200);
    $request->assertInertia(fn (Assert $page) => $page
        ->has('breadcrumbs')
        ->where('breadcrumbs', [
            ['name' => 'Listado de cuentos', 'href' => 'cuento.index', 'current' => true],
        ])
    );
});

