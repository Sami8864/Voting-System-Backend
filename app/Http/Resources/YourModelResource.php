<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

// This PHP class, within a Laravel application, extends Laravel's JsonResource class and is responsible for formatting responses into a standardized structure. The `toArray` method transforms the resource into an array, including fields for code, message, and data. The `makeWithCodeAndData` method creates a new instance of the resource with provided code, message, and data, facilitating consistent response formatting across the application.

class YourModelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'code' => $this->resource['code'] ?? 200,
            'message' => $this->resource['message'] ?? 'Success',
            'data' => $this->resource['data'] ?? $this->resource,
        ];
    }
    public static function makeWithCodeAndData($message, $code, $data)
    {
        return new static([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ]);
    }
}
