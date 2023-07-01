<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Models\Kangaroo;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class UserRepository
{
    /**
     * @var User
     */
    private User $model;

    /**
     * @param User $User
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Store kangaroo
     *
     * @param array $data
     * @return Kangaroo
     */
    public function create(array $data)
    {
        $eloquent = $this->model->create($data);
        return $eloquent;
    }
}
