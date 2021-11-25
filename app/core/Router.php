<?
// routing class
// goal is to help load the appropriate file according to the url

class Router
{
	private $url = array();
	private $request = array();

	public function add($url, $req = null) {
		$this->url[] = '/' . trim($url, '/');

		if ($req != null) {
			$this->request[] = $req;
		}
	}

	public function submit(){
		$params = isset($_GET['uri']) ? '/'.$_GET['uri']: '/';

		foreach ($this->url as $key => $value) {
			if (preg_match("#^$value$#", $params)) {
				$file = $this->request[$key];
				
				if (file_exists('app/views/'.$file.'.php')) {
					include 'app/views/' . $file . '.php';
				} else {
					// show 404 error page or something
					die($file .'.php doesnt exist!');
				}
			}
		}
	}
}
