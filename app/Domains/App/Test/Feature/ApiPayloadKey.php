<?php declare(strict_types=1);

namespace App\Domains\App\Test\Feature;

use Illuminate\Testing\TestResponse;
use App\Domains\App\Model\App as Model;
use App\Domains\Team\Model\Team as TeamModel;
use App\Domains\User\Model\User as UserModel;

class ApiPayloadKey extends FeatureAbstract
{
    /**
     * @var string
     */
    protected string $route = 'app.api.payload.key';

    /**
     * @return void
     */
    public function testGetUnauthorizedFail(): void
    {
        $this->get($this->route(null, $this->factoryCreate(Model::class)->id, 'user'))
            ->assertStatus(405);
    }

    /**
     * @return void
     */
    public function testPostUnauthorizedFail(): void
    {
        $row = $this->factoryCreate(Model::class);

        $this->post($this->route(null, $row->id, 'user'))
            ->assertStatus(422)
            ->assertSee('El campo api key es requerido.');

        $this->postJson($this->route(null, $row->id, 'user'))
            ->assertStatus(422)
            ->assertExactJson(json_decode('{"code":422,"status":"api_key","message":"El campo api key es requerido."}', true));

        $this->post($this->route(null, $row->id, 'user'), [], ['Authorization' => uniqid()])
            ->assertStatus(401)
            ->assertSee('Las credenciales indicadas no son correctas');

        $this->postJson($this->route(null, $row->id, 'user'), [], ['Authorization' => uniqid()])
            ->assertStatus(401)
            ->assertExactJson(json_decode('{"code":401,"status":"user_error","message":"Las credenciales indicadas no son correctas"}', true));
    }

    /**
     * @return void
     */
    public function testGetFail(): void
    {
        $this->authUser();

        $row = $this->rowCreateWithUser();

        $this->get($this->route(null, $row->id, 'user'))
            ->assertStatus(405)
            ->assertSee('Método no Permitido');

        $this->getJson($this->route(null, $row->id, 'user'))
            ->assertStatus(405)
            ->assertExactJson(json_decode('{"code":405,"status":"method_not_allowed","message":"Método no Permitido"}', true));
    }

    /**
     * @return void
     */
    public function testPostOtherFail(): void
    {
        $user = $this->authUser();

        $team = $this->factoryCreate(TeamModel::class);
        $team->users()->sync([$user->id]);

        $row = $this->factoryCreate(Model::class);

        $this->postAuthorized($row, 'user')
            ->assertStatus(404)
            ->assertSee('La aplicación solicitada no está disponible en estos momentos.');

        $this->postJsonAuthorized($row, 'user')
            ->assertStatus(404)
            ->assertExactJson(json_decode('{"code":404,"status":"error","message":"La aplicación solicitada no está disponible en estos momentos."}', true));

        $row->shared = true;
        $row->save();

        $this->postAuthorized($row, 'user')
            ->assertStatus(404)
            ->assertSee('La aplicación solicitada no está disponible en estos momentos.');

        $this->postJsonAuthorized($row, 'user')
            ->assertStatus(404)
            ->assertExactJson(json_decode('{"code":404,"status":"error","message":"La aplicación solicitada no está disponible en estos momentos."}', true));
    }

    /**
     * @return void
     */
    public function testPostInvalidFail(): void
    {
        $user = $this->authUser();
        $row = $this->rowCreateWithUser();

        $this->postAuthorized($row, uniqid())
            ->assertStatus(404)
            ->assertSee('No Encontrado');

        $this->postJsonAuthorized($row, uniqid())
            ->assertStatus(404)
            ->assertExactJson(json_decode('{"code":404,"status":"error","message":"No Encontrado"}', true));
    }

    /**
     * @return void
     */
    public function testPostTypeFail(): void
    {
        $user = $this->authUser();

        $row = $this->rowCreateWithUser();

        $row->type = 'server';
        $row->shared = false;
        $row->editable = false;

        $row->save();

        $this->assertEquals($row->payload('url'), 'https://google.es');
        $this->assertEquals($row->payload('user'), 'Google');
        $this->assertEquals($row->payload('password'), '123456');

        $this->postAuthorized($row, 'user')
            ->assertStatus(404)
            ->assertSee('La aplicación solicitada no está disponible en estos momentos.');

        $this->postJsonAuthorized($row, 'user')
            ->assertStatus(404)
            ->assertExactJson(json_decode('{"code":404,"status":"error","message":"La aplicación solicitada no está disponible en estos momentos."}', true));
    }

    /**
     * @return void
     */
    public function testPostSuccess(): void
    {
        $user = $this->authUser();

        $row = $this->rowCreateWithUser();

        $row->shared = false;
        $row->editable = false;

        $row->save();

        $this->assertEquals($row->payload('url'), 'https://google.es');
        $this->assertEquals($row->payload('user'), 'Google');
        $this->assertEquals($row->payload('password'), '123456');

        $this->postAuthorized($row, 'url')
            ->assertStatus(200)
            ->assertExactJson(['value' => base64_encode($row->payload('url'))]);

        $this->postJsonAuthorized($row, 'url')
            ->assertStatus(200)
            ->assertExactJson(['value' => base64_encode($row->payload('url'))]);

        $this->postAuthorized($row, 'user')
            ->assertStatus(200)
            ->assertExactJson(['value' => base64_encode($row->payload('user'))]);

        $this->postJsonAuthorized($row, 'user')
            ->assertStatus(200)
            ->assertExactJson(['value' => base64_encode($row->payload('user'))]);

        $this->postAuthorized($row, 'password')
            ->assertStatus(200)
            ->assertExactJson(['value' => base64_encode($row->payload('password'))]);

        $this->postJsonAuthorized($row, 'password')
            ->assertStatus(200)
            ->assertExactJson(['value' => base64_encode($row->payload('password'))]);

        $this->postAuthorized($row, 'private')
            ->assertStatus(200)
            ->assertExactJson(['value' => base64_encode('')]);

        $this->postJsonAuthorized($row, 'private')
            ->assertStatus(200)
            ->assertExactJson(['value' => base64_encode('')]);

        $row = $this->rowCreateWithUserAndTeam();

        $row->user_id = $this->factoryCreate(UserModel::class)->id;
        $row->shared = true;

        $row->save();

        $this->postAuthorized($row, 'user')
            ->assertStatus(200)
            ->assertExactJson(['value' => base64_encode('Google')]);

        $this->postJson($this->route(null, $row->id, 'user'), [], ['Authorization' => $user->api_key])
            ->assertStatus(200)
            ->assertExactJson(['value' => base64_encode('Google')]);
    }

    /**
     * @param \App\Domains\App\Model\App $row
     * @param string $key
     *
     * @return \Illuminate\Testing\TestResponse
     */
    protected function postAuthorized(Model $row, string $key): TestResponse
    {
        return $this->post($this->route(null, $row->id, $key), [], $this->apiAuthorization());
    }

    /**
     * @param \App\Domains\App\Model\App $row
     * @param string $key
     *
     * @return \Illuminate\Testing\TestResponse
     */
    protected function postJsonAuthorized(Model $row, string $key): TestResponse
    {
        return $this->postJson($this->route(null, $row->id, $key), [], $this->apiAuthorization());
    }
}
