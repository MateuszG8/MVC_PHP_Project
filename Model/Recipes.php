<?php

class Recipes
{
    protected $nazwa;
    protected $autor;
    protected $kategoria;
    protected $przepis;
    protected $skladniki;
    protected $porcje;
    protected $trudnosc;
    protected $zdjecie;

    function __construct($nazwa, $autor, $kategoria, $przepis, $skladniki, $porcje, $trudnosc, $zdjecie)
    {
        $this->nazwa = $nazwa;
        $this->autor = $autor;
        $this->kategoria = $kategoria;
        $this->przepis = $przepis;
        $this->skladniki = $skladniki;
        $this->porcje = $porcje;
        $this->trudnosc = $trudnosc;
        $this->zdjecie = $zdjecie;
    }

    static public function getAllRecipes($bd)
    {
        $stmt = $bd->select("SELECT przepisy.id, przepisy.nazwa, przepisy.zdjecie, poziom.trudnosc, uzytkownicy.login, przepisy.autor FROM przepisy,uzytkownicy,poziom WHERE przepisy.autor=uzytkownicy.id_uzytk AND przepisy.trudnosc=poziom.id;");
        return $stmt;
    }
    static public function getSearchedRecipes($bd,$word)
    {
        $stmt=$bd->select("SELECT przepisy.id, przepisy.nazwa, przepisy.zdjecie, poziom.trudnosc, uzytkownicy.login, przepisy.autor FROM przepisy,uzytkownicy,poziom WHERE przepisy.nazwa like '%".$word."%' AND przepisy.autor=uzytkownicy.id_uzytk AND przepisy.trudnosc=poziom.id;" );
        return $stmt;
    }
    static public function getCategory($bd,$cat)
    {
        $stmt=$bd->select("SELECT przepisy.id, przepisy.nazwa, przepisy.zdjecie, poziom.trudnosc, uzytkownicy.login, przepisy.autor FROM przepisy,uzytkownicy,poziom WHERE przepisy.autor=uzytkownicy.id_uzytk AND przepisy.trudnosc=poziom.id and przepisy.kategoria like '%".$cat."%';");
        return $stmt;
    }

    static public function showUserRecipes($bd,$id){
        $stmt=$bd->select("SELECT przepisy.id, przepisy.nazwa, przepisy.zdjecie, poziom.trudnosc, uzytkownicy.login, przepisy.autor FROM przepisy,uzytkownicy,poziom WHERE przepisy.autor=uzytkownicy.id_uzytk AND przepisy.trudnosc=poziom.id AND przepisy.autor=".$id.";");
        return $stmt;
    }
    public function addToDB($bd){
        $sql = "INSERT INTO przepisy VALUES (NULL,'$this->nazwa','$this->autor', '$this->kategoria', '$this->przepis', '$this->skladniki','$this->porcje','$this->trudnosc','$this->zdjecie')";
        $bd->insert($sql);
    }
    static public function showRecipebyID($bd,$id){
        $stmt=$bd->select("SELECT * FROM przepisy,uzytkownicy,poziom WHERE przepisy.id=".$id." AND przepisy.autor=uzytkownicy.id_uzytk AND przepisy.trudnosc=poziom.id;");
        return $stmt;
    }
    static public function updateRecipe($bd,$id,$nazwa, $autor, $kategoria, $opis, $skladniki, $porcje, $trudnosc, $zdjecie){
        $bd->insert("UPDATE przepisy SET nazwa='$nazwa', autor='$autor', kategoria='$kategoria', przepis='$opis', skladniki='$skladniki', porcje='$porcje', trudnosc='$trudnosc', zdjecie='$zdjecie' WHERE id='$id';");
    }
    static public function deleteRecipe($bd,$id){
        $bd->delete("Delete from przepisy WHERE id='$id';");
    }
    static public function addOpinion($bd,$autor_id,$id_przepisu,$ocena,$opinia){
        $sql = "INSERT INTO opinie VALUES (NULL,'$id_przepisu','$autor_id', '$ocena', '$opinia');";
        $bd->insert($sql);
    }
    static public function showOpinions($bd,$id){
        $stmt=$bd->select("SELECT * FROM uzytkownicy,opinie WHERE opinie.id_przepisu=".$id." AND opinie.nick=uzytkownicy.id_uzytk;");
        return $stmt;
    }




}