<?php

namespace App\Core;

/**
 * Gerencia autenticação e sessão do utilizador.
 */
class Auth
{
    public static function iniciarSessao(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function login(array $usuario): void
    {
        self::iniciarSessao();
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_perfil'] = $usuario['perfil'];
    }

    public static function logout(): void
    {
        self::iniciarSessao();
        $_SESSION = [];
        session_destroy();
    }

    public static function verificado(): bool
    {
        self::iniciarSessao();
        return isset($_SESSION['usuario_id']);
    }

    public static function usuarioId(): ?int
    {
        self::iniciarSessao();
        return $_SESSION['usuario_id'] ?? null;
    }

    public static function usuarioNome(): ?string
    {
        self::iniciarSessao();
        return $_SESSION['usuario_nome'] ?? null;
    }

    public static function perfil(): ?string
    {
        self::iniciarSessao();
        return $_SESSION['usuario_perfil'] ?? null;
    }

    public static function ehAdmin(): bool
    {
        return self::perfil() === 'admin';
    }

    /**
     * Redireciona para o login se não houver sessão ativa.
     * Deve ser chamado no início de controllers que exigem autenticação.
     */
    public static function exigir(): void
    {
        if (!self::verificado()) {
            header('Location: /login');
            exit;
        }
    }

    /**
     * Restringe o acesso a um conjunto de perfis. Ex: Auth::exigirPerfil(['admin']);
     */
    public static function exigirPerfil(array $perfis): void
    {
        self::exigir();

        if (!in_array(self::perfil(), $perfis, true)) {
            http_response_code(403);
            die('Acesso não autorizado para o seu perfil.');
        }
    }
}
