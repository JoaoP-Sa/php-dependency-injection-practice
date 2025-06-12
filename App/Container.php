<?php

namespace App;

//closures são objetos que representam funções anônimas.
use Closure;
use ReflectionClass;
use ReflectionParameter;

final class Container
{
    private $instances = [];

    // método responsável por definir um novo objeto
    public function set(string $id, Closure $closure): void
    {
        $this->instances[$id] = $closure;
    }

    // método responsável por pegar um objeto já instanciado e injetar no construtor de algum novo objeto
    public function get($id): object
    {
        // se a referência existir ela é retornada
        if ($this->has($id)) {
            return $this->instances[$id]($this);
        }

        // se a referência não existir no container então significa que foi passado uma classe para ser
        // instanciada, e ao fazermos a reflexão dela conseguimos os parâmetros do método construtor
        $reflection = new ReflectionClass($id);
        $constructor = $reflection->getConstructor();
        $dependencies = $constructor->getParameters();

        // se a classe não implementa um método construtor então retornamos apenas uma instância dela
        if ($constructor === null) {
            return new $id();
        }

        // itera sobre os parâmetros do construtor para fazer a resolução das dependências que ele
        // exige. O método newInstanceArgs cria uma nova instância da classe usando os novos parâmetros
        // usados. O array_map() é usado para iterar os parâmetros atuais, resolvê-los junto ao container,
        // e retornar um array das instâncias já resolvidas pelo container.
        $paramClassReference = array_map(function(ReflectionParameter $dependency) {
            // busca uma referencia da classe desse parâmetro no container 
            return $this->get( $dependency->getType()->getName() );
        }, $dependencies);

        return $reflection->newInstanceArgs($paramClassReference);
    }

    // método responsável por implementar um objeto uma única vez, para não permitir que ele seja resetado
    public function singleton(string $id, Closure $closure): void
    {
        $this->instances[$id] = function() use ($closure) {
            
            // o static serve para a variável preservar o valor mesmo após o fim da execução do método
            static $resolvedInstance;

            if (null === $resolvedInstance) {
                $resolvedInstance = $closure($this);
            }

            return $resolvedInstance;
        };
    }

    public function has($id): bool
    {
        return isset($this->instances[$id]);
    }
}
