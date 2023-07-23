<?php

namespace App\Http\Controllers\API\Visitor;

use App\Http\Controllers\Controller;
use App\Services\Visitor\VisitorCategoryService;
use Illuminate\Http\Request;

class VisitorCategoryController extends Controller
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
      return response($categories);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  // Создание категории
  public function store(Request $request)
  {
    try {
      $category = $this->visitorCategoryService->createCategory($request);
      return response($category);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  // Редактирование категории
  public function update(Request $request, $id)
  {
    try {
      $category = $this->visitorCategoryService->updateCategory($request, $id);
      return response($category);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  // Удаление категории
  public function destroy($id)
  {
    try {
      $this->visitorCategoryService->deleteCategory($id);
      return response(null);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }
}
