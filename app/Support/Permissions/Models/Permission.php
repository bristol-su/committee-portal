<?php


namespace App\Support\Permissions\Models;


use App\Support\Permissions\Contracts\Models\Permission as PermissionContract;

class Permission implements PermissionContract
{

    private $ability;

    private $name;

    private $description;

    private $type;

    private $moduleAlias;

    private $moduleType;

    public function __construct(string $ability = '', string $name = '', string $description = '', string $type = 'global', string $alias = '', string $moduleType = '')
    {
        $this->setAbility($ability);
        $this->setName($name);
        $this->setDescription($description);
        $this->setType($type);
        $this->setModuleAlias($alias);
        $this->setModuleType($moduleType);
    }

    public function getAbility(): string
    {
        return $this->ability;
    }

    public function setAbility(string $ability)
    {
        $this->ability = $ability;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function getModuleAlias(): string
    {
        return $this->moduleAlias;
    }

    public function setModuleAlias(string $moduleAlias)
    {
        $this->moduleAlias = $moduleAlias;
    }

    public function getModuleType(): string
    {
        return $this->moduleType;
    }

    public function setModuleType(string $moduleType)
    {
        $this->moduleType = $moduleType;
    }

    public function toArray()
    {
        return [
            'ability' => $this->getAbility(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'type' => $this->getType(),
            'alias' => $this->getModuleAlias(),
            'module_type' => $this->getModuleType()
        ];
    }
}
