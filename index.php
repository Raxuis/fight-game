<?php
class Warrior
{
    private $life;
    private $name;
    private $damage;

    public function hit($warrior)
    {
        $warrior->life -= rand(40, 60);
        $warrior->damage += 1;
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
    public function setDamage($data)
    {
        $this->damage = $data;
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
    public function getDamage()
    {
        return $this->damage;
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
    'name' => 'Kobe',
    'damage' => 0
];
$warriorsInfos2 = [
    'life' => rand(100, 200),
    'name' => 'MJ',
    'damage' => 0
];
$warrior1 = new Warrior($warriorsInfos1);
$warrior2 = new Warrior($warriorsInfos2);
while ($warrior1->getLife() > 0 && $warrior2->getLife() > 0) {
    $warrior1->hit($warrior2);
    if ($warrior2->getLife() <= 0) {
        echo '<p>' . $warrior2->getName() . ' is dead in ' . $warrior2->getDamage() . ' damages.💀' . '</p>';
        unset($warrior2);
        break;
    }
    echo '<p>' . $warrior1->getName() . ' hit ' . $warrior2->getName() . ' (' . $warrior2->getLife() . ' hp) 🤜' . '</p>';
    $warrior2->hit($warrior1);
    if ($warrior1->getLife() <= 0) {
        echo '<p>' . $warrior1->getName() . ' is dead in ' . $warrior1->getDamage() . ' damages.💀' . '</p>';
        unset($warrior1);
        break;

    }
    echo '<p>' . $warrior2->getName() . ' hit ' . $warrior1->getName() . ' (' . $warrior1->getLife() . ' hp) 🤜' . '</p>';
} ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/ico" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Raphaël | Fight Game</title>
</head>

<body>
    <main>
        <div className="pt-6">
            <h1 className="text-center text-3xl font-bold">
                Fight Game made by <a href="https://github.com/Raxuis" target="_blank" rel="noopener noreferrer">
                    Raphaël | Raxuis 👋
                </a>
            </h1>
        </div>
    </main>