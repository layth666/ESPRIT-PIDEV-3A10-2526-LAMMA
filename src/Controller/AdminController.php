<?php

namespace App\Controller;

<<<<<<< HEAD
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ParticipationRepository;
use App\Repository\RestaurantRepository;
use App\Entity\Participation;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_dashboard')]
    public function index(
        ParticipationRepository $pr, 
        RestaurantRepository $rr, 
        \App\Repository\AbonnementRepository $ar, 
        \App\Repository\FavoriRepository $fr
    ): Response
    {
        // Calculate platform stats
        $confirmedParticipations = $pr->findByStatut(Participation::STATUT_CONFIRME);
        
        $totalParticipants = 0;
        $totalRevenue = 0;
        foreach ($confirmedParticipations as $p) {
            $totalParticipants += $p->getTotalParticipants();
            $totalRevenue += (float) $p->getMontantCalcule();
        }
        
        $totalRestaurants = count($rr->findAll());

        // Advanced Stats for Google Charts
        $revenueStats = $ar->getRevenueStats();
        $popularityStats = $fr->getPopularityStats();
        
        // Participation timeline (grouped by month)
        $timelineRaw = $pr->createQueryBuilder('p')
            ->select("SUBSTRING(p.dateInscription, 1, 7) as month, COUNT(p.id) as total")
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('admin/dashboard.html.twig', [
            'totalParticipants' => $totalParticipants,
            'totalRestaurants' => $totalRestaurants,
            'totalRevenue' => $totalRevenue,
            'revenueStats' => $revenueStats,
            'popularityStats' => $popularityStats,
            'participationTimeline' => $timelineRaw
        ]);
    }
}
=======
use App\Entity\Post;
use App\Entity\Comment;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class AdminController extends AbstractController
{
#[Route('/admin', name: 'admin_dashboard')]
public function dashboard(PostRepository $postRepository, CommentRepository $commentRepository): Response
{
    $totalPosts = count($postRepository->findAll());
    $totalComments = count($commentRepository->findAll());
    $latestPosts = $postRepository->findBy([], ['createdAt' => 'DESC'], 5);
    $latestComments = $commentRepository->findBy([], ['createdAt' => 'DESC'], 5);
    
    // Get posts with most comments
    $allPosts = $postRepository->findAll();
    $postsWithCommentCount = [];
    foreach ($allPosts as $post) {
        $postsWithCommentCount[] = [
            'post' => $post,
            'comment_count' => count($post->getComments())
        ];
    }
    usort($postsWithCommentCount, function($a, $b) {
        return $b['comment_count'] <=> $a['comment_count'];
    });
    $topPosts = array_slice($postsWithCommentCount, 0, 5);
    
    // Prepare data for chart (last 6 months)
    $months = [];
    $postCounts = [];
    
    for ($i = 5; $i >= 0; $i--) {
        $month = (new \DateTime())->modify("-$i months")->format('M Y');
        $months[] = $month;
        $count = 0;
        foreach ($allPosts as $post) {
            if ($post->getCreatedAt() && $post->getCreatedAt()->format('M Y') === $month) {
                $count++;
            }
        }
        $postCounts[] = $count;
    }
    
    return $this->render('admin/dashboard.html.twig', [
        'total_posts' => $totalPosts,
        'total_comments' => $totalComments,
        'latest_posts' => $latestPosts,
        'latest_comments' => $latestComments,
        'top_posts' => $topPosts,
        'chart_months' => json_encode($months),
        'chart_data' => json_encode($postCounts),
        'total_posts_json' => $totalPosts,
        'total_comments_json' => $totalComments,
    ]);
}

    #[Route('/admin/posts', name: 'admin_posts')]
    public function managePosts(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findBy([], ['createdAt' => 'DESC']);
        
        return $this->render('admin/posts.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/admin/post/{id}/delete', name: 'admin_post_delete', methods: ['POST'])]
    public function deletePost(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('admin_delete_post_' . $post->getId(), $request->request->get('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();
            $this->addFlash('success', 'Post deleted successfully!');
        }
        
        return $this->redirectToRoute('admin_posts');
    }

    #[Route('/admin/comments', name: 'admin_comments')]
    public function manageComments(CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository->findBy([], ['createdAt' => 'DESC']);
        
        return $this->render('admin/comments.html.twig', [
            'comments' => $comments,
        ]);
    }

    #[Route('/admin/comment/{id}/delete', name: 'admin_comment_delete', methods: ['POST'])]
    public function deleteComment(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('admin_delete_comment_' . $comment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($comment);
            $entityManager->flush();
            $this->addFlash('success', 'Comment deleted successfully!');
        }
        
        return $this->redirectToRoute('admin_comments');
    }

    #[Route('/admin/statistics', name: 'admin_stats')]
    public function statistics(PostRepository $postRepository, CommentRepository $commentRepository, ChartBuilderInterface $chartBuilder): Response
    {
        // Posts per month
        $allPosts = $postRepository->findAll();
        $postsPerMonth = [];
        $postsPerMonthArray = [];
        
        foreach ($allPosts as $post) {
            if ($post->getCreatedAt()) {
                $month = $post->getCreatedAt()->format('M Y');
                if (!isset($postsPerMonth[$month])) {
                    $postsPerMonth[$month] = 0;
                }
                $postsPerMonth[$month]++;
            }
        }
        
        // Comments per month
        $allComments = $commentRepository->findAll();
        $commentsPerMonth = [];
        $commentsPerMonthArray = [];
        
        foreach ($allComments as $comment) {
            if ($comment->getCreatedAt()) {
                $month = $comment->getCreatedAt()->format('M Y');
                if (!isset($commentsPerMonth[$month])) {
                    $commentsPerMonth[$month] = 0;
                }
                $commentsPerMonth[$month]++;
            }
        }
        
        // Get last 6 months for chart
        $months = [];
        $postData = [];
        $commentData = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $month = (new \DateTime())->modify("-$i months")->format('M Y');
            $months[] = $month;
            $postData[] = $postsPerMonth[$month] ?? 0;
            $commentData[] = $commentsPerMonth[$month] ?? 0;
        }
        
        // Create line chart for trends
        $trendChart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $trendChart->setData([
            'labels' => $months,
            'datasets' => [
                [
                    'label' => 'Posts',
                    'backgroundColor' => '#f09000',
                    'borderColor' => '#f09000',
                    'data' => $postData,
                    'tension' => 0.1,
                ],
                [
                    'label' => 'Comments',
                    'backgroundColor' => '#1a2f45',
                    'borderColor' => '#1a2f45',
                    'data' => $commentData,
                    'tension' => 0.1,
                ],
            ],
        ]);
        
        $trendChart->setOptions([
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Content Trends (Last 6 Months)',
                ],
            ],
        ]);
        
        // Most active posts
        $activePosts = [];
        foreach ($allPosts as $post) {
            $activePosts[] = [
                'title' => $post->getTitle(),
                'comments' => count($post->getComments())
            ];
        }
        usort($activePosts, function($a, $b) {
            return $b['comments'] <=> $a['comments'];
        });
        $activePosts = array_slice($activePosts, 0, 10);
        
        return $this->render('admin/statistics.html.twig', [
            'posts_per_month' => $postsPerMonth,
            'comments_per_month' => $commentsPerMonth,
            'active_posts' => $activePosts,
            'total_posts' => count($allPosts),
            'total_comments' => count($allComments),
            'trend_chart' => $trendChart,
        ]);
    }
}
>>>>>>> 889c5b1 (Symfony blog project)
