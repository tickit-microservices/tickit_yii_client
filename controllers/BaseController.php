<?php

namespace app\controllers;

use Yii;
use yii\base\Module;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Request;

class BaseController extends Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var string the name of the HTTP header containing the information about total number of data items.
     * This is used when serving a resource collection with pagination.
     */
    public $totalCountHeader = 'X-Pagination-Total-Count';

    /**
     * @var string the name of the HTTP header containing the information about total number of pages of data.
     * This is used when serving a resource collection with pagination.
     */
    public $pageCountHeader = 'X-Pagination-Page-Count';

    /**
     * @var string the name of the HTTP header containing the information about the current page number (1-based).
     * This is used when serving a resource collection with pagination.
     */
    public $currentPageHeader = 'X-Pagination-Current-Page';

    /**
     * @var string the name of the HTTP header containing the information about the number of data items in each page.
     * This is used when serving a resource collection with pagination.
     */
    public $perPageHeader = 'X-Pagination-Per-Page';

    /**
     * BaseController constructor.
     *
     * @param string $id
     * @param Module $module
     * @param array $config
     */
    public function __construct($id, Module $module, array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->request = Yii::$app->request;
    }

    /**
     * @param $action
     *
     * @return bool
     *
     * @throws BadRequestHttpException
     */
    public function beforeAction($action)
    {
        // TODO check this
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }
}
