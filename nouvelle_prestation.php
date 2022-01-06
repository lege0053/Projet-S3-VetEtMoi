<?php
declare(strict_types=1);
require "autoload.php";
$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected() )
    header("Location: connexion.php");
if(!$auth->getUser()->isVeto()) {
    header("Location: accueil.php");
}
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

$webPage->appendJs(<<<JS

    window.onload = function() {
        addProduct();
    }

    let products = 0;

    function updateTotalPrice(){
        let prices = document.getElementsByClassName('productPrice');
        console.log(prices);
        let price = 0.0;
        for(let i = 0; i < prices.length; i++) {
            price += parseFloat(prices[i].innerText);
        }
        
        document.getElementById('total_price').innerText = price;
        
    }

    function addProduct(){
        products++;
        
        let tr = document.createElement('tr');
        let th = document.createElement('th');
        let thInput = document.createElement('input');
        let td1 = document.createElement('td');
        let tdInput = document.createElement('input');
        let td2 = document.createElement('td');
        let td3 = document.createElement('td');
        
        th.scope = 'row';
        thInput.setAttribute('list', 'productDatalist')
        thInput.type = 'text';
        thInput.name = 'acte_produit_select-' + products;
        thInput.id = 'product-' + products;
        thInput.placeholder = 'Ajouter...';
        thInput.addEventListener("input", function(event){
            if(event.inputType == "insertReplacementText" || event.inputType == null) {
                let product = this;
                let ajaxRequest = new AjaxRequest({
                    url: "api/getProductInformation.php",
                    method: 'get',
                    handleAs: 'json',
                    parameters: {
                        productName: product.value
                    },
                    onSuccess: function (res) {
                        if(!res['error']){
                            tdInput.disabled = false;
                            tdInput.value = 0;
                            td2.innerText = res[0]['PU_TTC'];
                            td3.innerText = '0.0';
                            updateTotalPrice();
                            addProduct();
                        }
                        else{
                            tdInput.disabled = true;
                        }
                    },
                    onError: function (status, message) {
                    }
                });
            }
        });
        
        tdInput.style.backgroundColor = '#C4C4C4';
        tdInput.style.width = '100%';
        tdInput.type = 'number';
        tdInput.step = '0.1';
        tdInput.value = 0;
        tdInput.required = false;
        tdInput.disabled = true;
        tdInput.id = 'productQuantity-' + products;
        tdInput.onchange = function() {
            let PU = td2.innerText;
            td3.innerText = Math.round((PU * this.value)*100)/100.0;
            updateTotalPrice();
        };
        
        td2.innerText = '0.0';
        td3.innerText = '0.0';
        td3.className = 'productPrice';
        
        tr.appendChild(th);
        th.appendChild(thInput);
        tr.appendChild(td1);
        td1.appendChild(tdInput);
        tr.appendChild(td2);
        tr.appendChild(td3);
        document.getElementById('Presta-tbody').appendChild(tr);
    }
JS);

//RECUPERATION DES ACTES ET DES PRODUITS
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

$dataList = "";
foreach ($actesOuProduits as $acteOuProduit) {
    $dataList.="<option id=\"productId-{$acteOuProduit->getId()}\" value={$acteOuProduit->getName()}>";
}

$webPage->appendContent(<<< HTML
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
                <datalist id="productDatalist">
                    $dataList
                </datalist>
                <table>
                    <thead>
                        <tr style="font-size: 20px;">
                            <th scope="col">Acte ou Produit</th>
                            <th scope="col"">Quantité</th>
                            <th scope="col"">PU.TTC</th>
                            <th scope="col"">Total TTC</th>
                        </tr>
                    </thead>
                    <tbody id="Presta-tbody">
                    </tbody>
                    <p style="font-weight: bold; text-align: end; margin: 15px; padding-right: 1%; font-size: 20px;">Total Euros: <span id="total_price">0.0</span></p>
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
HTML);

echo $webPage->toHTML();