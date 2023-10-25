<?php

namespace App\Kernel\Contracts;

interface QueryBuilderInterface
{
    public function table(string $table): static;
    public function select(array $columns = ['*']): static;
    public function where(string $column, string $operator, string $value): static;
    public function orderBy(string $column, string $direction = 'ASC'): static;
    public function limit(int $count): static;
    public function get(): array;
    public function first(): ?array;
    public function delete($id): int;
    public function create(array $data): bool;
    public function update(int $id, array $data): bool;
    public function join(string $table, string $first, string $operator, string $second, string $type = 'inner'): static;
    public function groupBy(string $column): static;
    public function having(string $column, string $operator, string $value): static;
}
