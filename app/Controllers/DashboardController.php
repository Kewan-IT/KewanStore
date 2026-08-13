<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        Auth::exigir();

        $this->view('dashboard/index', [
            'title' => 'Dashboard | KewanStore',
            'usuarioNome' => Auth::usuarioNome(),
            'perfil' => Auth::perfil(),
            'resumo' => [
                'vendasHoje' => 0,
                'produtos' => 0,
                'clientes' => 0,
                'caixa' => 0.00,
            ],
        ]);
    }
}
