<?php
	namespace backend\controllers;
	use Yii;
	use Yii\helpers\ArrayHelper;
	use backend\models\AdminUser;
	use backend\models\Role;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;
	use yii\filters\VerbFilter;
	use yii\filters\AccessControl;

	/*
	* Base class for all controllers
	*/
	class BaseController extends Controller
	{
	    /**
	     * Returns the ACL.
	     * @return Array
	     */
	    public function behaviors()
	    {
	        return [
	            'access' => [
	                'class' => AccessControl::className(),
	                'rules' => [
	                    [
	                        'allow' => true,    
	                        'roles' => self::getAllowedRoles(),
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
	     * Get all the roles that have access to this controller
	     * @return Array of all roles
	     */
	    private static function getAllowedRoles()
	    {
	        $auth = Yii::$app->authManager;
	        //'librarian' role has access to the entire system
	        //So add it
	        $roles = ['librarian']; //
	        $allRoles = self::array_delete(ArrayHelper::getColumn($auth->roles, 'name'), 'librarian');

	        $key = static::getKey();
	        //Get a list of all roles that are allowed access to the particular controller
	        foreach($allRoles as $role)
	        {
	            $permissions = $auth->getPermissionsByRole($role);

	            if (array_key_exists($key, $permissions))
	                array_push($roles, $role);
	        }
	        //Return the array of allowed roles
	        return $roles;
	    }

	    /**
	     * Utility fn to remove an element from an array
	     * @return Array without the deleted element
	     */
	    
	    private static function array_delete($array, $element)
	    {
	        return array_diff($array, [$element]);
	    }    
	}
?>
