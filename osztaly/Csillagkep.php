<?php 

namespace osztaly;

class Csillagkep {

    private string $latinNev;
    private string $rovidites;
    private string $magyarNev;
    private float $terulet;

    public function __construct(string $latinNev, string $rovidites, string $magyarNev, float $terulet){
        $this->latinNev = $latinNev;
        $this->rovidites = $rovidites;
        $this->magyarNev = $magyarNev;
        $this->terulet = $terulet;
    }

    public function getLatinNev() : string {
        return $this->latinNev;
    }

    public function getRovidites() : string {
        return $this->rovidites;
    }

    public function getMagyarNev() : string {
        return $this->magyarNev;
    }

    public function getTerulet() : float {
        return $this->terulet;
    }

}