<?php

namespace frontend\controllers;

use Yii;
use app\models\PremiumPackage;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

//For RBAC
use yii\filters\AccessControl;
use common\models\User;

//For Purchase
use app\models\Game;

/**
 * PremiumPackageController implements the CRUD actions for PremiumPackage model.
 */
class PremiumPackageController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::userIsBryant();
                        }
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
     * Lists all PremiumPackage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PremiumPackage::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PremiumPackage model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PremiumPackage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PremiumPackage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PremiumPackage model.
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
     * Deletes an existing PremiumPackage model.
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
     * Finds the PremiumPackage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PremiumPackage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PremiumPackage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    //Determine if purchase went through unmolested. If so, award premium. If not,
    //  award proportionate premium. Be sure to display PayPal required message.
    //  Redirect back to game view.
    public function actionThankYou()
    {
        //TODO log the transaction.
        $paypalreqs = "Your transaction has been completed and a receipt for your purchase has been emailed to you. ";
        $shamemessage = "";
        $messageType = "good";
        
        //Verify payment.
        $paymentAmount = $_GET['amt'];
        $packageId = $_GET['item_number'];
        $owner = $_GET['owner'];
        
        $package = PremiumPackage::findOne($packageId);
        $scalar = $paymentAmount / $package->costReal;
        $premiumPurchased = 0;
        if($scalar >= 1)
            $premiumPurchased = $package->premiumGained;
        else
        {
            $premiumPurchased = $package->premiumGained * $scalar;
            $shamemessage = "Through tom-foolery, you attempted to pay a fraction "
                    . "of the amount due. For your troubles you will be awarded "
                    . "only a fraction of the currency you were trying to cheat "
                    . "from the dwarves. ";
            $messageType = "bad";
        }
        
        //Generate message.
        $message = "Thank you for your purchase! ";
        $message .= $paypalreqs;
        $message .= $shamemessage;
        $message .= "You have been awarded $premiumPurchased special brew!";
        
        //Award premium.
        $game = Game::findOne($owner);
        $game->premium += $premiumPurchased;
        $game->save();
        
        //Go back to the game.
        $this->redirect(['game/view-world', 'message' => $message, 'messageType' => $messageType]);
    }
}
