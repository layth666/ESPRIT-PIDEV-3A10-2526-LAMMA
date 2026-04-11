<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @param int $id ID de l'article (ex: ID du RepasDetaille ou Menu)
     * @param float $price Prix unitaire de l'article
     */
    public function add(int $id, float $price = 0.0): void
    {
        $session = $this->requestStack->getSession();
        $cart = $session->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'quantity' => 1,
                'price' => $price
            ];
        }

        $session->set('cart', $cart);
    }

    /**
     * @param int $id
     * @param bool $completely Si vrai, supprime l'article entièrement, sinon décrémente
     */
    public function remove(int $id, bool $completely = false): void
    {
        $session = $this->requestStack->getSession();
        $cart = $session->get('cart', []);

        if (isset($cart[$id])) {
            if ($completely || $cart[$id]['quantity'] <= 1) {
                unset($cart[$id]);
            } else {
                $cart[$id]['quantity']--;
            }
        }

        $session->set('cart', $cart);
    }

    public function getFullCart(): array
    {
        $session = $this->requestStack->getSession();
        return $session->get('cart', []);
    }

    public function clear(): void
    {
        $session = $this->requestStack->getSession();
        $session->remove('cart');
    }

    /**
     * Retourne le total sous forme de chaîne formatée (équivalent exactitude type BigDecimal)
     */
    public function getTotal(): string
    {
        $total = 0.0;
        $cart = $this->getFullCart();
        
        foreach ($cart as $item) {
            $total += ((float)$item['price'] * $item['quantity']);
        }
        
        return number_format($total, 2, '.', '');
    }

    public function countItems(): int
    {
        $count = 0;
        $cart = $this->getFullCart();
        
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        
        return $count;
    }
}
