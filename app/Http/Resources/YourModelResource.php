<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
