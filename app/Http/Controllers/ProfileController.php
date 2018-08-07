<?php

namespace App\Http\Controllers;

use App\Models\FevBusinessmanProject;
use App\Models\FevInvestmentProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ErrorsController;
use App\Http\Controllers\ApiController;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;

use App\Models\LoadFileImg;

Class ProfileController extends Controller
{
    private $user;
    private $request;
    private $url;
    private $profile = null;
    private $input;
    private $file;
    public  $files_list = array();
    public  $user_info = null;
    private $profile_types_array = array(2 => 'App\Http\Controllers\InvestorController', 4 => 'App\Http\Controllers\BusinessController');
    
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->user = $this->request->user();
        $this->input = $this->request->input();
        $this->file = $_FILES;
    }

    public function init($menu = null){

        if(isset($this->user['id_group'])){

            $user = new $this->profile_types_array[$this->user['id_group']]();
            $user->setRequest($this->request);

            $this->profile = $user->initProfile($menu);

        }else{

            $this->profile = ErrorsController::getError('У вас нет прав для доступа к данной странице!');

        }

        return $this->getProfile();

    }
    public function uploadFileImages(){

        $api = new ApiController();

        $user = new $this->profile_types_array[$this->user['id_group']]();
        $user->setRequest($this->request);
        $user->setUserInfo();

        $api->countUploadFilesInvestorProject($this->file, $user->count_file_limit);

        foreach ($this->file as $file){

            $api->uploadFile($this->input, $file);

            if($api->getData('error_status') != 'true'){

                $check_file = new LoadFileImg();

                // Настройка пользовательских директорий, где хронятся картинки
                $check_file->f_upload_dir = $check_file->f_upload_dir.$user->file_dir;
                $check_file->f_return_dir = $check_file->f_return_dir.$user->file_dir;

                if ($check_file->checkExt($file)) {

                    $check_file->setFileName();
                    $check_file->setDirName();

                    $status_load = LoadFileImg::uploadFile(
                        $check_file->f__file_info,
                        $check_file->f_upload_dir,
                        $check_file->f__file
                    );

                    if ($status_load) {

                        //Формируем путь до файла
                        $url = $check_file->f_upload_dir . $check_file->f__file;

                        // Проверяем существует ли файл
                        if (file_exists($url)) {

                            if($api->count_files > 1){

                                $this->files_list =  $check_file->f_return_dir.$check_file->f__file;
                                $idi = LoadFileImg::addImg($this->files_list, $user->getUserId());
                                $api->upSetData('uploaded_photo', $this->files_list);
                                $api->upSetData('uploaded_photo_id', $idi);

                            }else{

                                $this->files_list =  $check_file->f_return_dir.$check_file->f__file;
                                $idi = LoadFileImg::addImg($this->files_list, $user->getUserId());
                                $api->setData('uploaded_photo', $this->files_list);
                                $api->setData('uploaded_photo_id', $idi);

                            }

                            $api->setData('error_status', 'false');

                        }

                    }

                }

            }

        }

        return $api->getJson();

    }
    public function deleteFileImages(){

        $api = new ApiController();
        $api->deleteImage($this->input);

        $user = new $this->profile_types_array[$this->user['id_group']]();
        $user->setRequest($this->request);
        $user->setUserInfo();

        if($api->getData('error_status') != 'true'){

            $exist_img = LoadFileImg::getImgOnId(
                $this->input['id_img'],
                $user->getUserId()
            );

            if($exist_img){

                // Тут проверяем и формируем 1 или несколько картинок для записи
                $this->input['load_img'] = LoadFileImg::getImgString(
                    $this->input['load_img'],
                    $user,
                    $this->user['id_group'],
                    $api
                );

                if($api->getData('error_status') != 'true'){

                    LoadFileImg::deleteImg($exist_img[0]->path_img);
                    LoadFileImg::deleteImgOnId(
                        $this->input['id_img'],
                        $user->getUserId()
                    );

                    if($api->chechInput($this->input, 'id_advert') === true){

                        // Удаляем из строки картинку, которую передали в del_img
                        $this->input['load_img'] = str_replace(',"'.$this->input['del_img'].'"', '', str_replace('"'.$this->input['del_img'].'",', '', $this->input['load_img']));
                        $user->updateProjectImg($this->input);

                    }

                    $api->setData('error_status', 'false');

                }

            }else{

                $api->setData('error_status', 'true');
                $api->setData('error_message', 'Вы пытаетесь удалить файл, которого не существует!');

            }

        }

        return $api->getJson();

    }
    public function settings(){

        if(isset($this->user['id_group'])){

            $user = new $this->profile_types_array[$this->user['id_group']]();
            $user->setRequest($this->request);

            $this->profile = $user->initSetting();

        }else{

            $this->profile = ErrorsController::getError('У вас нет прав для доступа к данной странице!');

        }

        return $this->getProfile();

    }
    public function adverts($advert_id = null){

        if(isset($this->user['id_group'])){

            $user = new $this->profile_types_array[$this->user['id_group']]();
            $user->setRequest($this->request);

            if($advert_id === null)
                $this->profile = $user->initAdverts();
            else
                $this->profile = $user->initAdvertsOnId($advert_id);

        }else{

            $this->profile = ErrorsController::getError('У вас нет прав для доступа к данной странице!');

        }

        return $this->getProfile();

    }
    public function dialogs($dialog_id = null){

        if(isset($this->user['id_group'])){

            $user = new $this->profile_types_array[$this->user['id_group']]();
            $user->setRequest($this->request);

            if($dialog_id === null)
                $this->profile = $user->initDialogs();
            else
                $this->profile = $user->initDialogsOnId($dialog_id);

        }else{

            $this->profile = ErrorsController::getError('У вас нет прав для доступа к данной странице!');

        }

        return $this->getProfile();

    }
    public function paymentAdvert(){

        $api = new ApiController();

        $api->paymentAdvert($this->input);

        if($api->getData('error_status') != 'true'){

            $user = new $this->profile_types_array[$this->user['id_group']]();
            $user->setRequest($this->request);
            $user->setUserInfo();
            $user->getUser();

            if($this->input['type_payment'] == '1'){

                // Тут оплата робокассой

            }elseif($this->input['type_payment'] == '2'){

                // Тут оплата со счета в личном кабинете
                if($user->paymentInProfile($this->input, $api) === true){

                    // Обновляем объявление и его статус
                    if($user->updateProjectStatus($this->input, '3') === false){

                        $api->setData('error_status', 'false');

                    }else{

                        $api->setData('error_status', 'true');
                        $api->setData('error_message', 'Возникла ошабка при обновлении объвления!');

                    }

                    $api->setData('error_status', 'false');
                    $api->setData('error_message', 'Информация успешно обновлена!');

                }

            }else{

                $api->setData('error_status', 'true');
                $api->setData('error_message', 'Возникла непонятная ошибка!');

            }

        }

        return $api->getJson();

    }
    public function payment($advert_id){

        if(isset($this->user['id_group'])){

            $user = new $this->profile_types_array[$this->user['id_group']]();
            $user->setRequest($this->request);

            $this->profile = $user->initPaymentAdvertOnId($advert_id);

        }else{

            $this->profile = ErrorsController::getError('У вас нет прав для доступа к данной странице!');

        }

        return $this->getProfile();

    }
    public function advertCreate(){

        if(isset($this->user['id_group'])){

            $user = new $this->profile_types_array[$this->user['id_group']]();
            $user->setRequest($this->request);

            $this->profile = $user->initAdvertCreate();

        }else{

            $this->profile = ErrorsController::getError('У вас нет прав для доступа к данной странице!');

        }

        return $this->getProfile();

    }
    public function updateAdvert(){

        $api = new ApiController();
        $api->updateAdvert($this->input, $this->user['id_group']);

        if($api->getData('error_status') != 'true'){

            $user = new $this->profile_types_array[$this->user['id_group']]();
            $user->setRequest($this->request);
            $user->setUserInfo();
            $user->getUser();

            // Тут проверяем и формируем 1 или несколько картинок для записи
            $this->input['load_img'] = LoadFileImg::getImgString(
                $this->input['load_img'],
                $user,
                $this->user['id_group'],
                $api
            );

            if($user->updateProject($this->input) === false){

                $api->setData('error_status', 'true');
                $api->setData('error_message', 'Возникла ошабка при обновлении объвления!');

            }else{

                LoadFileImg::updateImgOnId(
                    $this->input['load_img'],
                    $user->getUserId()
                );

                $api->setData('error_status', 'false');

            }

        }

        return $api->getJson();

    }
    public function sendMessage(){

        $api = new ApiController();
        $api->sendMessage($this->input);

        if($api->getData('error_status') != 'true'){

            $user = new $this->profile_types_array[$this->user['id_group']]();
            $user->setRequest($this->request);
            $user->setUserInfo();
            $user->getUser();

            $id_message = $user->setMessage($this->input);

            if($id_message === false){

                $api->setData('error_status', 'true');
                $api->setData('error_message', 'Возникла ошабка при обновлении объвления!');

            }else{

                $api->setData('datetime_message', date("Y-m-d H:i:s"));
                $api->setData('id_message', $id_message);
                $api->setData('error_status', 'false');

            }

        }

        return $api->getJson();

    }
    public function sendDialogInvestor(){

        $api = new ApiController();
        $api->sendDialog($this->input);

        if($api->getData('error_status') != 'true'){

            $user = new $this->profile_types_array[$this->user['id_group']]();
            $user->setRequest($this->request);
            $user->setUserInfo();
            $user->getUser();

            $info = $user->getInvestorProjectForDialog($this->input['id_advert']);

            $this->input['id_to_user'] = $info[0]->id_user_info;
            $id_tiket = $user->setDialog($this->input);

            if($id_tiket === false){

                $api->setData('error_status', 'true');
                $api->setData('error_message', 'Возникла ошабка при обновлении объвления!');

            }else{

                $api->setData('ticket_id', $id_tiket);
                $api->setData('error_status', 'false');

            }

        }

        return $api->getJson();

    }
    public function sendDialogBusinessman(){

        $api = new ApiController();
        $api->sendDialog($this->input);

        if($api->getData('error_status') != 'true'){

            $user = new $this->profile_types_array[$this->user['id_group']]();
            $user->setRequest($this->request);
            $user->setUserInfo();
            $user->getUser();

            $info = $user->getBusinessProjectForDialog($this->input['id_advert']);

            $this->input['id_to_user'] = $info[0]->id_user_info;
            $id_tiket = $user->setDialog($this->input);

            if($id_tiket === false){

                $api->setData('error_status', 'true');
                $api->setData('error_message', 'Возникла ошабка при обновлении объвления!');

            }else{

                $api->setData('ticket_id', $id_tiket);
                $api->setData('error_status', 'false');

            }

        }

        return $api->getJson();

    }
    public function showPhoneInvestor(){

        $api = new ApiController();

        if(isset($this->user['id_group'])){

            if($api->chechInput($this->input, 'id_advert') === true){

                $user = new $this->profile_types_array[$this->user['id_group']]();
                $user->setRequest($this->request);
                $user->setUserInfo();
                $user->getUser();

                $info = $user->getInvestorProjectPhone($this->input['id_advert']);

                if($info){

                    //feedbacks_investor_proj

                    $phone = (empty($info[0]->phone_investor_proj) ? $info[0]->user_info_phone : $info[0]->phone_investor_proj);

                    $this->input['feedbacks'] = ($info[0]->feedbacks_investor_proj + 1);
                    FevInvestmentProject::updateProjectFeedBack($this->input);

                    $api->setData('error_status', 'false');
                    $api->setData('phone', $phone);

                }else{

                    $api->setData('error_status', 'true');
                    $api->setData('error_message', 'Ошибка загрузки пользователя!');

                }

            }

        }else{

            $api->setData('error_status', 'true');
            $api->setData('error_message', 'Войдите или Зарегистрируйтесь!');

        }

        return $api->getJson();

    }
    public function showPhoneBusinessman(){

        $api = new ApiController();

        if(isset($this->user['id_group'])){

            if($api->chechInput($this->input, 'id_advert') === true){

                $user = new $this->profile_types_array[$this->user['id_group']]();
                $user->setRequest($this->request);
                $user->setUserInfo();
                $user->getUser();

                $info = $user->getBusinessProjectPhone($this->input['id_advert']);

                if($info){

                    //feedbacks_investor_proj

                    $phone = (empty($info[0]->phone_business_proj) ? $info[0]->user_info_phone : $info[0]->phone_business_proj);

                    $this->input['feedbacks'] = ($info[0]->feedbacks_business_proj + 1);
                    FevBusinessmanProject::updateProjectFeedBack($this->input);

                    $api->setData('error_status', 'false');
                    $api->setData('phone', $phone);

                }else{

                    $api->setData('error_status', 'true');
                    $api->setData('error_message', 'Ошибка загрузки пользователя!');

                }

            }

        }else{

            $api->setData('error_status', 'true');
            $api->setData('error_message', 'Войдите или Зарегистрируйтесь!');

        }

        return $api->getJson();

    }
    public function replayAdvert(){

        $api = new ApiController();

        if($api->chechInput($this->input, 'id_advert') === true){

            $user = new $this->profile_types_array[$this->user['id_group']]();
            $user->setRequest($this->request);
            $user->setUserInfo();
            $user->getUser();

            if($user->updateProjectStatus($this->input, '0') === false){

                $api->setData('error_status', 'true');
                $api->setData('error_message', 'Возникла ошабка при обновлении объвления!');

            }else{

                $api->setData('error_status', 'false');

            }

        }

        return $api->getJson();

    }
    public function arhivesAdvert(){

        $api = new ApiController();

        if($api->chechInput($this->input, 'id_advert') === true){

            $user = new $this->profile_types_array[$this->user['id_group']]();
            $user->setRequest($this->request);
            $user->setUserInfo();
            $user->getUser();

            if($user->updateProjectStatus($this->input, '2') === false){

                $api->setData('error_status', 'true');
                $api->setData('error_message', 'Возникла ошабка при обновлении объвления!');

            }else{

                $api->setData('error_status', 'false');

            }

        }

        return $api->getJson();

    }
    public function createAdvertForPayment(){

        $api = new ApiController();
        $api->createAdvert($this->input);

        $user = new $this->profile_types_array[$this->user['id_group']]();
        $user->setRequest($this->request);
        $user->setUserInfo();
        $user->getUser();

        // Тут проверяем и формируем 1 или несколько картинок для записи
        $img = LoadFileImg::getImgString(
            $this->input['load_img'],
            $user,
            $this->user['id_group'],
            $api
        );

        if($img !== false AND $api->getData('error_status') != 'true'){

            $this->input['load_img'] = $img;

            if($user->setProject($this->input) === false){

                $api->setData('error_status', 'true');
                $api->setData('error_message', 'Возникла ошабка при добавлении объвления!');

            }else{

                $api->setData('error_status', 'false');
                $api->setData('advert_id', $user->advert_id);

            }

        }

        return $api->getJson();

    }
    public function getSubActivities(){

        $api = new ApiController();
        $user = new $this->profile_types_array[$this->user['id_group']]();

        if($api->chechInput($this->input, 'id_activity') === true){

            $sub_activities = ApiController::getSubActivities(
                $user->getSubActivityTypes($this->input['id_activity'])
            );

            $api->setData('error_status', 'false');
            $api->setData('sub_activities', $sub_activities);

        }

        return $api->getJson();

    }
    public function registrationInvestor(){

        $api = new ApiController();
        $api->registration($this->input);

        if($api->getData('error_status') != 'true'){

            $user = new $this->profile_types_array[2]();

            if($user->getTrueIsEmailExist($this->input['mail_investor']) === true){

                $api->setData('error_status', 'true');
                $api->setData('error_message', 'Данный email адрес уже существует!');

            }else{

                if($user->passwordsIdentical($this->input) === false){

                    $api->setData('error_status', 'true');
                    $api->setData('error_message', 'Введенные пароли не совпадают!');

                }else{

                    $registration = $user->registration($this->input);
                    if($registration === false){

                        $api->setData('error_status', 'true');
                        $api->setData('error_message', 'Возникла ошибка при регистрации!');

                    }else{

                        $api->setData('error_status', 'false');
                        $api->setData('success_message', 'Вы успешно зарегистрировались на нашем сайте!<br>Теперь Вы можете <a href="/login">Авторизоваться</a>');

                    }

                }

            }

        }

        return $api->getJson();

    }
    public function registrationBusinessman(){

        $api = new ApiController();
        $api->registration($this->input);

        if($api->getData('error_status') != 'true'){

            $user = new $this->profile_types_array[4]();

            if($user->getTrueIsEmailExist($this->input['mail_investor']) === true){

                $api->setData('error_status', 'true');
                $api->setData('error_message', 'Данный email адрес уже существует!');

            }else{

                if($user->passwordsIdentical($this->input) === false){

                    $api->setData('error_status', 'true');
                    $api->setData('error_message', 'Введенные пароли не совпадают!');

                }else{

                    $registration = $user->registration($this->input);
                    if($registration === false){

                        $api->setData('error_status', 'true');
                        $api->setData('error_message', 'Возникла ошибка при регистрации!');

                    }else{

                        $api->setData('error_status', 'false');
                        $api->setData('success_message', 'Вы успешно зарегистрировались на нашем сайте!<br>Теперь Вы можете <a href="/login">Авторизоваться</a>');

                    }

                }

            }

        }

        return $api->getJson();

    }
    public function getProfile(){

        return $this->profile;

    }

}
