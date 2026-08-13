<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function loginForm()
    {
        $this->viewSemLayout('auth/login', [
            'title' => 'Login | KewanStore',
            'errors' => []
        ]);
    }

    public function entrar()
    {
        $email = $this->entrada('email');
        $senha = $this->entrada('password');

        if (empty($email) || empty($senha)) {
            $this->viewSemLayout('auth/login', [
                'title' => 'Login | KewanStore',
                'errors' => ['Informe o email e a senha para continuar.']
            ]);
            return;
        }

        $usuario = (new Usuario())->buscarPorEmail($email);

        if (!$usuario || !password_verify($senha, $usuario['senha'] ?? '')) {
            $this->viewSemLayout('auth/login', [
                'title' => 'Login | KewanStore',
                'errors' => ['Credenciais inválidas. Verifique o email e a senha.']
            ]);
            return;
        }

        Auth::login($usuario);
        $this->redirecionar('/');
    }

    public function sair()
    {
        Auth::logout();
        $this->redirecionar('/login');
    }

    public function register()
    {
        // Lógica de registro
    }
}
