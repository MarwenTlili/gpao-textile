<?php
namespace App\Controller\Admin;

use App\Repository\PlanningHebdomadaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("is_granted('ROLE_GERANT')")
 */
class ReliquatsController extends AbstractController{
    private $planningHebdomadaireRepository;
    private $pourcentageReliquat = 5;

    public function __construct(PlanningHebdomadaireRepository $planningHebdomadaireRepository){
        $this->planningHebdomadaireRepository = $planningHebdomadaireRepository;
    }

    /**
     * @Route("/admin/reliquats", name="admin_planning_hebdomadaire_reliquats")
     */
    public function reliquats(Request $request, PaginatorInterface $paginator){
        
        $reliquats = new ArrayCollection();
        $toutLesPlanning = $this->planningHebdomadaireRepository->findAll();

        foreach ($toutLesPlanning as $key => $planning) {
            $aProduire = $planning->getOrdreFabrication()->getQteTotal();
            $somme = 0;
            $rest = 0;
            foreach ($planning->getProductionJournalier() as $key => $productionJournalier) {
                $somme += $productionJournalier->getQuantitePremiereChoix()+$productionJournalier->getQuantiteDeuxiemeChoix();
            }

            $rest = $aProduire - $somme;
            $seuil = round(($somme * $this->pourcentageReliquat) / 100);
            dump("aProduire: {$aProduire};produit: {$somme}; rest: {$rest}; seil: {$seuil}");

            if ( ($rest > $seuil) && ($planning->getEndAt() < new \DateTime('now')) ) {
                $reliquats[] = $planning;
            }
        }

        dump($reliquats);

        $pagination = $paginator->paginate(
            $reliquats, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            1 /*limit per page*/,
        );
        
        return $this->render('admin/reliquats.html.twig', [
            'plannings_hebdomadaire' => $pagination,
            'getTotalItemCount' => $reliquats->count()
        ]);
    }
}