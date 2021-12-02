<?php

namespace App\Http\Controllers\API\Visitor;

use App\Http\Controllers\BaseController;
use App\Services\Visitor\VisitorCategoryService;
use Illuminate\Http\Request;

class VisitorCategoryController extends BaseController
{
    private $visitorCategoryService;

    public function __construct(VisitorCategoryService $visitorCategoryService)
    {
        $this->visitorCategoryService = $visitorCategoryService;
    }

    // Получить списока категорий
    public function index()
    {
        try {
            $categories = $this->visitorCategoryService->getListCategories();
            return response()->success('Список категорий получен успешно', $categories);
        } catch (\Exception $exception) {
            return $this->sendError($exception, 'Ошибка получения списка категорий');
        }
    }

    // Создание категории
    public function store(Request $request)
    {
        try {
            $category = $this->visitorCategoryService->createCategory($request);
            return $this->sendSuccess($category, 'Категория успешно создана');
        } catch (\Exception $exception) {
            return $this->sendError($exception, 'Ошибка создания категории');
        }
    }

    // Редактирование категории
    public function update(Request $request, $id)
    {
        try {
            $category = $this->visitorCategoryService->updateCategory($request, $id);
            return $this->sendSuccess($category, 'Категория успешно обновлена');
        } catch (\Exception $exception) {
            return $this->sendError($exception, 'Ошибка обновления категории');
        }
    }

    // Удаление категории
    public function destroy($id)
    {
        try {
            $this->visitorCategoryService->deleteCategory($id);
            return $this->sendSuccess(null, 'Категория успешно удалена');
        } catch (\Exception $exception) {
            return $this->sendError($exception, 'Ошибка удаления категории');
        }
    }
}
