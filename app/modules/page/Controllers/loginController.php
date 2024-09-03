<?php

/**
 *
 */

class Page_loginController extends Page_mainController
{

    public function indexAction()
    {
        $this->setLayout('page_login');
        $contentModel = new Page_Model_DbTable_Content();
        //$this->_view->bannerprincipal= $contentModel->getList("content_section = 'Publicidad - Banner'","orden ASC");

    }

    public function loginAction()
    {
        $this->setLayout('blanco');
        $contentModel = new Page_Model_DbTable_Content();
        //$this->_view->contenido= $contentModel->getList("content_section = 'Inscribase'","orden ASC");

        $user = $this->_getSanitizedParam("cedula");
        $password = $this->_getSanitizedParam("clave");
        /* echo $user;
        echo $password; */
        
        $userModel = new Core_Model_DbTable_User();
        if ($userModel->autenticateUser($user, $password) == true) {
           
            
        
            $resUser = $userModel->searchUserByUser($user);
            Session::getInstance()->set("kt_login_id", $resUser->user_id);
            Session::getInstance()->set("kt_login_level", $resUser->user_level);
            Session::getInstance()->set("kt_login_user", $resUser->user_user);
            Session::getInstance()->set("kt_login_name", $resUser->user_names . " " . $resUser->user_lastnames);
            Session::getInstance()->set("kt_cargo", $resUser->user_cargo);
            if ($resUser->user_level == 1 || $resUser->user_level == 2 || $resUser->user_level == 3 || $resUser->user_level == 4) {
                header("Location:/page/documentos/");
            }
        } else {

            header("Location:/page/login?cedula=" . $user . "&error=1");
        }
    }

    public function logoutAction()
    {
        //LOG
        $data['log_tipo'] = "LOGOUT";
        $logModel = new Administracion_Model_DbTable_Log();
        $logModel->insert($data);

        Session::getInstance()->set("kt_login_id", "");
        Session::getInstance()->set("kt_login_level", "");
        Session::getInstance()->set("kt_login_user", "");
        Session::getInstance()->set("kt_login_name", "");
        session_destroy();
        header('Location: /page/');
    }

    public function forgotpassword2Action()
    {
        $this->setLayout('blanco');
        $this->_csrf_section = "login_admin";
        $modelUser = new Core_Model_DbTable_User();
        $email = $this->_getSanitizedParam("email");
        $error = true;
        $message = "Usuario No encontrado";
        $filter = " user_email = '" . $email . "' ";
        $user = $modelUser->getList($filter, "")[0];
        $id = $user->user_id;
        Session::getInstance()->set("error_olvido", $message);
        if ($user) {
            $sendingemail = new Core_Model_Sendingemail($this->_view);
            $code = Session::getInstance()->get('csrf')['page_csrf'];
            $modelUser->editCode($id, $code);
            $user = $modelUser->getById($user->user_id);
            if ($sendingemail->forgotpassword2($user) == 1) {
                $error = 2;
                $message = "Se ha enviado a su correo un mensaje de recuperación de contraseña.";
                Session::getInstance()->set("mensaje_olvido", $message);
                Session::getInstance()->set("error_olvido", "");
            } else {
                $message = "Lo sentimos ocurrio un error y no se pudo enviar su mensaje";
                Session::getInstance()->set("error_olvido", $message);
            }
        }
        header('Location: /page/login/olvido');
    }

    public function olvidoAction()
    {
        $this->setLayout('page_login');
        $this->getLayout()->setTitle("¿Haz olvidado tu contraseña?");
        $id = Session::getInstance()->get("kt_login_id");
        $level = Session::getInstance()->get("kt_login_level");

        $csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
        $this->_view->csrf = $csrf;
        $this->_view->error_olvido = Session::getInstance()->get("error_olvido");
        Session::getInstance()->set("error_olvido", "");
        $this->_view->mensaje_olvido = Session::getInstance()->get("mensaje_olvido");
        Session::getInstance()->set("mensaje_olvido", "");
    }

    public function changepasswordAction()
    {


        $this->setLayout('page_login');

        $user = $this->validarCodigo();
        // print_r($user);
        if (isset($user['error'])) {
            if ($user['error'] == 1) {
                $this->_view->error = "Lo sentimos este codigo ya fue utilizado.";
            } else {
                $this->_view->error = "La información Suministrada es invalida.";
            }
        } else {
            $this->_view->usuario = $user['user']->user_user;
            new Core_Model_Csrf('nueva_contrasena');
            $csrf = Session::getInstance()->get('csrf')['nueva_contrasena'];
            $password = $this->_getSanitizedParam("password");
            $re_password = $this->_getSanitizedParam("re_password");
            if ($this->getRequest()->isPost() == true && $password == $re_password) {
                $id_user = $user['user']->user_id;
                $modelUser = new Core_Model_DbTable_User();
                $modelUser->changePassword($id_user, $password);
                $modelUser->editCode($id_user, $csrf);

                $this->_view->message = "Se ha cambiado su contraseña satisfactoriamente.";
            } else {
                $this->_view->code = $this->_getSanitizedParam("code");
                $this->_view->usuario = $user['user']->user_user;
                $this->_view->csrf = $this->_getSanitizedParam("csrf");
            }
        }
    }

    protected function validarCodigo()
    {
        $res = [];
        $code =  base64_decode($this->_getSanitizedParam("code"));
        if (isset($code) && $this->isJson($code) == true) {
            $code = json_decode($code, true);
            $modelUser = new Core_Model_DbTable_User();
            if (isset($code['user'])) {
                $user = $modelUser->getById($code['user']);
                if (isset($user->user_id)) {
                    if ($user->user_code == $code['code']) {
                        $res['user'] = $user;
                    } else {
                        $res['error'] =  1;
                        $res['user'] = $user;
                    }
                } else {
                    $res['error'] =  2;
                }
            } else {
                $res['error'] =  3;
            }
        } else {
            $res['error'] =  4;
        }
        return $res;
    }

    /**
     * verifica si una cadena es de tipo json
     * @param  string  $string cadena a evaluar
     * @return boolean    resultado de la evaluacion
     */
    private function isJson($string)
    {
        return ((is_string($string) && (is_object(json_decode($string)) || is_array(json_decode($string))))) ? true : false;
    }
}
