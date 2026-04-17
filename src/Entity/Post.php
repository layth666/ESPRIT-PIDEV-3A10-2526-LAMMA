<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\Table(name: 'posts')]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le titre ne peut pas être vide.")]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: "Le titre doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le titre ne peut pas dépasser {{ limit }} caractères."
    )]
    #[Assert\Regex(
        pattern: "/^[a-zA-Z0-9\s\p{P}]+$/u",
        message: "Le titre contient des caractères non autorisés."
    )]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "Le contenu ne peut pas être vide.")]
    #[Assert\Length(
        min: 10,
        max: 5000,
        minMessage: "Le contenu doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le contenu ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $content = null;

    #[ORM\Column(name: 'created_at', nullable: true)]
    private ?\DateTime $createdAt = null;

    #[ORM\Column(type: 'json', nullable: true)]
    private array $reactions = [];

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'post', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->reactions = [
            '👍' => 0,
            '❤️' => 0,
            '😂' => 0,
            '😮' => 0,
            '😢' => 0,
            '😡' => 0
        ];
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;
        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getReactions(): array
    {
        if ($this->reactions === null) {
            $this->reactions = [
                '👍' => 0,
                '❤️' => 0,
                '😂' => 0,
                '😮' => 0,
                '😢' => 0,
                '😡' => 0
            ];
        }
        return $this->reactions;
    }

    public function setReactions(?array $reactions): static
    {
        if ($reactions === null) {
            $reactions = [
                '👍' => 0,
                '❤️' => 0,
                '😂' => 0,
                '😮' => 0,
                '😢' => 0,
                '😡' => 0
            ];
        }
        $this->reactions = $reactions;
        return $this;
    }

    public function addReaction(string $emoji): static
    {
        $reactions = $this->getReactions();
        if (!isset($reactions[$emoji])) {
            $reactions[$emoji] = 0;
        }
        $reactions[$emoji]++;
        $this->reactions = $reactions;
        return $this;
    }

    public function removeReaction(string $emoji): static
    {
        $reactions = $this->getReactions();
        if (isset($reactions[$emoji]) && $reactions[$emoji] > 0) {
            $reactions[$emoji]--;
        }
        $this->reactions = $reactions;
        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setPost($this);
        }
        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }
        return $this;
    }
}