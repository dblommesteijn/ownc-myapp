<?php
/**
 * ownCloud - myapp
 *
 * This file is licensed under the MIT License. See the COPYING file.
 *
 * @author Dennis Blommesteijn <dennis@blommesteijn.com>
 * @copyright Dennis Blommesteijn 2015
 */

namespace OCA\MyApp\Controller;

use OCP\IRequest;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;

class PageController extends Controller {

	private $userId;

	public function __construct($AppName, IRequest $request, $UserId){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
	}

	/**
	 * CAUTION: the @Stuff turns off security checks; for this page no admin is
	 *          required and no CSRF check. If you don't know what CSRF is, read
	 *          it up in the docs or you might create a security hole. This is
	 *          basically the only required method to add this exemption, don't
	 *          add it to any other method if you don't exactly know what it does
	 *
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function index() {
		$params = ['user' => $this->userId];
		return new TemplateResponse('myapp', 'main', $params);  // templates/main.php
	}

	/**
	 * Simply method that posts back the payload of the request
	 * @NoAdminRequired
	 */
	public function doEcho($echo) {
		return new DataResponse(['echo' => $echo]);
	}

	/**
	 * Simply method that posts back the payload of the request
	 * @NoAdminRequired
	 */
	public function publish(){
		$param = $this->request->getParams();
		if(!is_array($param)){
			return new DataResponse(["error"=>"expected array"]);
		}
		if(!array_key_exists('id', $param)){
			return new DataResponse(["error"=>"no `id` present"]);
		}
		$id = (int) $param['id'];
		if(!is_int($id)){
			return new DataResponse(["error"=>"expected integer"]);
		}
		$userId = \OC::$server->getUserSession()->getUser()->getUID();
		if(strlen($userId) <= 0){
			return new DataResponse(["error"=>"no `userId` present"]);
		}
		// create new publish job
		$job = new \OCA\MyApp\Transfer();
		// register transfer job
		\OC::$server->getJobList()->add($job, ["fileId" => $id, "userId" => $userId]);

		// TODO: respond with success
		return new DataResponse(["publish" => ["name" => ""]]);
	}


}