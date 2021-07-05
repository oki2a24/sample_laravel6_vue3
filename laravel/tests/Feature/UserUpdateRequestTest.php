<?php

namespace Tests\Feature;

use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Validator;
use Mockery;
use Tests\TestCase;

class UserUpdateRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    /*
    public function メール未変更でも正常終了すること1。Mock(): void
    {
        $user = factory(User::class)->create();

        $data = [
            'name' => '名前',
            'email' => $user->email,
            'zip' => '0123456',
        ];
        //$request = new UserUpdateRequest();
        $request = Mockery::mock(UserUpdateRequest::class)
            ->makePartial()
            ->shouldReceive('route')
            ->with('user')
            ->once()
            ->andReturn($user)
            ->getMock();
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);

        $result = $validator->passes();
        $this->assertTrue($result);
    }
    */

    /**
     * @test
     * @return void
     */
    public function メール未変更でも正常終了すること2。setRouteResolver(): void
    {
        $user = factory(User::class)->create();

        $data = [
            'name' => '名前',
            'email' => $user->email,
            'zip' => '0123456',
        ];
        //$request = new UserUpdateRequest();
        $request = UserUpdateRequest::create('api/user/'.$user->id, Request::METHOD_PATCH, $data);
        $request->setRouteResolver(function () use ($request) {
            return (new Route(Request::METHOD_PATCH, 'api/user/{user}', []))
                ->bind($request);
        });
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);

        $result = $validator->passes();
        $this->assertTrue($result);
    }

    /**
     * @test
     * @return void
     */
    public function メール未変更でも正常終了すること3。モデル結合ルート(): void
    {
        $user = factory(User::class)->create();

        $data = [
            'name' => '名前',
            'email' => $user->email,
            'zip' => '0123456',
        ];
        $request = new UserUpdateRequest();
        $request->user = $user;
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);

        $result = $validator->passes();
        $this->assertTrue($result);
    }
}
