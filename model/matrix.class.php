<?php

class Matrix
{
    protected $lineArray;
    protected $lineCount = 500;
    protected $charArray = ["-", "*", "%", "&", "#", "@", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];
    protected $speed = 75000000;
    protected $screenWidth = 125;

    protected function buildLineArray()
    {
        for ($i=1; $i<=$this->screenWidth; $i++) {
            $this->lineArray[$i] = 1;
        }
    }

    public function enter()
    {
        $this->setColorGreen();
        $this->clearScreen();
        $this->setTerminalWidth();
        $this->fillScreen();
        $this->buildLineArray();

        for ($l=1; $l<=$this->lineCount; $l++) {
            $this->writeLine();
        }

        $this->setColorClear();
    }

    protected function writeCharacter()
    {
        echo $this->charArray[array_rand($this->charArray)];
    }

    protected function writeLine()
    {
        foreach ($this->lineArray as $key => $line) {
            if ($line == 1) {

                $rand = rand(1, 30);

                if ($rand == 1) {
                    $this->setColorLightGreen();
                    $this->writeCharacter();
                    $this->lineArray[$key] = 0;
                    $this->setColorGreen();
                } else {
                    $this->writeCharacter();
                }
            } else {
                echo " ";
                $randTwo = rand(1, 60);

                if ($randTwo == 1) {
                    $this->lineArray[$key] = 1;
                }
            }
        }

        echo "\r";
        echo "\033[T\033[A";
        time_nanosleep(0, $this->speed);
    }

    protected function clearScreen()
    {
        system("clear");
    }

    protected function fillScreen()
    {
        for ($l=1; $l<=50; $l++) {
            for ($i=1; $i<=$this->screenWidth; $i++) {
                echo $this->charArray[array_rand($this->charArray)];
            }

            echo "\r";
            echo "\033[T\033[A";
        }
    }

    protected function setColorClear()
    {
        echo "\033[0m";
    }

    protected function setColorLightGreen()
    {
        echo "\033[1m";
        echo "\033[1;32m";
    }

    protected function setColorGreen()
    {
        echo "\033[0;32m";
    }

    protected function setTerminalWidth()
    {
        $this->screenWidth = system("tput cols");
    }
}
