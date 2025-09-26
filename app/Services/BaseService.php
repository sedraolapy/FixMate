<?php

namespace App\Services;


abstract class BaseService
{
    protected $model ;

    abstract public function __construct();

    protected function withRelations()
    {
    return [];
    }

        public function getAll()
        {
            return $this->model::with($this->withRelations())->get();
        }


    public function create($data){
        $modelInstance =  $this->model::create($data);
        $modelInstance->setTranslations('name',[
            'en' => $data['name_en'],
            'ar' => $data['name_ar'],
        ]);
        $modelInstance->save();

        return $this->model::with($this->withRelations())->find($modelInstance->id);

    }

    public function getById($id)
    {
        return $this->model::with($this->withRelations())->findOrFail($id);
    }



    public function update($id ,$data){
        $modelInstance = $this->getById($id);
        $modelInstance->update($data);

        $translations = [
            'en' => $data['name_en'] ?? $modelInstance->getTranslation('name', 'en'),
            'ar' => $data['name_ar'] ?? $modelInstance->getTranslation('name', 'ar'),
        ];

        $modelInstance->setTranslations('name', $translations);

        $modelInstance->save();

        return $this->model::with($this->withRelations())->find($modelInstance->id);

    }

    public function delete($id){
        $modelInstance = $this->getById($id);
        $modelInstance->delete();

        return $modelInstance ;
    }
}