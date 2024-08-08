<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use app\models\User;
use webvimark\modules\UserManagement\components\GhostAccessControl;
use yii\web\UnauthorizedHttpException;
use yii\web\ServerErrorHttpException;
use yii\base\Model;
use yii\helpers\Url;
use yii\rest\ActiveController;

class ApiPatientController extends ActiveController
{

    /**
     * @var string the scenario to be assigned to the new model before it is validated and saved.
     */
    public $scenario = Model::SCENARIO_DEFAULT;

    /**
     * @var string the name of the view action. This property is needed to create the URL when the model is successfully created.
     */
    public $viewAction = 'view';

    public $checkAccess;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => (Yii::$app->request->headers['authorization']) ? HttpBearerAuth::className() : GhostAccessControl::class,
        ];

        // Выводим в браузер данные в JSON формате
        $behaviors['contentNegotiator'] = [
            'class' => yii\filters\ContentNegotiator::className(),
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
                // 'application/xml' => \yii\web\Response::FORMAT_XML,
            ],
            'languages' => [
                'en',
                'de',
            ],
        ];

        return $behaviors;
    }

    public function beforeAction($action)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    public function init()
    {

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $mUser = User::getCurrentUser();

        // Тут как раз указыаем что только пользователи с ролью user могут пользоваться API
        // НО ЕСТЬ НЮАНС - из-за RBAC модуля (GhostAccessControl) мы должны добавлять все страницы с API
        // для того пользователя который у нас работает, 
        // иначе будет работать только через Postman, через браузер не будет
        // Суперадмин работает и там и там без добавления URl адресов!
        if ($mUser && !$mUser::hasRole('user')) {
            throw new UnauthorizedHttpException();
        }

    }

    public function actions()
    {
        $actions = parent::actions();

        // Удаляем дефолтные экшены "delete", "update", "create"
        unset($actions['delete'], $actions['update'], $actions['create']);

        // Добавим фильтрацию чтобы where в запросе работало
        // Фитры есть тут https://www.yiiframework.com/doc/guide/2.0/en/rest-filtering-collections
        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => $this->modelClass,
        ];

        return $actions;
    }

    /**
     *  Создадим свой экшен create
     * 
     */
    public function actionCreate()
    {

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        /* @var $model \yii\db\ActiveRecord */
        $model = new $this->modelClass([
            'scenario' => $this->scenario,
        ]);

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', $model->getPrimaryKey(true));
            $response->getHeaders()->set('Location', Url::toRoute([$this->viewAction, 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

        // array_filter просто удалит несуществующие значения массива
        // Формат вывода параметров json находиться в components->response конфиг файла
        return array_filter([
            'id' => $model->id,
            'errors' => $model->errors
        ]);

    }

    public $modelClass = 'app\models\Patient';
}
