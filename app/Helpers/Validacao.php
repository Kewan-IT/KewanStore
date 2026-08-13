<?php

namespace App\Helpers;

class Validacao
{
    private $erros = [];
    
    public function validar($dados, $regras)
    {
        foreach ($regras as $campo => $regra) {
            $this->validarCampo($campo, $dados[$campo] ?? null, $regra);
        }
        return empty($this->erros);
    }
    
    private function validarCampo($campo, $valor, $regra)
    {
        $regras = explode('|', $regra);
        
        foreach ($regras as $r) {
            if ($r === 'required' && empty($valor)) {
                $this->erros[$campo] = "O campo {$campo} é obrigatório";
            } elseif (strpos($r, 'min:') === 0) {
                $min = (int) str_replace('min:', '', $r);
                if (strlen($valor) < $min) {
                    $this->erros[$campo] = "O campo {$campo} deve ter no mínimo {$min} caracteres";
                }
            }
        }
    }
    
    public function getErros()
    {
        return $this->erros;
    }
}
