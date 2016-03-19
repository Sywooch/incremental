<?php

namespace frontend\controllers;

use Yii;
use app\models\Game;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

//For RBAC
use yii\filters\AccessControl;
use common\models\User;

use app\models\Incrementable;
use app\models\IncrementableConnections;

/**
 * GameController implements the CRUD actions for Game model.
 */
class GameController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'view-world'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::userIsBryant();
                        }
                    ],
                    [
                        'actions' => ['view-world'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Game models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Game::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Game model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionViewWorld($message="", $messageType="none")
    {
        $model = Game::find()->where(['user'=>Yii::$app->user->identity->id])->one();
        return $this->render('viewUser', [
            'model' => $model,
            'message' => $message,
            'messageType' => $messageType,
        ]);
    }
    
    public function actionViewGame($id)
    {
        return $this->render('viewUser', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionViewIncrementables($id)
    {
        $game = $this->findModel($id);
        $dataProvider = new ActiveDataProvider([
            'query' => Incrementable::find(),
        ]);
        $dataProvider2 = new ActiveDataProvider([
            'query' => IncrementableConnections::find()->where(['owner' => $game->user]),
        ]);
        $userIsOwner = false;
        if(!Yii::$app->user->isGuest && ($game->user == Yii::$app->user->identity->id))
            $userIsOwner = true;

        return $this->render('viewIncrementables', [
            'model' => $game,
            'incrementableProvider' => $dataProvider,
            'userIsOwner' => $userIsOwner,
        ]);
    }

    /**
     * Creates a new Game model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Game();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Game model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Game model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Game model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Game the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Game::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    //Performs purchase and returns information for the ajax folder.
    //Called by ajax script in 'js/incremental-controller.js'. Never navigated to.
    public function actionPurchaseIncrementable()
    {
        //Get our game.
        $game = Game::findOne(intval($_POST['game']));
        //Update game points.
        $game->updatePoints();
        $incrementableId = $_POST['incrementable'];
        $incrementable = Incrementable::findOne($incrementableId);
        //Perform purchase.
        $purchaseWasSuccessful = $game->purchaseIncrementable($incrementableId);
        //Determine our error/success status.
        $message = "null";
        if($purchaseWasSuccessful)
            $message = "success";
        else
        {
            if($incrementable->premiumCost > 0)
                $message = "prompt-premium";
            else
                $message = "failure";
        }
            
        //Determine our new info for this upgrade.
        $wasPremium = $incrementable->premiumCost > 0;
        $newLevel = $game->getLevelOfIncrementable($incrementableId);
        $incrementable = Incrementable::findOne($incrementableId);
        if($incrementable->premiumCost > 0)
            $newCost = $incrementable->getPremiumCostForLevel($newLevel);
        else
            $newCost = $incrementable->getCostForLevel($newLevel);
        $newProduction = $incrementable->getProductionForLevel($newLevel);
        $newGamePoints = $game->points;
        $newGameProduction = $game->getPointsPerUpdate();
        $newName = $incrementable->name;
        $newBio = $incrementable->urlBio;
        $newPremium = $game->premium;
        echo json_encode([$message, $newLevel, $newCost, $newProduction, $newGamePoints, $newGameProduction, $newName, $newBio, $newPremium]); exit;
    }
    
    //Performs purchase of tap upgrade and returns information for the ajax.
    //Called by ajax script in 'js/incremental-controller.js'. Never navigated to.
    public function actionPurchaseTapUpgrade()
    {
        //Get our game.
        $game = Game::findOne(intval($_POST['game']));
        //Update game points.
        $game->updatePoints();
        //Perform purchase.
        $purchaseWasSuccessful = $game->upgradeTap();
        //Determine our error/success stats.
        $message = "null";
        if($purchaseWasSuccessful)
            $message = "success";
        else
            $message = "failure";
        //Determine our new info for this upgrade.
        $newTapCost = $game->getCostToUpgradeClick();
        $newTapValue = $game->getPointsPerClick();
        $newPoints = $game->points;
        echo json_encode([$message, $newTapCost, $newTapValue, $newPoints]); exit;
    }
    
    public function actionPerformTap()
    {
        //Get our game.
        $game = Game::findOne(intval($_POST['game']));
        //Store our tap for later.
        $game->tapCount += 1;
        $game->save();
        //Calculate our tap value.
        $tapValue = $game->getPointsPerClick();
        echo json_encode([$tapValue]); exit;
    }
    
    public function actionPurchaseEfficiencyUpgrade($costToUpgrade = 1000, $efficiencyIncrease = 0.2)
    {
        //Get our game.
        $game = Game::findOne(intval($_POST['game']));
        //Check funds.
        $message = "failure";
        $newPremium = 0;
        $newEfficiency = 0;
        $newIncrement = 0;
        if($game->premium >= $costToUpgrade)
        {
            $game->premium -= $costToUpgrade;
            $game->efficiency += $efficiencyIncrease;
            $game->save();
            $message = 'success';
            $newPremium = $game->premium;
            $newEfficiency = ($game->efficiency * 100) - 60;
            $newIncrement = $game->getPointsPerUpdate();
        }
        echo json_encode([$message, $newPremium, $newEfficiency, $newIncrement]); exit;
    }
}
