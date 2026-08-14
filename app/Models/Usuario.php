<?php

namespace App\Models;

use App\Core\Model;

class Usuario extends Model
{
    protected string $tabela = 'usuarios';

    protected array $fillable = [
        'nome',
        'email',
        'senha',
        'perfil',
        'foto',
        'ativo',
    ];

    public function buscarPorEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);

        $usuario = $stmt->fetch();

        return $usuario ?: null;
    }
}
