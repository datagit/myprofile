<?php

namespace FrontendBundle\Controller;

use DataSourceBundle\Utilities\ProfileHelper;
use FrontendBundle\Form\ProfileLoginType;
use DataSourceBundle\Entity\Profile;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class LayoutController extends BaseController
{

    public function renderFormLoginAction()
    {
        $profileInfo = $this->getProfile();
        if (!empty($profileInfo)) {
            return $this->render('FrontendBundle:_Partial:_profileinfo.html.twig',
                array('edit_profile_link' => $this->generateUrl('frontend_profile_edit'),
                    'logout_link' => $this->generateUrl('frontend_profile_logout'),
                    'email' => $profileInfo['email'],));
        } else {
            //form login
            return $this->render('FrontendBundle:_Partial:_formlogin.html.twig', array('action_login' => $this->generateUrl('frontend_profile_login')));
        }
    }

    public function loginsmAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $email = $request->request->get('email', '');
            $password = trim($request->request->get('password', ''));

            $result = $this->getDoctrine()
                ->getRepository('DataSourceBundle:Profile')
                ->createQueryBuilder('p')
                ->select('p')
                ->where('p.email = :email')
                ->setParameter('email', $email)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            if (empty ($result)) {
                return new JsonResponse(array('code' => 201, 'msg' => 'Login failed. Email or password invalid!'));
            }
            if ($result[0]['password'] != $password) {
                return new JsonResponse(array('code' => 202, 'msg' => 'Login failed. Email or password invalid!'));
            }
            if ($result[0]['status'] == 0) {
                return new JsonResponse(array('code' => 203, 'msg' => 'Login failed. Email was locked!'));
            }
            //store object to session
            $this->storeProfile($result[0]);
            return new JsonResponse(array('code' => 200, 'msg' => 'Login successful!'));
        }

        return new Response('This is not ajax!', 400);
    }

    public function logoutAction(Request $request)
    {
        $this->clearAll();
        return $this->redirectToRoute('frontend_homepage');
    }

    public function editAction(Request $request)
    {
        $profileInfo = $this->getProfile();
        if (!$profileInfo) {
            return $this->redirect($this->generateUrl('frontend_homepage'));
        }

        $entity = $this->getDoctrine()
            ->getRepository('DataSourceBundle:Profile')
            ->find($profileInfo['id']);
        if (empty($entity)) {
            throw $this->createNotFoundException('Unable to find Profile entity.');
        }

        //get list categoties for job title
        $categories = $this->getDoctrine()
            ->getRepository('DataSourceBundle:Category')
            ->findAll();
        $categoriesName = array();
        $myCategories = explode(',', $entity->getCategoriesJson());
        if (!empty($myCategories)) {
            foreach ($categories as $cat) {
                if (in_array($cat->getId(), $myCategories)) {
                    $categoriesName[] = $cat->getName();
                }
            }
        }

        return $this->render('FrontendBundle:Default:edit.html.twig',
            array('entity' => $entity,
                'link_update_profile' => $this->generateUrl('frontend_profile_update_profile'),
                'categories' => $categories,
                'current_categories' => implode(', ', $categoriesName),
                'link_update_jobs_history_profile' => $this->generateUrl('frontend_profile_update_jobs_history_profile'),
                'link_remove_jobs_history_profile' => $this->generateUrl('frontend_profile_remove_jobs_history_profile'),
                'link_update_skill_profile' => $this->generateUrl('frontend_profile_update_skill_profile'),
                'link_remove_skill_profile' => $this->generateUrl('frontend_profile_remove_skill_profile'),

                'link_update_education_profile' => $this->generateUrl('frontend_profile_update_education_profile'),
                'link_remove_education_profile' => $this->generateUrl('frontend_profile_remove_education_profile'),
                'link_update_photo_profile' => $this->generateUrl('frontend_profile_update_photo_profile'),
                'link_move_photo_profile' => $this->generateUrl('frontend_profile_move_photo_profile'),

            ));
    }

    public function updateProfileAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $profileInfo = $this->getProfile();
            if (empty($profileInfo)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataSourceBundle:Profile')
                ->find($profileInfo['id']);
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }


            $name = trim($request->request->get('name', ''));
            $value = $request->request->get('value', '');
            $pk = trim($request->request->get('pk', ''));

            switch ($name) {
                case 'firstName':
                    if (!empty($value)) {
                        $entity->setFirstName($value);
                    }
                    break;
                case 'lastName':
                    if (!empty($value)) {
                        $entity->setLastName($value);
                    }
                    break;
                case 'jobTitle':
                    if (!empty($value)) {
                        $entity->setJobTitle($value);
                    }
                    break;
                case 'birthday':
                    $entity->setBirthday($value);
                    break;
                case 'sex':
                    if ($value == '') {
                        $value = '0';
                    }
                    $entity->setSex($value);
                    break;
                case 'phone':
                    $entity->setPhone($value);
                    break;
                case 'summary':
                    $entity->setSummary($value);
                    break;
                case 'researchInterests':
                    $entity->setResearchInterests($value);
                    break;

                case 'categoriesJson':
                    if (!empty($value)) {

                    }
                    break;
            }
            $em->persist($entity);
            $em->flush();

            return new JsonResponse(array('status' => 200));
        }

        return new JsonResponse(array('status' => 400));
    }

    public function updateJobsHistoryProfileAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $profileInfo = $this->getProfile();
            if (empty($profileInfo)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataSourceBundle:Profile')
                ->find($profileInfo['id']);
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }
            $cid = $request->request->get('cid', '');
            $cname = $request->request->get('cname', '');
            $ctitle = $request->request->get('ctitle', '');
            $cstartTime = $request->request->get('cstart_time', '');
            $cendTime = $request->request->get('cend_time', '');
            $cdescription = $request->request->get('cdescription', '');
            $ccurrentJob = $request->request->get('ccurrent_job', 0);
            $corder = $request->request->get('corder', 0);

            $experience = (!$entity->getJobHistoryJson()) ? array() : json_decode($entity->getJobHistoryJson(), true);

            if (empty($corder)) {
                $corder = count($experience);
            }
            $key = ProfileHelper::getKeyById($experience, $cid);
            $item = array(
                'id' => $cid,
                'name' => $cname,
                'title' => $ctitle,
                'start_time' => $cstartTime,
                'end_time' => $cendTime,
                'description' => $cdescription,
                'current_job' => $ccurrentJob,
                'group' => '',
                'order' => $corder,
            );
            if ($key == -1) {
                //add new
                $item['id'] = time();
                $experience[] = $item;
            } else {
                //update
                if ($ccurrentJob == 1) {
                    $experience = ProfileHelper::resetCurrentJob($experience);
                }
                $experience[$key] = $item;
            }
            $entity->setJobHistoryJson(json_encode($experience));


            $em->persist($entity);
            $em->flush();

            $html = $this->render('@Frontend/Default/_jobs_history.html.twig',
                array('jobHistoryJson' => json_encode($experience)))->getContent();

            return new JsonResponse(array('status' => 200, 'html' => $html));
        }

        return new JsonResponse(array('status' => 400));
    }

    public function removeJobsHistoryProfileAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $profileInfo = $this->getProfile();
            if (empty($profileInfo)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataSourceBundle:Profile')
                ->find($profileInfo['id']);
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }
            $cid = $request->request->get('cid', '');

            $experience = (!$entity->getJobHistoryJson()) ? array() : json_decode($entity->getJobHistoryJson(), true);

            ProfileHelper::remove($experience, $cid);
            $entity->setJobHistoryJson(json_encode($experience));

            $em->persist($entity);
            $em->flush();

            $html = $this->render('@Frontend/Default/_jobs_history.html.twig',
                array('jobHistoryJson' => json_encode($experience)))->getContent();

            return new JsonResponse(array('status' => 200, 'html' => $html));
        }

        return new JsonResponse(array('status' => 400));
    }

    public function updateSkillProfileAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $profileInfo = $this->getProfile();
            if (empty($profileInfo)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataSourceBundle:Profile')
                ->find($profileInfo['id']);
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }
            $sid = $request->request->get('sid', '');
            $sname = $request->request->get('sname', '');
            $slevel = $request->request->get('slevel', '');
            $sverified = $request->request->get('sverified', '');

            $skills = (!$entity->getSkillJson()) ? array() : json_decode($entity->getSkillJson(), true);

            $key = ProfileHelper::getKeyById($skills, $sid);
            $item = array(
                'id' => $sid,
                'name' => $sname,
                'level' => $slevel,
                'verified' => $sverified,
            );
            if ($key == -1) {
                //add new
                $item['id'] = time();
                $skills[] = $item;
            } else {
                //update
                $skills[$key] = $item;
            }
            $entity->setSkillJson(json_encode($skills));


            $em->persist($entity);
            $em->flush();

            $html = $this->render('@Frontend/Default/_skill.html.twig',
                array('skillJson' => json_encode($skills)))->getContent();

            return new JsonResponse(array('status' => 200, 'html' => $html));
        }

        return new JsonResponse(array('status' => 400));
    }

    public function removeSkillProfileAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $profileInfo = $this->getProfile();
            if (empty($profileInfo)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataSourceBundle:Profile')
                ->find($profileInfo['id']);
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }
            $sid = $request->request->get('sid', '');

            $skill = (!$entity->getSkillJson()) ? array() : json_decode($entity->getSkillJson(), true);

            ProfileHelper::remove($skill, $sid);
            $entity->setSkillJson(json_encode($skill));

            $em->persist($entity);
            $em->flush();

            $html = $this->render('@Frontend/Default/_skill.html.twig',
                array('skillJson' => json_encode($skill)))->getContent();

            return new JsonResponse(array('status' => 200, 'html' => $html));
        }

        return new JsonResponse(array('status' => 400));
    }


    public function updateEducationProfileAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $profileInfo = $this->getProfile();
            if (empty($profileInfo)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataSourceBundle:Profile')
                ->find($profileInfo['id']);
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }
            $eid = $request->request->get('eid', '');
            $ename = $request->request->get('ename', '');
            $emajor = $request->request->get('emajor', '');
            $estartTime = $request->request->get('estart_time', '');
            $eendTime = $request->request->get('eend_time', '');
            $eorder = $request->request->get('eorder', 0);

            $education = (!$entity->getEducationJson()) ? array() : json_decode($entity->getEducationJson(), true);

            if (empty($eorder)) {
                $eorder = count($education);
            }
            $key = ProfileHelper::getKeyById($education, $eid);
            $item = array(
                'id' => $eid,
                'name' => $ename,
                'major' => $emajor,
                'start_time' => $estartTime,
                'end_time' => $eendTime,
                'order' => $eorder,
            );
            if ($key == -1) {
                //add new
                $item['id'] = time();
                $education[] = $item;
            } else {
                //update
                $education[$key] = $item;
            }
            $entity->setEducationJson(json_encode($education));


            $em->persist($entity);
            $em->flush();

            $html = $this->render('@Frontend/Default/_education.html.twig',
                array('educationJson' => json_encode($education)))->getContent();

            return new JsonResponse(array('status' => 200, 'html' => $html));
        }

        return new JsonResponse(array('status' => 400));
    }

    public function removeEducationProfileAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $profileInfo = $this->getProfile();
            if (empty($profileInfo)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataSourceBundle:Profile')
                ->find($profileInfo['id']);
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }
            $eid = $request->request->get('eid', '');

            $education = (!$entity->getEducationJson()) ? array() : json_decode($entity->getEducationJson(), true);

            ProfileHelper::remove($education, $eid);
            $entity->setEducationJson(json_encode($education));

            $em->persist($entity);
            $em->flush();

            $html = $this->render('@Frontend/Default/_education.html.twig',
                array('educationJson' => json_encode($education)))->getContent();

            return new JsonResponse(array('status' => 200, 'html' => $html));
        }

        return new JsonResponse(array('status' => 400));
    }

    private function getPathCDN(Request $request)
    {
        //return dirname($request->server->get('DOCUMENT_ROOT')) . '/cdn/upload/';
        return dirname($request->server->get('DOCUMENT_ROOT')) . '/web/cdn/upload/';
    }

    private function getPathTempCDN(Request $request)
    {
        //return dirname($request->server->get('DOCUMENT_ROOT')) . '/cdn/upload/';
        return dirname($request->server->get('DOCUMENT_ROOT')) . '/web/cdn/temp/';
    }

    private function getImageFromCdn($filename, $istemp)
    {
        if($istemp) {
            return "cdn/temp/{$filename}";
        }
        return "cdn/upload/{$filename}";
    }

    public function updatePhotoProfileAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $profileInfo = $this->getProfile();
            if (empty($profileInfo)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataSourceBundle:Profile')
                ->find($profileInfo['id']);
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }


            $cdnPath = $this->getPathTempCDN($request);
            //---------------
            $target_file = $cdnPath . basename($_FILES['file']["name"]);

            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES['file']["tmp_name"]);
                if ($check === false) {
                    return new JsonResponse(array('status' => 400, 'msg' => 'file is not an image'));
                }
            }

            // Check file size
            if ($_FILES['file']["size"] > 1000000) {
                return new JsonResponse(array('status' => 400, 'msg' => 'sorry, your file is too large'));
            }
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                return new JsonResponse(array('status' => 400, 'msg' => 'sorry, only JPG, JEPG, GIT files are allow'));
            }

            $genrateFileName = time() . '.' . $imageFileType;
            if (!move_uploaded_file($_FILES['file']["tmp_name"], $cdnPath . $genrateFileName)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'sorry, there was an error uploading your file'));
            }

            //$entity->setPhoto($genrateFileName);
            $newUrl = $this->generateUrl('frontend_profile_view_photo', array('filename' => $genrateFileName, 'size' => '300x300', 'istemp' => 1), UrlGeneratorInterface::ABSOLUTE_URL);

            //$em->persist($entity);
            //$em->flush();

            return new JsonResponse(array('status' => 200, 'filename' => $genrateFileName, 'newurl' => $newUrl, 'mgs' => 'your file has uploaded successful'));
        }

        return new JsonResponse(array('status' => 400));
    }

    public function movePhotoProfileAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $profileInfo = $this->getProfile();
            if (empty($profileInfo)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'session timeout'));
            }
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DataSourceBundle:Profile')
                ->find($profileInfo['id']);
            if (empty($entity)) {
                return new JsonResponse(array('status' => 400, 'msg' => 'profile not found'));
            }

            $filename = $request->request->get('filename', '');
            $source = $this->getPathTempCDN($request);
            $desc = $this->getPathCDN($request);

            if (! rename($source . $filename, $desc . $filename) ) {
                return new JsonResponse(array('status' => 400, 'msg' => 'sorry, there was an error uploading your file'));
            }

            //delete old image
            $oldPhoto = $entity->getPhoto();
            $oldPath = $this->getPathCDN($request) . $oldPhoto;
            if(is_file($oldPath)) {
                unlink($oldPath);
            }

            $entity->setPhoto($filename);
            $newUrl = $this->generateUrl('frontend_profile_view_photo', array('filename' => $filename, 'size' => '300x300'), UrlGeneratorInterface::ABSOLUTE_URL);

            $em->persist($entity);
            $em->flush();

            return new JsonResponse(array('status' => 200, 'filename' => $filename, 'newurl' => $newUrl, 'mgs' => 'your file has uploaded successful'));
        }

        return new JsonResponse(array('status' => 400));
    }

    public function viewPhotoAction(Request $request, $filename, $size, $istemp = 0)
    {
        if($istemp == 0) {
            $path = $this->getImageFromCdn($filename, false);
        } else {
            $path = $this->getImageFromCdn($filename, true);
        }

        if (is_file($path)) {
            // RedirectResponse object
            $imagemanagerResponse = $this->container
                ->get('liip_imagine.controller')
                ->filterAction($request,        // http request
                    $path,       // original image you want to apply a filter to
                    $size  // filter defined in config.yml
                );

            // string to put directly in the "src" of the tag <img>
            $cacheManager = $this->container->get('liip_imagine.cache.manager');
            $srcPath = $cacheManager->getBrowserPath($path, $size);
            $fp = fopen($srcPath, "rb");
            $file = stream_get_contents($fp);
        } else {
            $default = dirname($this->getPathCDN($request)) . '/300x300.png';
            $fp = fopen($default, "rb");
            $file = stream_get_contents($fp);
        }

        $response = new Response($file, 200);
        $response->headers->set('Content-Type', 'image/png');
        return $response;
    }


    public function renderFormSearchAction()
    {
        return $this->render('FrontendBundle:_Partial:_formsearch.html.twig');
    }

    public function renderRecommendProfileAction()
    {
        return $this->render('FrontendBundle:_Partial:_recommendprofile.html.twig');
    }

    public function renderTopFriendsActivitiesAction()
    {
        return $this->render('FrontendBundle:_Partial:_topfriendsactivities.html.twig');
    }
}
