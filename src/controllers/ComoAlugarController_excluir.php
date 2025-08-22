<!-- 
namespace src\controllers;

use \core\Controller;
use src\handlers\Helper;
use src\models\CmsConfiguracao;
use \src\models\Script;

class ComoAlugarController extends Controller {

    public function __construct(){
        $conf =  CmsConfiguracao::first()->toArray();
         Helper::siteEmManutencao( $conf);
     }

    public function index() {
        $dados = [];
       

        $this->render('como-alugar', $dados);
    }

} -->
