<?php
require_once "autoload.php";

$p = new WebPage('Prestation Test');
$p->appendJsUrl("js/acteOuProduit.js");
$p->appendJsUrl("js/ajaxrequest.js");

/*******Actes ou produits*********/
$req = MyPDO::getInstance()->prepare(<<<SQL
            SELECT *
            FROM ActeOuProduit
        SQL);
$req->execute();
$req->setFetchMode(PDO::FETCH_CLASS, ActeOuProduit::class);
$actesOuProduits = $req->fetchAll();
if(!$actesOuProduits)
{
    throw new InvalidArgumentException("No ActesOuProduit.");
}

$html = <<< HTML
<label>
  <select id="acteOuProduit" size="5">
  <option>Actes ou Produits...</option>
HTML;
foreach ($actesOuProduits as $acteOuProduit) {
    $html .= "<option value='{$acteOuProduit->getId()}'>{$acteOuProduit->getName()}</option>\n";
}
$html .= "</select>";

/*******Quantité*********/
$html .= <<< HTML
<label>
    <select id="quantité" size="5">
        <option>Quantité...</option>
    </select>
</label>
HTML;

/*******PU.TTC*********/
$html .= <<< HTML
<label>
    <select id="PU_TTC" size="5">
        <option>PU.TTC...</option>
    </select>
    
</label>
HTML;

/*******Total_TTC*********/
$html .= <<< HTML
<label>
    <select id="Total_TTC" size="5">
        <option>Total TTC...</option>
    </select>
</label>
HTML;

$p->appendContent($html);
echo $p->toHTML();