<?php

namespace ukf;

class Menu
{
    private $sourceFileName = "source/headerMenu.json";

    public function getMenuData(string $type): array
    {
        $menu = [];

        if ($this->validateMenuType($type)) {
            if ($type === "header") {
                try {
                    $menuJsonFile = file_get_contents($this->sourceFileName);
                    $menu = json_decode($menuJsonFile, true);
                } catch (\Exception $exception) {
                    //echo $exception->getMessage();
                }
            }
        }

        return $menu;
    }

    public function printMenu(array $menu)
    {
        foreach ($menu as $menuName => $menuData) {
            echo '<li><a href="' . $menuData['path'] . '">' . $menuData['name'] . '</a></li>';
        }
    }

    private function validateMenuType(string $type): bool
    {
        $menuTypes = [
            'header',
            'footer'
        ];

        if (in_array($type, $menuTypes)) {
            return true;
        } else {
            return false;
        }
    }


    public function preparePortfolio(int $numberOfRows = 2, int $numberOfCols = 4): array
    {
        $portfolio = [];
        $colIndex = 1;

        for ($i = 1; $i <= $numberOfRows; $i++) {
            for ($j = 1; $j <= $numberOfCols; $j++) {
                $portfolio[$i][] = $colIndex;
                $colIndex++;
            }
        }

        return $portfolio;
    }

    private function parseFile($csv_file)
    {
        $file =
            fopen("...", "r");
        fgets($file); // Načítame prvý riadok ale nepotrebujeme ho takže si to neuložíme nikde
        $line = fgets($file);
        while ($line != "") {
            $line = explode(",", $line);
            $line[0]; // -> prvy udaj
            $line[1]; // -> druhy udaj
            $line[3]; // -> treti (asi path)
            // Další riadok
            $line = fgets($file);
        }
    }
}
?>