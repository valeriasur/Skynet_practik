<?php
class BracketDeleter {

    private string $destination = '';

    private array $brackets = [
        '(' => ')',
        '<' => '>',
        '{' => '}',
        '[' => ']',
    ];

    public function __construct(private string $source) {}

    public function process() {
        $this->destination = $this->source;
        do {
            $original = $this->destination;
            foreach ($this->brackets as $startBracket => $endBracket) {
                $startPos = strpos($this->destination, $startBracket);
                $endPos = strpos($this->destination, $endBracket);
                $startAndEndPos= strpos($this->destination, $startBracket.$endBracket);
                if ($startPos !== false && $endPos !== false && $endPos > $startPos) {
                    $this->destination = substr_replace($this->destination, '', $startPos, $endPos - $startPos + strlen($endBracket));
                }
                elseif ($startAndEndPos !== false){
                    $this->destination = substr_replace($this->destination, '', $startAndEndPos, strlen($startBracket.$endBracket));
                }
            }
        } while ($this->destination !== $original);
    }
    

    public function getResult(): string {
        return $this->destination;
    }
}


