<?php /** @noinspection ContractViolationInspection */

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
     * @param SessionInterface $session
     * @return JsonResponse
     * @throws Exception
     */
    public function simulation(SessionInterface $session): JsonResponse
    {
        $runner = 'progress-simulation';
        $total = 100;
        $running = $session->get($runner);
        if ($running === null) {
            $running = 1;
            $session->set($runner, $running);
        }
        if ($running < $total) {
            $running += random_int(0, 10);
            $session->set($runner, $running);
        }
        if ($running >= $total) {
            $session->set($runner, null);
        }
        return $this->json([
            'total' => $total,
            'current' => $running,
            'progress' => $running > $total ? 1 : $running / $total
        ]);
    }
}
