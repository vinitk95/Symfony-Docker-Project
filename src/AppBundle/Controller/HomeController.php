<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class HomeController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function homeAction(Request $request) {

        $userdets = $this->getDoctrine()
                ->getRepository('AppBundle:USER')
                ->findAll();
        return $this->render('mine/index.html.twig', [
                    'userdtls' => $userdets,
        ]);
    }

    /**
     * @Route("about/", name="about")
     */
    public function aboutAction(Request $request) {
        return $this->render('mine/about.html.twig');
    }

    /**
     * @Route("register/", name="register")
     */
    public function registerAction(Request $request) {

        $user = new \AppBundle\Entity\USER();
        $user->setEMAIL("");
        $user->setPASSWORD("");
        $array = array();
        for ($i = 1; $i <= 50; $i++) {
            $array[] = $i;
        }
        $form = $this->createFormBuilder($user)
                ->add('EMPID', TextType::class)
                ->add('NAME', TextType::class)
                ->add('EMAIL', TextType::class)
                ->add('PASSWORD', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'invalid_message' => 'The password fields must match.',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_options' => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'),
                ))
                ->add('EXPERIENCE', ChoiceType::class, array('choices' => $array))
                ->add('GENDER', ChoiceType::class, array(
                    'choices' => array(
                        'Male' => true,
                        'Female' => false,
                    ),
                ))
                ->add('ADDRESS', TextType::class)
                ->add('save', SubmitType::class, ['label' => 'Save'])
                ->add('reset', ResetType::class, array(
                    'attr' => array('class' => 'save'),
                ))
                ->getForm();


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            echo "Records updated successfully";
        }
        
        return $this->render('mine/register.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/lucky")
     */
    public function number() {
        $number = random_int(0, 100);

        return $this->render('mine/number.html.twig', [
                    'number' => $number,
        ]);
    }

    /**
     * @Route("login/", name="login")
     */
    public function loginAction(Request $request) {

        $admin = new \AppBundle\Entity\Admin();

        $form = $this->createFormBuilder($admin)
                ->add('username', TextType::class)
                ->add('passcode', PasswordType::class)
                ->add('save', SubmitType::class, ['label' => 'Login'])
                ->getForm();

        $form->handleRequest($request);
        $message="";
        if ($form->isSubmitted() && $form->isValid()) {

            $admin = $form->getData();
            $username = $form['username']->getData();
            $passcode = $form['passcode']->getData();
            $user=false;
            if(strcmp($username, 'admin')==0 && strcmp($passcode, '123')==0){
                $user=true;
            }
            
            
//            $doct = $this->getDoctrine()->getManager();
//
//            $user = $this->getDoctrine()
//                    ->getRepository('AppBundle:Admin')
//                    ->findOneBy(array('username' => $username, 'passcode' => $passcode));


            if ($user) {
                $response = $this->forward('AppBundle\Controller\HomeController::aboutRegistration');
                return $response;
            } else {
                $message= "Please enter valid Username or Password";
            }
        }

        return $this->render('mine/login.html.twig', [
                    'form' => $form->createView(),
        'message'=>$message]);
    }

    /**
     * @Route("manage/", name="manage")
     */
    public function aboutRegistration() {
//        $stud = $this->getDoctrine()
//                ->getRepository('AppBundle:USER')
//                ->findAll();
        return $this->render('mine/manage.html.twig');
    }

    /**
     * @Route("/delete/{id}") 
     */
    public function deleteAction($id) {
        $doct = $this->getDoctrine()->getManager();
        $stud = $doct->getRepository('AppBundle:USER')->find($id);

        if ($stud) {
            $doct->remove($stud);
            $doct->flush();
        }
        $response = $this->forward('AppBundle\Controller\HomeController::aboutRegistration');

        return $response;
    }

    /**
     * @Route("/show/{id}") 
     */
    public function getDetailsForUser($id, Request $request) {

        $doct = $this->getDoctrine()->getManager();
        $stud = $doct->getRepository('AppBundle:USER')->find($id);

        $user = new \AppBundle\Entity\USER();
        $user->setEMPID($stud->getEMPID());
        $user->setNAME($stud->getNAME());
        $user->setEMAIL($stud->getEMAIL());
        $user->setPASSWORD($stud->getPASSWORD());
        $user->setEXPERIENCE($stud->getEXPERIENCE());
        $user->setGENDER($stud->getGENDER());
        $user->setADDRESS($stud->getADDRESS());
        $array = array();
        for ($i = 0; $i <= 50; $i++) {
            $array[] = $i;
        }
        $form = $this->createFormBuilder($user)
                ->add('EMPID', TextType::class)
                ->add('NAME', TextType::class)
                ->add('EMAIL', TextType::class)
                ->add('PASSWORD', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'invalid_message' => 'The password fields must match.',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_options' => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'),
                ))
                ->add('EXPERIENCE', ChoiceType::class, array('choices' => $array))
                ->add('GENDER', ChoiceType::class, array(
                    'choices' => array(
                        'Male' => true,
                        'Female' => false,
                    ),
                ))
                ->add('ADDRESS', TextType::class)
                ->add('save', SubmitType::class, ['label' => 'Update'])
                ->add('reset', ResetType::class, array(
                    'attr' => array('class' => 'save'),
                ))
                ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $user = $form->getData();
             $doct = $this->getDoctrine()->getManager();
              $entityManager = $this->getDoctrine()->getManager();
              $stud1 = $doct->getRepository('AppBundle:USER')->find($id);
              if ($stud1) { 
              $stud1->setEMPID($user->getEMPID());
              $stud1->setNAME($user->getNAME());
              $stud1->setEMAIL($user->getEMAIL());
              $stud1->setPASSWORD($user->getPASSWORD());
              $stud1->setEXPERIENCE($user->getEXPERIENCE());
              $stud1->setGENDER($user->getGENDER());
              $stud1->setADDRESS($user->getADDRESS());
              $doct->flush();
              echo 'Records Updated Successfully';
              }else{
                  $user = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            echo "records created Successfully";
              }
            return $this->render('mine/register.html.twig', [
                    'form' => $form->createView(),
        ]);
        }

        return $this->render('mine/register.html.twig', [
                    'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/testing") 
     */
    public function testController(){
       
        return $this->render('mine/test.html.twig',array(
            'name'=>'',
            'mobileno'=>''
        ));
        
    }
    
    /**
     * @Route("/testingresult") 
     */
    public function getTestControllerData(){
        $name=$_POST['name'];
        $name=$name.'fasdfasdf';
        $mobileno=$_POST['mobileno'].'234234';
       
        return $this->render('mine/test.html.twig', array(
            'name'=>$name,
            'mobileno'=>$mobileno
        ));
    }

}
