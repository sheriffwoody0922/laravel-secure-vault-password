<?php declare(strict_types=1);

namespace App\Domains\Tag\Test\Controller;

use App\Domains\Tag\Model\Tag as Model;

class Update extends ControllerAbstractTestCase
{
    /**
     * @var string
     */
    protected string $route = 'tag.update';

    /**
     * @var string
     */
    protected string $action = 'update';

    /**
     * @var array
     */
    protected array $validation = [
        'name' => ['bail', 'string', 'required'],
        'color' => ['bail', 'string', 'required', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
    ];

    /**
     * @return void
     */
    public function testGetUnauthorizedFail(): void
    {
        $this->get($this->route(null, $this->factoryCreate(Model::class)->id))
            ->assertStatus(302)
            ->assertRedirect(route('user.auth.credentials'));
    }

    /**
     * @return void
     */
    public function testPostUnauthorizedFail(): void
    {
        $this->post($this->route(null, $this->factoryCreate(Model::class)->id))
            ->assertStatus(302)
            ->assertRedirect(route('user.auth.credentials'));
    }

    /**
     * @return void
     */
    public function testGetNoAdminFail(): void
    {
        $this->authUserAdmin(false);

        $this->get($this->route(null, $this->factoryCreate(Model::class)->id))
            ->assertStatus(302)
            ->assertRedirect(route('dashboard.index'));
    }

    /**
     * @return void
     */
    public function testPostNoAdminFail(): void
    {
        $this->authUserAdmin(false);

        $this->post($this->route(null, $this->factoryCreate(Model::class)->id))
            ->assertStatus(302)
            ->assertRedirect(route('dashboard.index'));
    }

    /**
     * @return void
     */
    public function testGetSuccess(): void
    {
        $this->authUserAdmin();

        $this->get($this->route(null, $this->factoryCreate(Model::class)->id))
            ->assertStatus(200)
            ->assertViewIs('domains.tag.update');
    }

    /**
     * @return void
     */
    public function testPostEmptySuccess(): void
    {
        $this->authUserAdmin();

        $this->post($this->route(null, $this->factoryCreate(Model::class)->id))
            ->assertStatus(200)
            ->assertViewIs('domains.tag.update');
    }

    /**
     * @return void
     */
    public function testPostEmptyWithActionFail(): void
    {
        $this->authUserAdmin();

        $this->post($this->route(null, $this->factoryCreate(Model::class)->id), $this->action())
            ->assertStatus(422)
            ->assertDontSee('validation.')
            ->assertDontSee('validator.');
    }

    /**
     * @return void
     */
    public function testPostWithoutActionSuccess(): void
    {
        $this->authUserAdmin();

        $id = $this->factoryCreate(Model::class)->id;

        $this->post($this->route(null, $id), $this->factoryWhitelist(Model::class, ['name'], false))
            ->assertStatus(200)
            ->assertViewIs('domains.tag.update');
    }

    /**
     * @return void
     */
    public function testPostSuccess(): void
    {
        $this->authUserAdmin();

        $data = $this->factoryMake(Model::class)->toArray();

        $this->followingRedirects()
            ->post($this->route(null, $this->factoryCreate(Model::class)->id), $data + $this->action())
            ->assertStatus(200)
            ->assertSee('La Etiqueta ha sido actualizada correctamente')
            ->assertSee($data['name']);

        $row = $this->rowLast(Model::class);

        $this->assertEquals($row->name, $data['name']);
        $this->assertEquals($row->color, $data['color']);
    }
}
