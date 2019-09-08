<?php


namespace App\Support\Permissions\Contracts\Models;


use Illuminate\Contracts\Support\Arrayable;

interface Permission extends Arrayable
{

    public function __construct(string $ability = '', string $name = '', string $description = '');

    public function setAbility(string $ability);

    public function setName(string $name);

    public function setDescription(string $description);

    public function setType(string $type);

    public function setModuleAlias(string $moduleAlias);

    public function setModuleType(string $moduleType);

    public function getAbility(): string;

    public function getName(): string;

    public function getDescription(): string;

    public function getType(): string;

    public function getModuleAlias(): string;

    public function getModuleType(): string;
}
