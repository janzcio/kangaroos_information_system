<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\KangarooRepository;

class KangarooService
{
    /**
     * @var KangarooRepository
     */
    private KangarooRepository $kangarooRepository;

    /**
     * @param KangarooRepository $kangarooRepository
     */
    public function __construct(KangarooRepository $kangarooRepository)
    {
        $this->kangarooRepository = $kangarooRepository;
    }

    /**
     *  Get List of Kangaroos
     * 
     * @return Kangaroo
     */
    public function getList()
    {
        return $this->kangarooRepository->getList();
    }

    /**
     *  Store Kangaroo
     * 
     * @return Kangaroo
     */
    public function create(array $data)
    {        
        return $this->kangarooRepository->create($data);
    }

    /**
     *  Store Kangaroo
     * 
     * @return Kangaroo
     */
    public function update(int $id, array $data)
    {
        return $this->kangarooRepository->update($id, $data);
    }

    /**
     *  delete Kangaroo
     * 
     * @return Boolean
     */
    public function delete(int $id)
    {
        return $this->kangarooRepository->delete($id);
    }

    /**
     *  Show Kangaroo
     * 
     * @return Boolean
     */
    public function show(int $id)
    {
        return $this->kangarooRepository->find($id);
    }
}
