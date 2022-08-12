<?php declare(strict_types = 1);

namespace App\Entity;

class Message
{
    private string $title = 'Achtung';
    private string $text = '';

    public function __construct(string $title = null, string $text = null)
    {
        $this->title = $title ?? $this->title;
        $this->text = $text ?? $this->text;
    }

    public function getTitle(): string
    {
        return str_replace("'", '"', $this->title);
    }

    public function getText(): string
    {
        return str_replace("'", '"', $this->text);
    }
}
