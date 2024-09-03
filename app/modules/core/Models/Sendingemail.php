<?php

/**
* Modelo del modulo Core que se encarga de  enviar todos los correos nesesarios del sistema.
*/
class Core_Model_Sendingemail
{
	/**
     * Intancia de la calse emmail
     * @var class
     */
    protected $email;

    protected $_view;

     public function __construct($view)
    {
        $this->email = new Core_Model_Mail();
        $this->_view = $view;
    }


    public function forgotpassword($user)
    {
        if ($user) {
            $code = [];
            $code['user'] = $user->user_id;
            $code['code'] = $user->code;
            $codeEmail = base64_encode(json_encode($code));
            $this->_view->url = "http://".$_SERVER['HTTP_HOST']."/administracion/index/changepassword?code=".$codeEmail;
           	$this->_view->host = "http://".$_SERVER['HTTP_HOST']."/";
            $this->_view->nombre = $user->user_names." ".$user->user_lastnames;
            $this->_view->usuario = $user->user_user;
            /*fin parametros de la vista */
            //$this->email->getMail()->setFrom("desarrollo4@omegawebsystems.com","Intranet Coopcafam");
            $this->email->getMail()->addAddress($user->user_email,  $user->user_names." ".$user->user_lastnames);
            $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/forgotpassword.php');
            $this->email->getMail()->Subject = "Recuperación de Contraseña Gestor de Contenidos";
            $this->email->getMail()->msgHTML($content);
            $this->email->getMail()->AltBody = $content;
            if ($this->email->sed()==true) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function forgotpassword2($user)
    {
        if ($user) {
            $code = [];
            $code['user'] = $user->user_id;
            $code['code'] = $user->code;
            $codeEmail = base64_encode(json_encode($code));
            $this->_view->url = "https://".$_SERVER['HTTP_HOST']."/page/login/changepassword?code=".$codeEmail; 
           	$this->_view->host = "https://".$_SERVER['HTTP_HOST']."/";
            $this->_view->nombre = $user->user_names." ".$user->user_lastnames;
            $this->_view->usuario = $user->user_user;
            $this->email->getMail()->addAddress($user->user_email,  $user->user_names." ".$user->user_lastnames);
            $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/forgotpassword.php');
            $this->email->getMail()->Subject = "Recuperación de Contraseña";
            $this->email->getMail()->msgHTML($content);
            $this->email->getMail()->AltBody = $content;
            if ($this->email->sed()==true) {
                return 1;
            } else {
                return 2; 
            }
        }
    }

}