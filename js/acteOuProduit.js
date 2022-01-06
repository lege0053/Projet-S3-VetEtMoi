window.onload = function () {
    document.getElementById('acteOuProduit').onchange = function () {
        charge("PU_TTC.php", this.value, document.getElementById('PU_TTC'));
    }
    document.getElementById('artiste').onchange = function () {
        charge("albums.php", this.value, document.getElementById('album'));
    }
    document.getElementById('album').onchange = function () {
        description(this.value);
    }
}
