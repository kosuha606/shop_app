<?php

namespace App\Core\Interfaces;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

interface ApplicationInterface
{
    public function getConfig(): array;

    public function run(): void;

    public function getContainer(): ContainerInterface;

    public function request(): Request;

    public function requestException(): ?\Throwable;
}