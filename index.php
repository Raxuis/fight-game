<?php
if (!empty($_GET)) {
    if (!empty($_GET['name_1']) && !empty($_GET['name_2'])) {
        class Warrior
        {
            private $life;
            private $name;
            private $hits;

            public function hit($warrior)
            {
                $warrior->life -= rand(40, 60);
                $warrior->hits += 1;
            }
            private function hydrate(array $warriorInfos)
            {
                if (is_array($warriorInfos) && count($warriorInfos)) {
                    foreach ($warriorInfos as $key => $value) {
                        $method = 'set' . ucfirst($key);
                        if (method_exists($this, $method)) {
                            $this->$method($value);
                        }
                    }
                }
            }

            public function setLife($data)
            {
                $this->life = $data;
            }
            public function setHits($data)
            {
                $this->hits = $data;
            }
            public function setName($data)
            {
                $this->name = $data;
            }
            public function getName()
            {
                return $this->name;
            }
            public function getLife()
            {
                return $this->life;
            }
            public function getHits()
            {
                return $this->hits;
            }
            public function __construct($warriorInfos = array())
            {
                $this->hydrate($warriorInfos);
            }
            public function __destruct()
            {
            }
        }

        $warriorsInfos1 = [
            'life' => rand(100, 200),
            'name' => $_GET['name_1'],
            'hits' => 0
        ];
        $warriorsInfos2 = [
            'life' => rand(100, 200),
            'name' => $_GET['name_2'],
            'hits' => 0
        ];

        function hitText($warrior1, $warrior2)
        {
            echo '<p>' . ucfirst($warrior1->getName()) . ' hit ' . ucfirst($warrior2->getName()) . ' (' . ($warrior2->getLife() > 0 ? $warrior2->getLife() : 0) . ' hp) 🤜' . '</p>';
        }
        function deathText($warrior)
        {
            echo '<p>' . ucfirst($warrior->getName()) . ' is dead in ' . $warrior->getHits() . ' hits.💀' . '</p>';
            echo '<a href="index.php" class="text-blue-500 hover:text-blue-300">Go back</a>';
        }

        $warrior1 = new Warrior($warriorsInfos1);
        $warrior2 = new Warrior($warriorsInfos2);
        while ($warrior1->getLife() > 0 && $warrior2->getLife() > 0) {
            $warrior1->hit($warrior2);
            hitText($warrior1, $warrior2);
            if ($warrior2->getLife() <= 0) {
                deathText($warrior2);
                break;
            }
            $warrior2->hit($warrior1);
            hitText($warrior2, $warrior1);
            if ($warrior1->getLife() <= 0) {
                deathText($warrior1);
                break;
            }

        }

    } else {
        header('location: index.php');
        exit();
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/ico" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Raphaël | Fight Game</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon" />
</head>

<body>
    <main>
        <?php if (!isset($_GET['name_1']) || !isset($_GET['name_2'])) { ?>
            <div class="flex items-center flex-col p-10">
                <h1 class="text-3xl font-bold ">
                    Fight Game made by <a href="https://github.com/Raxuis" target="_blank" rel="noopener noreferrer"
                        class="text-blue-500 hover:text-blue-300">
                        Raphaël | Raxuis 👋
                    </a>
                </h1>
                <form action="" method="get" class="flex items-center flex-col gap-3">
                    <div class="pt-3">
                        <label class="block text-white text-sm font-bold mb-2" htmlFor="name">
                            Player 1 name:
                        </label>
                        <input id="name" type="text" name="name_1"
                            class="block w-full px-3 py-2 mt-1 text-base text-white-900 bg-white border border-gray-300 rounded-md dark:bg-gray-700" />
                    </div>
                    <div class="pt-3">
                        <label class="block text-white text-sm font-bold mb-2" htmlFor="name">
                            Player 2 name:
                        </label>
                        <input id="name" type="text" name="name_2"
                            class="block w-full px-3 py-2 mt-1 text-base text-white-900 bg-white border border-gray-300 rounded-md dark:bg-gray-700" />
                    </div>
                    <button type="submit"
                        class="block w-full px-3 py-2 mt-4 text-base font-medium text-white bg-blue-700 rounded-md border border-blue-700  hover:bg-blue-800  focus:ring">Valider</button>
        </main>
    <?php } ?>