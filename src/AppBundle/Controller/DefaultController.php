<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Dealer;
use AppBundle\Entity\Vehicle;
use AppBundle\Extra\VehicleSearch;
use AppBundle\Form\VehicleSearchType;
use AppBundle\Form\VehicleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    private function clean($string){
        return trim(strip_tags($string));
    }

    private function cleanAll(array $strings){

        return array_map(function ($string)
        {
            if(is_array($string)){
                return $this->cleanAll($string);
            }elseif (is_string($string))
            {
                return $this->clean($string);
            }
            return $string;
        }, $strings);

    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $vehicles = $em->getRepository(Vehicle::class)
        ->findby([],['id' => 'DESC' ],8,0);

        return $this->render('default/index.html.twig', ['vehicles' => $vehicles ]);
    }


    /**
     * @Route("/search", name="search")
     */
    public function formSearchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        return $this->render('default/vehicle-search-form.html.twig');
    }



    /**
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("vehicule", name="vehicle")
     */
    public function vehicleActionShow(Request $request){
        $em = $this->getDoctrine()->getManager();
        $vehicles = $em->getRepository(Vehicle::class)->findAll();

        return $this->render('default/vehicle.html.twig',
            ['vehicles' => $vehicles, 'isSearch'=> false] );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("contactez-nous", name="contact_us")
     */
    public function contactAction(Request $request){

        if($request->getMethod() === 'POST'){
            $posts = $request->request->all();

            $posts = $this->cleanAll($posts);
            $verify = $this->verifyCaptcha($posts['g-recaptcha-response']);
//            if(false === $verify){
//                $this->addFlash('danger', 'Les robots sont bannis :) ');
//            }
            if( $this->checkRequired($posts) && $verify){
                $mailer = $this->get('mailer');
                $message = 'Vous venez de recevoir un message de :'.PHP_EOL;

                $message.= ( 'Nom : ' . $posts['user-name'].PHP_EOL.PHP_EOL );

                $message.= ( 'Email : ' . $posts['user-email'].PHP_EOL.PHP_EOL );

                $message.= ( 'Message : '.PHP_EOL.PHP_EOL );

                $message.= $posts['user-message'];

                $message = (new \Swift_Message('Message de contact utilisateur auto.ibohcompany.com'))
                    ->setFrom(['info@ibohcompany.com' => 'Auto-IBOH Company'])
                    ->setTo(['angemartialkoffi@gmail.com' => 'Ange Martial Koffi',
                        'eric997997@gmail.com' => 'Eric Léonard','info@ibohcompany.com' =>'Iboh Info' ])
                    ->setBody($message)
                    ->setReplyTo([ $posts['user-email'] =>  $posts['user-name'] ]);
                $mailer->send($message);

                $this->addFlash('success','Votre message a été envoyé avec succes');
            }

        }

        return $this->render('default/contact.html.twig');
    }
    function checkRequired(array $posts = []){
        $required = ['user-name', 'user-email', 'user-message', 'g-recaptcha-response'];

        foreach ($required as $name ) {
            if(false === array_key_exists($name, $posts)  || empty($posts[$name])){
                $this->addFlash('danger', 'Veuillez remplir le champs ' .$name);
                return false;
            }
        }
        return true;
    }

    private function verifyCaptcha($captchaResponse){
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $posts = [
            'response' => $captchaResponse,
            'secret' => "6LdqEXAUAAAAABrEH6vYlFlkOJDoFHoIpi13eYgb",
            'remoteip' => $_SERVER["REMOTE_ADDR"]
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $posts);

        $response = curl_exec($ch);

        if(curl_errno($ch)){
            return false;
        }


        $result = json_decode($response, true);

        return true === $result['success'];
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("vehicule-details/{id}", name="details_car")
     */
    public function detailsCarAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();

        $vehicle = $em->find(Vehicle::class, (int) $id);
        $dealer = $em->find(Dealer::class, (int) $id);

        if(null === $vehicle){
            throw $this->createNotFoundException('Vehicule non trouvé');
        }

        return $this->render('default/details-car.html.twig',['vehicle' => $vehicle, 'dealer' => $dealer]);

    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("ajouter-car", name="add_car")
     */
    public function addCarAction(Request $request,  $id = 0){

        $em = $this->getDoctrine()->getManager();

        if(0 === $id){
            $car = new Vehicle();
        }else{
            $car = $em->find(Vehicle::class, $id);
            if(null === $car){
                throw $this->createNotFoundException('Cet élément n\'existe pas en base de données');
            }
        }

        $form = $this->createForm(VehicleType::class, $car);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            /** @var Vehicle $car */
            $car = $form->getData();

            $em->persist($car);
            $em->flush();
            $this->addFlash('success', 'Véhicule ajouté ');
            return $this->redirectToRoute('app_homepage');
            }


        return$this->render('default/add-car.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/upload-from-dropzone", name="upload_from_dropzone")
     */
    public function uploadFromDropzoneAction(Request $request){
        $file = $request->files->get('file');
        return new JsonResponse($this->upload($file));
    }

    /**
     * @Route("/remove-upload", name="remove_upload")
     * @param Request $request
     * @return JsonResponse
     */
    public function removeUploadAction(Request $request){
        $file = $request->request->get('url');
        $filename = basename($file);
        $uploadDirectory = $this->getParameter('kernel.project_dir').'/web/uploads';
        try{
            unlink($uploadDirectory.'/'.$filename);
            $result = 'ok';
        }catch (\Exception $e){
            $result = $e->getMessage();
        }
        return new JsonResponse([$result]);
    }

    private function upload($file){
        if(null !== $file && $file instanceof UploadedFile){
            $extension = $file->guessClientExtension();
            $extension = $this->clean($extension);
            $uniqid = uniqid('', true);
            $uploadDirectory = $this->getParameter('kernel.project_dir').'/web/uploads';
            $filename = $uniqid.'.'.$extension;
            $file->move($uploadDirectory, $filename);
            return [
                'success' => true,
                'file' => $filename
            ];
        }

        return [
            'success' => false
        ];
    }



    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("search-vehicle", name="search_vehicle")
     */
    public function vehicleSearchAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $search = new VehicleSearch();
        $form = $this->createform(VehicleSearchType::class, $search);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $search = $form->getData();
            $repository = $em->getRepository(Vehicle::class);
            $result = $repository->search($search);

            return $this->render('default/vehicle.html.twig',
                ['vehicles' => $result,'page' => 1,'max' => 12, 'isSearch' => true]);
        }
        return $this->render('default/search-vehicle.html.twig',
            [
                'form' => $form->createView(),
                'search' => $search
            ]);
    }

}
