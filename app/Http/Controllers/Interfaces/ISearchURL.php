<?php
/**
 * Created by PhpStorm.
 * User: Hp
 * Date: 11.02.2018
 * Time: 15:05
 */

namespace App\Http\Controllers\Interfaces;

use App\Http\Requests\Request;

interface SearchURL{

    //public function __construct(Request $request);



    /*
     * Геттеры отвечающие за получения информации
     */

    // Получаем информацю о проектах
    public function getProjects();

    // Получаем информацю об 1 проекте
    public function getProjectOnId($idp);

    // Получаем информацю о диалогах
    public function getDialogs();

    // Получаем информацю об 1 диалоге
    public function getDialogOnId($idd);

    // Получаем информацию о пользователе
    public function getUser();


    /*
     * Сеттеры отвечающие за изменение информации
     */

    // Изменяем/Добавляем информацию о проекте
    public function setProject($input);

    // изменяем/Добавляем информациб о диалоге
    public function setDialog($data);

    // изменяем/Добавляем информацию о пользователе
    public function setUser();



}