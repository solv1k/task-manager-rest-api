<?php

declare(strict_types=1);

namespace App\Dto\Task;

use App\Core\Abstracts\AbstractDto;

final class UpdateTaskDto extends AbstractDto
{
    public function __construct(
        public ?string $title,
        public ?string $description,
        public ?bool $completed,
    ) {}
}
