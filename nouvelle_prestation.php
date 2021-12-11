<?php
declare(strict_types=1);
require "autoload.php";

$webPage=new WebPage("Prestation");
$webPage->appendCss(<<<CSS
table {
  table-layout: fixed;
  width: 100%;
  border-collapse: collapse;
}

thead th:nth-child(1) {
  width: 50%;
}

th {
font-weight: bold;
}

th, td {
  padding: 15px;
  border: 1px solid #262626;
}

th input {
    background-color: #C4C4C4;
    width: 100%;
}


CSS);

$html = <<< HTML
<div class="d-flex flex-column align-items-center" style="padding-top: 120px;">
    <div class="d-flex justify-content-center" style="background-color: #262626; width: 80%">
        <h3 class="title" style="background-color: #262626; color: white; font-size: 30px; margin: auto; padding: 22px;">Prestation du 30 Nov.2021 - 15h30</h3> 
    </div>
    <div class="d-flex flex-column" style="background-color: #E3E3E3; width: 80%;">
        <div class="d-flex flex-column" style="padding-left: 60px; padding-right: 60px;  margin-top: 40px; margin-bottom: 40px;">
            <!--MOTIF-->
            <label for="choix_motif" style="font-weight: bold; font-size: 19px; margin-bottom: 1px;">Motif :</label>
            <input list="motifs" type="text" id="choix_motif" style="background-color: #C4C4C4; width: 200px; padding: 8px;">
            <datalist id="motifs">
              <option value="Chirurgie">
              <option value="Consultation">
              <option value="Vaccination">
              <option value="Urgence">
              <option value="Contrôle">
              <option value="Retrait Fils">
              <option value="Autre">
            </datalist>
            <!--DETAILS-->
            <label for="details" style="margin-top: 10px; font-weight: bold; font-size: 19px;margin-bottom: 1px;">Détails :</label>
            <textarea id="details" class="mt-2 form-control md-textarea" rows="6" style="outline: 0; border:0;background-color: #C4C4C4; font-weight: inherit;"></textarea>
            <!--ORDONNANCE-->
            <label for="ordonnance" style="margin-top: 10px; font-weight: bold; font-size: 19px;margin-bottom: 1px;">Ordonnance :</label>
            <textarea id="ordonnance" class="mt-2 form-control md-textarea" rows="6" style="outline: 0; border:0;background-color: #C4C4C4; font-weight: inherit;"></textarea>
            <!--PRESTATION-->
            <p style="margin-top: 10px; font-weight: bold;font-size: 19px;margin-bottom: 1px;">Prestation :</p>
            <div class="d-flex flex-column-reverse" style="background-color: #C4C4C4">
                <table>
                    <thead>
                        <tr style="font-size: 20px;">
                            <th scope="col">Acte ou Produit</th>
                            <th scope="col"">Quantité</th>
                            <th scope="col"">PU.TTC</th>
                            <th scope="col"">Total TTC</th>
                        </tr>
                    </thead>
                    <tbody>
HTML;
$actesOuProduits = ["CONSULTATION_PRE-OPERATOIRE","BILAN_SANGUIN_PRE-OPERATOIRE_CHIEN", "ANESTHESIE_D'INDUCTION_CHIEN_<_50_KG", "CASTRATION_CHIEN", "PREVICOX_227_MG_150_CPS_PRIS_D'UNE_PLAQUETTE", "RETRAIT_DES_FILS"];
for($i=0; $i <10; $i++)
{
    $html.= <<< HTML
    <tr>
        <th scope="row">
            <input list="acte_produit" type="text" id="choix_actes_produits" placeholder="ajouter..." style="">
            <datalist id="acte_produit">
    HTML;
    foreach ($actesOuProduits as $acteOuProduit) {
        $html.="<option value=$acteOuProduit>";
    }
            $html.= <<< HTML
            </datalist>
        </th>
        <td><input style="background-color: #C4C4C4;" type="number" step="0.1" value="1.0" required></td>
        <td>26.00</td>
        <td>26.00</td>
    </tr>
    HTML;
}
$html .= <<< HTML
                    <p style="font-weight: bold; text-align: end; margin: 15px; padding-right: 1%; font-size: 20px;">Total Euros: 247.77</p>
                </table>
            </div>
            <div class="d-flex justify-content-space-between" style="margin-top: 50px;">
            <input type='button' class='button' value='Imprimer la facture' style='padding: 12px 25px; font-size: 18px; '>
            <input type='button' class='button' onclick='showEditMeetingPopup();' value='Payer la prestation' style='padding: 12px 25px; font-size: 18px; '>
            <input type='submit' class='button' value='Valider la prestation' style='padding: 12px 25px; font-size: 18px; '>
            </div>
        </div>
    </div>
</div>
HTML;

$webPage->appendJsUrl("js/meetingUtils.js");
$webPage->appendContent($html);
echo $webPage->toHTML();