<?php


namespace App\Services\Visitor;

use App\Models\Visitor\VisitorCategory as VisitorCategoryModel;


class VisitorCategoryService
{
    // Создание категории
    public function createCategory($data)
    {
        try {
            $category = new VisitorCategoryModel();
            $category->title = $data->title;
            $category->save();
            return $category;
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Получить список категорий
    public function getListCategories()
    {
        try {
            return VisitorCategoryModel::all();
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Редактирование категории
    public function updateCategory($data, $id)
    {
        try {
            $category = new VisitorCategoryModel();
            $category->exists = true;
            $category->id = $id;
            $category->title = $data->title;
            $category->save();
            return $category;
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Удаление категории
    public function deleteCategory($id)
    {
        try {
            $category = new VisitorCategoryModel();
            $category->exists = true;
            $category->id = $id;
            $category->delete();
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Получение категории по id
    public function getCategoryById($id){
        $category = VisitorCategoryModel::where('id', +$id)->first();
        if($category){
            return $category;
        }
        throw new \Exception('С id: ' . +$id . ' категории не найдено');
    }
}
