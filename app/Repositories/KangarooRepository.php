<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Kangaroo;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class KangarooRepository
{
    /**
     * @var Kangaroop
     */
    private Kangaroo $model;

    /**
     * @param Kangaroo $Kangaroo
     */
    public function __construct(Kangaroo $model)
    {
        $this->model = $model;
    }

    /**
     * Get listg of kangaroo
     * 
     * @return Kangaroo
     */
    public function getList()
    {
        $result = $this->model->all();

        return $result;
    }

    /**
     * Store kangaroo
     *
     * @param array $data
     * @return Kangaroo
     */
    public function create(array $data){
        $eloquent = $this->model->create($data);
        if (request()->hasFile('photo')) {
            $photo = request()->file('photo');
            $filename = "$eloquent->id." . $photo->getClientOriginalExtension();
            $photo->storeAs('uploads', $filename, 'public');
        }
        return $eloquent;
    }

    /**
     * Update kangaroo
     *
     * @param Integer $id
     * @param array $updateData
     * @return Kangaroo
     */
    public function update(int $id, array $updateData){
        unset($updateData['photo']);
        $eloquent = $this->model->where('id', $id)->update($updateData);
        if (request()->hasFile('photo')) {
            $photo = request()->file('photo');
            $filename = "$id." . $photo->getClientOriginalExtension();
            
            // delete first the old
            Storage::disk('public')->delete("uploads/$filename");
            
            $photo->storeAs('uploads', $filename, 'public');
        }
        return $eloquent;
    }

    /**
     * Get Details of kangaroo
     *
     * @param Integer $id
     * @return Kangaroo
     */
    public function find(int $id){
        $eloquent = $this->model->find($id);
        return $eloquent;
    }

    /**
     * Delete kangaroo
     *
     * @param Integer $id
     * @return Boolean
     */
    public function delete(int $id){
        try {
            $deleted = false;
            DB::beginTransaction();

            $eloquent = $this->model->find($id);
        
            $eloquent->delete();
            $deleted = true;
            
            DB::commit();
        } catch (QueryException $ex) {
            DB::rollBack();
            $deleted = false;
        }

        return $deleted;
    }
}
