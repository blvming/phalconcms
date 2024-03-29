<?php
/**
 * @author Uhon Liu http://phalconcmf.com <futustar@qq.com>
 */

namespace Backend\Media\Controllers;

use Phalcon\Mvc\View;
use Core\Utilities\MediaUpload;
use Core\BackendController;

/**
 * Class ManagerController
 *
 * @package Backend\Media\Controllers
 */
class ManagerController extends BackendController
{
    public function indexAction()
    {

    }

    public function newAction()
    {
        $this->view->setVar('max_file_upload', (int)ini_get("upload_max_filesize"));
    }

    public function uploadImageAction()
    {
        if($this->request->isAjax()) {
            if($files = $this->request->getUploadedFiles()) {
                $response = (new MediaUpload($files[0]))->response;
                if($response['code'] == 0){
                    // $this->response->setStatusCode(200, $response['msg']);
                } else {
                    $this->response->setStatusCode(406, $response['msg']);
                }
                $this->view->disableLevel(View::LEVEL_NO_RENDER);
            }
        }
    }
}