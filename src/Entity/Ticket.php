<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ticket_number = null;

    #[ORM\Column]
    private ?int $fare = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTicketNumber(): ?string
    {
        return $this->ticket_number;
    }

    public function setTicketNumber(string $ticket_number): static
    {
        $this->ticket_number = $ticket_number;

        return $this;
    }

    public function getFare(): ?int
    {
        return $this->fare;
    }

    public function setFare(int $fare): static
    {
        $this->fare = $fare;

        return $this;
    }
}
