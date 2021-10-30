<?php



namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//include_once "src/sms/smsc_api.php";

class SmsController extends AbstractController
{
    /**
     * @Route("/sms", name="sms")
     */
    public function index(): Response
    {

//        $balance = get_balance();
        $text2 = "русский текст";
        $text = mb_convert_encoding($text2, 'windows-1251', 'utf-8');
//        $result = send_sms("+79527606124", $text, 0,0,0,9,'malverdo');
//        $result = send_sms("+79524408777", "code", 1,0,0,10);


        return $this->render('sms/index.html.twig', [
            'controller_name' => 'SmsController',
        ]);
    }
}
