<?php

namespace App;

class Calculator
{
    protected OperationInterface $operation;

    public function __construct(OperationInterface $operation = null)
    {
        $this->operation = $operation ?? new AdditionStrategy();
    }

    //Metodo magico
    public function __call($method, $arguments)
    {
        //$method = addition -> AdditionStrategy
        $classname = ucfirst($method) . 'Strategy';
        //$arguments = [param1, param2]
        list($a, $b) = $arguments;
        //instanciar la operacion con el nombre de la estrategia
        $this->setOperation(new $classname);

        return $this->execute($a, $b);
    }

    public function execute($a, $b)
    {
        return $this->operation->doOperation($a, $b);
    }

    public function setOperation(OperationInterface $operation)
    {
        $this->operation = $operation;
    }
}
