<?php

namespace App\Models;

use App\Core\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'perfil',
        'ativo'
    ];

    public function buscarPorEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);

        $usuario = $stmt->fetch();

        return $usuario ?: null;
    }
}
