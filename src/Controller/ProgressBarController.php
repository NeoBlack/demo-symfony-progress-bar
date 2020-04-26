<?php /** @noinspection ContractViolationInspection */

namespace App\Controller;

use App\Repository\ProgressDemoRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgressBarController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('progress_bar/index.html.twig', [
            'controller_name' => self::class
        ]);
    }

    /**
     * @Route("/progress/simulation", name="progress_simulation")
     * @return JsonResponse
     * @throws Exception
     */
    public function simulation(ProgressDemoRepository $progressDemoRepository): JsonResponse
    {
        $total = count($progressDemoRepository->findAll());
        foreach ($progressDemoRepository->findBy(['updated' => 0], null, 10) as $nextRecord) {
            $nextRecord->setUpdated(1);
            $progressDemoRepository->persist($nextRecord);
        }
        sleep(random_int(0, 4));
        $updated = count($progressDemoRepository->findBy(['updated' => 1]));
        return $this->json([
            'total' => $total,
            'updated' => $updated,
            'progress' => $updated > $total ? 1 : $updated / $total
        ]);
    }
}
