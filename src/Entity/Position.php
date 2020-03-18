<?php

namespace App\Entity;

class Position
{
    private const PLAY_PLAY_STATUS = 'play';
    private const BENCH_PLAY_STATUS = 'bench';

    private string $name;
    private string $fullName = '';
    private array $players;
    private int $playTime;
    private int $inMinute;
    private int $outMinute;

    public function __construct(string $name, array $players)
    {
        $this->name = $name;
        $this->players = $players;
        $this->playTime = 0;
        $this->inMinute = 0;
        $this->outMinute = 0;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFullName(): string
    {
        switch ($this->name) {
            case 'В':
                $this->fullName = 'Вратарь';
                break;
            case 'З':
                $this->fullName = 'Защитник';
                break;
            case 'П':
                $this->fullName = 'Полузащитник';
                break;
            case 'Н':
                $this->fullName = 'Нападающий';
                break;
        }
        return $this->fullName;
    }

    public function getInMinute(): int
    {
        return $this->inMinute;
    }

    public function getOutMinute(): int
    {
        return $this->outMinute;
    }

    public function getPlayTime(): int
    {
        return $this->playTime;
    }

    public function goToPlay(int $minute): void
    {
        $isPlay = 0;
        foreach ($this->players as $player) {
            if ($player->isPlay()) {
                $isPlay++;
            }
        }
        if ($isPlay === 0) {
            $this->inMinute = $minute;
        }
    }

    public function goToBench(int $minute): void
    {
        $isPlay = 0;
        foreach ($this->players as $player) {
            if ($player->isPlay()) {
                $isPlay++;
            }
        }
        if ($isPlay === 0) {
            $this->outMinute = $minute;
            $this->playTime += $this->outMinute - $this->inMinute + 1;
        }
    }

}