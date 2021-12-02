<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Funcionario{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $nome;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataDeNascimento;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataDeEntrada;

    /**
     * @ORM\ManyToOne(targetEntity="Projeto", inversedBy="funcionarios")
     */
    private $projeto;

    /**
     * @ORM\OneToMany(targetEntity="HoraLancada", mappedBy="funcionario")
     */
    private $horasLancadas;

    public function __toString()
    {
        return $this->getNome();
    }
    //-----------Get--------------

    /* Phpstorm fez isso sozinho, faz parte do phpdocumentor e permite ver a sintaxe da função em outros arquivos
       @return mostra o tipo da variavel que vai retornar
       @param mostra os tipos dos parametros das funcoes
    */
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return mixed
     */
    public function getDataDeEntrada()
    {
        return $this->dataDeEntrada;
    }

    /**
     * @return mixed
     */
    public function getDataDeNascimento()
    {
        return $this->dataDeNascimento;
    }

    /**
     * @return mixed
     */
    public function getTempoNaEmpresa(){
        $hoje = new \DateTime();
        $diferenca = $hoje->diff($this->dataDeEntrada);

        return $diferenca;
    }

    /**
     * @return mixed
     */
    public function getProjeto()
    {
        return $this->projeto;
    }

    /**
     * @return mixed
     */
    public function getHorasLancadas()
    {
        return $this->horasLancadas;
    }

    //----------------Set-------------------

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @param mixed $dataDeEntrada
     */
    public function setDataDeEntrada($dataDeEntrada)
    {
        $this->dataDeEntrada = $dataDeEntrada;
    }

    /**
     * @param mixed $dataDeNascimento
     */
    public function setDataDeNascimento($dataDeNascimento)
    {
        $this->dataDeNascimento = $dataDeNascimento;
    }

    /**
     * @param mixed $projeto
     */
    public function setProjeto($projeto)
    {
        $this->projeto = $projeto;
    }

    /**
     * @param mixed $horasLancadas
     */
    public function setHorasLancadas($horasLancadas)
    {
        $this->horasLancadas = $horasLancadas;
    }
}