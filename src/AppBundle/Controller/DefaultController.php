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

class DefaultController extends Controller
{
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
        return $this->render('default/contact.html.twig');
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
                ['vehicle' => $result,'page' => 1,'max' => 12, 'isSearch' => true]);
        }
        return $this->render('default/search-vehicle.html.twig',
            [
                'form' => $form->createView(),
                'search' => $search
            ]);
    }

}
