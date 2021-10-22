<?php declare(strict_types=1);

/**
 * Classe WebPage permettant de ne plus écrire l'enrobage HTML lors de la création d'une page Web.
 **/
class WebPage
{
    /**
     * Texte compris entre \<head\> et \</head\>.
     *
     * @var string $head
     */
    private $head = '';

    /**
     * Texte compris entre \<title\> et \</title\>.
     *
     * @var string $title
     */
    private $title = null;

    /**
     * Texte compris entre \<body\> et \</body\>.
     *
     * @var string $body
     */
    private $body = '';

    /**
     * Constructeur.
     *
     * @param string $title Titre de la page
     */
    public function __construct(string $title = null)
    {
        if (!is_null($title)) {
            $this->setTitle($title);
        }
    }

    /**
     * Retourner le contenu de $this->body.
     *
     * @return string
     */
    public function body(): string
    {
        return $this->body;
    }

    /**
     * Retourner le contenu de $this->head.
     *
     * @return string
     */
    public function head(): string
    {
        return $this->head;
    }

    /**
     * Affecter le titre de la page.
     *
     * @param string $title Le titre
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Ajouter un contenu dans $this->head.
     *
     * @param string $content Le contenu à ajouter
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    /**
     * Ajouter un contenu CSS dans head.
     *
     * @param string $css Le contenu CSS à ajouter
     *@see WebPage::appendToHead(string $content) : void
     *
     */
    public function appendCss(string $css): void
    {
        $this->appendToHead(<<<HTML
            <style>
                {$css}
            </style>
        HTML);
    }

    /**
     * Ajouter l'URL d'un script CSS dans head.
     *
     * @param string $url L'URL du script CSS
     *@see WebPage::appendToHead(string $content) : void
     *
     */
    public function appendCssUrl(string $url): void
    {
        $this->appendToHead(<<<HTML
            <link rel="stylesheet" type="text/css" href="{$url}">
        HTML);
    }

    /**
     * Ajouter un contenu JavaScript dans head.
     *
     * @param string $js Le contenu JavaScript à ajouter
     *@see WebPage::appendToHead(string $content) : void
     *
     */
    public function appendJs(string $js): void
    {
        $this->appendToHead(<<<HTML
            <script defer type='text/javascript'>
            {$js}
            </script>
        HTML);
    }

    /**
     * Ajouter l'URL d'un script JavaScript dans head.
     *
     * @param string $url L'URL du script JavaScript
     *@see WebPage::appendToHead(string $content) : void
     *
     */
    public function appendJsUrl(string $url): void
    {
        $this->appendToHead(<<<HTML
            <script defer type='text/javascript' src='{$url}'></script>
        HTML);
    }

    /**
     * Ajouter un contenu dans body.
     *
     * @param string $content Le contenu à ajouter
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    /**
     * Produire la page Web complète.
     *
     * @return string
     *
     * @throws Exception si title n'est pas défini
     */
    public function toHTML(): string
    {
        if (is_null($this->title)) {
            throw new Exception(__CLASS__.': title not set');
        }

        return <<<HTML
        <!doctype html>
        <html lang="fr">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="icon" type="image/png" href="img/logo.png">
                <link rel="stylesheet" type="text/css" href="css/general.css">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                <title>{$this->title}</title>
                {$this->head()}
            </head>
            <body>
                {$this->getHeader()}
                {$this->body}
                {$this->getFooter()}
            </body>
        </html>
        HTML;
    }

    /**
     * Protéger les caractères spéciaux pouvant dégrader la page Web.
     *
     * @param string $string La chaîne à protéger
     *
     * @return string La chaîne protégée
     *
     * @see https://www.php.net/manual/en/function.htmlspecialchars.php
     */
    public static function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'utf-8');
    }

    /**
     * Retourne une icone SVG selon son nom.
     *
     * @param string $iconName
     * @param int $size
     * @return string
     */
    public static function getIcon(string $iconName, int $size = 24) : string {
         return <<<HTML
            <img src="img/svg/icon-$iconName.svg" height="$size" width="$size">
        HTML;
    }

    public static function getHTMLButton(bool $submitType, string $value, string $href=''): string {
        return $submitType ? "<input class='button' type=\"submit\" value=\"$value\">" : "<a class='button' href=\"$href\">$value</a>";
    }

    public static function getHTMLInput(string $title = '', string $inputType = '', string $name='', string $id='', string $placeholder='', string $value='', bool $required=true, bool $hidden=false): string {
        return "<div class='form-input'><label for='$id'>$title</label>
        <input type='$inputType' name='$name' id='$id' value='$value' placeholder='$placeholder' ".($required ? "required ": "").($hidden ? "hidden " : "")."></div>";
    }

    private function getHeader() : string {
        $userHeader = !AbstractUserAuthentication::isUserConnected() ? <<<HTML
            <a class="linkNav m-2 p-2" href="./connexion.php">{$this->getIcon("user")}CONNEXION</a>
            <a class="linkNav m-2 p-2" href="./inscription.php">{$this->getIcon("user")}S'INSCRIRE</a>
        HTML
        : (
            AbstractUserAuthentication::isUserAdmin() ?
                <<< HTML
                    <a class="linkNav m-2 p-2" href="./gestion.php">{$this->getIcon("user")}GESTION</a>
                    <a class="linkNav m-2 p-2" href="./profile.php">{$this->getIcon("user")}MON COMPTE</a>
                HTML
            : <<<HTML
            <a class="linkNav m-2 p-2" href="./profile.php">{$this->getIcon("user")}MON COMPTE</a>
        HTML);

        return <<<HTML
        <img src="img/svg/background-tache.svg" style="position: absolute; z-index: -1;" width="600">
        <nav class="d-flex justify-content-between mb-5">
            <svg class="mr-auto p-3" width="390" height="82" viewBox="0 0 390 82" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.2804 81.375H15.3575C12.3645 81.3763 9.43645 80.5026 6.93354 78.8615C4.43062 77.2204 2.46205 74.8834 1.27003 72.138C0.0780081 69.3927 -0.285465 66.3587 0.224331 63.4095C0.734126 60.4602 2.09495 57.7244 4.13938 55.5384L8.77194 50.5687C11.0087 48.1718 12.2273 45 12.1709 41.7221C12.1145 38.4441 10.7875 35.3161 8.46969 32.9976L3.9185 28.4464C3.38911 27.8983 3.09617 27.1641 3.10279 26.4021C3.10942 25.6401 3.41506 24.9112 3.95391 24.3723C4.49275 23.8335 5.22167 23.5278 5.98368 23.5212C6.74569 23.5146 7.47982 23.8075 8.02794 24.3369L12.5733 28.8881C15.956 32.2721 17.8927 36.8372 17.9751 41.6213C18.0575 46.4053 16.2792 51.0344 13.0151 54.5329L8.3825 59.5026C7.11557 60.8624 6.27295 62.5623 5.95794 64.3939C5.64293 66.2256 5.86922 68.1093 6.60907 69.8142C7.34892 71.5192 8.57018 72.9712 10.1231 73.9922C11.676 75.0133 13.4932 75.559 15.3517 75.5625H18.2754C18.2638 74.3767 18.2696 72.8887 18.3219 71.1915C18.473 66.774 18.9613 60.8278 20.3563 54.8351C21.7513 48.8773 24.0879 42.6405 28.0869 37.8394C31.6499 33.5614 36.4918 30.4866 42.8623 29.7716V12.7061C42.8681 5.69625 48.5585 0 55.5742 0C58.5269 0 60.9217 2.40056 60.9217 5.35913V8.16656H67.763C71.5993 8.16656 75.1507 10.1486 77.1734 13.4094L79.7019 17.4898C84.1252 24.6334 79.3066 33.7881 71.1284 34.3751V72.3424C71.1284 77.3295 67.0888 81.375 62.1016 81.375H58.8873V72.3424C58.8881 70.3519 58.4967 68.3809 57.7355 66.5417C56.9743 64.7026 55.8583 63.0314 54.4511 61.6237C53.0439 60.216 51.3732 59.0993 49.5343 58.3374C47.6955 57.5755 45.7246 57.1834 43.7341 57.1834H38.6308C37.86 57.1834 37.1208 57.4896 36.5757 58.0346C36.0307 58.5796 35.7245 59.3188 35.7245 60.0896C35.7245 60.8604 36.0307 61.5996 36.5757 62.1447C37.1208 62.6897 37.86 62.9959 38.6308 62.9959H43.7341C48.8898 62.9959 53.0748 67.1809 53.0748 72.3424V81.375H21.2804Z" fill="#02897A"/>
                <path d="M132.009 62.6875C130.643 62.6875 129.769 62.0475 129.385 60.7675L116.329 19.8075L116.201 19.2315C116.201 18.8902 116.329 18.5915 116.585 18.3355C116.883 18.0368 117.225 17.8875 117.609 17.8875H125.545C126.142 17.8875 126.633 18.0582 127.017 18.3995C127.443 18.7408 127.721 19.1248 127.849 19.5515L136.937 49.1195L145.961 19.5515C146.089 19.1248 146.345 18.7408 146.729 18.3995C147.155 18.0582 147.667 17.8875 148.265 17.8875H156.265C156.606 17.8875 156.905 18.0368 157.161 18.3355C157.459 18.5915 157.609 18.8902 157.609 19.2315L157.481 19.8075L144.425 60.7675C144.041 62.0475 143.166 62.6875 141.801 62.6875H132.009ZM176.082 63.3275C170.962 63.3275 166.93 61.9408 163.986 59.1675C161.042 56.3942 159.506 52.3622 159.378 47.0715V44.8315C159.549 39.7968 161.106 35.8715 164.05 33.0555C167.037 30.1968 171.026 28.7675 176.018 28.7675C179.645 28.7675 182.695 29.5142 185.17 31.0075C187.687 32.4582 189.565 34.4635 190.802 37.0235C192.082 39.5835 192.722 42.5275 192.722 45.8555V47.3915C192.722 47.8182 192.573 48.2022 192.274 48.5435C191.975 48.8422 191.591 48.9915 191.122 48.9915H170.642V49.4395C170.727 51.4448 171.218 53.0662 172.114 54.3035C173.01 55.5408 174.311 56.1595 176.018 56.1595C177.085 56.1595 177.959 55.9462 178.642 55.5195C179.325 55.0502 179.943 54.4955 180.498 53.8555C180.882 53.3862 181.181 53.1088 181.394 53.0235C181.65 52.8955 182.034 52.8315 182.546 52.8315H190.482C190.866 52.8315 191.186 52.9595 191.442 53.2155C191.741 53.4288 191.89 53.7275 191.89 54.1115C191.89 55.2208 191.25 56.5008 189.97 57.9515C188.733 59.4022 186.919 60.6608 184.53 61.7275C182.141 62.7942 179.325 63.3275 176.082 63.3275ZM181.458 42.6555V42.5275C181.458 40.4368 180.967 38.7942 179.986 37.5995C179.047 36.3622 177.725 35.7435 176.018 35.7435C174.354 35.7435 173.031 36.3622 172.05 37.5995C171.111 38.7942 170.642 40.4368 170.642 42.5275V42.6555H181.458ZM216.901 62.6875C208.069 62.6875 203.653 58.4848 203.653 50.0795V37.7915H198.661C198.192 37.7915 197.786 37.6422 197.445 37.3435C197.146 37.0448 196.997 36.6608 196.997 36.1915V31.0075C196.997 30.5382 197.146 30.1542 197.445 29.8555C197.786 29.5568 198.192 29.4075 198.661 29.4075H203.653V18.8475C203.653 18.3782 203.802 17.9942 204.101 17.6955C204.442 17.3968 204.826 17.2475 205.253 17.2475H212.677C213.146 17.2475 213.53 17.3968 213.829 17.6955C214.128 17.9942 214.277 18.3782 214.277 18.8475V29.4075H222.277C222.746 29.4075 223.13 29.5568 223.429 29.8555C223.77 30.1542 223.941 30.5382 223.941 31.0075V36.1915C223.941 36.6608 223.77 37.0448 223.429 37.3435C223.13 37.6422 222.746 37.7915 222.277 37.7915H214.277V49.1835C214.277 52.3408 215.493 53.9195 217.925 53.9195H222.853C223.322 53.9195 223.706 54.0688 224.005 54.3675C224.304 54.6662 224.453 55.0502 224.453 55.5195V61.0875C224.453 61.5142 224.304 61.8982 224.005 62.2395C223.706 62.5382 223.322 62.6875 222.853 62.6875H216.901ZM246.456 63.3275C241.421 63.3275 237.432 62.1542 234.488 59.8075C231.544 57.4608 230.072 54.2608 230.072 50.2075C230.072 47.6048 230.819 45.3222 232.312 43.3595C233.805 41.3968 235.939 39.6262 238.712 38.0475C237.091 36.2982 235.917 34.6768 235.192 33.1835C234.509 31.6475 234.168 30.0902 234.168 28.5115C234.168 26.4635 234.701 24.5862 235.768 22.8795C236.835 21.1728 238.413 19.8075 240.504 18.7835C242.595 17.7595 245.112 17.2475 248.056 17.2475C250.787 17.2475 253.155 17.7595 255.16 18.7835C257.208 19.7648 258.744 21.1088 259.768 22.8155C260.835 24.4795 261.368 26.3142 261.368 28.3195C261.368 30.7942 260.621 32.9275 259.128 34.7195C257.635 36.4688 255.416 38.1968 252.472 39.9035L260.088 47.5195C260.771 46.4102 261.347 45.3435 261.816 44.3195C262.328 43.2528 262.84 41.8662 263.352 40.1595C263.523 39.5622 263.971 39.2635 264.696 39.2635H271.16C271.501 39.2635 271.8 39.3915 272.056 39.6475C272.312 39.8608 272.44 40.1382 272.44 40.4795C272.397 41.9728 271.693 43.9995 270.328 46.5595C269.005 49.1195 267.533 51.3808 265.912 53.3435L273.08 60.5755C273.379 60.9595 273.528 61.2795 273.528 61.5355C273.528 61.8768 273.4 62.1542 273.144 62.3675C272.931 62.5808 272.653 62.6875 272.312 62.6875H263.608C262.925 62.6875 262.371 62.4742 261.944 62.0475L259.064 59.2955C255.779 61.9835 251.576 63.3275 246.456 63.3275ZM247.032 34.0155C248.739 33.1622 250.019 32.3302 250.872 31.5195C251.768 30.7088 252.216 29.7488 252.216 28.6395C252.216 27.4875 251.811 26.5702 251 25.8875C250.232 25.1622 249.251 24.7995 248.056 24.7995C246.947 24.7995 245.965 25.1622 245.112 25.8875C244.301 26.6128 243.896 27.5515 243.896 28.7035C243.896 29.4715 244.131 30.2822 244.6 31.1355C245.112 31.9462 245.923 32.9062 247.032 34.0155ZM246.456 55.1995C249.101 55.1995 251.299 54.4102 253.048 52.8315L244.536 44.3195C241.72 45.8128 240.312 47.6262 240.312 49.7595C240.312 51.3808 240.931 52.7035 242.168 53.7275C243.405 54.7088 244.835 55.1995 246.456 55.1995ZM282.116 62.6875C281.689 62.6875 281.305 62.5382 280.964 62.2395C280.665 61.8982 280.516 61.5142 280.516 61.0875V19.4875C280.516 19.0182 280.665 18.6342 280.964 18.3355C281.305 18.0368 281.689 17.8875 282.116 17.8875H289.028C290.052 17.8875 290.799 18.3568 291.268 19.2955L302.532 39.4555L313.796 19.2955C314.265 18.3568 315.012 17.8875 316.036 17.8875H322.884C323.353 17.8875 323.737 18.0368 324.036 18.3355C324.377 18.6342 324.548 19.0182 324.548 19.4875V61.0875C324.548 61.5568 324.377 61.9408 324.036 62.2395C323.737 62.5382 323.353 62.6875 322.884 62.6875H315.268C314.799 62.6875 314.393 62.5382 314.052 62.2395C313.753 61.9408 313.604 61.5568 313.604 61.0875V37.0875L306.436 50.4635C305.881 51.4448 305.135 51.9355 304.196 51.9355H300.868C300.313 51.9355 299.865 51.8075 299.524 51.5515C299.183 51.2955 298.884 50.9328 298.628 50.4635L291.396 37.0875V61.0875C291.396 61.5142 291.247 61.8982 290.948 62.2395C290.649 62.5382 290.265 62.6875 289.796 62.6875H282.116ZM349.836 63.3275C344.545 63.3275 340.471 62.0688 337.612 59.5515C334.753 57.0342 333.196 53.4928 332.94 48.9275C332.897 48.3728 332.876 47.4128 332.876 46.0475C332.876 44.6822 332.897 43.7222 332.94 43.1675C333.196 38.6448 334.796 35.1248 337.74 32.6075C340.684 30.0475 344.716 28.7675 349.836 28.7675C354.999 28.7675 359.052 30.0475 361.996 32.6075C364.94 35.1248 366.54 38.6448 366.796 43.1675C366.839 43.7222 366.86 44.6822 366.86 46.0475C366.86 47.4128 366.839 48.3728 366.796 48.9275C366.54 53.4928 364.983 57.0342 362.124 59.5515C359.265 62.0688 355.169 63.3275 349.836 63.3275ZM349.836 55.5195C351.713 55.5195 353.1 54.9648 353.996 53.8555C354.892 52.7035 355.404 50.9542 355.532 48.6075C355.575 48.1808 355.596 47.3275 355.596 46.0475C355.596 44.7675 355.575 43.9142 355.532 43.4875C355.404 41.1835 354.871 39.4555 353.932 38.3035C353.036 37.1515 351.671 36.5755 349.836 36.5755C346.295 36.5755 344.417 38.8795 344.204 43.4875L344.14 46.0475L344.204 48.6075C344.289 50.9542 344.78 52.7035 345.676 53.8555C346.615 54.9648 348.001 55.5195 349.836 55.5195ZM376.033 24.6075C375.564 24.6075 375.18 24.4582 374.881 24.1595C374.582 23.8608 374.433 23.4768 374.433 23.0075V17.2475C374.433 16.7782 374.582 16.3942 374.881 16.0955C375.18 15.7968 375.564 15.6475 376.033 15.6475H383.713C384.182 15.6475 384.566 15.7968 384.865 16.0955C385.164 16.3942 385.313 16.7782 385.313 17.2475V23.0075C385.313 23.4768 385.164 23.8608 384.865 24.1595C384.566 24.4582 384.182 24.6075 383.713 24.6075H376.033ZM376.097 62.6875C375.628 62.6875 375.244 62.5382 374.945 62.2395C374.646 61.9408 374.497 61.5568 374.497 61.0875V31.0075C374.497 30.5382 374.646 30.1542 374.945 29.8555C375.244 29.5568 375.628 29.4075 376.097 29.4075H383.649C384.118 29.4075 384.502 29.5568 384.801 29.8555C385.1 30.1542 385.249 30.5382 385.249 31.0075V61.0875C385.249 61.5142 385.1 61.8982 384.801 62.2395C384.502 62.5382 384.118 62.6875 383.649 62.6875H376.097Z" fill="#02897A"/>
            </svg>
            <a class="linkNav m-2 p-2" href="./accueil.php">ACCUEIL</a>
            <a class="linkNav m-2 p-2" href="./activites.php">ACTIVITES</a>
                <a class="linkNav m-2 p-2" href="./conseils.php">CONSEILS</a>
            <a class="linkNav m-2 p-2" href="./boutique.php">BOUTIQUE</a>
            $userHeader
        </nav>
        HTML;
    }

    private function getFooter() : string {
        return <<<HTML
            <footer class="footer" style="background-color: #242424; color: #E2E2E2">
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-md-3 col-sm-6">
                    <!--Column1-->
                    <div class="mt-5 mb-5">
                      <h4>Nous Contacter</h4>
                      <ul class="list-unstyled">
                        <li><a href="tel:+33325563596" style="text-decoration: none; color: #02897A">03 25 56 35 96</a> </li>
                        <li>contact@vetetmoi.fr</li>
                      </ul>
                    </div>
                  </div>
                    <div class="mt-5 mb-5">
                        <h4>Nos Réseaux</h4>
                        <a href="#">{$this->getIcon("instagram")}</a>
                        <a href="#">{$this->getIcon("youtube")}</a>
                        <a href="#">{$this->getIcon("twitter")}</a></li>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="border-top: 1px solid #E2E2E2; padding: 10px;font-size: 12px;">
                        <p class="text-center">&copy; Copyright 2021 - Vet&Moi.  Tous droits réservés.</p>
                    </div>
                </div>
              </div>
            </footer>
        HTML;
    }
}
