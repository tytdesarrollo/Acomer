<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\IndexForm;
use app\models\AsignaForm;
use yii\widgets\ActiveForm;
use yii\web\Response;
use app\models\FormSearch;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\helpers\Url;
use PDO;
use app\models\TwPcIdentity;
use app\models\TwPcPersonalData;
use app\models\PrbUsuario;
use app\models\Gen0011;
use app\models\Ldap;



class SiteController extends Controller
{ 	


	public function actionPrueba(){

		 $form = new FormSearch();
        $search = null; //valor de la busqueda que da el usuario
        if($form->load(Yii::$app->request->get())){ // si el formulario ha sido enviado
            if($form->validate()){ // si el formulario es valido
                $search = Html::encode($form->q); // guarda el valor de la busqueda del usuario
                $table = Gen0011::find()
                        ->where(["like", "TERCOD", $search])
                        ->orwhere(["like", "TERRAZ", $search])
                        ->orwhere(["like", "TERDIR", $search]);
                $count = clone $table;
                $pages = new Pagination([
                        "pageSize" => 1, // registros por pagina
                        "totalCount" => $count->count() //cantidad total de registros
                    ]);
                $model = $table->offset($pages->offset)->limit($pages->limit)->all();
            }else{
                $form->getErrors();
            }
        }else{
            $table = Gen0011::find();
            $count = clone $table;
            $pages = new Pagination([
                    "pageSize" => 3,
                    "totalCount" => $count->count()
                ]);
            $model = $table->offset($pages->offset)->limit($pages->limit)->all();
        }

        return $this->render("prueba",['model' => $model, 'form' => $form, 'search' => $search, 'pages' => $pages]);
	}	
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
		$recordar = null;
		
		$this->layout=false;       			
		
        $model = new IndexForm();
		
		$modeladp = new Ldap;
		
		$ladpcon = $modeladp->directorioactivo();
		
		if($ladpcon[2]=="false"){
			
			$recordar = "<a class='color-white' href='' data-toggle='modal' data-target='#recordarpass'>Olvidaste tu contraseña?</a>";
		}
		
		if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax){
			
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model);			
		}
		
		if($model->load(Yii::$app->request->post())){
		if($model->validate()){
			
			//Yii::$app->params['usuario'] = $model->usuario;
			//Yii::$app->params['clave'] = $model->clave;
			
			return $this->redirect(['site/logueo','usuario'=>$model->usuario,'clave'=>$model->clave,'operacion'=>'L']);
			
		}else{
			
			 return $this->goBack();
			 
			}		
		}
		
        return $this->render('index', ['model' => $model,'recordar' => $recordar]);
    }


}

