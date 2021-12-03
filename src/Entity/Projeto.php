<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Projeto
{
    //-----Atributos e Construtor-----
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
     * @ORM\OneToMany(targetEntity="Funcionario", mappedBy="projeto")
     */
    private $funcionarios;

    /**
     * @ORM\OneToMany(targetEntity="HoraLancada", mappedBy="projeto")
     */
    private $horasLancadas;

    public function __construct()
    {
        $this->funcionarios = new ArrayCollection();
        $this->horasLancadas = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNome();
    }

    //----------Get---------
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
    public function getFuncionarios()
    {
        return $this->funcionarios;
    }

    /**
     * @return mixed
     */
    public function getHorasLancadas()
    {
        return $this->horasLancadas;
    }

    public function getTotalHorasLancadas()
    {
        $horas = 0;
        foreach($this->horasLancadas as $horasLancada){
            $horas += $horasLancada->getQuantidade();
        }

        return $horas;
    }
    //--------Set-------
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @param mixed $funcionarios
     */
    public function setFuncionarios($funcionarios)
    {
        $this->funcionarios = $funcionarios;
    }

    /**
     * @param mixed $horasLancadas
     */
    public function setHorasLancadas($horasLancadas)
    {
        $this->horasLancadas = $horasLancadas;
    }

    //------------Add & Remove----------
    public function addFuncionario(Funcionario $funcionario)
    {
        $funcionario->setProjeto($this);
        $this->funcionarios->add($funcionario);
    }

    public function removeFuncionario(Funcionario $funcionario)
    {
        $funcionario->setProjeto(null);
        $this->funcionarios->remove($funcionario);
    }

    public function addHorasLancada(HoraLancada $hora)
    {
        $this->horasLancadas->add($hora);
    }

    public function removeHorasLancada(HoraLancada $hora)
    {
        $this->horasLancadas->remove($hora);
    }


}
