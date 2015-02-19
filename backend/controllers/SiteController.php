<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\models\DefaultSearch;
use common\models\Contracts;
use common\models\Accruals;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'contract-data', 'create-accruals'],
                        'allow' => TRUE,
                        'matchCallback' => '\common\models\User::hasBackendAccess'
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new DefaultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionContractData() {
        if (!empty(Yii::$app->request->post('expandRowKey'))) {
            $model = Contracts::findOne(Yii::$app->request->post('expandRowKey'));
            if($model){
                $query = $model->getAccruals();

                $accruals = new ActiveDataProvider([
                    'query' => $query,
                ]);
                
                $query = $model->getPayments();

                $payments = new ActiveDataProvider([
                    'query' => $query,
                ]);
                
                return $this->renderPartial('_contract-details', ['model'=>$model, 'accruals' => $accruals, 'payments' => $payments]);
            }
        }
            
        return '<div class="alert alert-danger">No data found</div>';
    }
    
    public function actionCreateAccruals(){
        $contracts = Contracts::find()->andWhere(['>', 'end_date', date('Y-m-d')])->andWhere(['<=', 'start_date', date('Y-m-d')])->all();
        foreach($contracts as $contract){
            
        }
        var_dump($contracts);
    }
}
