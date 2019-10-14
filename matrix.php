<?php

/**
 * Class Matrix
 */
class Matrix
{
    protected $charArray = [
        "- ", "* ", "% ", "& ", "# ", "@ ", "1 ", "2 ", "3 ", "4 ", "5 ", "6 ", "7 ", "8 ", "9 ", "0 ",
        "ア", "ィ", "イ", "ゥ", "ウ", "ェ", "エ", "ォ", "オ", "カ", "ガ", "キ", "ギ", "ク", "グ", "ケ", "ゲ", "コ",
        "ゴ", "サ", "ザ", "シ", "ジ", "ス", "ズ", "セ", "ゼ", "ソ", "ゾ", "タ", "ダ", "チ", "ヂ", "ッ", "ツ", "ヅ", "テ"
    ];
    protected $colorArray = ["22", "28"];
    protected $lineArray;
    protected $lineCount = 750;
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
        $this->setColorGreens();
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
            if ($line == 1 || $line == 2) {

                if ($line == 2) {
                    $this->setColorLightGreen();
                    $this->writeCharacter();
                    $this->lineArray[$key] = 1;
                    $this->setColorGreens();
                } else {
                    $this->writeCharacter();
                }

                $rand = rand(1, 30);

                if ($rand == 1) {
                    $this->lineArray[$key] = 0;
                }

            } else {
                echo "  ";
                $randTwo = rand(1, 60);

                if ($randTwo == 1) {
                    $this->lineArray[$key] = 2;
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
        echo "\033[38;5;15m";
    }

    protected function setColorGreens()
    {
        $colorCode = $this->colorArray[array_rand($this->colorArray)];
        echo "\033[38;5;".$colorCode."m";
    }

    protected function setTerminalWidth()
    {
        $this->screenWidth = system("tput cols");
    }
}
