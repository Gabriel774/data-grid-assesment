<?php

namespace App\Filters;

use App\Filters\Contracts\QueryFilter;

class FilterTemplate
{
    public function __construct(
        public string $value,
        public string $label,
        public string $queryFilter,
        public string $inputType,
        public ?string $queryColumn = null,
        public ?string $placeholder = null,
        public array $extra_data = []
    ) {
    }

    public function toQueryFilter(): QueryFilter
    {
        return new $this->queryFilter(
            $this->queryColumn ?? $this->value,
            request()->input($this->value)
        );
    }

    public function toInterfaceFilter(): array
    {
        return [
            'label' => $this->label,
            'type' => $this->inputType,
            'value' => $this->value,
            'placeholder' => $this->placeholder,
            'extra_data' => $this->extra_data
        ];
    }
}