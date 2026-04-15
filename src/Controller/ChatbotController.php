<?php

namespace App\Controller;

use App\Service\ScoutChatbotService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChatbotController extends AbstractController
{
    #[Route('/api/chatbot/ask', name: 'app_api_chatbot_ask', methods: ['POST'])]
    public function ask(Request $request, ScoutChatbotService $chatbotService): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $message = $data['message'] ?? '';

        if (empty($message)) {
            return $this->json(['error' => 'Message vide'], 400);
        }

        $response = $chatbotService->getAiResponse($message);

        return $this->json([
            'response' => $response,
            'time' => (new \DateTime())->format('H:i')
        ]);
    }
}
