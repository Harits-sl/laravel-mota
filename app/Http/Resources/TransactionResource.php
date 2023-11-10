<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionResource extends ResourceCollection
{
    //define properti
    public $status;
    public $isSuccess;
    public $message;
    public $resource;

    /**
     * __construct
     *
     * @param  mixed $status
     * @param  mixed $isSuccess
     * @param  mixed $message
     * @param  mixed $resource
     * @return void
     */
    public function __construct($status, $isSuccess, $message, $resource)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->isSuccess  = $isSuccess;
        $this->message = $message;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => $this->status,
            'success' => $this->isSuccess,
            'message' => $this->message,
            'data' => $this->resource
        ];
    }
}
