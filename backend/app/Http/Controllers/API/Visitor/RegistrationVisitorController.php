<?php

namespace App\Http\Controllers\API\Visitor;

use App\Http\Controllers\BaseController;
use App\Services\Firm\FirmService;
use App\Services\Visitor\VisitorCategoryService;
use App\Services\Visitor\VisitorService;
use Illuminate\Http\Request;

class RegistrationVisitorController extends BaseController
{
    private $visitorService;
    private $visitorCategoryService;
    private $firmService;

    public function __construct
    (
        VisitorService $visitorService,
        VisitorCategoryService $visitorCategoryService,
        FirmService $firmService
    )
    {
        $this->visitorService = $visitorService;
        $this->visitorCategoryService = $visitorCategoryService;
        $this->firmService = $firmService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        // Ищем поситителя по ФИО
        $visitor = $this->visitorService->getVisitorByFullName($request->visitor);
        // Проверяем переданный id категории поситителя
        $this->visitorCategoryService->getCategoryById($request->visitor['categoryId']);
        // Если посититель не найден
        if(!$visitor){
            // Создаем нового поситителя
            $visitor = $this->visitorService->createVisitor($request->visitor);
        } else {
            // Обновляем данные поситителя
            $this->visitorService->updateVisitor($visitor, $request->visitor);
        }

        // Ищем фирму поситителя
        $firm = $this->firmService->getFirmByTitle($request->firm);
        // Если фирма не найдена и запрос с фирмой не пустой
        if($firm === null && $request->firm !== null ) {
            // Создаем новую фирму для поситителя
            $firm = $this->firmService->createFirm($request->firm);
        }
        // Если фирма найдена и id найденой фирмы отличается от текущей фирмы поситителя
        if($firm && $firm->id !== $visitor->firm_id){
            // Обновляем фирму для поситителя
            $this->visitorService->updateVisitorFirm($visitor->id, $firm->id);
        }

        $visitor = $this->visitorService->getVisitorById($visitor->id);
        return $this->sendSuccess($visitor, 'Посетитель зарегистрирован успешно');
        /*try {

        } catch (\Exception $exception) {
            return $this->sendError($exception, 'Ошибка регистрации посетителя');
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
