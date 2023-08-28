<?php

namespace PixiiBomb\Essentials\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PixiiBomb\Essentials\Models\Content;
use PixiiBomb\Essentials\Models\Meta;
use PixiiBomb\Essentials\Models\PixiiUser;
use PixiiBomb\Essentials\Requests\LoginUserRequest;
use PixiiBomb\Essentials\Requests\RegisterUserRequest;
use PixiiBomb\Essentials\View\Components\Container;
use PixiiBomb\Essentials\View\Components\Form;

class UserController extends ContentController
{
    protected function updateProfile()
    {

    }

    protected function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.login');
    }

    protected function form(string $alias, string $action): Form
    {
        return (new Form())
            ->setTitle($alias)
            ->setAction($action)
            ->setSubmit($alias);
    }

    public function login(): View
    {
        $alias = getMethodName(__METHOD__);
        $meta = new Meta($alias);
        $form = $this->form($alias, 'user.' . AUTHENTICATE);

        $containers = [
            (new Container())
                ->setAlias($alias)
                ->setView($this->filename($alias))
                ->setContainerData($form)
        ];

        $content = new Content($meta, $containers);
        return self::layout($content);
    }

    public function authenticate(LoginUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $credentials = [
            USERNAME => $validated[USERNAME],
            PASSWORD => $validated[PASSWORD],
        ];

        if (Auth::attempt($credentials))
        {
            return redirect()->route($request->getSuccessRoute());
        } else {
            dd($request);
        }
    }

    public function register(): View
    {
        $alias = getMethodName(__METHOD__);
        $meta = new Meta($alias);
        $form = $this->form($alias, 'user.create');

        $containers = [
            (new Container())
                ->setAlias($alias)
                ->setView($this->filename($alias))
                ->setContainerData($form)
        ];

        $content = new Content($meta, $containers);
        return self::layout($content);
    }

    public function create(RegisterUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = PixiiUser::create([
            USERNAME => $validated[USERNAME],
            EMAIL => $validated[EMAIL],
            PASSWORD => bcrypt($validated[PASSWORD])
        ]);

        Auth::login($user);
        return redirect()->route($request->getSuccessRoute());
    }

    public function dashboard(): View
    {
        return parent::setup(getMethodName(__METHOD__));
    }
}
