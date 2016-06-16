<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');

/**
 * User Model
 *
 * @property Userstatus $Userstatus
 * @property Role $Role
 * @property Title $Title
 * @property Applicant $Applicant
 * @property Log $Log
 * @property Order $Order
 * @property Payment $Payment
 */
class User extends AppModel
{

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    public $virtualFields = array('name' => "CONCAT_WS(' ', User.first_name, User.middle_name, User.last_name)");

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array('userstatus_id' => array('numeric' => array('rule' => array('numeric'), 'message' => 'Your custom message here', 'allowEmpty' => false, 'required' => true, //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
    ), 'notEmpty' => array('rule' => array('notEmpty'), 'message' => 'Your custom message here', 'allowEmpty' => false, //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
    ),), 'role_id' => array('notEmpty' => array('rule' => array('notEmpty'), 'message' => 'Your custom message here', 'allowEmpty' => false, //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
    ), 'numeric' => array('rule' => array('numeric'), //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
    ),), 'title_id' => array('numeric' => array('rule' => array('numeric'), //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
    ), 'notEmpty' => array('rule' => array('notEmpty'), //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
    ),), 'email' => array('mustUnique' => array('rule' => 'isUnique', 'message' => 'This email is already registered',), 'email' => array('rule' => array('email'), //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
    ), 'notEmpty' => array('rule' => array('notEmpty'), //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
    ),), 'password' => array('minLength' => array('rule' => array('minLength', 6), //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
    ), 'maxLength' => array('rule' => array('maxLength', 255), //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
    ),), 'first_name' => array('notEmpty' => array('rule' => array('notEmpty'), //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
    ), 'minLength' => array('rule' => array('minLength', 2), //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
    ),), 'middle_name' => array('maxLength' => array('rule' => array('maxLength', 255), //'message' => 'Your custom message here',
        'allowEmpty' => true, 'required' => false, //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
    ),), 'last_name' => array('minLength' => array('rule' => array('minLength', 2), //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
    ), 'notEmpty' => array('rule' => array('notEmpty'), //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
    ),),);

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Userstatus' => array('className' => 'Userstatus', 'foreignKey' => 'userstatus_id', 'conditions' => '', 'fields' => '', 'order' => ''),
        'Role' => array('className' => 'Role', 'foreignKey' => 'role_id', 'conditions' => '', 'fields' => '', 'order' => ''),
        'Title' => array('className' => 'Title', 'foreignKey' => 'title_id', 'conditions' => '', 'fields' => '', 'order' => ''),
        'Customer' => array('className' => 'Customer', 'foreignKey' => 'customer_id', 'conditions' => '', 'fields' => '', 'order' => 'Customer.name')
    );

    /**
     * hasMany associations
     *
     * @var array
     */

    public function beforeSave($options = array())
    {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
        }
        return true;
    }

    function LoginValidate()
    {
        $validate1 = array('email' => array('mustNotEmpty' => array('rule' => 'notEmpty', 'message' => 'Please enter email')), 'password' => array('mustNotEmpty' => array('rule' => 'notEmpty', 'message' => 'Please enter password')));
        $this->validate = $validate1;
        return $this->validates();
    }

    /**
     * model validation array
     *
     * @var array
     */
    function RegisterValidate()
    {
        $validate1 = array('first_name' => array('mustNotEmpty' => array('rule' => 'notEmpty', 'message' => 'Please enter first name')), 'last_name' => array('mustNotEmpty' => array('rule' => 'notEmpty', 'on' => 'create', 'message' => 'Please enter last name')), 'email' => array('mustNotEmpty' => array('rule' => 'notEmpty', 'message' => 'Please enter email', 'last' => true), 'mustBeEmail' => array('rule' => array('email'), 'message' => 'Please enter valid email', 'last' => true), 'mustUnique' => array('rule' => 'isUnique', 'message' => 'This email is already registered',)), 'password' => array('mustNotEmpty' => array('rule' => 'notEmpty', 'message' => 'Please enter password', 'on' => 'create', 'last' => true), 'mustBeLonger' => array('rule' => array('minLength', 6), 'message' => 'Password must be greater than 5 characters', 'on' => 'create', 'last' => true), 'mustMatch' => array('rule' => array('verifies'), 'message' => 'Both passwords must match'), //'on' => 'create'
        ));
        $this->validate = $validate1;
        return $this->validates();
    }

    /**
     * Used to match passwords
     *
     * @access protected
     * @return boolean
     */
    public function verifies()
    {
        return ($this->data['User']['password'] === $this->data['User']['cpassword']);
    }

    /**
     * Used to generate activation key
     *
     * @access public
     * @param string $password user password
     * @return hash
     */
    public function getActivationKey($id)
    {
        $salt = Configure::read("Security.salt");
        return md5(md5($id) . $salt);
    }

    public function invite($user, $reinvite = false)
    {
        $name = $this->getNameById($user['User']['id']);
        $role = $this->getRoleById($user['User']['id']);

        $activate_key = $this->getActivationKey($user['User']['id'] . $user['User']['password']);

        $link = Router::url("/users/activate?ident=" . $user['User']['id'] . "&activate=" . $activate_key, true);

        if ($reinvite) {
            $body = "Beste " . $name . ",

We have noticed that you haven’t accepted our invitation to register for ICG 2015 yet. Because our organisation has done an upgrade to the invitation and registration process,
previous send invite e-mails are now invalid.

In this e-mail you will find your new invitation link: <a href='" . $link . "'>" . $link . "</a>

Please, be aware that registration needs to be completed on the 1st of Februari 2015.

If there are any questions, please contact us at <a href='mailto:app@topeventsregioalkmaar.nl'>app@topeventsregioalkmaar.nl</a>.

We are very happy to welcome you in Alkmaar!

";

        } else {
            if ($role == 'hod') {
                $body = "Beste " . $name . ",

You have accept the invitation of Alkmaar to participate in the 49th International Children's Games in 2015.

Because you pre-registered your city, we are assuming that you are the Head of Delegation (HOD) who will also register your complete team. If you are not the HOD who will be register your team, please forward this message to the real HOD.

If you are the HOD: you can now register your city in our ICG Alkmaar App. Go to this link: <a href='" . $link . "'>" . $link . "</a> and create your own password to log in.

We are very happy to welcome you in Alkmaar!

";
            } else {
                $body = "Dear " . $name . ",

Alkmaar wants to invite you to the 49th International Children's Games from the 24th of June till the 29th of June 2015. To register for the Games, please accept this invitation to join the ICG registration App.

Go to this link: <a href='" . $link . "'>" . $link . "</a> and create your own password to log in.

We are very happy to welcome you in Alkmaar!

";
            }
        }

        $Email = new CakeEmail('default');
        $Email->to($user['User']['email'], $name);
        $Email->subject('Uitnodiging');

        try {
            $result = $Email->send($body);
        } catch (Exception $ex) {
            // we could not send the email, ignore it
            $result = false;
        }
        $this->log($result, LOG_DEBUG);
        return $result;
    }

    public function forgotPassword($user)
    {
        $name = $this->getNameById($user['User']['id']);

        $activate_key = $this->getActivationKey($user['User']['id'] . $user['User']['password']);

        $link = Router::url("/users/activatepassword?ident=" . $user['User']['id'] . "&activate=" . $activate_key, true);

        $body = "Dear " . $name . ",
		
Let's help you get signed in. You have requested to have your password reset on " . $user['User']['email'] . ". Please click the link below to reset your password now :

" . $link . "

If the above link does not work please copy and paste the URL link (above) into your browser address bar to get to the Page to reset your password.

Choose a password you can remember and please keep it secure.";

        $Email = new CakeEmail('default');
        $Email->to($user['User']['email'], $name);
        $Email->subject('Somebody requested to reset your password for the ICG Alkmaar 2015 App');

        try {
            $result = $Email->send($body);
        } catch (Exception $ex) {
            // we could not send the email, ignore it
            $result = "Could not send registration email to userid-" . $userId;
        }
        $this->log($result, LOG_DEBUG);
    }

    public function getNameById($userId)
    {
        $res = $this->findById($userId);
        if (!empty($res['User']['middle_name'])) {
            return $res['User']['first_name'] . ' ' . $res['User']['middle_name'] . ' ' . $res['User']['last_name'];
        } else {
            return $res['User']['first_name'] . ' ' . $res['User']['last_name'];
        }
    }

    public function getRoleById($userId)
    {
        $res = $this->findById($userId);
        return $res['Role'];
    }

    public function getRoleByName($role)
    {
        $res = $this->Role->findByName($role);
        return $res['Role'];
    }

    public function getRoleNameById($userId)
    {
        $res = $this->findById($userId);
        return $res['Role']['name'];
    }

    public function getRoleDescriptionByName($role)
    {
        $res = $this->Role->findByName($role);
        return $res['Role']['description'];
    }

    public function getRoleIdByName($role)
    {
        $res = $this->Role->findByName($role);
        return $res['Role']['id'];
    }

    public function getTeamId($userId)
    {
        $res = $this->Applicant->findByUserId($userId);
        return $res['Applicant']['team_id'];
    }


}
