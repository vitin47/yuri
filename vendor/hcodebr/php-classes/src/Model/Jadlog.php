<?php
namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;
use \Hcode\Mailer;
use \Hcode\Model\User;
class Jadlog extends Model{
    private  $vModalidade;
    private  $Password;
    private  $vSeguro;
    private  $vVlDec;
    private  $vVlColeta;
    private  $vCepOrig;
    private  $vCepDest;
    private  $vPeso;
    private  $vFrap;
    private  $vEntrega;
    private  $vCnpj;

    $nrzipcode = str_replace('-', '', $nrzipcode);
        $totals = $this->getProductsTotals();
    
    
    function __construct( $args = array() ) {
	
        // Dados necessários para calcular o valor do frete
        $default = array(            'cep_origem'           => '89062-080',
                                     'cep_destino'          => '69926-000',
                                     'peso'                 => '30',
                                     'valor'                => '10,00',
                                     'modalidade'           => '5',
                                     'cnpj'                 => '17977285000118',
                                     'password'             => 'C2o0E1m3',
                                     'seguro'               => 'N',
                                     'coleta'               => '',
                                     'acobrar'              => 'N',
                                     'entrega'              => 'D',
                                     );
        
        $data_jadlog = array_merge( $default , $args );
        
        $this->vModalidade          =    $default['modalidade'];
        $this->Password             =    $default['password'];
        $this->vSeguro              =    $default['seguro'];
        $this->vVlDec               =    $default['valor'];
        $this->vVlColeta            =    $default['coleta'];
        $this->vCepOrig             =    $default['cep_origem'];
        $this->vCepDest             =    $default['cep_destino'];
        $this->vPeso                =    $default['peso'];
        $this->vFrap                =    $default['acobrar'];
        $this->vEntrega             =    $default['entrega'];
        $this->vCnpj                =    $default['cnpj'];
        
    }
    
    public function calcular_frete(){
    try {
    	$LinkCalcFrete	= "http://www.jadlog.com.br:8080/JadlogEdiWs/services/ValorFreteBean?method=valorar";
        $LinkCalcFrete  .= "&vModalidade=".$this->vModalidade."&Password=".$this->Password."&vSeguro=".$this->vSeguro."&vVlDec=".$this->vVlDec."&vVlColeta=".$this->vVlColeta;
        $LinkCalcFrete  .= "&vCepOrig=".$this->vCepOrig."&vCepDest=".$this->vCepDest."&vPeso=".$this->vPeso."&vFrap=".$this->vFrap."&vEntrega=".$this->vEntrega."&vCnpj=".$this->vCnpj;
    	$calculo 		= simplexml_load_file($LinkCalcFrete);
       if ( $calculo->Retorno == "-1" ) :
            throw new Exception("Acesso negado ou senha incorreta!");
       elseif($calculo->Retorno == "-2"):
            throw new Exception("Não existe tarifa para paramêtros solicitados.");
       elseif($calculo->Retorno == "-3"):
            throw new Exception("Erro do Banco de Dados.");
       elseif($calculo->Retorno == "-99"):
            throw new Exception("Erro indeterminado! Favor entrar em contato com o Suporte através do email helpdesk@jadlog.com.br .");
       else:
           return $calculo->Retorno;
       endif;
       
            
        } catch (Exception $e) {
            
            echo $e->getMessage();
        }
	
    }
    
    
    
}